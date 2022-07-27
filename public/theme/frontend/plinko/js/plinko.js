var PLINKO = {
    _: function (selector) {
        return document.querySelector(selector);
    },
    flex: function (item) {
        item.style.display = "flex";
    },
    none: function (item) {
        item.style.display = "none";
    },
};

var PLINKO_UI = {
    playGame: function () {
        GAME_PLINKO.sendPlayRequest();
    },
    disableButtonPlay: function () {
        var button = PLINKO._("button.play");
        if (!button) return;
        button.disabled = true;
        button.querySelector(".text").innerHTML = "WAIT";
    },
    enableButtonPlay: function () {
        var button = PLINKO._("button.play");
        if (!button) return;
        button.disabled = false;
        button.querySelector(".text").innerHTML = "START";
    },
    init: function () {
        var button = PLINKO._("button.play");
        button.addEventListener("click", function (e) {
            PLINKO_UI.playGame();
        });
        this.initEvent();
        this.detectInactive();
        this.showBlurPopupIfInactive();
        this.loadPlinkoHistoryGame();
    },
    initEvent: function () {
        var lsMode = document.querySelectorAll(".label_choose.mode");
        var inputQty = PLINKO._(".qty_box input[name='qty']");
        inputQty.addEventListener("input", function (e) {
            PLINKO_UI.updateLocalStorage();
        });
        lsMode.forEach(function (e, i) {
            e.addEventListener("click", function () {
                PLINKO_UI.updateLocalStorage();
            });
        });
        var lsrisk = document.querySelectorAll(".label_choose.risk");
        lsrisk.forEach(function (e, i) {
            e.addEventListener("click", function () {
                PLINKO_UI.updateLocalStorage();
            });
        });
        let qty = localStorage.getItem("plinko_qty");
        if (qty != undefined) {
            PLINKO._(".qty_box input[name='qty']").value = qty;
        }
        let mode = localStorage.getItem("plinko_mode");
        if (mode != undefined) {
            PLINKO._(
                `.label_choose.mode input[value="${mode}"]`
            ).checked = true;
        }
        let type = localStorage.getItem("plinko_type");
        if (type != undefined) {
            PLINKO._(
                `.label_choose.risk input[value="${type}"]`
            ).checked = true;
        }
    },
    updateLocalStorage: function () {
        localStorage.setItem(
            "plinko_qty",
            PLINKO._(".qty_box input[name='qty']").value
        );
        localStorage.setItem(
            "plinko_type",
            PLINKO._(".label_choose.risk input:checked").value
        );
        localStorage.setItem(
            "plinko_mode",
            PLINKO._(".label_choose.mode input:checked").value
        );
    },
    detectInactive: function () {
        let self = this;
        document.addEventListener("visibilitychange", function (event) {
            PLINKO_UI.showBlurPopupIfInactive();
        });
    },
    showBlurPopupIfInactive: function () {
        let self = this;
        if (document.hidden) {
            PLINKO._("#game").classList.add("inactive");
            PLINKO._("#warning-inactive").classList.remove("d-none");
            self.setGameStatus(1);
        } else {
            self.setGameStatus(0);
        }
    },
    isInactive: function () {
        let state = sessionStorage.getItem("plinko_inactive");
        return state != undefined && state == 1;
    },
    setGameStatus: function (status) {
        sessionStorage.setItem("plinko_inactive", status);
    },
    loadPlinkoHistoryGame: function () {
        var self = this;
        var itemContent = document.querySelector("#game-gowin-history");
        if (itemContent) {
            XHR.send({
                url: "get-game-plinko-history",
                method: "GET",
            }).then((res) => {
                if (res.code == 200 && res.html) {
                    itemContent.innerHTML = res.html;
                    self.initPaginateBox(itemContent);
                }
            });
        }
    },
    initPaginateBox: function (element, callback = null) {
        var self = this;
        var listPaginateBoxLinkBtn = element.querySelectorAll(
            ".paginate-box-link-btn.action"
        );
        listPaginateBoxLinkBtn.forEach((btn) => {
            if (btn.dataset.href != "") {
                btn.addEventListener("click", function () {
                    XHR.send({
                        url: this.dataset.href,
                        method: "GET",
                    }).then((res) => {
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
    },
};

var PLINKO_SOCKET = {
    connecter: null,
    wsReady: false,
    openListeners: [],
    messageListeners: [],
    closeListeners: [],
    errorListeners: [],
    addOpenListener: function (callback) {
        if (callback) {
            this.openListeners.push(callback);
        }
    },
    addMessageListener: function (callback) {
        if (callback) {
            this.messageListeners.push(callback);
        }
    },
    addCloseListener: function (callback) {
        if (callback) {
            this.closeListeners.push(callback);
        }
    },
    addErrorListener: function (callback) {
        if (callback) {
            this.errorListeners.push(callback);
        }
    },
    sendData: function (data) {
        BASE_GUI.showLoading();
        if (this.wsReady) {
            connecter.send(data);
        } else {
            BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
        }
    },
    init: function () {
        var userTokenIp = PLINKO._("input[name=auth_token]");
        if (!userTokenIp) return;
        var userToken = userTokenIp.value;
        connecter = new WebSocket(
            `ws://localhost:8888/?auth_token=${userToken}`
        );
        var self = this;
        connecter.onopen = function (e) {
            self.wsReady = true;
            for (let listener of self.openListeners) {
                listener(e);
            }
        };
        connecter.onmessage = function (e) {
            for (let listener of self.messageListeners) {
                let data = {};
                if (e.data) {
                    data = JSON.parse(e.data);
                }

                listener(e, data);
            }
        };
        connecter.onclose = function (e) {
            self.wsReady = false;
            for (let listener of self.closeListeners) {
                listener(e);
            }
        };
        connecter.onerror = function (e) {
            self.wsReady = false;
            for (let listener of self.errorListeners) {
                listener(e);
            }
        };
    },
};

var GAME_PLINKO = {
    currentGameInfo: {},
    init: function () {
        PLINKO_SOCKET.init();
        PLINKO_SOCKET.addOpenListener(this.onOpenSocket);
        PLINKO_SOCKET.addCloseListener(this.onCloseSocket);
        PLINKO_SOCKET.addErrorListener(this.onErrorSocket);
        PLINKO_SOCKET.addMessageListener(this.onMessageSocket);
        if (this.isBetted()) {
            GAME_LOOP.showCountDownPlayBox();
        }
    },
    onOpenSocket: function (e) {
        BASE_GUI.hideLoading();
        PLINKO_UI.init();
        GAME_PLINKO.initGame();
    },
    onCloseSocket: function (e) {
        BASE_GUI.showLoading();
        BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
    },
    onErrorSocket: function (e) {
        BASE_GUI.showLoading();
        BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
    },
    onMessageSocket: function (e, data) {
        BASE_GUI.hideLoading();
        if (data.success && data.action) {
            GAME_PLINKO.processMessageData(data);
        } else {
            if (data.message) {
                BASE_GUI.createFlashNotify(data.message);
            } else {
                BASE_GUI.createFlashNotify("Lỗi không xác đinh!");
            }
        }
    },
    isAutoMode: function () {
        let input = PLINKO._(".label_choose input[name=mode]:checked");
        return input.value == "auto";
    },
    initGame: function () {
        data = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO;
        PLINKO_SOCKET.sendData(JSON.stringify(data));
    },
    retrieveResult: function () {
        data = {};
        data.type = connectionGameType;
        data.currentGame = this.currentGameInfo;
        data.action = PLINKO_STATUS.GAME_ACTION_RETRIEVE_RESULT;
        PLINKO_SOCKET.sendData(JSON.stringify(data));
    },
    sendPlayRequest: function () {
        this.setStateBet(1);
        var data = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = this.currentGameInfo;
        var gameData = {
            type: PLINKO._("[name=risk]:checked").value,
            mode: PLINKO._("[name=mode]:checked").value,
            qty: PLINKO._("[name=qty]").value,
        };
        data.gameData = gameData;
        PLINKO_SOCKET.sendData(JSON.stringify(data));
    },
    setStateBet: function (value) {
        let game_index = this.currentGameInfo.current_game_idx;
        let obj = {};
        obj[game_index] = value;
        sessionStorage.setItem("plinko_betted", JSON.stringify(obj));
    },
    isBetted: function () {
        try {
            let obj = JSON.parse(sessionStorage.getItem("plinko_betted"));
            let game_index = this.currentGameInfo.current_game_idx;
            let state = obj[game_index];
            return state != undefined && state == 1;
        } catch (error) {}
        return false;
    },
    betSuccess: function (data) {
        BASE_GUI.createFlashNotify("Bet thành công.");
    },
    processMessageData: function (data) {
        switch (data.action) {
            case PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                let dataAttachment = data.data;
                this.currentGameInfo.current_game_idx =
                    dataAttachment.current_game_idx ?? "";
                GAME_LOOP.initInfo(dataAttachment);
                break;
            case PLINKO_STATUS.GAME_ACTION_DO_BET:
                this.betSuccess(data.data);
                break;
            case PLINKO_STATUS.GAME_ACTION_RETRIEVE_RESULT:
                this.renderBall(data.data);
                break;
            default:
                break;
        }
    },
    renderBall: async function (data) {
        let games = data.games;
        if (!games) return;
        for (let index = 0; index < games.length; index++) {
            const item = games[index];
            ShortPlinko.createDisc(item.path, item.type);
            await this.sleep(400);
        }
    },
    sleep: function (ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    },
};
var GAME_LOOP = {
    interValGameTime: null,
    timeRemaining: 0,
    gamePlinkoTimeBox: PLINKO._("#game-plinko-time-box"),
    needRetreiveResult: false,
    initInfo: function (data) {
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
    },
    runMainLoop: function () {
        let minutes = (this.timeRemaining / 60) | 0;
        let seconds = this.timeRemaining % 60 | 0;
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
        this.autoPlay();
        this.showTimeChecker();
        this.showTimePlayBox();
        this.timeRemaining--;
    },
    countDownPlayBox: function (status) {
        if (!status) {
            PLINKO.none(PLINKO._(".ready"));
        } else {
            let seconds = this.timeRemaining % 60 | 0;
            seconds = seconds < 10 ? "0" + seconds : String(seconds);
            PLINKO.flex(PLINKO._(".ready"));
            let time = PLINKO._(".ready .time");

            time.innerHTML = `<span class="item">${seconds.substr(0, 1)}</span>
            <span class="item">${seconds.substr(1, 1)}</span>`;
        }
    },
    refreshGame: function () {
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        if (PLINKO_UI.isInactive()) {
            GAME_PLINKO.setStateBet(0);
            window.location.href = window.location.href;
        } else {
            GAME_PLINKO.initGame();
            GAME_PLINKO.setStateBet(0);
        }
    },
    showTimeChecker: function () {
        var mark = PLINKO._(".game-betting .mark-box");
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let duration = parseInt(PLINKO_CONFIG.NUMBER_TIME_TO_CHECK);
        let showCountDownCalculate =
            this.timeRemaining <= lastPoint &&
            this.timeRemaining >= lastPoint - duration;
        if (showCountDownCalculate) {
            PLINKO.flex(mark);
            let time = lastPoint - this.timeRemaining;
            time = Math.abs(time - duration);
            time = time < 10 ? "0" + time : "" + time;
            let html = ``;
            for (var i = 0; i < time.length; i++) {
                html += `<span class="item m-r-20">${time.charAt(i)}</span>`;
            }
            mark.innerHTML = html;
        } else {
            PLINKO.none(mark);
        }
        if (this.timeRemaining < lastPoint - duration) {
            if (!this.needRetreiveResult) return;
            if (!GAME_PLINKO.isBetted()) return;
            this.needRetreiveResult = false;
            GAME_PLINKO.retrieveResult();
        }
    },
    showTimePlayBox: function () {
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let status = GAME_PLINKO.isBetted() || this.timeRemaining < lastPoint;
        this.countDownPlayBox(status);
    },
    autoPlay: function () {
        let lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        let status =
            !GAME_PLINKO.isBetted() &&
            this.timeRemaining > lastPoint &&
            this.timeRemaining < lastPoint + 2;
        if (GAME_PLINKO.isAutoMode() && status) {
            GAME_PLINKO.sendPlayRequest();
        }
    },
};

window.addEventListener("DOMContentLoaded", function () {
    GAME_PLINKO.init();
});
