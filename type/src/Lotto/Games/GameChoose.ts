import Selector from "../../Base/Selector";

export default class GameChoose {
    constructor() {
        this.initEvents();

    }
    initEvents() {
        let self = this;
        Selector.on('click', '.ls_number .item_number span', function (e: any) {
            var _this = e.target;
            let currentTab = Selector._('.panel .type_js.nav-item[data-state="true"]');
            let targetId = currentTab.dataset.target;
            let currentGame = currentTab.id;
            let currentConfig = LOTTO_TYPES[currentGame];
            if (_this.classList.contains('choosen')) {
                _this.classList.remove('choosen');
            }
            else {
                if (self.validate(targetId, currentConfig)) {
                    _this.classList.add('choosen');
                }
                else {
                    alert(`Bạn chỉ được đánh ${currentConfig.choose_max} số!`);
                }
            }

        });
    }
    public validate(targetId: any, currentConfig: any) {


        let currentPanel = Selector._(targetId);
        let checkedItems = currentPanel.querySelectorAll(':scope .item_number span.choosen');

        if (!currentConfig) return false;
        if (checkedItems.length >= currentConfig.choose_max) {
            return false;
        }
        return true;
    }

}