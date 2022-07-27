import Selector from "../Base/Selector";

export default class LottoGlobal {

    private static _currentGameInfo: any = {};
    public static get currentGameInfo(): any {
        return LottoGlobal._currentGameInfo;
    }
    public static set currentGameInfo(value: any) {
        LottoGlobal._currentGameInfo = value;
    }


    public static changeGameTitle() {
        let html = `<span class="domain xs">Miền Bắc</span> / `;
        let title = Selector._(".box_booking .box_mini .types");
        let category = Selector._(
            ".item_type_game.nav-item input[name=category]:checked"
        );
        let categoryParent = category.parentElement;
        if (categoryParent) {
            html += `<span class="lotto xs">${categoryParent.innerText}</span> / `;
        }
        let type = Selector._('.type_js.nav-item input[name="type"]:checked');
        let typeParent = type.parentElement;
        if (typeParent) {
            html += `<span class="type xs">${typeParent.innerText}</span>`;
        }
        title.innerHTML = html;
    }
    public static updateListLotto() {
        let lottos = Selector._(".ls_lotto");

        let html = ``;
        let items = Selector.all(".item_number span.choosen");
        let itemSelects = Selector.all(
            ".list_choosen .item_number_select span.choosen"
        );
        if (items.length > 0) {
            items.forEach(function (e: any, i: number) {
                html += `<span class="lotto">${e.innerText}</span>`;
            });
        } else if (itemSelects.length > 0) {
            itemSelects.forEach(function (e: any, i: number) {
                html += `<span class="lotto">${e.innerText}</span>`;
            });
        } else {
            html = `<span class="no-result">Chưa chọn số</span>`;
        }

        lottos.innerHTML = html;
    }
    public static getCurrentTypeGame() {
        let currentTab = Selector._(
            '.panel .type_js.nav-item[data-state="true"]'
        );
        if (!currentTab) return 0;
        return currentTab.id;
    }

    public static getCurrentGameConfig() {
        let currentGame = this.getCurrentTypeGame();
        let currentConfig = LOTTO_TYPES[currentGame] || {};
        return currentConfig;
    }

}
