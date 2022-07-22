/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

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
    BaseGameSocket.prototype.sendData = function (data, showLoading) {
        if (showLoading === void 0) { showLoading = true; }
        this.psocket.sendData(data, showLoading);
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

/***/ "./src/Base/InactiveBrowser.ts":
/*!*************************************!*\
  !*** ./src/Base/InactiveBrowser.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var InactiveBrowser = /** @class */ (function () {
    function InactiveBrowser() {
        this.browserPrefixes = ['moz', 'ms', 'o', 'webkit'];
        this.isVisible = true;
        this.browserPrefix = this.getBrowserPrefix();
        this.hiddenPropertyName = this.getHiddenPropertyName(this.browserPrefix);
        this.visibilityEventName = this.getVisibilityEvent(this.browserPrefix);
        this.initEvent();
    }
    InactiveBrowser.prototype.getHiddenPropertyName = function (prefix) {
        return (prefix ? prefix + 'Hidden' : 'hidden');
    };
    InactiveBrowser.prototype.getVisibilityEvent = function (prefix) {
        return (prefix ? prefix : '') + 'visibilitychange';
    };
    InactiveBrowser.prototype.getBrowserPrefix = function () {
        for (var i = 0; i < this.browserPrefixes.length; i++) {
            if (this.getHiddenPropertyName(this.browserPrefixes[i]) in document) {
                return this.browserPrefixes[i];
            }
        }
        return null;
    };
    InactiveBrowser.prototype.onVisible = function () {
        if (this.isVisible) {
            return;
        }
        this.isVisible = true;
        if (this.onEventVisible) {
            this.onEventVisible();
        }
    };
    InactiveBrowser.prototype.onHidden = function () {
        if (!this.isVisible) {
            return;
        }
        this.isVisible = false;
        if (this.onEventHidden) {
            this.onEventHidden();
        }
    };
    InactiveBrowser.prototype.handleVisibilityChange = function (forcedFlag) {
        if (typeof forcedFlag === "boolean") {
            if (forcedFlag) {
                return this.onVisible();
            }
            return this.onHidden();
        }
        if (document[this.hiddenPropertyName]) {
            return this.onHidden();
        }
        return this.onVisible();
    };
    InactiveBrowser.prototype.initEvent = function () {
        var self = this;
        document.addEventListener(this.visibilityEventName, function () {
            self.handleVisibilityChange('khong can');
        }, false);
        document.addEventListener('focus', function () {
            self.handleVisibilityChange(true);
        }, false);
        document.addEventListener('blur', function () {
            self.handleVisibilityChange(false);
        }, false);
        window.addEventListener('focus', function () {
            self.handleVisibilityChange(true);
        }, false);
        window.addEventListener('blur', function () {
            self.handleVisibilityChange(false);
        }, false);
    };
    return InactiveBrowser;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (InactiveBrowser);


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
    Socket.prototype.sendData = function (data, showLoading) {
        if (showLoading === void 0) { showLoading = true; }
        if (showLoading) {
            _BaseGui__WEBPACK_IMPORTED_MODULE_0__["default"].showLoading();
        }
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

/***/ "./src/PlinkoV2/PlinkoGameTimer.ts":
/*!*****************************************!*\
  !*** ./src/PlinkoV2/PlinkoGameTimer.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PlinkoGlobal */ "./src/PlinkoV2/PlinkoGlobal.ts");
/* harmony import */ var _PlinkoStorage__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PlinkoStorage */ "./src/PlinkoV2/PlinkoStorage.ts");



var PlinkoGameTimer = /** @class */ (function () {
    function PlinkoGameTimer(plinkoSocket) {
        this.plinkoSocket = plinkoSocket;
        this.interValGameTime = null;
        this.timeRemaining = 0;
        this.needRetreiveResult = false;
        this.gamePlinkoTimeBox = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._("#game-plinko-time-box");
    }
    PlinkoGameTimer.prototype.initInfo = function (data) {
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
    PlinkoGameTimer.prototype.runMainLoop = function () {
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
        this.autoPlay();
        this.timeRemaining--;
    };
    PlinkoGameTimer.prototype.refreshGame = function () {
        if (this.interValGameTime) {
            clearInterval(this.interValGameTime);
        }
        if (_PlinkoStorage__WEBPACK_IMPORTED_MODULE_2__["default"].isInactive()) {
            window.location.href = window.location.href;
        }
        else {
            this.plinkoSocket.initGame();
        }
    };
    PlinkoGameTimer.prototype.showTimeChecker = function () {
        var mark = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".game-betting .mark-box");
        var lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        var showCountDownCalculate = this.timeRemaining <= lastPoint;
        if (showCountDownCalculate) {
            _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"].flex(mark);
            var time = this.timeRemaining;
            time = Math.abs(time);
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
    };
    PlinkoGameTimer.prototype.autoPlay = function () {
        var lastPoint = parseInt(PLINKO_CONFIG.LAST_POINT_TO_BET);
        var status = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].acceptBet() && this.timeRemaining > lastPoint;
        if (_PlinkoGlobal__WEBPACK_IMPORTED_MODULE_1__["default"].isAutoMode() && status) {
            this.plinkoSocket.sendPlayRequest(false);
        }
    };
    return PlinkoGameTimer;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoGameTimer);


/***/ }),

/***/ "./src/PlinkoV2/PlinkoGlobal.ts":
/*!**************************************!*\
  !*** ./src/PlinkoV2/PlinkoGlobal.ts ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");

var PlinkoGlobal = /** @class */ (function () {
    function PlinkoGlobal() {
    }
    Object.defineProperty(PlinkoGlobal, "currentGameInfo", {
        get: function () {
            return PlinkoGlobal._currentGameInfo;
        },
        set: function (value) {
            PlinkoGlobal._currentGameInfo = value;
        },
        enumerable: false,
        configurable: true
    });
    PlinkoGlobal.isAutoMode = function () {
        var input = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".label_choose input[name=mode]:checked");
        return input.value == "auto";
    };
    PlinkoGlobal.setTimeBet = function () {
        var time = new Date().getTime();
        this.lastTimeBet = time;
    };
    PlinkoGlobal.acceptBet = function () {
        var time = new Date().getTime();
        return time - this.lastTimeBet > this.TIME_EACH_BALL;
    };
    PlinkoGlobal.TIME_EACH_BALL = 2000;
    PlinkoGlobal._currentGameInfo = {};
    PlinkoGlobal.lastTimeBet = 0;
    return PlinkoGlobal;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoGlobal);


/***/ }),

