/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/Base/Ajax.ts":
/*!**************************!*\
  !*** ./src/Base/Ajax.ts ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var Ajax = /** @class */ (function () {
    function Ajax() {
    }
    Ajax.get = function (url, data) {
        if (data === void 0) { data = {}; }
        return new Promise(function (resolve, reject) {
            XHR.send({
                url: url,
                method: "GET",
                data: data
            }).then(function (res) {
                if (res.code == 200 && res.html) {
                    resolve(res);
                }
                else {
                    reject(res);
                }
            });
        });
    };
    return Ajax;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Ajax);


/***/ }),

/***/ "./src/Base/BaseGameSocket.ts":
/*!************************************!*\
  !*** ./src/Base/BaseGameSocket.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _BaseGui__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BaseGui */ "./src/Base/BaseGui.ts");

var BaseGameSocket = /** @class */ (function () {
    function BaseGameSocket(psocket) {
        this.psocket = psocket;
    }
    BaseGameSocket.prototype.init = function () {
        var _this = this;
        this.psocket.init();
        this.psocket.addOpenListener(function (e) {
            _this.onOpenSocket(e);
        });
        this.psocket.addCloseListener(function (e) {
            _this.onCloseSocket(e);
        });
        this.psocket.addErrorListener(function (e) {
            _this.onErrorSocket(e);
        });
        this.psocket.addMessageListener(function (e, data) {
            _this.onMessageSocket(e, data);
        });
    };
    BaseGameSocket.prototype.onOpenSocket = function (e) {
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].hideLoading();
    };
    BaseGameSocket.prototype.onCloseSocket = function (e) {
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].showLoading();
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].createFlashNotify("Không thể kết nối tới server", false);
    };
    BaseGameSocket.prototype.onErrorSocket = function (e) {
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].showLoading();
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].createFlashNotify("Không thể kết nối tới server", false);
    };
    BaseGameSocket.prototype.onMessageSocket = function (e, data) {
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].hideLoading();
        if (data.success && data.action) {
            this.processMessageData(data);
        }
        else {
            if (data.message) {
                _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].createFlashNotify(data.message);
            }
            else {
                _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].createFlashNotify("Lỗi không xác đinh!");
            }
        }
    };
    BaseGameSocket.prototype.sendData = function (data) {
        this.psocket.sendData(data);
    };
    return BaseGameSocket;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BaseGameSocket);


/***/ }),

/***/ "./src/Base/BaseGui.ts":
/*!*****************************!*\
  !*** ./src/Base/BaseGui.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var BaseGui = /** @class */ (function () {
    function BaseGui() {
    }
    BaseGui.showLoading = function () {
        BASE_GUI.showLoading();
    };
    BaseGui.createFlashNotify = function (message, autoHide) {
        if (autoHide === void 0) { autoHide = true; }
        BASE_GUI.createFlashNotify(message, autoHide);
    };
    BaseGui.hideLoading = function () {
        BASE_GUI.hideLoading();
    };
    return BaseGui;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BaseGui);


/***/ }),

/***/ "./src/Base/Selector.ts":
/*!******************************!*\
  !*** ./src/Base/Selector.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var Selector = /** @class */ (function () {
    function Selector() {
    }
    Selector.all = function (selector) {
        return document.querySelectorAll(selector);
    };
    Selector._ = function (selector) {
        return document.querySelector(selector);
    };
    Selector.flex = function (item) {
        item.style.display = "flex";
    };
    Selector.none = function (item) {
        item.style.display = "none";
    };
    Selector.on = function (eventName, elementSelector, callback) {
        document.addEventListener(eventName, function (e) {
            for (var target = (e.target); target && target != this; target = target.parentNode) {
                if (target.matches(elementSelector)) {
                    callback(e);
                    break;
                }
            }
        }, false);
    };
    return Selector;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Selector);


/***/ }),

/***/ "./src/Base/Socket.ts":
/*!****************************!*\
  !*** ./src/Base/Socket.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _BaseGui__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BaseGui */ "./src/Base/BaseGui.ts");
/* harmony import */ var _Selector__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Selector */ "./src/Base/Selector.ts");


