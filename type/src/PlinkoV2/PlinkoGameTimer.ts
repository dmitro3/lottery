import Selector from "../Base/Selector";
import PlinkoGlobal from "./PlinkoGlobal";
import PlinkoSocket from "./PlinkoSocketV2";
import PlinkoStorage from "./PlinkoStorage";
import Storage from "./PlinkoStorage";
import PlinkoUi from "./PlinkoUi";

export default class PlinkoGameTimer {
    private interValGameTime: any = null;
    private timeRemaining: number = 0;
    private gamePlinkoTimeBox: any;
    public constructor(private plinkoSocket: PlinkoSocket, private plinkoUi: PlinkoUi) {
        this.gamePlinkoTimeBox = Selector._("#game-plinko-time-box");
    }

    public initInfo(data: any) {
        if (!this.gamePlinkoTimeBox || !data.html) return;
        this.gamePlinkoTimeBox.innerHTML = data.html;
        this.timeRemaining = data.time_remaining ?? 0;
        PlinkoStorage.resetCountCurrentBall();

        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        let self = this;
        self.runMainLoop();
        this.interValGameTime = setInterval(() => {
            self.runMainLoop();
        }, 1000);
    }
    public runMainLoop() {
        let minutes: any = (this.timeRemaining / 60) | 0;
        let seconds: any = this.timeRemaining % 60 | 0;
        minutes = minutes < 10 ? "0" + minutes : String(minutes);
        seconds = seconds < 10 ? "0" + seconds : String(seconds);
        if (this.timeRemaining <= 0) {
            this.refreshGame();
        } else {
            this.plinkoUi.updateCountDownMain(minutes, seconds);
        }
        this.showTimeChecker();
        this.autoPlay();
        this.plinkoUi.updateCountDownPlayBox(this.timeRemaining);
        this.plinkoUi.updateCountDownBall();
        this.plinkoUi.playBackgroundAudio();
        this.timeRemaining--;
    }

    public refreshGame() {
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        PlinkoStorage.resetCountCurrentBall();
        if (Storage.isInactive()) {
            window.location.href = window.location.href;
        } else {
            this.plinkoSocket.initGame();
        }
    }
    public showTimeChecker() {
        var mark = Selector._(".game-betting .mark-box");
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_COUNT_DOWN);
        let showCountDownCalculate = this.timeRemaining <= lastPoint;
        if (showCountDownCalculate) {
            Selector.flex(mark);
            this.plinkoUi.updateCountDownFullBox(mark, this.timeRemaining);
        } else {
            Selector.none(mark);
        }
    }
    public autoPlay() {
        let status = PlinkoGlobal.acceptBet() && this.hasEnoughTimeToPlay() && !Storage.isInactive();
        let hasEnoughBall = this.hasEnoughBall()
        let gameInited = PlinkoGlobal.GAME_INITED;
        let isAutoMode = PlinkoGlobal.isAutoMode();
        if (isAutoMode && status && hasEnoughBall && gameInited) {
            this.plinkoUi.disableButtonPlay();
            this.plinkoSocket.sendPlayRequest(false);
            PlinkoStorage.incrementCountCurrentBall();
        }
    }
    private hasEnoughBall() {
        let userQty: any = PlinkoStorage.getQty();
        let max: any = PLINKO_CONFIG.MAXIMUM_BALL;
        let currentCount: any = PlinkoStorage.getCountCurrentBall();
        return userQty <= max && userQty - currentCount > 0
    }
    private hasEnoughTimeToPlay() {
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        return this.timeRemaining > lastPoint + 3;
    }

}
