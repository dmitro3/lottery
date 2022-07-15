import Ajax from "../Base/Ajax";
import Selector from "../Base/Selector";

export default class LottoUi {
    constructor() {

    }
    init() {
        this.initEvents();
        this.showQuestion();
    }
    initEvents() {
        let self = this;
        let typeGames = Selector.all('.item_type_game input');
        typeGames.forEach((typeGame: any) => {
            typeGame.addEventListener('change', async function (e: any) {

                let input = this;;
                let parent = this.parentElement;
                let type = input ? input.value : 0;
                let content: any = await self.getGameContent(type);
                let target = Selector._(parent.getAttribute('data-target'));
                let otherpanels = target.parentElement.querySelectorAll(':scope > .panel');
                otherpanels.forEach(function (otherpanel: any, i: number) {
                    otherpanel.innerHTML = '';
                });

                target.innerHTML = content.html;


            }, false)
        });
        if (typeGames.length > 0) {
            var input = typeGames[0];
            var eventInit = new Event("change");
            input.dispatchEvent(eventInit);
        }

    }
    getGameContent(typeGame: number) {
        return Ajax.get("get-game-lotto-content", { typeGame });
    }
    showQuestion() {
        Selector.on('click', 'span.question', function (e: any) {
            let _this = e.target;
            let next = _this.nextElementSibling;
            if (!next) { return; }
            if (!next.classList.contains("active")) {
                next.classList.add("active");
            } else {
                next.classList.remove("active");
            }

        })

    }

}