var Socket = /** @class */ (function () {
    function Socket(socketUrl) {
        if (socketUrl === void 0) { socketUrl = 'ws://localhost:8888/'; }
        this.socketUrl = socketUrl;
        this.connecter = null;
        this.wsReady = false;
        this.openListeners = [];
        this.messageListeners = [];
        this.closeListeners = [];
        this.errorListeners = [];
    }
    Socket.prototype.addOpenListener = function (callback) {
        if (callback) {
            this.openListeners.push(callback);
        }
    };
    Socket.prototype.addMessageListener = function (callback) {
        if (callback) {
            this.messageListeners.push(callback);
        }
    };
    Socket.prototype.addCloseListener = function (callback) {
        if (callback) {
            this.closeListeners.push(callback);
        }
    };
    Socket.prototype.addErrorListener = function (callback) {
        if (callback) {
            this.errorListeners.push(callback);
        }
    };
    Socket.prototype.sendData = function (data) {
        _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].showLoading();
        if (this.wsReady) {
            this.connecter.send(data);
        }
        else {
            _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].createFlashNotify("Không thể kết nối tới server", false);
        }
    };
    Socket.prototype.init = function () {
        var userTokenIp = _Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("input[name=auth_token]");
        if (!userTokenIp)
            return;
        var userToken = userTokenIp.value;
        var url = this.socketUrl + "?auth_token=".concat(userToken);
        this.connecter = new WebSocket(url);
        var self = this;
        this.connecter.onopen = function (e) {
            self.wsReady = true;
            for (var _i = 0, _a = self.openListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                listener(e);
            }
        };
        this.connecter.onmessage = function (e) {
            for (var _i = 0, _a = self.messageListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                var data = {};
                if (e.data) {
                    data = JSON.parse(e.data);
                }
                listener(e, data);
            }
        };
        this.connecter.onclose = function (e) {
            self.wsReady = false;
            for (var _i = 0, _a = self.closeListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                listener(e);
            }
        };
        this.connecter.onerror = function (e) {
            self.wsReady = false;
            for (var _i = 0, _a = self.errorListeners; _i < _a.length; _i++) {
                var listener = _a[_i];
                listener(e);
            }
        };
    };
    return Socket;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Socket);


/***/ }),

/***/ "./src/Lotto/Games/BaseGame.ts":
/*!*************************************!*\
  !*** ./src/Lotto/Games/BaseGame.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var BaseGame = /** @class */ (function () {
    function BaseGame(formbet) {
        this.formbet = formbet;
    }
    return BaseGame;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BaseGame);


/***/ }),

/***/ "./src/Lotto/Games/FormBet.ts":
/*!************************************!*\
  !*** ./src/Lotto/Games/FormBet.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../LottoGlobal */ "./src/Lotto/LottoGlobal.ts");


