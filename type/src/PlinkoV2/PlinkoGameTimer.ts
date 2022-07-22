import Selector from "../Base/Selector";
import PlinkoGlobal from "./PlinkoGlobal";
import PlinkoSocket from "./PlinkoSocketV2";
import Storage from "./PlinkoStorage";

export default class PlinkoGameTimer {
    private interValGameTime: any = null;
    private timeRemaining: number = 0;
    private gamePlinkoTimeBox: any;
    private needRetreiveResult: boolean = false;
    public constructor(private plinkoSocket: PlinkoSocket) {
        this.gamePlinkoTimeBox = Selector._("#game-plinko-time-box");
    }

    public initInfo(data: any) {
        if (!this.gamePlinkoTimeBox || !data.html) return;
        this.needRetreiveResult = true;
        this.gamePlinkoTimeBox.innerHTML = data.html;
        this.timeRemaining = data.time_remaining ?? 0;

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
            var countDownTimeBox =
                this.gamePlinkoTimeBox.querySelector(".out .number");
            if (countDownTimeBox) {
                countDownTimeBox.innerHTML = `
                        <div class="item">${minutes.substr(0, 1)}</div>
                        <div class="item">${minutes.substr(1, 1)}</div>
                        <div class="item c-row c-row-middle">:</div>
                        <div class="item">${seconds.substr(0, 1)}</div>
                        <div class="item">${seconds.substr(1, 1)}</div>
                    `;
            }
        }
        this.showTimeChecker();
        this.autoPlay();
        this.timeRemaining--;
    }
    public refreshGame() {
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        if (Storage.isInactive()) {
            window.location.href = window.location.href;
        } else {
            this.plinkoSocket.initGame();
        }
    }
    public showTimeChecker() {
        var mark = Selector._(".game-betting .mark-box");
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let showCountDownCalculate = this.timeRemaining <= lastPoint;
        if (showCountDownCalculate) {
            Selector.flex(mark);
            let time: any = this.timeRemaining;
            time = Math.abs(time);
            time = time < 10 ? "0" + time : "" + time;
            let html = ``;
            for (var i = 0; i < time.length; i++) {
                html += `<span class="item m-r-20">${time.charAt(i)}</span>`;
            }
            mark.innerHTML = html;
        } else {
            Selector.none(mark);
        }
    }
    public autoPlay() {
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let status = PlinkoGlobal.acceptBet() && this.timeRemaining > lastPoint;
        if (PlinkoGlobal.isAutoMode() && status) {
            this.plinkoSocket.sendPlayRequest(false);
        }
    }
}
