import Selector from "../../Base/Selector";
import LottoGlobal from "../LottoGlobal";
import BaseGame from "./BaseGame";
import FormBet from "./FormBet";

export default class GameSelect extends BaseGame {
    constructor(formbet: FormBet) {
        super(formbet);
        this.initEvents();
    }
    initEvents() {
        let self = this;
        Selector.on(
            "click",
            ".ls_number .group_number button.btn_xs",
            function (e: any) {
                var _this = e.target;
                let currentTab = Selector._(
                    '.panel .type_js.nav-item[data-state="true"]'
                );
                let targetId = currentTab.dataset.target;
                let currentGame = currentTab.id;
                let currentConfig = LOTTO_TYPES[currentGame];
                let parent = _this.parent;

                let panel = Selector._(targetId);
                let number = self.getChooseNumber(panel);
                self.addNumber(panel, number);
                self.updateListLotto();
            }
        );
        Selector.on(
            "click",
            ".ls_number .item_number_select span",
            function (e: any) {
                var _this = e.target;
                var text = _this.innerHTML;
                if (confirm(`Bạn muốn xóa số ${text}?`)) {
                    _this.parentElement.remove();
                }
            }
        );
    }
    public updateListLotto() {
        LottoGlobal.updateListLotto();
        this.formbet.changeHtmlPreview();
    }
    getChooseNumber(panel: any) {
        let selects = panel.querySelectorAll(".ls_number .group_number select");

        let number = "";
        for (let i = 0; i < selects.length; i++) {
            const element = selects[i];
            number += element.value;
        }
        return number;
    }
    addNumber(panel: any, number: any) {
        let listChoosen = panel.querySelector(
            ".ls_number .ls_number.list_choosen"
        );
        let item = listChoosen.querySelector(`span[data-number="${number}"]`);
        if (item) {
            alert(`Bạn đã chọn số ${number} trước đó!`);
        } else {
            let str = `<label class="item_number_select">
            <span type="checkbox" class="choosen" data-number="${number}">${number}</span>
        </label>`;
            listChoosen.insertAdjacentHTML("beforeend", str);
        }
    }
    removeChoosen() {
        let itemSelects = Selector.all(
            ".list_choosen .item_number_select span.choosen"
        );
        itemSelects.forEach((e: any, i: number) => {
            e.parentElement.remove();
        });
    }
}