var FormBet = /** @class */ (function () {
    function FormBet(lottoSocket) {
        this.lottoSocket = lottoSocket;
        this.totalMinBet = 0;
        this.betPerNumber = 0;
        this.betWin = 0;
        this.initEvents();
        this.initSubmit();
        this.changeHtmlPreview();
    }
    FormBet.prototype.initEvents = function () {
        var self = this;
        var input = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.box_booking input[name="bet"]');
        input.addEventListener("change", function (e) {
            var _this = e.target;
            self.validateMoney(_this);
            self.changeHtmlPreview();
        });
    };
    FormBet.prototype.initSubmit = function () {
        var self = this;
        var button = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('#lotto_bet');
        button.addEventListener("click", function (e) {
            var _this = e.target;
            if (self.validateBetting()) {
                self.sendPlayRequest();
            }
        });
    };
    FormBet.prototype.sendPlayRequest = function () {
        var inputMoney = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('input[name=bet]');
        var money = parseInt(inputMoney.value) || 0;
        var numbers = this.getNumberChoosen();
        var currentGameConfig = _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].getCurrentGameConfig();
        var type = currentGameConfig.id;
        this.lottoSocket.sendPlayRequest(type, money, numbers);
    };
    FormBet.prototype.validateBetting = function () {
        var currentGameConfig = _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].getCurrentGameConfig();
        var inputMoney = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('input[name=bet]');
        if (!inputMoney || !currentGameConfig)
            return false;
        var money = parseInt(inputMoney.value) || 0;
        var numberLotto = this.getNumberChoosen().length;
        var minMoney = numberLotto * currentGameConfig.min_bet;
        var minChoose = currentGameConfig.choose_min;
        var maxChoose = currentGameConfig.choose_max;
        if (numberLotto < minChoose || numberLotto > maxChoose) {
            if (minChoose == maxChoose) {
                alert("B\u1EA1n c\u1EA7n ch\u1ECDn ".concat(minChoose, " s\u1ED1!"));
            }
            else {
                alert("B\u1EA1n c\u1EA7n ch\u1ECDn t\u1ED1i thi\u1EC3u ".concat(minChoose, " s\u1ED1 v\u00E0 t\u1ED1i \u0111a ").concat(maxChoose, " s\u1ED1!"));
            }
            return false;
        }
        if (money < minMoney) {
            alert("S\u1ED1 ti\u1EC1n t\u1ED1i thi\u1EC3u l\u00E0 ".concat(minMoney, "k!"));
            return false;
        }
        return true;
    };
    FormBet.prototype.validateMoney = function (input) {
        var value = input.value;
        value = Math.abs(value);
        if (value > 999999999999) {
            value = 999999999999;
        }
        if (value < 1) {
            value = 1;
        }
        input.value = value;
    };
    FormBet.prototype.changeHtmlPreview = function () {
        this.changeHtmlMinBet();
        this.changeHtmlBetPerNumber();
        this.changeHtmlWinBet();
    };
    FormBet.prototype.changeHtmlMinBet = function () {
        var text = "-";
        var currentConfig = _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].getCurrentGameConfig();
        if (currentConfig) {
            var minBet = parseInt(currentConfig.min_bet);
            var chooseMin = parseInt(currentConfig.choose_min);
            if (!this.hasChoosen()) {
                this.totalMinBet = minBet;
            }
            else {
                var numbers = this.getNumberChoosen();
                var numChoosen = numbers.length / chooseMin;
                numChoosen = numChoosen < 1 ? 1 : numChoosen;
                this.totalMinBet = minBet * numChoosen;
            }
            text = String(this.totalMinBet);
        }
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".plot_total .min span").innerText = text;
    };
    FormBet.prototype.changeHtmlBetPerNumber = function () {
        var text = "";
        if (!this.hasChoosen()) {
            text = "-";
        }
        else {
            var total = this.getTotalMoney();
            this.betPerNumber = total / this.totalMinBet;
            this.betPerNumber = Math.round(this.betPerNumber * 100) / 100;
            text = String(this.betPerNumber);
        }
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".plot_total .money span").innerText = text;
    };
    FormBet.prototype.changeHtmlWinBet = function () {
        var text = "";
        if (!this.hasChoosen()) {
            text = "-";
        }
        else {
            var currentConfig = _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].getCurrentGameConfig();
            if (currentConfig) {
                var win = parseInt(currentConfig.win);
                this.betWin = this.betPerNumber * win;
                this.betWin = Math.round(this.betWin * 100) / 100;
                text = String(this.betWin);
            }
        }
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".plot_total .money_win span").innerText = text;
    };
    FormBet.prototype.hasChoosen = function () {
        var items = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".ls_lotto span.lotto");
        return items.length > 0;
    };
    FormBet.prototype.getNumberChoosen = function () {
        var items = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".ls_lotto span.lotto");
        var numbers = [];
        for (var i = 0; i < items.length; i++) {
            var element = items[i];
            numbers.push(element.innerText);
        }
        return numbers;
    };
    FormBet.prototype.getTotalMoney = function () {
        var input = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.box_booking input[name="bet"]');
        var value = 1;
        if (input) {
            value = parseInt(input.value);
        }
        return value;
    };
    FormBet.prototype.updateBoxTitle = function () {
        _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].updateListLotto();
        _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].changeGameTitle();
    };
    return FormBet;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FormBet);


/***/ }),

