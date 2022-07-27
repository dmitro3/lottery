import LottoGameTimer from "../Lotto/LottoGameTimer";


export default class LottoMbGameTimer extends LottoGameTimer {
    public runMainLoop() {
        let time = this.timeRemaining;
        let hours: any = (time / 3600) | 0;
        time = time % 3600;
        let minutes: any = (time / 60) | 0;
        let seconds: any = time % 60 | 0;
        hours = hours < 10 ? "0" + hours : String(hours);
        minutes = minutes < 10 ? "0" + minutes : String(minutes);
        seconds = seconds < 10 ? "0" + seconds : String(seconds);
        if (this.timeRemaining <= 0) {
            this.refreshGame();
        } else {
            var countDownTimeBox =
                this.gamePlinkoTimeBox.querySelector(".out .number");
            if (countDownTimeBox) {
                countDownTimeBox.innerHTML = `
                        <div class="item">${hours.substr(0, 1)}</div>
                        <div class="item">${hours.substr(1, 1)}</div>
                        <div class="item c-row c-row-middle">:</div>
                        <div class="item">${minutes.substr(0, 1)}</div>
                        <div class="item">${minutes.substr(1, 1)}</div>
                        <div class="item c-row c-row-middle">:</div>
                        <div class="item">${seconds.substr(0, 1)}</div>
                        <div class="item">${seconds.substr(1, 1)}</div>
                    `;
            }
        }
        this.showTimeChecker();
        this.timeRemaining--;
    }
}