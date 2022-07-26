import Ajax from "../Base/Ajax";
import BaseGui from "../Base/BaseGui";
import Selector from "../Base/Selector";
import FormBet from "./Games/FormBet";
import GameChoose from "./Games/GameChoose";
import GameSelect from "./Games/GameSelect";
import LottoGlobal from "./LottoGlobal";

export default class LottoUi {
    constructor(
        private formbet: FormBet,
        private gameChoose: GameChoose,
        private gameSelect: GameSelect
    ) { }
    init() {
        this.initEvents();
        this.showQuestion();
    }


    initEvents() {
        this.initEventCategoryChange();
        this.initEventTypeChange();
    }
    initEventCategoryChange() {
        let self = this;
        let typeGames = Selector.all(".item_type_game input");
        typeGames.forEach((typeGame: any) => {
            typeGame.addEventListener(
                "change",
                async function (e: any) {
                    BaseGui.showLoading();
                    let input = this;
                    let parent = this.parentElement;
                    let type = input ? input.value : 0;

                    let content: any = await self.getGameContent(type);
                    await self.getChoosenNumber(type);

                    let target = Selector._(parent.getAttribute("data-target"));
                    let otherpanels =
                        target.parentElement.querySelectorAll(
                            ":scope > .panel"
                        );
                    otherpanels.forEach(function (otherpanel: any, i: number) {
                        otherpanel.innerHTML = "";
                    });

                    target.innerHTML = content.html;
                    self.updateAfterGetGameContent();
                    BaseGui.hideLoading();
                },
                false
            );
        });
        if (typeGames.length > 0) {
            var input = typeGames[0];
            var eventInit = new Event("change");
            input.dispatchEvent(eventInit);
        }
    }
    updateAfterGetGameContent() {
        this.formbet.updateBoxTitle();
        this.formbet.changeHtmlPreview();
    }
    initEventTypeChange() {
        let self = this;
        Selector.on(
            "change",
            ".type_js.nav-item input[name=type]",
            function (e: any) {
                self.clearChoosenItem();
                self.formbet.updateBoxTitle();
            }
        );
    }
    private clearChoosenItem() {
        this.gameChoose.removeChoosen();
        this.gameSelect.removeChoosen();
    }
    getGameContent(typeGame: number) {
        return Ajax.get("get-game-lotto-content", { typeGame });
    }
    async getChoosenNumber(typeGame: number) {
        let response: any = await Ajax.get("get-game-lotto-choosen", { typeGame });
        let numbers = response.data;
        let str = ``;
        if (numbers.length > 0) {
            for (let i = 0; i < numbers.length; i++) {
                const num = numbers[i];
                str += `<span class="lotto">${num}</span>`
            }
            Selector._('.ls_lotto_choosen').innerHTML = str;
        }

    }
    showQuestion() {
        Selector.on("click", "span.question", function (e: any) {
            let _this = e.target;
            let next = _this.nextElementSibling;
            if (!next) {
                return;
            }
            if (!next.classList.contains("active")) {
                next.classList.add("active");
            } else {
                next.classList.remove("active");
            }
        });
    }
}