/***/ "./src/Lotto/Games/GameChoose.ts":
/*!***************************************!*\
  !*** ./src/Lotto/Games/GameChoose.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../LottoGlobal */ "./src/Lotto/LottoGlobal.ts");
/* harmony import */ var _BaseGame__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseGame */ "./src/Lotto/Games/BaseGame.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();



var GameChoose = /** @class */ (function (_super) {
    __extends(GameChoose, _super);
    function GameChoose(formbet) {
        var _this_1 = _super.call(this, formbet) || this;
        _this_1.initEvents();
        return _this_1;
    }
    GameChoose.prototype.initEvents = function () {
        var self = this;
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].on("click", ".ls_number .item_number span", function (e) {
            var _this = e.target;
            var currentTab = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.panel .type_js.nav-item[data-state="true"]');
            var targetId = currentTab.dataset.target;
            var currentGame = currentTab.id;
            var currentConfig = LOTTO_TYPES[currentGame];
            if (_this.classList.contains("choosen")) {
                _this.classList.remove("choosen");
            }
            else {
                if (self.validate(targetId, currentConfig)) {
                    _this.classList.add("choosen");
                }
                else {
                    alert("B\u1EA1n ch\u1EC9 \u0111\u01B0\u1EE3c \u0111\u00E1nh ".concat(currentConfig.choose_max, " s\u1ED1!"));
                }
            }
            self.updateListLotto();
        });
    };
    GameChoose.prototype.updateListLotto = function () {
        _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].updateListLotto();
        this.formbet.changeHtmlPreview();
    };
    GameChoose.prototype.validate = function (targetId, currentConfig) {
        var currentPanel = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(targetId);
        var checkedItems = currentPanel.querySelectorAll(":scope .item_number span.choosen");
        if (!currentConfig)
            return false;
        if (checkedItems.length >= currentConfig.choose_max) {
            return false;
        }
        return true;
    };
    GameChoose.prototype.removeChoosen = function () {
        var items = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".item_number span.choosen");
        items.forEach(function (e, i) {
            e.classList.remove("choosen");
        });
    };
    return GameChoose;
}(_BaseGame__WEBPACK_IMPORTED_MODULE_2__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (GameChoose);


/***/ }),

/***/ "./src/Lotto/Games/GameSelect.ts":
/*!***************************************!*\
  !*** ./src/Lotto/Games/GameSelect.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../LottoGlobal */ "./src/Lotto/LottoGlobal.ts");
/* harmony import */ var _BaseGame__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseGame */ "./src/Lotto/Games/BaseGame.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();



var GameSelect = /** @class */ (function (_super) {
    __extends(GameSelect, _super);
    function GameSelect(formbet) {
        var _this_1 = _super.call(this, formbet) || this;
        _this_1.initEvents();
        return _this_1;
    }
    GameSelect.prototype.initEvents = function () {
        var self = this;
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].on("click", ".ls_number .group_number button.btn_xs", function (e) {
            var _this = e.target;
            var currentTab = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.panel .type_js.nav-item[data-state="true"]');
            var targetId = currentTab.dataset.target;
            var currentGame = currentTab.id;
            var currentConfig = LOTTO_TYPES[currentGame];
            var parent = _this.parent;
            var panel = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(targetId);
            var number = self.getChooseNumber(panel);
            self.addNumber(panel, number);
            self.updateListLotto();
        });
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].on("click", ".ls_number .item_number_select span", function (e) {
            var _this = e.target;
            var text = _this.innerHTML;
            if (confirm("B\u1EA1n mu\u1ED1n x\u00F3a s\u1ED1 ".concat(text, "?"))) {
                _this.parentElement.remove();
            }
        });
    };
    GameSelect.prototype.updateListLotto = function () {
        _LottoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].updateListLotto();
        this.formbet.changeHtmlPreview();
    };
    GameSelect.prototype.getChooseNumber = function (panel) {
        var selects = panel.querySelectorAll(".ls_number .group_number select");
        var number = "";
        for (var i = 0; i < selects.length; i++) {
            var element = selects[i];
            number += element.value;
        }
        return number;
    };
    GameSelect.prototype.addNumber = function (panel, number) {
        var listChoosen = panel.querySelector(".ls_number .ls_number.list_choosen");
        var item = listChoosen.querySelector("span[data-number=\"".concat(number, "\"]"));
        if (item) {
            alert("B\u1EA1n \u0111\u00E3 ch\u1ECDn s\u1ED1 ".concat(number, " tr\u01B0\u1EDBc \u0111\u00F3!"));
        }
        else {
            var str = "<label class=\"item_number_select\">\n            <span type=\"checkbox\" class=\"choosen\" data-number=\"".concat(number, "\">").concat(number, "</span>\n        </label>");
            listChoosen.insertAdjacentHTML("beforeend", str);
        }
    };
    GameSelect.prototype.removeChoosen = function () {
        var itemSelects = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".list_choosen .item_number_select span.choosen");
        itemSelects.forEach(function (e, i) {
            e.parentElement.remove();
        });
    };
    return GameSelect;
}(_BaseGame__WEBPACK_IMPORTED_MODULE_2__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (GameSelect);


/***/ }),

