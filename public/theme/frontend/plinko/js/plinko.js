var PLINKO = {
    _: function (selector) {
        return document.querySelector(selector);
    },
    changeToStopButtonPlay: function () {},
    playGame: function () {
        var data = {};
        data.type = connectionGameType;
        data.action = 2;
        data.currentGame = PLINKO_LOAD.currentGameInfo;
        var gameData = {
            type: this._("[name=risk]:checked").value,
            mode: this._("[name=mode]:checked").value,
            qty: this._("[name=qty]").value,
        };
        data.gameData = gameData;
        PLINKO_LOAD.sendData(JSON.stringify(data));
    },
};

var PLINKO_UI = {
    init: function () {
        var button = PLINKO._("button.play");
        button.addEventListener("click", function (e) {
            PLINKO.playGame();
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
                listener(e);
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
    init: function () {
        PLINKO_SOCKET.init();
        PLINKO_SOCKET.addOpenListener(this.onOpenSocket);
        PLINKO_SOCKET.addCloseListener(this.onCloseSocket);
        PLINKO_SOCKET.addErrorListener(this.onErrorSocket);
        PLINKO_SOCKET.addMessageListener(this.onMessageSocket);
    },
    onOpenSocket: function (e) {
        BASE_GUI.hideLoading();
        PLINKO_UI.init();
        GAME_PLINKO.initCurentGameInfo();
    },
    onCloseSocket: function (e) {
        BASE_GUI.showLoading();
        BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
    },
    onErrorSocket: function (e) {
        BASE_GUI.showLoading();
        BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
    },
    onMessageSocket: function (data) {
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
    initCurentGameInfo: function () {
        data = {};
        data.type = connectionGameType;
        data.action = 1;
        PLINKO_SOCKET.sendData(JSON.stringify(data));
    },
    processMessageData: function (data) {
        switch (data.action) {
            case game_statuses.GAME_ACTION_GET_CURRENT_GAME_INFO:
                initGameInfo(data.data);
                break;
            case game_statuses.GAME_ACTION_DO_BET:
                betSuccess(data.data);
            default:
                break;
        }
    },
};

var PLINKO_LOAD = (function () {
    var currentGameInfo = {};
    var interValGameTime = null;
    var timeRemaining = 0;

    var gamePlinkoTimeBox = PLINKO._("#game-plinko-time-box");

    var initGameInfo = function (data) {
        currentGameInfo.current_game_idx = data.current_game_idx ?? "";
        if (gamePlinkoTimeBox && data.html) {
            gamePlinkoTimeBox.innerHTML = data.html;
            timeRemaining = data.time_remaining ?? 0;
            var countDownTimeBox =
                gamePlinkoTimeBox.querySelector(".out .number");
            if (interValGameTime) {
                clearInterval(interValGameTime);
            }
            function gameTimer() {
                minutes = (timeRemaining / 60) | 0;
                seconds = timeRemaining % 60 | 0;
                minutes = minutes < 10 ? "0" + minutes : String(minutes);
                seconds = seconds < 10 ? "0" + seconds : String(seconds);
                if (timeRemaining <= 0) {
                    if (interValGameTime) {
                        clearInterval(interValGameTime);
                    }
                    // BASE_GUI.showLoading();
                    // window.location.href = window.location.href;
                } else {
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
                timeRemaining--;
            }
            gameTimer();
            interValGameTime = setInterval(() => {
                gameTimer();
            }, 1000);
        }
    };
    var betSuccess = function (data) {
        BASE_GUI.createFlashNotify("Đặt hàng thành công.");
    };
    return {
        currentGameInfo: currentGameInfo,
        _: function () {
            init();
        },
        sendData(data) {
            sendData(data);
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    // PLINKO_LOAD._();
    GAME_PLINKO.init();
});
