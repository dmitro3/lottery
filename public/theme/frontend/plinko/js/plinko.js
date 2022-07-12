var PLINKO = {
    _: function (selector) {
        return document.querySelector(selector);
    },
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

var PLINKO_LOAD = (function () {
    var connecter = null;
    var wsReady = false;
    var currentGameInfo = {};
    var interValGameTime = null;
    var timeRemaining = 0;

    var gamePlinkoTimeBox = document.querySelector("#game-plinko-time-box");

    var init = function () {
        var userTokenIp = document.querySelector("input[name=auth_token]");
        if (!userTokenIp) return;
        var userToken = userTokenIp.value;
        connecter = new WebSocket(
            `ws://localhost:8080/?auth_token=${userToken}`
        );
        connecter.onopen = function (e) {
            wsReady = true;
            BASE_GUI.hideLoading();
            PLINKO_UI.init();
            initCurentGameInfo();
        };
        connecter.onmessage = function (e) {
            actionProvider(JSON.parse(e.data));
        };
        connecter.onclose = function (e) {
            wsReady = false;
            BASE_GUI.showLoading();
            BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
        };
        connecter.onerror = function (e) {
            wsReady = false;
            BASE_GUI.showLoading();
            BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
        };
    };
    var sendData = function (data) {
        BASE_GUI.showLoading();
        if (wsReady) {
            connecter.send(data);
        } else {
            BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
        }
    };
    var initCurentGameInfo = function () {
        data = {};
        data.type = connectionGameType;
        data.action = 1;
        sendData(JSON.stringify(data));
    };
    var actionProvider = function (data) {
        BASE_GUI.hideLoading();
        if (data.success && data.action) {
            switch (data.action) {
                case 1:
                    initGameInfo(data.data);
                    break;
                case 2:
                    betSuccess(data.data);
                default:
                    break;
            }
        } else {
            if (data.message) {
                BASE_GUI.createFlashNotify(data.message);
            } else {
                BASE_GUI.createFlashNotify("Lỗi không xác đinh!");
            }
        }
    };
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
                    BASE_GUI.showLoading();
                    window.location.href = window.location.href;
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
    PLINKO_LOAD._();
});