/***/ "./src/PlinkoV2/PlinkoSocketV2.ts":
/*!****************************************!*\
  !*** ./src/PlinkoV2/PlinkoSocketV2.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _Plinko_PlinkoSocket__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Plinko/PlinkoSocket */ "./src/Plinko/PlinkoSocket.ts");
/* harmony import */ var _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PlinkoGlobal */ "./src/PlinkoV2/PlinkoGlobal.ts");
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



var PlinkoSocketV2 = /** @class */ (function (_super) {
    __extends(PlinkoSocketV2, _super);
    function PlinkoSocketV2() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    PlinkoSocketV2.prototype.retrieveResult = function () {
        return;
    };
    PlinkoSocketV2.prototype.sendPlayRequest = function (showLoading) {
        if (showLoading === void 0) { showLoading = true; }
        _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].setTimeBet();
        var data = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].currentGameInfo;
        var gameData = {
            type: _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._("[name=risk]:checked").value,
            mode: _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._("[name=mode]:checked").value,
            qty: _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._("[name=qty]").value,
        };
        data.gameData = gameData;
        this.sendData(JSON.stringify(data), showLoading);
    };
    PlinkoSocketV2.prototype.betSuccess = function (data) {
        var game = data.games;
        if (game) {
            this.renderBall(game);
        }
        // BaseGui.createFlashNotify("Bet thành công.");
        console.log("bet thanh cong");
    };
    PlinkoSocketV2.prototype.processMessageData = function (data) {
        var _a;
        switch (data.action) {
            case PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                var dataAttachment = data.data;
                _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].currentGameInfo.current_game_idx =
                    (_a = dataAttachment.current_game_idx) !== null && _a !== void 0 ? _a : "";
                if (this.onInitGameCallback) {
                    this.onInitGameCallback(dataAttachment);
                }
                break;
            case PLINKO_STATUS.GAME_ACTION_DO_BET:
                this.betSuccess(data.data);
                break;
            default:
                break;
        }
    };
    PlinkoSocketV2.prototype.renderBall = function (game) {
        return __awaiter(this, void 0, void 0, function () {
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        ShortPlinko.createDisc(game.path, game.type);
                        return [4 /*yield*/, this.sleep(500)];
                    case 1:
                        _a.sent();
                        return [2 /*return*/];
                }
            });
        });
    };
    PlinkoSocketV2.prototype.sleep = function (ms) {
        return new Promise(function (resolve) { return setTimeout(resolve, ms); });
    };
    return PlinkoSocketV2;
}(_Plinko_PlinkoSocket__WEBPACK_IMPORTED_MODULE_1__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoSocketV2);