/***/ "./src/Lotto/LottoGameTimer.ts":
/*!*************************************!*\
  !*** ./src/Lotto/LottoGameTimer.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");

var LottoGameTimer = /** @class */ (function () {
    function LottoGameTimer(gameSocket) {
        this.gameSocket = gameSocket;
        this.interValGameTime = null;
        this.timeRemaining = 0;
        this.needRetreiveResult = false;
        this.gamePlinkoTimeBox = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._("#game-lotto-time-box");
    }
    LottoGameTimer.prototype.initInfo = function (data) {
        var _a;
        if (!this.gamePlinkoTimeBox || !data.html)
            return;
        this.needRetreiveResult = true;
        this.gamePlinkoTimeBox.innerHTML = data.html;
        this.timeRemaining = (_a = data.time_remaining) !== null && _a !== void 0 ? _a : 0;
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        var self = this;
        self.runMainLoop();
        this.interValGameTime = setInterval(function () {
            self.runMainLoop();
        }, 1000);
    };
    LottoGameTimer.prototype.runMainLoop = function () {
        var minutes = (this.timeRemaining / 60) | 0;
        var seconds = this.timeRemaining % 60 | 0;
        minutes = minutes < 10 ? "0" + minutes : String(minutes);
        seconds = seconds < 10 ? "0" + seconds : String(seconds);
        if (this.timeRemaining <= 0) {
            this.refreshGame();
        }
        else {
            var countDownTimeBox = this.gamePlinkoTimeBox.querySelector(".out .number");
            if (countDownTimeBox) {
                countDownTimeBox.innerHTML = "\n                        <div class=\"item\">".concat(minutes.substr(0, 1), "</div>\n                        <div class=\"item\">").concat(minutes.substr(1, 1), "</div>\n                        <div class=\"item c-row c-row-middle\">:</div>\n                        <div class=\"item\">").concat(seconds.substr(0, 1), "</div>\n                        <div class=\"item\">").concat(seconds.substr(1, 1), "</div>\n                    ");
            }
        }
        this.showTimeChecker();
        this.timeRemaining--;
    };
    LottoGameTimer.prototype.refreshGame = function () {
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
    };
    LottoGameTimer.prototype.showTimeChecker = function () {
        var mark = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".result_plot_threads .mark-box");
        var lastPoint = parseInt(LOTTO_CONFIG.LAST_POINT_TO_BET);
        var duration = parseInt(LOTTO_CONFIG.NUMBER_TIME_TO_CHECK);
        var showCountDownCalculate = this.timeRemaining <= lastPoint &&
            this.timeRemaining >= lastPoint - duration;
        if (showCountDownCalculate) {
            _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].flex(mark);
            var time = lastPoint - this.timeRemaining;
            time = Math.abs(time - duration);
            time = time < 10 ? "0" + time : "" + time;
            var html = "";
            for (var i = 0; i < time.length; i++) {
                html += "<span class=\"item m-r-20\">".concat(time.charAt(i), "</span>");
            }
            mark.innerHTML = html;
        }
        else {
            _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].none(mark);
        }
        if (this.timeRemaining < lastPoint - duration) {
            if (!this.needRetreiveResult)
                return;
            this.needRetreiveResult = false;
            // this.plinkoSocket.retrieveResult();
        }
    };
    return LottoGameTimer;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LottoGameTimer);


