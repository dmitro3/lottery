import InactiveBrowser from "../Base/InactiveBrowser";
import Selector from "../Base/Selector";
import PlinkoGlobal from "./PlinkoGlobal";
import PlinkoSocket from "./PlinkoSocketV2";
import Storage from "./PlinkoStorage";

export default class PlinkoUi {
    public constructor(private plinkoSocket: PlinkoSocket) {}
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
    public init() {
        let self = this;
        var button = Selector._("button.play");
        button.addEventListener("click", function (e: any) {
            self.playGame();
        });
        this.initEvent();
        // this.detectInactive();
        // this.showBlurPopupIfInactive();
        this.loadPlinkoHistoryGame();
        this.loadGuiFromLocalStorage();
    }
    public initEvent() {
        let self = this;
        var lsMode = document.querySelectorAll(".label_choose.mode");
        var inputQty = Selector._(".qty_box input[name='qty']");
        inputQty.addEventListener("input", function (e: any) {
            self.updateLocalStorage();
        });
        lsMode.forEach(function (e, i) {
            e.addEventListener("click", function () {
                self.updateLocalStorage();
            });
        });
        var lsrisk = document.querySelectorAll(".label_choose.risk");
        lsrisk.forEach(function (e, i) {
            e.addEventListener("click", function () {
                self.updateLocalStorage();
            });
        });
    }
    private loadGuiFromLocalStorage() {
        Selector._(".qty_box input[name='qty']").value = Storage.getQty();
        Selector._(
            `.label_choose.mode input[value="${Storage.getMode()}"]`
        ).checked = true;
        Selector._(
            `.label_choose.risk input[value="${Storage.getType()}"]`
        ).checked = true;
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
    }
    public showBlurPopupIfInactive(isHidden: boolean) {
        if (isHidden) {
            Selector._("#game").classList.add("inactive");
            Selector._("#warning-inactive").classList.remove("d-none");
            Storage.setInactive(1);
        } else {
            Selector._("#game").classList.remove("inactive");
            Selector._("#warning-inactive").classList.add("d-none");
            Storage.setInactive(0);
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