/***/ }),

/***/ "./src/PlinkoV2/PlinkoStorage.ts":
/*!***************************************!*\
  !*** ./src/PlinkoV2/PlinkoStorage.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var PlinkoStorage = /** @class */ (function () {
    function PlinkoStorage() {
    }
    PlinkoStorage.isInactive = function () {
        var state = sessionStorage.getItem(PlinkoStorage.KEY_PLINKO_INACTIVE);
        return state != undefined && state == 1;
    };
    PlinkoStorage.setInactive = function (status) {
        sessionStorage.setItem(PlinkoStorage.KEY_PLINKO_INACTIVE, status);
    };
    PlinkoStorage.getQty = function () {
        var qty = localStorage.getItem(PlinkoStorage.KEY_PLINKO_QTY);
        return qty == undefined ? 1 : qty;
    };
    PlinkoStorage.getMode = function () {
        var mode = localStorage.getItem(PlinkoStorage.KEY_PLINKO_MODE);
        return mode == undefined ? 'manual' : mode;
    };
    PlinkoStorage.getType = function () {
        var type = localStorage.getItem(PlinkoStorage.KEY_PLINKO_TYPE);
        return type == undefined ? 2 : type;
    };
    PlinkoStorage.setConfigGame = function (qty, mode, type) {
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_QTY, qty);
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_TYPE, type);
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_MODE, mode);
    };
    PlinkoStorage.KEY_PLINKO_INACTIVE = "plinko_inactive";
    PlinkoStorage.KEY_PLINKO_QTY = "plinko_qty";
    PlinkoStorage.KEY_PLINKO_MODE = "plinko_mode";
    PlinkoStorage.KEY_PLINKO_TYPE = "plinko_type";
    PlinkoStorage.KEY_PLINKO_BETTED = "plinko_betted";
    return PlinkoStorage;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoStorage);


/***/ }),

/***/ "./src/PlinkoV2/PlinkoUi.ts":
/*!**********************************!*\
  !*** ./src/PlinkoV2/PlinkoUi.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_InactiveBrowser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/InactiveBrowser */ "./src/Base/InactiveBrowser.ts");
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PlinkoGlobal */ "./src/PlinkoV2/PlinkoGlobal.ts");
/* harmony import */ var _PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./PlinkoStorage */ "./src/PlinkoV2/PlinkoStorage.ts");