/***/ }),

/***/ "./src/Lotto/LottoGlobal.ts":
/*!**********************************!*\
  !*** ./src/Lotto/LottoGlobal.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");

var LottoGlobal = /** @class */ (function () {
    function LottoGlobal() {
    }
    Object.defineProperty(LottoGlobal, "currentGameInfo", {
        get: function () {
            return LottoGlobal._currentGameInfo;
        },
        set: function (value) {
            LottoGlobal._currentGameInfo = value;
        },
        enumerable: false,
        configurable: true
    });
    LottoGlobal.changeGameTitle = function () {
        var html = "<span class=\"domain xs\">Mi\u1EC1n B\u1EAFc</span> / ";
        var title = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".box_booking .box_mini .types");
        var category = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".item_type_game.nav-item input[name=category]:checked");
        var categoryParent = category.parentElement;
        if (categoryParent) {
            html += "<span class=\"lotto xs\">".concat(categoryParent.innerText, "</span> / ");
        }
        var type = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.type_js.nav-item input[name="type"]:checked');
        var typeParent = type.parentElement;
        if (typeParent) {
            html += "<span class=\"type xs\">".concat(typeParent.innerText, "</span>");
        }
        title.innerHTML = html;
    };
    LottoGlobal.updateListLotto = function () {
        var lottos = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".ls_lotto");
        var html = "";
        var items = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".item_number span.choosen");
        var itemSelects = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].all(".list_choosen .item_number_select span.choosen");
        if (items.length > 0) {
            items.forEach(function (e, i) {
                html += "<span class=\"lotto\">".concat(e.innerText, "</span>");
            });
        }
        else if (itemSelects.length > 0) {
            itemSelects.forEach(function (e, i) {
                html += "<span class=\"lotto\">".concat(e.innerText, "</span>");
            });
        }
        else {
            html = "<span class=\"no-result\">Ch\u01B0a ch\u1ECDn s\u1ED1</span>";
        }
        lottos.innerHTML = html;
    };
    LottoGlobal.getCurrentTypeGame = function () {
        var currentTab = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._('.panel .type_js.nav-item[data-state="true"]');
        if (!currentTab)
            return 0;
        return currentTab.id;
    };
    LottoGlobal.getCurrentGameConfig = function () {
        var currentGame = this.getCurrentTypeGame();
        var currentConfig = LOTTO_TYPES[currentGame] || {};
        return currentConfig;
    };
    LottoGlobal._currentGameInfo = {};
    return LottoGlobal;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LottoGlobal);


/***/ }),

/***/ "./src/Lotto/LottoSocket.ts":
/*!**********************************!*\
  !*** ./src/Lotto/LottoSocket.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_BaseGameSocket__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/BaseGameSocket */ "./src/Base/BaseGameSocket.ts");
/* harmony import */ var _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Base/BaseGui */ "./src/Base/BaseGui.ts");
/* harmony import */ var _LottoGlobal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./LottoGlobal */ "./src/Lotto/LottoGlobal.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();



