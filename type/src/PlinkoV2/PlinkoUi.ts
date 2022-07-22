import InactiveBrowser from "../Base/InactiveBrowser";
import InteractionListener from "../Base/InteractionListener";
import Selector from "../Base/Selector";
import PlinkoGlobal from "./PlinkoGlobal";
import PlinkoSocket from "./PlinkoSocketV2";
import PlinkoStorage from "./PlinkoStorage";
import Storage from "./PlinkoStorage";

export default class PlinkoUi {
    public constructor(private plinkoSocket: PlinkoSocket) {
    }


    public playGame() {
        if (!PlinkoGlobal.acceptBet()) {
            return;
        }
        let self = this;
        this.disableButtonPlay();
        this.plinkoSocket.sendPlayRequest(false);
        setTimeout(function () {
            self.enableButtonPlay();
        }, PlinkoGlobal.TIME_EACH_BALL);
    }
    disableButtonPlay() {
        var button = Selector._("button.play");
        if (!button) return;
        button.disabled = true;
    }
    enableButtonPlay() {
        var button = Selector._("button.play");
        if (!button) return;
        button.disabled = false;
    }
    disableQtyBox() {
        var box = Selector._(".qty_box");
        if (!box) return;
        box.classList.add('disabled');
    }
    enableQtyBox() {
        var box = Selector._(".qty_box");
        if (!box) return;
        box.classList.remove('disabled');
    }
    public init() {
        let self = this;
        var button = Selector._("button.play");
        button.addEventListener("click", function (e: any) {
            self.playGame();
        });
        this.initEvent();
        this.detectInactive();
        // this.showBlurPopupIfInactive();
        this.loadPlinkoHistoryGame();
        this.loadGuiFromLocalStorage();
    }
    public initEvent() {
        let self = this;
        var lsMode = document.querySelectorAll(".label_choose.mode");
        var inputQty = Selector._(".qty_box input[name='qty']");
        inputQty.addEventListener("input", function (event: any) {
            self.updateLocalStorage();
        });
        lsMode.forEach(function (e, i) {
            e.addEventListener("click", function (event: any) {
                let autoMode = PlinkoGlobal.isAutoMode();
                if (autoMode) {
                    self.disableButtonPlay();
                    self.enableQtyBox();
                }
                else {

                    self.enableButtonPlay();
                    self.disableQtyBox();
                }
                self.updateLocalStorage();
            });
        });
        var lsrisk = document.querySelectorAll(".label_choose.risk");
        lsrisk.forEach(function (e, i) {
            e.addEventListener("click", function (event: any) {
                self.updateLocalStorage();
            });
        });
        document.addEventListener('game_inited', function () {
            PlinkoGlobal.GAME_INITED = true;
        })
    }

    private loadGuiFromLocalStorage() {
        Selector._(".qty_box input[name='qty']").value = Storage.getQty();
        let mode = Storage.getMode();
        Selector._(
            `.label_choose.mode input[value="${Storage.getMode()}"]`
        ).checked = true;
        Selector._(
            `.label_choose.risk input[value="${Storage.getType()}"]`
        ).checked = true;
        let autoMode = PlinkoGlobal.isAutoMode();
        if (autoMode) {
            this.disableButtonPlay();
            this.enableQtyBox();
        }
        else {

            this.enableButtonPlay();
            this.disableQtyBox();
        }
    }
    public updateLocalStorage() {
        let qty = Selector._(".qty_box input[name='qty']").value;
        let type = Selector._(".label_choose.risk input:checked").value;
        let mode = Selector._(".label_choose.mode input:checked").value;
        Storage.setConfigGame(qty, mode, type);
    }
    public detectInactive() {
        let self = this;
        let inactiveBrowser = new InactiveBrowser();
        inactiveBrowser.onEventHidden = function () {
            self.showBlurPopupIfInactive(true);
        };
        inactiveBrowser.onEventVisible = function () {
            self.showBlurPopupIfInactive(false);
        };
        inactiveBrowser.init();
    }
    public showBlurPopupIfInactive(isHidden: boolean) {
        if (isHidden) {
            // Selector._("#game").classList.add("inactive");
            // Selector._("#warning-inactive").classList.remove("d-none");
            Storage.setInactive(1);
        } else {
            // Selector._("#game").classList.remove("inactive");
            // Selector._("#warning-inactive").classList.add("d-none");
            Storage.setInactive(0);
        }
    }

    public updateCountDownPlayBox(timeRemaining: any) {
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let status = timeRemaining <= lastPoint;
        if (!status) {
            Selector.none(Selector._(".ready"));
        } else {
            Selector.flex(Selector._(".ready"));
            let seconds: any = timeRemaining % 60 | 0;
            seconds = seconds < 10 ? "0" + seconds : String(seconds);
            let time = Selector._(".ready .time");
            time.innerHTML = `<span class="item">${seconds.substr(0, 1)}</span>
                <span class="item">${seconds.substr(1, 1)}</span>`;
        }
    }

    public updateCountDownMain(minutes: any, seconds: any) {
        let gamePlinkoTimeBox = Selector._("#game-plinko-time-box");
        var countDownTimeBox =
            gamePlinkoTimeBox.querySelector(".out .number");
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

    public updateCountDownFullBox(boxHtml: any, timeRemaining: any) {
        let time: any = timeRemaining;
        time = Math.abs(time);
        time = time < 10 ? "0" + time : "" + time;
        let html = ``;
        for (var i = 0; i < time.length; i++) {
            html += `<span class="item m-r-20">${time.charAt(i)}</span>`;
        }
        boxHtml.innerHTML = html;
    }
    public updateCountDownBall() {
        let boxBall = Selector._('.count_down_ball');
        if (PlinkoGlobal.isAutoMode()) {
            Selector.flex(boxBall);
            let span = boxBall.querySelector('span');
            let userQty: any = PlinkoStorage.getQty();
            span.innerText = userQty - PlinkoStorage.getCountCurrentBall();
        }
        else {
            Selector.none(boxBall);
        }
    }

    public loadPlinkoHistoryGame() {
        var self = this;
        var itemContent = document.querySelector("#game-gowin-history");
        if (itemContent) {
            XHR.send({
                url: "get-game-plinko-history",
                method: "GET",
            }).then((res: any) => {
                if (res.code == 200 && res.html) {
                    itemContent.innerHTML = res.html;
                    self.initPaginateBox(itemContent);
                }
            });
        }
    }
    public initPaginateBox(element: any, callback: any = null) {
        var self = this;
        var listPaginateBoxLinkBtn = element.querySelectorAll(
            ".paginate-box-link-btn.action"
        );
        listPaginateBoxLinkBtn.forEach((btn: any) => {
            if (btn.dataset.href != "") {
                btn.addEventListener("click", function () {
                    XHR.send({
                        url: this.dataset.href,
                        method: "GET",
                    }).then((res: any) => {
                        if (res.code == 200 && res.html) {
                            element.innerHTML = res.html;
                            self.initPaginateBox(element, callback);
                            if (callback) {
                                BASE_SUPPORT.callFunction(callback);
                            }
                        }
                    });
                });
            }
        });
    }
}
