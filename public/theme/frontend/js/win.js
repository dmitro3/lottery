var WIN_GUI = (function () {
    var popup = document.querySelector(".van-popup");
    var overlay = document.querySelector(".van-overlay");
    var _betting_mark = popup.querySelector(".betting-mark");
    var box_metting_text = popup.querySelector(".box .choose");
    var ipMiniGame = popup.querySelector("input[name=mini_game]");
    var ipMiniGameValue = popup.querySelector("input[name=mini_game_value]");
    var popupCurrentGameName = document.querySelector(
        ".betting-mark .head .box .con"
    );
    const class_betting = "betting-mark colorsmall";
    const class_popup = "van-popup van-popup--round van-popup--bottom head";

    var resetClassPopup = function () {
        _betting_mark.setAttribute("class", class_betting);
        popup.setAttribute("class", class_popup);
    };

    var showPopup = function (elms, type = "color") {
        elms.forEach(function (e, i) {
            e.addEventListener("click", function (event) {
                resetClassPopup();
                if (popupCurrentGameName) {
                    popupCurrentGameName.innerHTML =
                        WINDLOAD.currentGameInfo.game_type_name ?? "";
                }
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
                if (ipMiniGame) {
                    ipMiniGame.value = type;
                }
                if (_color != null) {
                    if (ipMiniGameValue) {
                        ipMiniGameValue.value = _color;
                    }
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
            _closeBet();
        });
    };
    var _closeBet = function () {
        popup.classList.add("van-slide-up-leave-active");
        overlay.style.display = "none";
        setTimeout(function () {
            popup.style.display = "none";
        }, 500);
        WIN_CALCULATE.resetAll();
    };
    var _getRandomInteger = function (min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    };
    var randomNumberBet = function () {
        var randomNumberBetBtn = document.querySelector(
            "#random-number-bet-btn"
        );
        function timerRandom(ms) {
            return new Promise(function (res) {
                return setTimeout(res, ms);
            });
        }
        async function doRandomNum(times, listBtnNumber) {
            var activeItem = null;
            for (var i = 0; i < times; i++) {
                var randNumer = _getRandomInteger(0, listBtnNumber.length - 1);
                console.log();
                activeItem = listBtnNumber[randNumer];
                activeItem.classList.add("action");
                setTimeout(() => {
                    activeItem.classList.remove("action");
                }, 60);
                await timerRandom(80);
            }
            if (activeItem) {
                activeItem.click();
            }
        }
        var listBtnNumber = document.querySelectorAll(
            ".game-betting .number-box .item"
        );
        if (randomNumberBetBtn && listBtnNumber.length > 1) {
            randomNumberBetBtn.addEventListener("click", function () {
                doRandomNum(50, listBtnNumber);
            });
        }
    };
    return {
        ipMiniGame: ipMiniGame,
        ipMiniGameValue: ipMiniGameValue,
        _: function () {
            showBet();
            closeBet();
            randomNumberBet();
        },
        _closeBet() {
            _closeBet();
        },
    };
})();
var WIN_CALCULATE = (function () {
    var gowinQtyInput = document.querySelector("#gowin-qty-input");
    var listItemGlobalMultiple = document.querySelectorAll(
        ".game-betting .random-box .item"
    );
    var listItemBettingMoney = document.querySelectorAll(
        ".betting-mark .amount-box .li"
    );
    var listItemBettingMultiple = document.querySelectorAll(
        ".betting-mark .multiple-box .li"
    );
    var minusQtyBtn = document.querySelector(
        ".betting-mark .stepper-box .minus"
    );
    var plusQtyBtn = document.querySelector(".betting-mark .stepper-box .plus");
    var bettingMarkTotalMoney = document.querySelector(
        "#betting-mark-total-money"
    );
    var initGlobalMultiple = function () {
        listItemGlobalMultiple.forEach((element) => {
            element.addEventListener("click", function () {
                if (this.classList.contains("active")) {
                    return;
                } else {
                    listItemGlobalMultiple.forEach((elm) => {
                        elm.classList.remove("active");
                    });
                    this.classList.add("active");
                    var multiple = parseInt(this.dataset.multiple);
                    if (gowinQtyInput) {
                        gowinQtyInput.value = multiple;
                        BASE_SUPPORT._dispatchEvent(gowinQtyInput, "change");
                    }
                }
            });
        });
    };
    var _resetGlobalMultiple = function () {
        listItemGlobalMultiple.forEach((element) => {
            if (element.classList.contains("default")) {
                element.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        });
    };
    var initBettingMoney = function () {
        listItemBettingMoney.forEach((element) => {
            element.addEventListener("click", function () {
                if (this.classList.contains("active")) {
                    return;
                } else {
                    listItemBettingMoney.forEach((elm) => {
                        elm.classList.remove("active");
                    });
                    this.classList.add("active");
                    calculateTotalMoney();
                }
            });
        });
    };
    var _resetBettingMoney = function () {
        listItemBettingMoney.forEach((element) => {
            if (element.classList.contains("default")) {
                element.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        });
    };
    var initBettingMultiple = function () {
        listItemBettingMultiple.forEach((element) => {
            element.addEventListener("click", function () {
                if (this.classList.contains("active")) {
                    return;
                } else {
                    listItemBettingMultiple.forEach((elm) => {
                        elm.classList.remove("active");
                    });
                    this.classList.add("active");
                    var multiple = parseInt(this.dataset.multiple);
                    if (gowinQtyInput) {
                        gowinQtyInput.value = multiple;
                        BASE_SUPPORT._dispatchEvent(gowinQtyInput, "change");
                    }
                }
            });
        });
    };
    var _resetBettingMultiple = function () {
        listItemBettingMultiple.forEach((element) => {
            if (element.classList.contains("default")) {
                element.classList.add("active");
            } else {
                element.classList.remove("active");
            }
        });
    };
    var initInputQty = function () {
        if (gowinQtyInput) {
            gowinQtyInput.addEventListener("change", function () {
                _initInputQty();
            });
            gowinQtyInput.addEventListener("input", function () {
                _initInputQty();
            });
            if (minusQtyBtn) {
                minusQtyBtn.addEventListener("click", function () {
                    if (!this.classList.contains("active")) {
                        return;
                    }
                    if (
                        isNaN(gowinQtyInput.value) ||
                        gowinQtyInput.value == ""
                    ) {
                        gowinQtyInput.value = 1;
                    } else {
                        gowinQtyInput.value = parseInt(gowinQtyInput.value) - 1;
                    }
                    BASE_SUPPORT._dispatchEvent(gowinQtyInput, "change");
                });
            }
            if (plusQtyBtn) {
                plusQtyBtn.addEventListener("click", function () {
                    if (!this.classList.contains("active")) {
                        return;
                    }
                    if (
                        isNaN(gowinQtyInput.value) ||
                        gowinQtyInput.value == ""
                    ) {
                        gowinQtyInput.value = 1;
                    } else {
                        gowinQtyInput.value = parseInt(gowinQtyInput.value) + 1;
                    }
                    BASE_SUPPORT._dispatchEvent(gowinQtyInput, "change");
                });
            }
        }
    };
    var _initInputQty = function () {
        if (parseInt(gowinQtyInput.value) <= 1) {
            gowinQtyInput.value = 1;
            if (minusQtyBtn) {
                minusQtyBtn.classList.remove("active");
            }
        } else {
            if (minusQtyBtn) {
                minusQtyBtn.classList.add("active");
            }
        }
        if (parseInt(gowinQtyInput.value) >= 999) {
            gowinQtyInput.value = 999;
            if (plusQtyBtn) {
                plusQtyBtn.classList.remove("active");
            }
        } else {
            if (plusQtyBtn) {
                plusQtyBtn.classList.add("active");
            }
        }
        var itemBettingMarkMultiple = document.querySelector(
            `.betting-mark .multiple-box .li[data-multiple="${gowinQtyInput.value}"]`
        );
        if (itemBettingMarkMultiple) {
            if (!itemBettingMarkMultiple.classList.contains("active")) {
                listItemBettingMultiple.forEach((element) => {
                    element.classList.remove("active");
                });
                itemBettingMarkMultiple.classList.add("active");
            }
        } else {
            listItemBettingMultiple.forEach((element) => {
                element.classList.remove("active");
            });
        }
        var itemGlobalMultiple = document.querySelector(
            `.game-betting .random-box .item[data-multiple="${gowinQtyInput.value}"]`
        );
        if (itemGlobalMultiple) {
            if (!itemGlobalMultiple.classList.contains("active")) {
                listItemGlobalMultiple.forEach((element) => {
                    element.classList.remove("active");
                });
                itemGlobalMultiple.classList.add("active");
            }
        } else {
            listItemGlobalMultiple.forEach((element) => {
                element.classList.remove("active");
            });
        }
        calculateTotalMoney();
    };
    var resetAll = function () {
        _resetGlobalMultiple();
        _resetBettingMultiple();
        _resetBettingMoney();
        if (gowinQtyInput) {
            gowinQtyInput.value = 1;
        }
        if (minusQtyBtn) {
            minusQtyBtn.classList.remove("active");
        }
        if (plusQtyBtn) {
            plusQtyBtn.classList.add("active");
        }
        calculateTotalMoney();
    };
    var calculateTotalMoney = function () {
        var itemBettingMarkAmountAcitve = document.querySelector(
            ".betting-mark .amount-box .active"
        );
        if (
            bettingMarkTotalMoney &&
            gowinQtyInput &&
            itemBettingMarkAmountAcitve
        ) {
            var totalMoney =
                parseInt(gowinQtyInput.value) *
                parseInt(itemBettingMarkAmountAcitve.dataset.amount);
            if (!isNaN(totalMoney) && totalMoney != "") {
                bettingMarkTotalMoney.innerHTML =
                    BASE_GUI.formatCurrency(totalMoney);
            }
        }
    };
    return {
        gowinQtyInput: gowinQtyInput,
        _: function () {
            initGlobalMultiple();
            initBettingMoney();
            initBettingMultiple();
            initInputQty();
            calculateTotalMoney();
        },
        resetAll() {
            resetAll();
        },
    };
})();
var WINDLOAD = (function () {
    var connecter = null;
    var wsReady = false;
    var currentGameInfo = {};
    var interValGameTime = null;
    var timeRemaining = 0;

    var gameGowinTimeBox = document.querySelector("#game-gowin-time-box");
    var markSelectBox = document.querySelector(
        ".game-betting .content .box .mark-box"
    );
    var voice1 = document.querySelector("#voice1");
    var voice2 = document.querySelector("#voice2");
    var turnAudiorightWrongNotice =
        BASE_SUPPORT.getCookie("switch_audio") === "true";
    var acceptRuleBox = document.querySelector("#accept-rule-box");

    var sendGameWinBetBtn = document.querySelector("#send-game-win-bet");

    var switchAudio = function (elm) {
        var imageIcon = elm.querySelector("img");
        if (imageIcon) {
            if (turnAudiorightWrongNotice) {
                imageIcon.setAttribute(
                    "src",
                    "theme/frontend/img/volume-off-outline.png"
                );
            } else {
                imageIcon.setAttribute(
                    "src",
                    "theme/frontend/img/volume-up-line.png"
                );
            }
        }
        turnAudiorightWrongNotice = !turnAudiorightWrongNotice;
        BASE_SUPPORT.setCookie("switch_audio", turnAudiorightWrongNotice, 60);
    };
    var initAudio = function () {
        var swichAudioElm = document.querySelector("#switch_audio");
        if (swichAudioElm) {
            var imageIcon = swichAudioElm.querySelector("img");
            if (imageIcon) {
                if (turnAudiorightWrongNotice == true) {
                    imageIcon.setAttribute(
                        "src",
                        "theme/frontend/img/volume-up-line.png"
                    );
                } else {
                    imageIcon.setAttribute(
                        "src",
                        "theme/frontend/img/volume-off-outline.png"
                    );
                }
            }
        }
    };
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
    var changeGameType = function () {
        var gameTypes = document.querySelectorAll(
            ".game-betting .tab .box .item"
        );
        gameTypes.forEach(function (element, i) {
            element.addEventListener("click", function (event) {
                if (this.classList.contains("action")) {
                    return;
                }
                var _active = this.getAttribute("src-active");
                var _disable = this.getAttribute("src-disable");
                var _id = this.getAttribute("data-id");
                var img = this.querySelector("img");
                this.classList.add("action");
                img.setAttribute("src", _active);
                var gameTypesNotActive = document.querySelectorAll(
                    ".game-betting .tab .box .item:not([data-id='" + _id + "'])"
                );
                gameTypesNotActive.forEach(function (elm) {
                    elm.classList.remove("action");
                    var imgNotActive = elm.querySelector("img");
                    imgNotActive.setAttribute("src", _disable);
                });
                initActiveGameType();
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

    var initSendGameWinBet = function () {
        if (sendGameWinBetBtn) {
            sendGameWinBetBtn.addEventListener("click", function () {
                var itemBettingMarkAmountAcitve = document.querySelector(
                    ".betting-mark .amount-box .active"
                );
                if (!itemBettingMarkAmountAcitve) {
                    BASE_GUI.createFlashNotify("Vui lòng chọn số tiền!");
                    return;
                }
                if (
                    !acceptRuleBox ||
                    acceptRuleBox.getAttribute("aria-checked") != "true"
                ) {
                    BASE_GUI.createFlashNotify(
                        "Vui lòng kiểm tra tôi đã đồng ý quy tắc bán trước!"
                    );
                    return;
                }
                if (timeRemaining <= 5) {
                    swal({
                        title: "Đã hết thời gian đặt cược!",
                        text: "Đã hết thời gian đặt cược cho ván này. Vui lòng đợi ván sau!",
                        icon: "error",
                        button: "Đóng!",
                    });
                    WIN_GUI._closeBet();
                    return;
                }
                var data = {};
                data.type = connectionGameType;
                data.currentGame = currentGameInfo;
                data.action = 2;
                data.mini_game = WIN_GUI.ipMiniGame
                    ? WIN_GUI.ipMiniGame.value
                    : "";
                data.mini_game_value = WIN_GUI.ipMiniGameValue
                    ? WIN_GUI.ipMiniGameValue.value
                    : "";
                data.qty = WIN_CALCULATE.gowinQtyInput
                    ? WIN_CALCULATE.gowinQtyInput.value
                    : "";
                data.amount =
                    itemBettingMarkAmountAcitve.getAttribute("amount");
                sendData(JSON.stringify(data));
                WIN_GUI._closeBet();
            });
        }
    };
    var actionProvider = function (data) {
        BASE_GUI.hideLoading();
        if (data.success && data.action) {
            switch (data.action) {
                case 1:
                    initGameTypeInfo(data.data);
                    break;
                case 2:
                    betSuccess(data.data);
                default:
                    break;
            }
        } else {
            if (data.message) {
                swal({
                    title: "Lỗi!",
                    text: data.message,
                    icon: "error",
                    button: "Đóng!",
                });
            } else {
                swal({
                    title: "Lỗi!",
                    text: "Lỗi không xác định",
                    icon: "error",
                    button: "Đóng!",
                });
            }
        }
    };
    var initGameTypeInfo = function (data) {
        currentGameInfo.game_type = data.game_type ?? "";
        currentGameInfo.current_game_idx = data.current_game_idx ?? "";
        currentGameInfo.game_type_name = data.game_type_name ?? "";
        if (gameGowinTimeBox && data.html) {
            gameGowinTimeBox.innerHTML = data.html;
            timeRemaining = data.time_remaining ?? 0;
            var countDownTimeBox =
                gameGowinTimeBox.querySelector(".out .number");
            if (interValGameTime) {
                clearInterval(interValGameTime);
            }
            function gameTimer() {
                minutes = (timeRemaining / 60) | 0;
                seconds = timeRemaining % 60 | 0;
                minutes = minutes < 10 ? "0" + minutes : String(minutes);
                seconds = seconds < 10 ? "0" + seconds : String(seconds);
                if (
                    timeRemaining > 1 &&
                    timeRemaining <= 5 &&
                    turnAudiorightWrongNotice
                ) {
                    if (voice1) {
                        voice1.play();
                    }
                }
                if (timeRemaining == 1 && turnAudiorightWrongNotice) {
                    if (voice2) {
                        voice2.play();
                    }
                }

                if (timeRemaining <= 5) {
                    WIN_GUI._closeBet();
                    if (markSelectBox) {
                        markSelectBox.style.display = "flex";
                        markSelectBox.innerHTML = `
                            <span class="item m-r-20">${seconds.substr(
                                0,
                                1
                            )}</span>
                            <span class="item m-l-20">${seconds.substr(
                                1,
                                1
                            )}</span>
                        `;
                    }
                } else {
                    if (markSelectBox) {
                        markSelectBox.style.display = "none";
                        markSelectBox.innerHTML = "";
                    }
                }
                if (timeRemaining <= 0) {
                    if (interValGameTime) {
                        clearInterval(interValGameTime);
                    }
                    initActiveGameType();
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
        console.log(data);
        var htmlContent = document.createElement("div");
        htmlContent.classList.add("content-game-win-bet-scuccess");
        htmlContent.innerHTML = `
            <div class="item-info">
                <div class="title">Phiên giao dịch:</div>
                <div class="value">
                    <strong>${data.game_idx}</strong>
                    <span class="small-note">(${data.game_type_name})</span>
                </div>
            </div>
            <div class="item-info">
                <div class="title">Mặt hàng đã chọn:</div>
                <div class="value">
                    ${data.mini_game_name} : 
                    <strong>${data.value_select_name}</strong>
                </div>
            </div>
            <div class="item-info">
                <div class="title">Số tiền giao dịch:</div>
                <div class="value">
                    ${data.qty} x ${data.base_amount} = <strong>${data.amount}</strong>
                </div>
            </div>
        `;
        swal({
            title: "Đặt hàng thành công!",
            content: htmlContent,
            icon: "success",
            button: "Đóng",
        });
    };
    return {
        currentGameInfo: currentGameInfo,
        _: function () {
            init();
            initAudio();
            initSendGameWinBet();
        },
        sendData(data) {
            sendData(data);
        },
        switchAudio(elm) {
            switchAudio(elm);
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    WIN_GUI._();
    WIN_CALCULATE._();
    WINDLOAD._();
});