var LottoSocket = /** @class */ (function (_super) {
    __extends(LottoSocket, _super);
    function LottoSocket(psocket) {
        return _super.call(this, psocket) || this;
    }
    LottoSocket.prototype.onOpenSocket = function (e) {
        _super.prototype.onOpenSocket.call(this, e);
        this.initGame();
        if (this.onOpenSocketCallback) {
            this.onOpenSocketCallback(e);
        }
    };
    LottoSocket.prototype.initGame = function () {
        var data = {};
        data.type = connectionGameType;
        data.action = LOTTO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO;
        this.sendData(JSON.stringify(data));
    };
    LottoSocket.prototype.retrieveResult = function () {
        var data = {};
        data.type = connectionGameType;
        data.currentGame = _LottoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].currentGameInfo;
        data.action = LOTTO_STATUS.GAME_ACTION_RETRIEVE_RESULT;
        this.sendData(JSON.stringify(data));
    };
    LottoSocket.prototype.sendPlayRequest = function (type, money, numbers) {
        var data = {};
        data.type = connectionGameType;
        data.action = LOTTO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = _LottoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].currentGameInfo;
        var gameData = {
            type: type,
            money: money,
            numbers: numbers,
        };
        data.gameData = gameData;
        this.sendData(JSON.stringify(data));
    };
    LottoSocket.prototype.betSuccess = function (data) {
        _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__["default"].createFlashNotify("Bet thành công.");
        window.location.href = window.location.href;
    };
    LottoSocket.prototype.processMessageData = function (data) {
        var _a;
        switch (data.action) {
            case LOTTO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                var dataAttachment = data.data;
                _LottoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].currentGameInfo.current_game_idx =
                    (_a = dataAttachment.current_game_idx) !== null && _a !== void 0 ? _a : "";
                if (this.onInitGameCallback) {
                    this.onInitGameCallback(dataAttachment);
                }
                break;
            case LOTTO_STATUS.GAME_ACTION_DO_BET:
                this.betSuccess(data.data);
                break;
            case LOTTO_STATUS.GAME_ACTION_RETRIEVE_RESULT:
                break;
            default:
                break;
        }
    };
    return LottoSocket;
}(_Base_BaseGameSocket__WEBPACK_IMPORTED_MODULE_0__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LottoSocket);


/***/ }),

/***/ "./src/Lotto/LottoUi.ts":
/*!******************************!*\
  !*** ./src/Lotto/LottoUi.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Ajax__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Ajax */ "./src/Base/Ajax.ts");
/* harmony import */ var _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Base/BaseGui */ "./src/Base/BaseGui.ts");
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (undefined && undefined.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};



var LottoUi = /** @class */ (function () {
    function LottoUi(formbet, gameChoose, gameSelect) {
        this.formbet = formbet;
        this.gameChoose = gameChoose;
        this.gameSelect = gameSelect;
    }
    LottoUi.prototype.init = function () {
        this.initEvents();
        this.showQuestion();
    };
    LottoUi.prototype.initEvents = function () {
        this.initEventCategoryChange();
        this.initEventTypeChange();
    };
    LottoUi.prototype.initEventCategoryChange = function () {
        var self = this;
        var typeGames = _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"].all(".item_type_game input");
        typeGames.forEach(function (typeGame) {
            typeGame.addEventListener("change", function (e) {
                return __awaiter(this, void 0, void 0, function () {
                    var input, parent, type, content, target, otherpanels;
                    return __generator(this, function (_a) {
                        switch (_a.label) {
                            case 0:
                                input = this;
                                parent = this.parentElement;
                                type = input ? input.value : 0;
                                _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__["default"].showLoading();
                                return [4 /*yield*/, self.getGameContent(type)];
                            case 1:
                                content = _a.sent();
                                _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__["default"].hideLoading();
                                target = _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"]._(parent.getAttribute("data-target"));
                                otherpanels = target.parentElement.querySelectorAll(":scope > .panel");
                                otherpanels.forEach(function (otherpanel, i) {
                                    otherpanel.innerHTML = "";
                                });
                                target.innerHTML = content.html;
                                self.updateAfterGetGameContent();
                                return [2 /*return*/];
                        }
                    });
                });
            }, false);
        });
        if (typeGames.length > 0) {
            var input = typeGames[0];
            var eventInit = new Event("change");
            input.dispatchEvent(eventInit);
        }
    };
    LottoUi.prototype.updateAfterGetGameContent = function () {
        this.formbet.updateBoxTitle();
        this.formbet.changeHtmlPreview();
    };
    LottoUi.prototype.initEventTypeChange = function () {
        var self = this;
        _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"].on("change", ".type_js.nav-item input[name=type]", function (e) {
            self.clearChoosenItem();
            self.formbet.updateBoxTitle();
        });
    };
    LottoUi.prototype.clearChoosenItem = function () {
        this.gameChoose.removeChoosen();
        this.gameSelect.removeChoosen();
    };
    LottoUi.prototype.getGameContent = function (typeGame) {
        return _Base_Ajax__WEBPACK_IMPORTED_MODULE_0__["default"].get("get-game-lotto-content", { typeGame: typeGame });
    };
    LottoUi.prototype.showQuestion = function () {
        _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"].on("click", "span.question", function (e) {
            var _this = e.target;
            var next = _this.nextElementSibling;
            if (!next) {
                return;
            }
            if (!next.classList.contains("active")) {
                next.classList.add("active");
            }
            else {
                next.classList.remove("active");
            }
        });
    };
    return LottoUi;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (LottoUi);


