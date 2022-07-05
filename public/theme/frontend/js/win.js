var WIN_GUI = (function () {
    var popup = document.querySelector(".van-popup");
    var overlay = document.querySelector(".van-overlay");
    var _betting_mark = popup.querySelector(".betting-mark");
    var box_metting_text = popup.querySelector(".box .choose");

    const class_betting = "betting-mark colorsmall";
    const class_popup = "van-popup van-popup--round van-popup--bottom";

    var resetClassPopup = function () {
        _betting_mark.setAttribute("class", class_betting);
        popup.setAttribute("class", class_popup);
    };

    var showPopup = function (elms, type = "color") {
        elms.forEach(function (e, i) {
            e.addEventListener("click", function (event) {
                resetClassPopup();
                var _color = null;
                var _choose = e.innerText;
                var _prefix = "color";
                if (type == "color") {
                    _color = e.dataset.color;
                }
                if (type == "number") {
                    _color = e.innerText;
                }
                if (type == "size") {
                    _color = e.dataset.size;
                }
                if (_color != null) {
                    var _class_add_betting = _prefix + _color;
                    var _class_add_popup = "van-slide-up-enter-active";
                    _betting_mark.classList.add(_class_add_betting);
                    popup.classList.add(_class_add_popup);
                    box_metting_text.innerText = _choose;
                    overlay.style.display = "block";
                    popup.style.display = "block";
                }
            });
        });
    };
    var showBet = function () {
        var bets = document.querySelectorAll(".color-box button");
        var numbers = document.querySelectorAll(".number-box button");
        var sizes = document.querySelectorAll(".btn-box button");
        if (bets != null) {
            showPopup(bets, "color");
        }
        if (numbers != null) {
            showPopup(numbers, "number");
        }
        if (sizes != null) {
            showPopup(sizes, "size");
        }
    };
    var closeBet = function () {
        var close_betting = document.querySelector(
            ".game .betting-mark .foot .left"
        );
        close_betting.addEventListener("click", function (e) {
            popup.classList.add("van-slide-up-leave-active");
            overlay.style.display = "none";
            setTimeout(function () {
                popup.style.display = "none";
            }, 500);
        });
    };
    return {
        _: function () {
            showBet();
            closeBet();
        },
    };
})();
var WINDLOAD = (function () {
    var connecter = null;
    var wsReady = false;
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
            initActiveGameType();
            changeGameType();
        };
        connecter.onmessage = function (e) {
            var infoMessage = JSON.parse(e.data);
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
        if (wsReady) {
            connecter.send(data);
        } else {
            BASE_GUI.createFlashNotify("Không thể kết nối tới server", false);
        }
    };
    var changeGameType = function () {
        var gameTypes = document.querySelectorAll(
            ".game-betting .tab .box .item"
        );
        gameTypes.forEach(function (e, i) {
            e.addEventListener("click", function (event) {
                var _active = e.getAttribute("src-active");
                var _disable = e.getAttribute("src-disable");
                var _id = e.getAttribute("data-id");
                var img = e.querySelector("img");
                e.classList.add("action");
                img.setAttribute("src", _active);
                var gameTypesNotActive = document.querySelectorAll(
                    ".game-betting .tab .box .item:not([data-id='" + _id + "'])"
                );
                gameTypesNotActive.forEach(function (elm) {
                    elm.classList.remove("action");
                    var imgNotActive = elm.querySelector("img");
                    imgNotActive.setAttribute("src", _disable);
                });
            });
        });
    };
    var initActiveGameType = function () {
        var activeGameType = document.querySelector(
            ".game-betting .tab .box .item.action"
        );
        if (activeGameType) {
            data = {};
            data.type = connectionGameType;
            data.game_type = activeGameType.dataset.id;
            data.action = 1;
            sendData(JSON.stringify(data));
        }
    };
    return {
        _: function () {
            init();
        },
        sendData(data) {
            sendData(data);
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    WIN_GUI._();
    WINDLOAD._();
});