var PlinkoUi = /** @class */ (function () {
    function PlinkoUi(plinkoSocket) {
        this.plinkoSocket = plinkoSocket;
    }
    PlinkoUi.prototype.playGame = function () {
        if (!_PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].acceptBet()) {
            return;
        }
        var self = this;
        this.disableButtonPlay();
        this.plinkoSocket.sendPlayRequest(false);
        setTimeout(function () {
            self.enableButtonPlay();
        }, _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_2__["default"].TIME_EACH_BALL);
    };
    PlinkoUi.prototype.disableButtonPlay = function () {
        var button = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("button.play");
        if (!button)
            return;
        button.disabled = true;
    };
    PlinkoUi.prototype.enableButtonPlay = function () {
        var button = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("button.play");
        if (!button)
            return;
        button.disabled = false;
    };
    PlinkoUi.prototype.init = function () {
        var self = this;
        var button = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("button.play");
        button.addEventListener("click", function (e) {
            self.playGame();
        });
        this.initEvent();
        // this.detectInactive();
        // this.showBlurPopupIfInactive();
        this.loadPlinkoHistoryGame();
        this.loadGuiFromLocalStorage();
    };
    PlinkoUi.prototype.initEvent = function () {
        var self = this;
        var lsMode = document.querySelectorAll(".label_choose.mode");
        var inputQty = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".qty_box input[name='qty']");
        inputQty.addEventListener("input", function (e) {
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
    };
    PlinkoUi.prototype.loadGuiFromLocalStorage = function () {
        _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".qty_box input[name='qty']").value = _PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].getQty();
        _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".label_choose.mode input[value=\"".concat(_PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].getMode(), "\"]")).checked = true;
        _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".label_choose.risk input[value=\"".concat(_PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].getType(), "\"]")).checked = true;
    };
    PlinkoUi.prototype.updateLocalStorage = function () {
        var qty = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".qty_box input[name='qty']").value;
        var type = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".label_choose.risk input:checked").value;
        var mode = _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._(".label_choose.mode input:checked").value;
        _PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].setConfigGame(qty, mode, type);
    };
    PlinkoUi.prototype.detectInactive = function () {
        var self = this;
        var inactiveBrowser = new _Base_InactiveBrowser__WEBPACK_IMPORTED_MODULE_0__["default"]();
        inactiveBrowser.onEventHidden = function () {
            self.showBlurPopupIfInactive(true);
        };
        inactiveBrowser.onEventVisible = function () {
            self.showBlurPopupIfInactive(false);
        };
    };
    PlinkoUi.prototype.showBlurPopupIfInactive = function (isHidden) {
        if (isHidden) {
            _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("#game").classList.add("inactive");
            _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("#warning-inactive").classList.remove("d-none");
            _PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].setInactive(1);
        }
        else {
            _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("#game").classList.remove("inactive");
            _Base_Selector__WEBPACK_IMPORTED_MODULE_1__["default"]._("#warning-inactive").classList.add("d-none");
            _PlinkoStorage__WEBPACK_IMPORTED_MODULE_3__["default"].setInactive(0);
        }
    };
    PlinkoUi.prototype.loadPlinkoHistoryGame = function () {
        var self = this;
        var itemContent = document.querySelector("#game-gowin-history");
        if (itemContent) {
            XHR.send({
                url: "get-game-plinko-history",
                method: "GET",
            }).then(function (res) {
                if (res.code == 200 && res.html) {
                    itemContent.innerHTML = res.html;
                    self.initPaginateBox(itemContent);
                }
            });
        }
    };
    PlinkoUi.prototype.initPaginateBox = function (element, callback) {
        if (callback === void 0) { callback = null; }
        var self = this;
        var listPaginateBoxLinkBtn = element.querySelectorAll(".paginate-box-link-btn.action");
        listPaginateBoxLinkBtn.forEach(function (btn) {
            if (btn.dataset.href != "") {
                btn.addEventListener("click", function () {
                    XHR.send({
                        url: this.dataset.href,
                        method: "GET",
                    }).then(function (res) {
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
    };
    return PlinkoUi;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoUi);


/***/ }),

/***/ "./src/Plinko/PlinkoGlobal.ts":
/*!************************************!*\
  !*** ./src/Plinko/PlinkoGlobal.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");

var PlinkoGlobal = /** @class */ (function () {
    function PlinkoGlobal() {
    }
    Object.defineProperty(PlinkoGlobal, "currentGameInfo", {
        get: function () {
            return PlinkoGlobal._currentGameInfo;
        },
        set: function (value) {
            PlinkoGlobal._currentGameInfo = value;
        },
        enumerable: false,
        configurable: true
    });
    PlinkoGlobal.isAutoMode = function () {
        var input = _Base_Selector__WEBPACK_IMPORTED_MODULE_0__["default"]._(".label_choose input[name=mode]:checked");
        return input.value == "auto";
    };
    PlinkoGlobal._currentGameInfo = {};
    return PlinkoGlobal;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoGlobal);


/***/ }),

/***/ "./src/Plinko/PlinkoSocket.ts":
/*!************************************!*\
  !*** ./src/Plinko/PlinkoSocket.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Base_BaseGameSocket__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Base/BaseGameSocket */ "./src/Base/BaseGameSocket.ts");
/* harmony import */ var _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Base/BaseGui */ "./src/Base/BaseGui.ts");
/* harmony import */ var _Base_Selector__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../Base/Selector */ "./src/Base/Selector.ts");
/* harmony import */ var _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./PlinkoGlobal */ "./src/Plinko/PlinkoGlobal.ts");
/* harmony import */ var _PlinkoStorage__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./PlinkoStorage */ "./src/Plinko/PlinkoStorage.ts");
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