/***/ }),

/***/ "./src/Lotto/TabPanel.ts":
/*!*******************************!*\
  !*** ./src/Lotto/TabPanel.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");

var TabPanel = /** @class */ (function () {
    function TabPanel(selector) {
        if (selector === void 0) { selector = ".nav-item"; }
        this.selector = selector;
        this.initEvents();
    }
    TabPanel.prototype.initEvents = function () {
        var self = this;
        _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].on('click', this.selector, function (e) {
            var _this = e.target;
            var _targetId = _this.dataset.target;
            var _target = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(_targetId);
            if (!_target) {
                return;
            }
            var parent = _target.parentElement;
            var allPanel = parent.querySelectorAll(':scope > .panel');
            allPanel.forEach(function (panel, i) {
                panel.style.display = "none";
                panel.dataset.state = "hide";
            });
            _target.style.display = "block";
            _target.dataset.state = "show";
            var allNavs = _this.parentElement.querySelectorAll(':scope > ' + self.selector);
            allNavs.forEach(function (panel, i) {
                panel.dataset.state = "false";
            });
            _this.dataset.state = "true";
        });
    };
    return TabPanel;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (TabPanel);


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/lotto.ts ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Base_Socket__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Base/Socket */ "./src/Base/Socket.ts");
/* harmony import */ var _Lotto_Games_FormBet__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Lotto/Games/FormBet */ "./src/Lotto/Games/FormBet.ts");
/* harmony import */ var _Lotto_Games_GameChoose__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Lotto/Games/GameChoose */ "./src/Lotto/Games/GameChoose.ts");
/* harmony import */ var _Lotto_Games_GameSelect__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Lotto/Games/GameSelect */ "./src/Lotto/Games/GameSelect.ts");
/* harmony import */ var _Lotto_LottoGameTimer__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./Lotto/LottoGameTimer */ "./src/Lotto/LottoGameTimer.ts");
/* harmony import */ var _Lotto_LottoSocket__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./Lotto/LottoSocket */ "./src/Lotto/LottoSocket.ts");
/* harmony import */ var _Lotto_LottoUi__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./Lotto/LottoUi */ "./src/Lotto/LottoUi.ts");
/* harmony import */ var _Lotto_TabPanel__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./Lotto/TabPanel */ "./src/Lotto/TabPanel.ts");








var tabPanel = new _Lotto_TabPanel__WEBPACK_IMPORTED_MODULE_7__["default"]();
var socket = new _Base_Socket__WEBPACK_IMPORTED_MODULE_0__["default"]('ws://localhost:8888/');
var lottoSocket = new _Lotto_LottoSocket__WEBPACK_IMPORTED_MODULE_5__["default"](socket);
var plinkoGameTimer = new _Lotto_LottoGameTimer__WEBPACK_IMPORTED_MODULE_4__["default"](lottoSocket);
lottoSocket.onOpenSocketCallback = function () {
};
lottoSocket.onInitGameCallback = function (data) {
    plinkoGameTimer.initInfo(data);
};
lottoSocket.init();
var formBet = new _Lotto_Games_FormBet__WEBPACK_IMPORTED_MODULE_1__["default"](lottoSocket);
var gameChoose = new _Lotto_Games_GameChoose__WEBPACK_IMPORTED_MODULE_2__["default"](formBet);
var gameSelect = new _Lotto_Games_GameSelect__WEBPACK_IMPORTED_MODULE_3__["default"](formBet);
var lottoUi = new _Lotto_LottoUi__WEBPACK_IMPORTED_MODULE_6__["default"](formBet, gameChoose, gameSelect);
lottoUi.init();

})();

/******/ })()
;