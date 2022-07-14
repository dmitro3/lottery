import Selector from "../Base/Selector";

export default class PlinkoGlobal {
    private static _currentGameInfo: any = {};
    public static get currentGameInfo(): any {
        return PlinkoGlobal._currentGameInfo;
    }
    public static set currentGameInfo(value: any) {
        PlinkoGlobal._currentGameInfo = value;
    }
    public static isAutoMode() {
        let input = Selector._(".label_choose input[name=mode]:checked");
        return input.value == "auto";
    }
}