var PlinkoSocket = /** @class */ (function (_super) {
    __extends(PlinkoSocket, _super);
    function PlinkoSocket(psocket) {
        return _super.call(this, psocket) || this;
    }
    PlinkoSocket.prototype.onOpenSocket = function (e) {
        _super.prototype.onOpenSocket.call(this, e);
        this.initGame();
        if (this.onOpenSocketCallback) {
            this.onOpenSocketCallback(e);
        }
    };
    PlinkoSocket.prototype.initGame = function () {
        var data = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO;
        this.sendData(JSON.stringify(data));
    };
    PlinkoSocket.prototype.retrieveResult = function () {
        var data = {};
        data.type = connectionGameType;
        data.currentGame = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_3__["default"].currentGameInfo;
        data.action = PLINKO_STATUS.GAME_ACTION_RETRIEVE_RESULT;
        this.sendData(JSON.stringify(data));
    };
    PlinkoSocket.prototype.sendPlayRequest = function () {
        _PlinkoStorage__WEBPACK_IMPORTED_MODULE_4__["default"].setGameStateBet(1);
        var data = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_3__["default"].currentGameInfo;
        var gameData = {
            type: _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"]._("[name=risk]:checked").value,
            mode: _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"]._("[name=mode]:checked").value,
            qty: _Base_Selector__WEBPACK_IMPORTED_MODULE_2__["default"]._("[name=qty]").value,
        };
        data.gameData = gameData;
        this.sendData(JSON.stringify(data));
    };
    PlinkoSocket.prototype.betSuccess = function (data) {
        _Base_BaseGui__WEBPACK_IMPORTED_MODULE_1__["default"].createFlashNotify("Bet thành công.");
    };
    PlinkoSocket.prototype.processMessageData = function (data) {
        var _a;
        switch (data.action) {
            case PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                var dataAttachment = data.data;
                _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_3__["default"].currentGameInfo.current_game_idx =
                    (_a = dataAttachment.current_game_idx) !== null && _a !== void 0 ? _a : "";
                if (this.onInitGameCallback) {
                    this.onInitGameCallback(dataAttachment);
                }
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
    };
    PlinkoSocket.prototype.renderBall = function (data) {
        return __awaiter(this, void 0, void 0, function () {
            var games, index, item;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        games = data.games;
                        if (!games)
                            return [2 /*return*/];
                        index = 0;
                        _a.label = 1;
                    case 1:
                        if (!(index < games.length)) return [3 /*break*/, 4];
                        item = games[index];
                        ShortPlinko.createDisc(item.path, item.type);
                        return [4 /*yield*/, this.sleep(400)];
                    case 2:
                        _a.sent();
                        _a.label = 3;
                    case 3:
                        index++;
                        return [3 /*break*/, 1];
                    case 4: return [2 /*return*/];
                }
            });
        });
    };
    PlinkoSocket.prototype.sleep = function (ms) {
        return new Promise(function (resolve) { return setTimeout(resolve, ms); });
    };
    return PlinkoSocket;
}(_Base_BaseGameSocket__WEBPACK_IMPORTED_MODULE_0__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoSocket);


/***/ }),

/***/ "./src/Plinko/PlinkoStorage.ts":
/*!*************************************!*\
  !*** ./src/Plinko/PlinkoStorage.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PlinkoGlobal */ "./src/Plinko/PlinkoGlobal.ts");

