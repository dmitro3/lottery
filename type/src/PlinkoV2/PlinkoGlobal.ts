import Selector from "../Base/Selector";

export default class PlinkoGlobal {
    public static TIME_EACH_BALL = 2000;
    private static _currentGameInfo: any = {};
    private static lastTimeBet = 0;
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
    public static setTimeBet() {
        let time = new Date().getTime();
        this.lastTimeBet = time;
    }
    public static acceptBet() {
        let time = new Date().getTime();
        return time - this.lastTimeBet > this.TIME_EACH_BALL;
    }
}