var PlinkoStorage = /** @class */ (function () {
    function PlinkoStorage() {
    }
    PlinkoStorage.isInactive = function () {
        var state = sessionStorage.getItem(PlinkoStorage.KEY_PLINKO_INACTIVE);
        return state != undefined && state == 1;
    };
    PlinkoStorage.setInactive = function (status) {
        sessionStorage.setItem(PlinkoStorage.KEY_PLINKO_INACTIVE, status);
    };
    PlinkoStorage.getQty = function () {
        var qty = localStorage.getItem(PlinkoStorage.KEY_PLINKO_QTY);
        return qty == undefined ? 1 : qty;
    };
    PlinkoStorage.getMode = function () {
        var mode = localStorage.getItem(PlinkoStorage.KEY_PLINKO_MODE);
        return mode == undefined ? 'manual' : mode;
    };
    PlinkoStorage.getType = function () {
        var type = localStorage.getItem(PlinkoStorage.KEY_PLINKO_TYPE);
        return type == undefined ? 2 : type;
    };
    PlinkoStorage.setConfigGame = function (qty, mode, type) {
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_QTY, qty);
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_TYPE, type);
        localStorage.setItem(PlinkoStorage.KEY_PLINKO_MODE, mode);
    };
    PlinkoStorage.isGameBetted = function () {
        try {
            var obj = JSON.parse(sessionStorage.getItem(PlinkoStorage.KEY_PLINKO_BETTED));
            var game_index = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_0__["default"].currentGameInfo.current_game_idx;
            var state = obj[game_index];
            return state != undefined && state == 1;
        }
        catch (error) { }
        return false;
    };
    PlinkoStorage.setGameStateBet = function (value) {
        try {
            var game_index = _PlinkoGlobal__WEBPACK_IMPORTED_MODULE_0__["default"].currentGameInfo.current_game_idx;
            var obj = {};
            obj[game_index] = value;
            sessionStorage.setItem(PlinkoStorage.KEY_PLINKO_BETTED, JSON.stringify(obj));
        }
        catch (error) {
        }
    };
    PlinkoStorage.KEY_PLINKO_INACTIVE = "plinko_inactive";
    PlinkoStorage.KEY_PLINKO_QTY = "plinko_qty";
    PlinkoStorage.KEY_PLINKO_MODE = "plinko_mode";
    PlinkoStorage.KEY_PLINKO_TYPE = "plinko_type";
    PlinkoStorage.KEY_PLINKO_BETTED = "plinko_betted";
    return PlinkoStorage;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PlinkoStorage);


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
/*!*************************!*\
  !*** ./src/plinkov2.ts ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Base_Socket__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Base/Socket */ "./src/Base/Socket.ts");
/* harmony import */ var _PlinkoV2_PlinkoGameTimer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PlinkoV2/PlinkoGameTimer */ "./src/PlinkoV2/PlinkoGameTimer.ts");
/* harmony import */ var _PlinkoV2_PlinkoSocketV2__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PlinkoV2/PlinkoSocketV2 */ "./src/PlinkoV2/PlinkoSocketV2.ts");
/* harmony import */ var _PlinkoV2_PlinkoUi__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./PlinkoV2/PlinkoUi */ "./src/PlinkoV2/PlinkoUi.ts");




var socket = new _Base_Socket__WEBPACK_IMPORTED_MODULE_0__["default"]('ws://localhost:8888/');
var plinkoSocket = new _PlinkoV2_PlinkoSocketV2__WEBPACK_IMPORTED_MODULE_2__["default"](socket);
var plinkoGameTimer = new _PlinkoV2_PlinkoGameTimer__WEBPACK_IMPORTED_MODULE_1__["default"](plinkoSocket);
var plinkoUi = new _PlinkoV2_PlinkoUi__WEBPACK_IMPORTED_MODULE_3__["default"](plinkoSocket);
plinkoSocket.onOpenSocketCallback = function () {
    plinkoUi.init();
};
plinkoSocket.onInitGameCallback = function (data) {
    plinkoGameTimer.initInfo(data);
    plinkoUi.loadPlinkoHistoryGame();
};
plinkoSocket.init();

})();

/******/ })()
;