/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/Loader.ts":
/*!***********************!*\
  !*** ./src/Loader.ts ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var Loader = /** @class */ (function () {
    function Loader(P5) {
        this._images = {
            ball_black: "theme/frontend/plinko/assets/images/ball_black.png",
            ball_green: "theme/frontend/plinko/assets/images/ball_xanh.png",
            ball: "theme/frontend/plinko/assets/images/ball1.png",
            light: "theme/frontend/plinko/assets/images/light.png",
            bg: "theme/frontend/plinko/assets/images/bg.jpg",
            hole: "theme/frontend/plinko/assets/images/hole.png",
            panel: "theme/frontend/plinko/assets/images/panel.png",
        };
        this.P5 = P5;
    }
    Loader.prototype.loadImages = function () {
        for (var _i = 0, _a = Object.entries(this._images); _i < _a.length; _i++) {
            var _b = _a[_i], key = _b[0], value = _b[1];
            var tmp = this.P5.loadImage(value);
            Loader.images[key] = tmp;
        }
    };
    Loader.getImage = function (key) {
        return Loader.images[key];
    };
    Loader.images = {};
    return Loader;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Loader);


/***/ }),

/***/ "./src/MatterWrapper.ts":
/*!******************************!*\
  !*** ./src/MatterWrapper.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_containers_BagContainer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/containers/BagContainer */ "./src/components/containers/BagContainer.ts");
/* harmony import */ var _components_containers_DiscContainer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/containers/DiscContainer */ "./src/components/containers/DiscContainer.ts");
/* harmony import */ var _components_containers_PegContainer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/containers/PegContainer */ "./src/components/containers/PegContainer.ts");
/* harmony import */ var _components_Hole__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/Hole */ "./src/components/Hole.ts");
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./configs/app */ "./src/configs/app.ts");
/* harmony import */ var _events_CollisionProvider__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./events/CollisionProvider */ "./src/events/CollisionProvider.ts");







var MatterWrapper = /** @class */ (function () {
    function MatterWrapper(P5) {
        this.lastCreateDiscTime = 0;
        this.P5 = P5;
        this.engine = matter_js__WEBPACK_IMPORTED_MODULE_0__.Engine.create();
        this.world = this.engine.world;
    }
    MatterWrapper.prototype.init = function () {
        this.createPegs();
        this.initDiscs(this.pegContainer);
        this.createBags(this.pegContainer);
        this.initEvents();
        this.hole = new _components_Hole__WEBPACK_IMPORTED_MODULE_4__.Hole(this.world, this.P5);
    };
    MatterWrapper.prototype.initEvents = function () {
        var _this = this;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Events.on(this.engine, "collisionStart", function (e) {
            _this.collisionStart(e);
        });
        // Matter.Events.on(this.engine, "collisionEnd", (e)=>{this.collisionEnd(e)});
    };
    MatterWrapper.prototype.createPegs = function () {
        this.pegContainer = new _components_containers_PegContainer__WEBPACK_IMPORTED_MODULE_3__["default"](this.world, this.P5);
        this.pegContainer.makePegs(_configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].APP.WIDTH, _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].APP.TOPBUFFER, _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].PEG);
        this.pegContainer.makeWalls();
    };
    MatterWrapper.prototype.initDiscs = function (pegContainer) {
        this.discContainer = new _components_containers_DiscContainer__WEBPACK_IMPORTED_MODULE_2__["default"](this.world, this.P5, pegContainer);
    };
    MatterWrapper.prototype.createBags = function (pegContainer) {
        this.bagContainer = new _components_containers_BagContainer__WEBPACK_IMPORTED_MODULE_1__["default"](this.world, this.P5, pegContainer);
        this.bagContainer.createBags();
    };
    MatterWrapper.prototype.createDisc = function () {
        if (this.checkConditionCreateDisc()) {
            this.lastCreateDiscTime = new Date().getTime();
            _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].RUNTIME.numberDiscInGame++;
            var path = _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].TEST.paths[_configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].TEST.count % _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].TEST.paths.length];
            this.discContainer.createDisc(path);
        }
    };
    MatterWrapper.prototype.checkConditionCreateDisc = function () {
        var isSpace = this.P5.keyIsDown(32);
        var isDemo = _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].APP.DEMO;
        var isEnoughSpace = _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].RUNTIME.numberDiscInGame <
            _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].TEST.maximumDiscInGame;
        var isEnoughTime = new Date().getTime() - this.lastCreateDiscTime >
            _configs_app__WEBPACK_IMPORTED_MODULE_5__["default"].TEST.minDistanceTime;
        return isSpace && isDemo && isEnoughSpace && isEnoughTime;
    };
    MatterWrapper.prototype.drawPegs = function () {
        this.pegContainer.show();
    };
    MatterWrapper.prototype.drawDiscs = function () {
        this.discContainer.show();
    };
    MatterWrapper.prototype.drawBag = function () {
        this.bagContainer.show();
    };
    MatterWrapper.prototype.drawHole = function () {
        this.hole.show();
    };
    MatterWrapper.prototype.update = function () {
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Engine.update(this.engine);
    };
    MatterWrapper.prototype.collisionStart = function (event) {
        var pairs = event.pairs;
        for (var i = 0; i < pairs.length; i++) {
            var pair = pairs[i];
            var bodyA = pair.bodyA;
            var bodyB = pair.bodyB;
            var collision = _events_CollisionProvider__WEBPACK_IMPORTED_MODULE_6__["default"].getCollisionTarget(this.world, this.discContainer, bodyA, bodyB);
            if (collision) {
                collision.action();
            }
        }
    };
    MatterWrapper.prototype.collisionEnd = function (event) { };
    return MatterWrapper;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MatterWrapper);


/***/ }),

/***/ "./src/P5Wrapper.ts":
/*!**************************!*\
  !*** ./src/P5Wrapper.ts ***!
  \**************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "P5Wrapper": () => (/* binding */ P5Wrapper)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Loader */ "./src/Loader.ts");
/* harmony import */ var _MatterWrapper__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./MatterWrapper */ "./src/MatterWrapper.ts");
var __assign = (undefined && undefined.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};



var P5Wrapper = /** @class */ (function () {
    function P5Wrapper(P5, options) {
        if (options === void 0) { options = {}; }
        this.options = {
            parent: "game",
        };
        this.P5 = P5;
        this.options = __assign(__assign({}, this.options), options);
        this.matterWrapper = new _MatterWrapper__WEBPACK_IMPORTED_MODULE_2__["default"](P5);
        this.loader = new _Loader__WEBPACK_IMPORTED_MODULE_1__["default"](P5);
    }
    P5Wrapper.prototype.preload = function () {
        this.loader.loadImages();
    };
    P5Wrapper.prototype.setup = function () {
        this.mCanvas = this.P5.createCanvas(_configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.WIDTH, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.HEIGHT);
        this.mCanvas.parent(this.options.parent);
        this.P5.background("#ccc");
        this.matterWrapper.init();
    };
    P5Wrapper.prototype.draw = function () {
        var background = _Loader__WEBPACK_IMPORTED_MODULE_1__["default"].getImage("bg");
        if (background)
            this.P5.background(background);
        this.debug();
        this.matterWrapper.update();
        this.matterWrapper.drawHole();
        this.matterWrapper.createDisc();
        this.matterWrapper.drawPegs();
        this.matterWrapper.drawDiscs();
        this.matterWrapper.drawBag();
    };
    P5Wrapper.prototype.mousePressed = function () {
        this.loadAndPlayGameSound();
    };
    P5Wrapper.prototype.loadAndPlayGameSound = function () {
        //SoundManager.playBackgroundSound();
    };
    P5Wrapper.prototype.debug = function () {
        if (!_configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.DEMO)
            return;
        this.debugLine();
        this.debugFrameRate();
        // this.P5.frameRate(5)
    };
    P5Wrapper.prototype.debugLine = function () {
        this.P5.push();
        this.P5.stroke("#f7a9a9");
        this.P5.line(_configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.WIDTH / 2, 0, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.WIDTH / 2, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.HEIGHT);
        this.P5.line(0, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.HEIGHT / 2, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.WIDTH, _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.HEIGHT / 2);
        this.P5.pop();
    };
    P5Wrapper.prototype.debugFrameRate = function () {
        {
            this.P5.text(this.P5.frameRate(), 10, 10);
        }
    };
    return P5Wrapper;
}());



/***/ }),

/***/ "./src/components/Bag.ts":
/*!*******************************!*\
  !*** ./src/components/Bag.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _sounds_SoundManager__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../sounds/SoundManager */ "./src/sounds/SoundManager.ts");
/* harmony import */ var _sounds_SoundProvider__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../sounds/SoundProvider */ "./src/sounds/SoundProvider.ts");
/* harmony import */ var _sprites_Broken__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../sprites/Broken */ "./src/sprites/Broken.ts");
/* harmony import */ var _BaseComponent__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./BaseComponent */ "./src/components/BaseComponent.ts");
/* harmony import */ var _WinPanel__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./WinPanel */ "./src/components/WinPanel.ts");
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







var Bag = /** @class */ (function (_super) {
    __extends(Bag, _super);
    function Bag(world, P5, x, y, index) {
        var _this = _super.call(this, world, P5) || this;
        _this.options = {
            isStatic: true,
            isSensor: true,
            restitution: 1,
            friction: 1,
            game_active: 0,
            game_bag_index: -1,
            game_type_ball: -1,
        };
        _this.effectYMax = 3;
        _this.effectY = 0;
        _this.x = x + 1;
        _this.y = y + _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.topBufferFromPeg;
        _this.color = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.colors[index];
        _this.text = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.texts[index];
        _this.text = _this.text + "";
        var w = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].PEG.spacing - _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].PEG.radius;
        var h = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.heightBody;
        var ny = _this.y + h * 1.5;
        var nx = _this.x + w / 2;
        _this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.rectangle(nx, ny, w, h, _this.options);
        _this.body.label = "bag";
        _this.body.collisionFilter.group = 2147483647;
        _this.body.collisionFilter.mask = 2147483647;
        _this.body.collisionFilter.category = 2147483647;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(world, _this.body);
        _this.brokenEffect = new _sprites_Broken__WEBPACK_IMPORTED_MODULE_4__["default"](P5, nx, _this.y + h * 0.5);
        if (_configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.texts[index] > 1) {
            _this.sound = _sounds_SoundProvider__WEBPACK_IMPORTED_MODULE_3__["default"].getInstance().getSound("big_win");
        }
        else {
            _this.sound = _sounds_SoundProvider__WEBPACK_IMPORTED_MODULE_3__["default"].getInstance().getSound("win_sound");
        }
        return _this;
    }
    Bag.prototype.setGameBagIndex = function (index) {
        this.body.game_bag_index = index;
    };
    Bag.prototype.show = function () {
        this.P5.push();
        this.effectCollision();
        this.showGameItem();
        this.showBody();
        this.showBrokenEffect();
        this.playSound();
        this.showWinPanel();
        this.P5.pop();
    };
    Bag.prototype.effectCollision = function () {
        if (this.body.game_active == 1) {
            this.effectY -= 0.5;
        }
        if (this.body.game_active == 0 && this.effectY < 0) {
            this.effectY += 0.5;
        }
        if (this.effectY + this.effectYMax < 0 && this.body.game_active == 1) {
            this.body.game_active = 0;
        }
    };
    Bag.prototype.showBrokenEffect = function () {
        if (this.body.game_active == 1) {
            this.brokenEffect.show();
        }
        else {
            this.brokenEffect.init();
        }
    };
    Bag.prototype.getEffectColor = function () {
        if (this.effectY >= 0)
            return this.color;
        var color = [];
        for (var i = 0; i < this.color.length; i++) {
            var element = this.color[i];
            if (element != 255 && element != 0) {
                element += Math.abs(this.effectY * 50);
            }
            element = Math.min(255, element);
            color.push(element);
        }
        return color;
    };
    Bag.prototype.playSound = function () {
        if (this.body.game_active == 1) {
            this._playSound();
        }
    };
    Bag.prototype._playSound = function () {
        if (_sounds_SoundManager__WEBPACK_IMPORTED_MODULE_2__["default"].exists(this.sound)) {
            if (this.sound.isPlaying()) {
                this.sound.stop();
            }
            this.sound.play();
        }
    };
    Bag.prototype.showWinPanel = function () {
        if (this.body.game_active == 1) {
            _WinPanel__WEBPACK_IMPORTED_MODULE_6__["default"].getInstance(this.P5).init(this.body.game_bag_index, this.body.game_type_ball);
        }
        _WinPanel__WEBPACK_IMPORTED_MODULE_6__["default"].getInstance(this.P5).show();
    };
    Bag.prototype.showGameItem = function () {
        this.P5.fill(this.getEffectColor());
        this.P5.beginShape();
        this.P5.noStroke();
        var addX = this.x;
        var addY = this.y + this.effectY;
        for (var index = 0; index < _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.path.length; index++) {
            var element = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.path[index];
            var nx = element.x * 0.35 + addX;
            var ny = element.y * 0.5 + addY;
            this.P5.curveVertex(nx, ny);
        }
        this.P5.endShape();
        this.drawText(addX, addY);
        this.P5.fill(0);
    };
    Bag.prototype.drawText = function (addX, addY) {
        var index = 0;
        var element = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].BAG.path[index];
        var nx = element.x * 0.35 + addX;
        var ny = element.y * 0.45 + addY;
        this.P5.fill(0);
        this.P5.textSize(10);
        this.P5.textStyle(this.P5.BOLD);
        this.P5.textAlign(this.P5.CENTER, this.P5.CENTER);
        this.P5.text(this.text, nx - 14, ny + 14);
    };
    return Bag;
}(_BaseComponent__WEBPACK_IMPORTED_MODULE_5__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Bag);


/***/ }),

/***/ "./src/components/BaseComponent.ts":
/*!*****************************************!*\
  !*** ./src/components/BaseComponent.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");

var BaseComponent = /** @class */ (function () {
    function BaseComponent(world, P5) {
        this.world = world;
        this.P5 = P5;
    }
    Object.defineProperty(BaseComponent.prototype, "body", {
        get: function () {
            return this._body;
        },
        set: function (value) {
            this._body = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(BaseComponent.prototype, "x", {
        get: function () {
            return this._x;
        },
        set: function (value) {
            this._x = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(BaseComponent.prototype, "y", {
        get: function () {
            return this._y;
        },
        set: function (value) {
            this._y = value;
        },
        enumerable: false,
        configurable: true
    });
    BaseComponent.prototype.getBody = function () {
        return this.body;
    };
    BaseComponent.prototype.showBody = function () {
        if (!_configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.SHOW_BODY)
            return;
        this.P5.rect(this.body.bounds.min.x, this.body.bounds.min.y, this.body.bounds.max.x - this.body.bounds.min.x, this.body.bounds.max.y - this.body.bounds.min.y);
    };
    return BaseComponent;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BaseComponent);


/***/ }),

/***/ "./src/components/Disc.ts":
/*!********************************!*\
  !*** ./src/components/Disc.ts ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../Loader */ "./src/Loader.ts");
/* harmony import */ var _sprites_Fire__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../sprites/Fire */ "./src/sprites/Fire.ts");
/* harmony import */ var _BaseComponent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./BaseComponent */ "./src/components/BaseComponent.ts");
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





var Disc = /** @class */ (function (_super) {
    __extends(Disc, _super);
    function Disc(world, P5, x, y, r, pegContainer, _fileType) {
        if (_fileType === void 0) { _fileType = _sprites_Fire__WEBPACK_IMPORTED_MODULE_3__.FireType.NORMAL; }
        var _this = _super.call(this, world, P5) || this;
        _this.pegContainer = pegContainer;
        _this._fileType = _fileType;
        _this.options = {
            restitution: 1,
            friction: 1,
            frictionAir: 0.01,
            density: 1,
            game_type_ball: 0,
        };
        _this.currentPaths = [];
        _this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.circle(x, y, r, _this.options);
        _this.r = r;
        _this.body.label = "disc";
        _this.body.collisionFilter.group = 1;
        _this.body.collisionFilter.mask = 1;
        _this.body.collisionFilter.category = 1;
        _this.body.game_type_ball = _fileType;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(world, _this.body);
        _this.fire = new _sprites_Fire__WEBPACK_IMPORTED_MODULE_3__["default"](P5, _fileType);
        _this.width = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].DISC.draw_width();
        return _this;
    }
    Object.defineProperty(Disc.prototype, "fileType", {
        get: function () {
            return this._fileType;
        },
        set: function (value) {
            this._fileType = value;
        },
        enumerable: false,
        configurable: true
    });
    Disc.prototype.init = function (paths) {
        if (paths === void 0) { paths = []; }
        this.incrementCount();
        var pow = Math.pow(2, _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count);
        this.body.collisionFilter.group = pow;
        this.body.collisionFilter.mask = pow;
        this.body.collisionFilter.category = pow;
        this.testWall(paths);
    };
    Disc.prototype.incrementCount = function () {
        _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count++;
        if (_configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count > 29) {
            _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count = 0;
            this.pegContainer.resetMaskCrossWall();
        }
    };
    Disc.prototype.testWall = function (paths) {
        if (paths === void 0) { paths = []; }
        // let path =
        //     AppConfig.TEST.paths[
        //         AppConfig.TEST.count % AppConfig.TEST.paths.length
        //     ];
        if (paths == undefined)
            return;
        for (var i = 0; i < paths.length - 1; i++) {
            var point = parseInt(paths[i]);
            var nextPoint = parseInt(paths[i + 1]);
            var wallLeft = point - 1 + "_" + (nextPoint - 1);
            var wallRight = point + 1 + "_" + (nextPoint + 1);
            if (this.pegContainer.walls[wallLeft]) {
                this.changeGroupWall(this.pegContainer.walls[wallLeft]);
            }
            if (this.pegContainer.walls[wallRight]) {
                this.changeGroupWall(this.pegContainer.walls[wallRight]);
            }
        }
    };
    Disc.prototype.changeGroupWall = function (wall) {
        var pow = Math.pow(2, _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count);
        wall.body.game_active = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].TEST.count + 1;
        wall.body.collisionFilter.mask |= pow;
        wall.body.collisionFilter.category |= pow;
    };
    Disc.prototype.collision = function (discBody, pegBody) {
        var idx = pegBody.game_idx_peg;
    };
    Disc.prototype.retreivePivotPoint = function (checkValue) {
        for (var i = 0; i < this.currentPaths.length; i++) {
            var p = parseInt(this.currentPaths[i]);
            if (p - 1 == checkValue || p + 1 == checkValue) {
                return p;
            }
        }
        return 0;
    };
    Disc.prototype.show = function () {
        this.showFire();
        this.P5.push();
        this.showGameItem();
        this.showBody();
        this.P5.pop();
    };
    Disc.prototype.showFire = function () {
        var pos = this.body.position;
        var posx = pos.x;
        var posy = pos.y;
        this.fire.show(posx, posy);
    };
    Disc.prototype.showGameItem = function () {
        var pos = this.body.position;
        var posx = pos.x;
        var posy = pos.y;
        this.P5.translate(posx, posy);
        // this.P5.fill("#4e58e4");
        // this.P5.noStroke();
        // this.P5.ellipse(0, 0, this.r * 2);
        // this.P5.ellipse(0, 0, AppConfig.DISC.draw_width());
        this.P5.image(this.getImageRender(), -this.width / 2, -this.width / 2, this.width, this.width);
    };
    Disc.prototype.getImageRender = function () {
        if (this.fileType == _sprites_Fire__WEBPACK_IMPORTED_MODULE_3__.FireType.NORMAL) {
            return _Loader__WEBPACK_IMPORTED_MODULE_2__["default"].getImage("ball_black");
        }
        else if (this.fileType == _sprites_Fire__WEBPACK_IMPORTED_MODULE_3__.FireType.MID) {
            return _Loader__WEBPACK_IMPORTED_MODULE_2__["default"].getImage("ball_green");
        }
        else {
            return _Loader__WEBPACK_IMPORTED_MODULE_2__["default"].getImage("ball");
        }
    };
    return Disc;
}(_BaseComponent__WEBPACK_IMPORTED_MODULE_4__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Disc);


/***/ }),

/***/ "./src/components/Hole.ts":
/*!********************************!*\
  !*** ./src/components/Hole.ts ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Hole": () => (/* binding */ Hole)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Loader */ "./src/Loader.ts");
/* harmony import */ var _BaseComponent__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseComponent */ "./src/components/BaseComponent.ts");
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



var Hole = /** @class */ (function (_super) {
    __extends(Hole, _super);
    function Hole(world, P5) {
        var _this = _super.call(this, world, P5) || this;
        _this.x = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].HOLE.DROP_POSITION_X;
        _this.y = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].HOLE.DROP_POSITION_Y;
        _this.width = _this.height = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].DISC.radius * 2 * 1.5;
        return _this;
    }
    Hole.prototype.show = function () {
        this.P5.push();
        this.showGameItem();
        this.P5.pop();
    };
    Hole.prototype.showGameItem = function () {
        this.P5.noStroke();
        this.P5.translate(this.x, this.y);
        this.P5.imageMode(this.P5.CENTER);
        var image = _Loader__WEBPACK_IMPORTED_MODULE_1__["default"].getImage("hole");
        if (image) {
            this.P5.image(image, 0, 0, this.width, this.height);
        }
    };
    return Hole;
}(_BaseComponent__WEBPACK_IMPORTED_MODULE_2__["default"]));



/***/ }),

/***/ "./src/components/Peg.ts":
/*!*******************************!*\
  !*** ./src/components/Peg.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Peg": () => (/* binding */ Peg)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _sprites_Light__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../sprites/Light */ "./src/sprites/Light.ts");
/* harmony import */ var _BaseComponent__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseComponent */ "./src/components/BaseComponent.ts");
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



var Peg = /** @class */ (function (_super) {
    __extends(Peg, _super);
    function Peg(world, P5, x, y, r) {
        var _this = _super.call(this, world, P5) || this;
        _this.countDrawLight = 0;
        _this.options = {
            isStatic: true,
            restitution: 1,
            friction: 0,
            game_idx_peg: 0,
            game_active: 0,
        };
        _this.r = r;
        _this.x = x;
        _this.y = y;
        _this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.circle(x, y, r, _this.options);
        _this.body.label = "peg";
        _this.body.collisionFilter.group = 2147483647;
        _this.body.collisionFilter.mask = 2147483647;
        _this.body.collisionFilter.category = 2147483647;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(world, _this.body);
        _this.light = new _sprites_Light__WEBPACK_IMPORTED_MODULE_1__["default"](_this.P5, "light");
        _this.light.finish = function () {
            _this.body.game_active = 0;
        };
        return _this;
    }
    Object.defineProperty(Peg.prototype, "name", {
        get: function () {
            return this._name;
        },
        set: function (value) {
            this._name = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Peg.prototype, "indexPeg", {
        get: function () {
            return this._indexPeg;
        },
        set: function (value) {
            this.body.game_idx_peg = value;
            this._indexPeg = value;
        },
        enumerable: false,
        configurable: true
    });
    Peg.prototype.show = function () {
        this.P5.push();
        this.showGameItem();
        this.showBody();
        this.P5.pop();
    };
    Peg.prototype.showGameItem = function () {
        this.P5.fill("#fff");
        this.P5.noStroke();
        var pos = this.body.position;
        this.P5.translate(pos.x, pos.y);
        this.P5.ellipse(0, 0, this.r * 2);
        this.P5.imageMode(this.P5.CENTER);
        if (this.body.game_active) {
            this.light.show();
        }
    };
    return Peg;
}(_BaseComponent__WEBPACK_IMPORTED_MODULE_2__["default"]));



/***/ }),

/***/ "./src/components/WinPanel.ts":
/*!************************************!*\
  !*** ./src/components/WinPanel.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Loader */ "./src/Loader.ts");


var WinPanel = /** @class */ (function () {
    function WinPanel(P5) {
        this.P5 = P5;
        this.imageWidth = 340;
        this.imageHeight = 50;
        this.scale = 0;
        this.effectYMax = 5;
        this.effectY = 0;
        this.state = WinPanelState.UP;
        this.index_bag = -1;
        this.currentBallPrice = 0;
    }
    WinPanel.prototype.init = function (index, typeBall) {
        this.scale = 1;
        this.state = WinPanelState.UP;
        this.index_bag = index;
        var price = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].DISC.prices[String(typeBall)];
        price = price !== null && price !== void 0 ? price : 0;
        this.currentBallPrice = price;
    };
    WinPanel.prototype.drawPanel = function (text) {
        if (text === void 0) { text = "Win + 100.000 VNĐ"; }
        this.P5.push();
        this.P5.imageMode(this.P5.CENTER);
        var x = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.WIDTH / 2;
        var y = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].APP.HEIGHT - this.imageHeight - 10 + this.effectY;
        // let t = 150 - (1 - this.scale) * 255;
        // t = Math.max(0, t);
        // this.P5.tint(255, t);
        this.P5.image(_Loader__WEBPACK_IMPORTED_MODULE_1__["default"].getImage("panel"), x, y, this.imageWidth * this.scale, this.imageHeight * this.scale);
        this.P5.textAlign(this.P5.CENTER, this.P5.CENTER);
        this.P5.textSize(22 * this.scale);
        this.P5.textStyle(this.P5.BOLD);
        this.P5.text(text, x, y);
        this.P5.pop();
    };
    WinPanel.prototype.show = function () {
        if (this.scale < 0.5) {
            this.effectY = 0;
            this.state = WinPanelState.NONE;
            return;
        }
        if (this.state == WinPanelState.UP) {
            this.effectY -= 0.1;
        }
        if (this.state == WinPanelState.DOWN) {
            this.effectY += 0.1;
        }
        if (this.effectY + this.effectYMax < 0) {
            this.state = WinPanelState.DOWN;
        }
        if (this.effectY > 0) {
            this.state = WinPanelState.STOP;
            this.scale -= 0.001;
        }
        this.drawPanel(this.getCurrentText(this.index_bag));
    };
    WinPanel.prototype.getCurrentText = function (index) {
        var text = this.currentBallPrice * _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].BAG.texts[index];
        return "Win +" + this.formatMoney(text) + " VNĐ";
    };
    WinPanel.prototype.formatMoney = function (number) {
        var pieces = parseFloat(number).toFixed(2).split("");
        var ii = pieces.length - 3;
        while ((ii -= 3) > 0) {
            pieces.splice(ii, 0, ",");
        }
        return pieces.join("").replace(".00", "").replace(/,/g, ".");
    };
    WinPanel.getInstance = function (P5) {
        if (!this.instance) {
            this.instance = new WinPanel(P5);
        }
        return this.instance;
    };
    return WinPanel;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (WinPanel);
var WinPanelState;
(function (WinPanelState) {
    WinPanelState[WinPanelState["NONE"] = 0] = "NONE";
    WinPanelState[WinPanelState["UP"] = 1] = "UP";
    WinPanelState[WinPanelState["DOWN"] = 2] = "DOWN";
    WinPanelState[WinPanelState["STOP"] = 3] = "STOP";
})(WinPanelState || (WinPanelState = {}));


/***/ }),

/***/ "./src/components/containers/BagContainer.ts":
/*!***************************************************!*\
  !*** ./src/components/containers/BagContainer.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Bag__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Bag */ "./src/components/Bag.ts");

var BagContainer = /** @class */ (function () {
    function BagContainer(world, P5, pegContainer) {
        this.world = world;
        this.P5 = P5;
        this.pegContainer = pegContainer;
        this.bags = [];
    }
    BagContainer.prototype.createBags = function () {
        //có 17 bag = 17 lỗ
        for (var index = 0; index < 17; index++) {
            var idx = 150 + index; //150 = peg ngoài cùng bên trái
            var peg = this.pegContainer.pegs[idx];
            var b = new _Bag__WEBPACK_IMPORTED_MODULE_0__["default"](this.world, this.P5, peg.x, peg.y, index);
            b.setGameBagIndex(index);
            this.bags.push(b);
        }
    };
    BagContainer.prototype.show = function () {
        this.bags.forEach(function (bag, idx) {
            bag.show();
        });
    };
    return BagContainer;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BagContainer);


/***/ }),

/***/ "./src/components/containers/DiscContainer.ts":
/*!****************************************************!*\
  !*** ./src/components/containers/DiscContainer.ts ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _sprites_Fire__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../sprites/Fire */ "./src/sprites/Fire.ts");
/* harmony import */ var _Disc__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../Disc */ "./src/components/Disc.ts");




var DiscContainer = /** @class */ (function () {
    function DiscContainer(world, P5, pegContainer) {
        this.world = world;
        this.P5 = P5;
        this.pegContainer = pegContainer;
        this.discs = [];
    }
    DiscContainer.prototype.createDisc = function (path, fireType) {
        if (path === void 0) { path = ""; }
        if (fireType === void 0) { fireType = _sprites_Fire__WEBPACK_IMPORTED_MODULE_2__.FireType.HOT; }
        var paths = path.split(" ");
        if (paths.length == 0)
            return;
        var first = paths[0];
        var direction = first == 16 ? -2 : +2;
        var x = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].DISC.x + direction;
        var y = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].DISC.y;
        var r = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].DISC.radius;
        var d = new _Disc__WEBPACK_IMPORTED_MODULE_3__["default"](this.world, this.P5, x, y, r, this.pegContainer, fireType);
        d.init(paths);
        this.discs.push(d);
    };
    DiscContainer.prototype.collision = function (discBody, pegBody) {
        this.discs.forEach(function (disc, idx) {
            disc.collision(discBody, pegBody);
        });
    };
    DiscContainer.prototype.show = function () {
        this.discs.forEach(function (disc, idx) {
            disc.show();
        });
    };
    DiscContainer.prototype.remove = function () {
        var _this = this;
        this.discs.forEach(function (disc, idx) {
            if (disc.getBody().position.y > 700) {
                matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.remove(_this.world, disc.getBody());
                delete _this.discs[idx];
                if (_this.removeCallback) {
                    _this.removeCallback();
                }
            }
        });
    };
    DiscContainer.prototype.removeById = function (id) {
        for (var index = 0; index < this.discs.length; index++) {
            var element = this.discs[index];
            if (element) {
                if (element.getBody().id == id) {
                    matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.remove(this.world, element.getBody());
                    // delete this.discs[index];
                    this.discs.splice(index, 1);
                    return;
                }
            }
        }
    };
    return DiscContainer;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (DiscContainer);


/***/ }),

/***/ "./src/components/containers/PegContainer.ts":
/*!***************************************************!*\
  !*** ./src/components/containers/PegContainer.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Peg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../Peg */ "./src/components/Peg.ts");
/* harmony import */ var _wall_CrossLeftWall__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../wall/CrossLeftWall */ "./src/components/wall/CrossLeftWall.ts");
/* harmony import */ var _wall_CrossRightWall__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../wall/CrossRightWall */ "./src/components/wall/CrossRightWall.ts");
/* harmony import */ var _wall_CrossWall__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../wall/CrossWall */ "./src/components/wall/CrossWall.ts");
/* harmony import */ var _wall_FunnelDownWall__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../wall/FunnelDownWall */ "./src/components/wall/FunnelDownWall.ts");
/* harmony import */ var _wall_FunnelWall__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../wall/FunnelWall */ "./src/components/wall/FunnelWall.ts");
/* harmony import */ var _wall_Wall__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../wall/Wall */ "./src/components/wall/Wall.ts");








var PegContainer = /** @class */ (function () {
    function PegContainer(world, P5) {
        this._pegs = [];
        this._walls = {};
        this.funnelwalls = [];
        this.world = world;
        this.P5 = P5;
    }
    Object.defineProperty(PegContainer.prototype, "pegs", {
        get: function () {
            return this._pegs;
        },
        set: function (value) {
            this._pegs = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(PegContainer.prototype, "walls", {
        get: function () {
            return this._walls;
        },
        set: function (value) {
            this._walls = value;
        },
        enumerable: false,
        configurable: true
    });
    PegContainer.prototype.makePegs = function (width, topBuffer, options) {
        if (options === void 0) { options = {
            radius: 1,
            spacing: 30,
            rows: 17,
        }; }
        var centerWidth = width / 2;
        var xSpacing = options.spacing * 1;
        var ySpacing = options.spacing * 0.8;
        var startX = centerWidth - xSpacing;
        var count = 0;
        var pegs = [];
        var idxPeg = 15; //Index của Peg đầu tiên
        var add = 28; // Index Peg đầu tiên hàng tiếp theo
        for (var i = 1; i < options.rows; i++) {
            count++;
            for (var j = 1; j < i + 3; j++) {
                var x = startX - 0.5 * (i + 1) * xSpacing + j * xSpacing;
                var y = topBuffer + i * ySpacing;
                var p = new _Peg__WEBPACK_IMPORTED_MODULE_1__.Peg(this.world, this.P5, x, y, options.radius);
                p.indexPeg = idxPeg;
                pegs.push(p);
                idxPeg += 2;
            }
            idxPeg += add;
            add -= 2;
        }
        return (this.pegs = pegs);
    };
    PegContainer.prototype.makeWalls = function () {
        this.makeFunnelWalls();
        this.makeHorizontalWalls();
        this.makeCrossWalls();
    };
    PegContainer.prototype.makeFunnelWalls = function () {
        if (this.pegs.length > 3) {
            var peg = this.pegs[0];
            var x2 = peg.x;
            var y2 = peg.y - 100;
            var w = new _wall_FunnelWall__WEBPACK_IMPORTED_MODULE_6__["default"](this.world, this.P5, peg.x, peg.y, x2, y2);
            this.funnelwalls.push(w);
            peg = this.pegs[2];
            x2 = peg.x;
            y2 = peg.y - 100;
            w = new _wall_FunnelWall__WEBPACK_IMPORTED_MODULE_6__["default"](this.world, this.P5, peg.x, peg.y, x2, y2);
            this.funnelwalls.push(w);
        }
        if (this.pegs.length > 167) {
            for (var index = 150; index < this.pegs.length; index++) { // peg ngoài cùng bên dưới trái
                var peg = this.pegs[index];
                var x2 = peg.x;
                var y2 = peg.y + 50;
                var w = new _wall_FunnelDownWall__WEBPACK_IMPORTED_MODULE_5__["default"](this.world, this.P5, peg.x, peg.y, x2, y2);
                this.funnelwalls.push(w);
            }
        }
    };
    PegContainer.prototype.makeHorizontalWalls = function () {
        for (var i = 0; i < this.pegs.length - 1; i++) {
            var peg = this.pegs[i];
            var nextPeg = this.pegs[i + 1];
            var pegIndex = peg.indexPeg;
            var nextPegIndex = nextPeg.indexPeg;
            var iPegIndex = (pegIndex / 35) | 0;
            var iNextPegIndex = (nextPegIndex / 35) | 0;
            if (iPegIndex == iNextPegIndex) {
                var newX1 = peg.x + _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].PEG.radius;
                var newY1 = peg.y - _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].WALL.height / 2;
                var newX2 = nextPeg.x - _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].PEG.radius;
                var newY2 = nextPeg.y - _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].WALL.height / 2;
                var w = new _wall_Wall__WEBPACK_IMPORTED_MODULE_7__["default"](this.world, this.P5, peg.x, peg.y, nextPeg.x, nextPeg.y);
                w.fromPeg = peg;
                w.toPeg = nextPeg;
                w.fromIndex = pegIndex;
                w.toIndex = nextPegIndex;
                var wallName = pegIndex + "_" + nextPegIndex;
                w.setWallName(wallName);
                this.walls[wallName] = w;
            }
        }
    };
    PegContainer.prototype.makeCrossWalls = function () {
        var currentRow = -1;
        var addLeft = 2;
        var addRight = 3;
        for (var i = 0; i < this.pegs.length; i++) {
            var peg = this.pegs[i];
            var pegIndex = peg.indexPeg;
            var rowPeg = (pegIndex / 35) | 0;
            if (currentRow != rowPeg) {
                currentRow = rowPeg;
                addLeft += 1;
                addRight += 1;
            }
            var tmpi = i + addLeft;
            if (tmpi < this.pegs.length) {
                var nextPeg = this.pegs[tmpi];
                this.createWall(peg, nextPeg, true);
            }
            tmpi = i + addRight;
            if (tmpi < this.pegs.length) {
                var nextPeg = this.pegs[tmpi];
                this.createWall(peg, nextPeg, false);
            }
        }
    };
    PegContainer.prototype.createWall = function (peg, nextPeg, isLeft) {
        var w = isLeft
            ? new _wall_CrossLeftWall__WEBPACK_IMPORTED_MODULE_2__["default"](this.world, this.P5, peg.x, peg.y, nextPeg.x, nextPeg.y)
            : new _wall_CrossRightWall__WEBPACK_IMPORTED_MODULE_3__["default"](this.world, this.P5, peg.x, peg.y, nextPeg.x, nextPeg.y);
        var nextPegIndex = nextPeg.indexPeg;
        var pegIndex = peg.indexPeg;
        w.fromIndex = pegIndex;
        w.toIndex = nextPegIndex;
        w.fromPeg = peg;
        w.toPeg = nextPeg;
        var wallName = pegIndex + "_" + nextPegIndex;
        w.setWallName(wallName);
        this.walls[wallName] = w;
        return w;
    };
    PegContainer.prototype.resetMaskCrossWall = function () {
        for (var _i = 0, _a = Object.entries(this.walls); _i < _a.length; _i++) {
            var _b = _a[_i], key = _b[0], wall = _b[1];
            if (wall instanceof _wall_CrossWall__WEBPACK_IMPORTED_MODULE_4__["default"]) {
                wall.body.collisionFilter.mask = 0;
                wall.body.collisionFilter.category = 0;
            }
        }
    };
    PegContainer.prototype.show = function () {
        for (var _i = 0, _a = Object.entries(this.walls); _i < _a.length; _i++) {
            var _b = _a[_i], key = _b[0], wall = _b[1];
            var w = wall;
            w.show();
        }
        this.pegs.forEach(function (peg) {
            peg.show();
        });
        this.funnelwalls.forEach(function (wall) {
            wall.show();
        });
    };
    return PegContainer;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PegContainer);


/***/ }),

/***/ "./src/components/wall/BaseWall.ts":
/*!*****************************************!*\
  !*** ./src/components/wall/BaseWall.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _BaseComponent__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../BaseComponent */ "./src/components/BaseComponent.ts");
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


var BaseWall = /** @class */ (function (_super) {
    __extends(BaseWall, _super);
    function BaseWall(world, P5, x1, y1, x2, y2) {
        var _this = _super.call(this, world, P5) || this;
        _this.options = {
            isStatic: true,
            restitution: 1,
            friction: 1,
            game_active: 0,
            wall_name: "",
        };
        _this.height = _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].WALL.height;
        return _this;
    }
    Object.defineProperty(BaseWall.prototype, "fromPeg", {
        get: function () {
            return this._fromPeg;
        },
        set: function (value) {
            this._fromPeg = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(BaseWall.prototype, "toPeg", {
        get: function () {
            return this._toPeg;
        },
        set: function (value) {
            this._toPeg = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(BaseWall.prototype, "fromIndex", {
        get: function () {
            return this._fromIndex;
        },
        set: function (value) {
            this._fromIndex = value;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(BaseWall.prototype, "toIndex", {
        get: function () {
            return this._toIndex;
        },
        set: function (value) {
            this._toIndex = value;
        },
        enumerable: false,
        configurable: true
    });
    BaseWall.prototype.setWallName = function (value) {
        this.body.wall_name = value;
    };
    BaseWall.prototype.setStroke = function () {
        this.P5.fill("#45bf36");
        if (this.body.game_active >= 1) {
            this.P5.stroke(_configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].COLORS[this.body.game_active % _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].COLORS.length]);
        }
        else {
            this.P5.stroke(255);
        }
    };
    return BaseWall;
}(_BaseComponent__WEBPACK_IMPORTED_MODULE_1__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BaseWall);


/***/ }),

/***/ "./src/components/wall/CrossLeftWall.ts":
/*!**********************************************!*\
  !*** ./src/components/wall/CrossLeftWall.ts ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CrossWall__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CrossWall */ "./src/components/wall/CrossWall.ts");
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

var CrossLeftWall = /** @class */ (function (_super) {
    __extends(CrossLeftWall, _super);
    function CrossLeftWall() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    CrossLeftWall.prototype.getPoints = function (x1, y1, x2, y2) {
        // y1 += 3;
        // y2 -= 10;
        var translateX = Math.abs(x2 - x1) / 2;
        var translateY = Math.abs(y2 - y1) / 2;
        var thickness = 0.2;
        var cutterY = 1;
        var cutterX = Math.tan(Math.PI * 30 / 180) * cutterY;
        var point1 = { x: x1 - translateX - cutterX, y: y1 + translateY + cutterY };
        var point2 = { x: x1 + thickness - translateX - cutterX, y: y1 + translateY + cutterY };
        var point3 = { x: x2 + thickness - translateX + cutterX, y: y2 + translateY - cutterY };
        var point4 = { x: x2 - translateX + cutterX, y: y2 + translateY - cutterY };
        return [[point1, point2, point3, point4]];
    };
    return CrossLeftWall;
}(_CrossWall__WEBPACK_IMPORTED_MODULE_0__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CrossLeftWall);


/***/ }),

/***/ "./src/components/wall/CrossRightWall.ts":
/*!***********************************************!*\
  !*** ./src/components/wall/CrossRightWall.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CrossWall__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CrossWall */ "./src/components/wall/CrossWall.ts");
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

var CrossRightWall = /** @class */ (function (_super) {
    __extends(CrossRightWall, _super);
    function CrossRightWall() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    CrossRightWall.prototype.getPoints = function (x1, y1, x2, y2) {
        var translateX = Math.abs(x2 - x1) / 2;
        var translateY = Math.abs(y2 - y1) / 2;
        var thickness = 0.2;
        var cutterY = 1;
        var cutterX = Math.tan(Math.PI * 30 / 180) * cutterY;
        var point1 = { x: x1 + translateX + cutterX, y: y1 + translateY + cutterY };
        var point2 = { x: x1 + thickness + translateX + cutterX, y: y1 + translateY + cutterY };
        var point3 = { x: x2 + thickness + translateX - cutterX, y: y2 + translateY - cutterY };
        var point4 = { x: x2 + translateX - cutterX, y: y2 + translateY - cutterY };
        return [[point1, point2, point3, point4]];
    };
    return CrossRightWall;
}(_CrossWall__WEBPACK_IMPORTED_MODULE_0__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CrossRightWall);


/***/ }),

/***/ "./src/components/wall/CrossWall.ts":
/*!******************************************!*\
  !*** ./src/components/wall/CrossWall.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _BaseWall__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseWall */ "./src/components/wall/BaseWall.ts");
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



var CrossWall = /** @class */ (function (_super) {
    __extends(CrossWall, _super);
    function CrossWall(world, P5, x1, y1, x2, y2) {
        var _this = _super.call(this, world, P5, x1, y1, x2, y2) || this;
        var points = _this.getPoints(x1, y1, x2, y2);
        _this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.fromVertices(points[0][0].x, points[0][0].y, points, _this.options);
        _this.body.label = "wall";
        _this.body.collisionFilter.group = 0;
        _this.body.collisionFilter.mask = 0;
        _this.body.collisionFilter.category = 0;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(world, _this.body);
        return _this;
    }
    CrossWall.prototype.show = function () {
        if (!_configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].WALL.showWall)
            return;
        this.P5.push();
        this.setStroke();
        var pos = this.body.position;
        // console.log(this.body.bounds);
        // this.P5.rect(
        //     this.body.bounds.min.x,
        //     this.body.bounds.min.y,
        //     this.body.bounds.max.x - this.body.bounds.min.x,
        //     this.body.bounds.max.y - this.body.bounds.min.y
        // );
        // this.P5.stroke('red')
        // this.P5.circle(this.body.vertices[0].x, this.body.vertices[0].y,1)
        // this.P5.stroke('black')
        // this.P5.circle(this.body.vertices[1].x, this.body.vertices[1].y,1)
        // this.P5.stroke('yellow')
        // this.P5.circle(this.body.vertices[2].x, this.body.vertices[2].y,1)
        // this.P5.stroke('white')
        // this.P5.circle(this.body.vertices[3].x, this.body.vertices[3].y,1)
        this.P5.beginShape();
        this.P5.vertex(this.body.vertices[0].x, this.body.vertices[0].y);
        this.P5.vertex(this.body.vertices[1].x, this.body.vertices[1].y);
        this.P5.vertex(this.body.vertices[2].x, this.body.vertices[2].y);
        this.P5.vertex(this.body.vertices[3].x, this.body.vertices[3].y);
        this.P5.endShape(this.P5.CLOSE);
        // console.log(this.body.wall_name);
        // console.log( this.body.bounds.min.x,
        //     this.body.bounds.min.y,
        //     this.body.bounds.max.x - this.body.bounds.min.x,
        //     this.body.bounds.max.y - this.body.bounds.min.y);
        // this.P5.translate(pos.x, pos.y);
        // this.P5.beginShape();
        // this.P5.vertex(this.fromPeg.x, this.fromPeg.y);
        // this.P5.vertex(this.fromPeg.x+1, this.fromPeg.y);
        // this.P5.vertex(this.toPeg.x, this.toPeg.y);
        // this.P5.vertex(this.toPeg.x+1, this.toPeg.y);
        // this.P5.endShape(this.P5.CLOSE);
        this.P5.pop();
    };
    return CrossWall;
}(_BaseWall__WEBPACK_IMPORTED_MODULE_2__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CrossWall);


/***/ }),

/***/ "./src/components/wall/FunnelDownWall.ts":
/*!***********************************************!*\
  !*** ./src/components/wall/FunnelDownWall.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _FunnelWall__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FunnelWall */ "./src/components/wall/FunnelWall.ts");
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


var FunnelDownWall = /** @class */ (function (_super) {
    __extends(FunnelDownWall, _super);
    function FunnelDownWall() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    FunnelDownWall.prototype.init = function (x1, y1, x2, y2) {
        var width = (this.width = 1);
        var height = (this.height = Math.abs(y2 - y1));
        this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.rectangle(x1, y1 + height / 2, width, height, this.options);
        this.body.label = "funnel_wall";
        this.body.collisionFilter.group = 2147483647;
        this.body.collisionFilter.mask = 2147483647;
        this.body.collisionFilter.category = 2147483647;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(this.world, this.body);
    };
    return FunnelDownWall;
}(_FunnelWall__WEBPACK_IMPORTED_MODULE_1__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FunnelDownWall);


/***/ }),

/***/ "./src/components/wall/FunnelWall.ts":
/*!*******************************************!*\
  !*** ./src/components/wall/FunnelWall.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _BaseWall__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseWall */ "./src/components/wall/BaseWall.ts");
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



var FunnelWall = /** @class */ (function (_super) {
    __extends(FunnelWall, _super);
    function FunnelWall(world, P5, x1, y1, x2, y2) {
        var _this = _super.call(this, world, P5, x1, y1, x2, y2) || this;
        _this.init(x1, y1, x2, y2);
        return _this;
    }
    FunnelWall.prototype.init = function (x1, y1, x2, y2) {
        var width = (this.width = _configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].WALL.funnel_width);
        var height = (this.height = Math.abs(y2 - y1));
        this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.rectangle(x1, y1 - height / 2, width, height, this.options);
        this.body.label = "funnel_wall";
        this.body.collisionFilter.group = 2147483647;
        this.body.collisionFilter.mask = 2147483647;
        this.body.collisionFilter.category = 2147483647;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(this.world, this.body);
    };
    FunnelWall.prototype.show = function () {
        if (!_configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].WALL.showWall)
            return;
        this.P5.push();
        this.setStroke();
        var pos = this.body.position;
        this.P5.rect(this.body.bounds.min.x, this.body.bounds.min.y, this.body.bounds.max.x - this.body.bounds.min.x, this.body.bounds.max.y - this.body.bounds.min.y);
        // this.P5.stroke(255);
        // this.P5.translate(pos.x, pos.y);
        // this.P5.rect(pos.x, pos.y,this.width,this.height) ;
        // this.P5.textSize(5)
        // this.P5.text(this.body.wall_name,0,0);
        this.P5.pop();
    };
    return FunnelWall;
}(_BaseWall__WEBPACK_IMPORTED_MODULE_2__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FunnelWall);


/***/ }),

/***/ "./src/components/wall/Wall.ts":
/*!*************************************!*\
  !*** ./src/components/wall/Wall.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! matter-js */ "./node_modules/matter-js/build/matter.js");
/* harmony import */ var matter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(matter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _BaseWall__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./BaseWall */ "./src/components/wall/BaseWall.ts");
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



var Wall = /** @class */ (function (_super) {
    __extends(Wall, _super);
    function Wall(world, P5, x1, y1, x2, y2) {
        var _this = _super.call(this, world, P5, x1, y1, x2, y2) || this;
        _this.wtfSpacing = 15; //Khong hiểu tại sao bị lệch đi 15px???
        _this.width = Math.abs(x2 - x1) - _this.wtfSpacing;
        _this.body = matter_js__WEBPACK_IMPORTED_MODULE_0__.Bodies.rectangle(x1 + _this.wtfSpacing, y1, _this.width, _this.height, _this.options);
        _this.body.label = "wall";
        _this.body.collisionFilter.group = 0;
        _this.body.collisionFilter.mask = 0;
        _this.body.collisionFilter.category = 0;
        matter_js__WEBPACK_IMPORTED_MODULE_0__.Composite.add(world, _this.body);
        return _this;
    }
    Wall.prototype.show = function () {
        if (!_configs_app__WEBPACK_IMPORTED_MODULE_1__["default"].WALL.showWall)
            return;
        this.P5.push();
        this.setStroke();
        var pos = this.body.position;
        this.P5.rect(this.body.bounds.min.x, this.body.bounds.min.y, this.body.bounds.max.x - this.body.bounds.min.x, this.body.bounds.max.y - this.body.bounds.min.y);
        // this.P5.stroke(255);
        // this.P5.translate(pos.x, pos.y);
        // this.P5.rect(pos.x, pos.y,this.width,this.height) ;
        // this.P5.textSize(5)
        // this.P5.text(this.body.wall_name,0,0);
        this.P5.pop();
    };
    return Wall;
}(_BaseWall__WEBPACK_IMPORTED_MODULE_2__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Wall);


/***/ }),

/***/ "./src/configs/app.ts":
/*!****************************!*\
  !*** ./src/configs/app.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var AppConfig = /** @class */ (function () {
    function AppConfig() {
    }
    AppConfig.P5 = null;
    AppConfig.APP = {
        WIDTH: 550,
        HEIGHT: 580,
        TOPBUFFER: 50,
        SHOW_BODY: false,
        DEMO: false,
    };
    AppConfig.HOLE = {
        DROP_POSITION_X: AppConfig.APP.WIDTH / 2,
        DROP_POSITION_Y: AppConfig.APP.TOPBUFFER - 10,
    };
    AppConfig.PEG = {
        spacing: 30,
        rows: 17,
        radius: 2,
    };
    AppConfig.DISC = {
        x: AppConfig.HOLE.DROP_POSITION_X,
        y: AppConfig.HOLE.DROP_POSITION_Y,
        prices: {
            "0": 1000,
            "1": 10000,
            "2": 100000,
        },
        tolerance: 1,
        radius: (AppConfig.PEG.spacing - 2 * AppConfig.PEG.radius - 3) / 2,
        real_width: function () {
            return AppConfig.DISC.radius * 2;
        },
        image_ball_width: 29,
        image_ball_height: 29,
        image_width: 39,
        image_height: 39,
        image_ratio: function () {
            return AppConfig.DISC.image_ball_width / AppConfig.DISC.image_width;
        },
        translate_x: function () {
            return ((AppConfig.DISC.image_width - AppConfig.DISC.image_ball_width) /
                2);
        },
        translate_y: function () {
            return ((AppConfig.DISC.image_height -
                AppConfig.DISC.image_ball_height) /
                2);
        },
        draw_width: function () {
            return AppConfig.DISC.real_width() / AppConfig.DISC.image_ratio();
        },
    };
    AppConfig.WALL = {
        height: 1,
        funnel_width: 5,
    };
    AppConfig.BAG = {
        topBufferFromPeg: 30,
        heightBody: 10,
        texts: [
            1000, 500, 100, 10, 5, 1.1, 1, 0.5, 0.1, 0.5, 1, 1.1, 5, 10, 100,
            500, 1000,
        ],
        colors: [
            [255, 50, 0],
            [255, 100, 0],
            [255, 150, 0],
            [255, 200, 0],
            [255, 255, 0],
            [200, 255, 0],
            [150, 255, 0],
            [100, 255, 0],
            [50, 255, 0],
            [100, 255, 0],
            [150, 255, 0],
            [200, 255, 0],
            [255, 255, 0],
            [255, 200, 0],
            [255, 150, 0],
            [255, 100, 0],
            [255, 50, 0],
        ],
        path: [
            { x: 78.41999816894531, y: 1 },
            { x: 78.81401062011719, y: 3.4272117614746094 },
            { x: 79.12202453613281, y: 5.866900444030762 },
            { x: 79.36260223388672, y: 8.314196586608887 },
            { x: 79.54679870605469, y: 10.766397476196289 },
            { x: 79.68211364746094, y: 13.221792221069336 },
            { x: 79.77305603027344, y: 15.67923641204834 },
            { x: 79.82268524169922, y: 18.13786506652832 },
            { x: 79.83242797851562, y: 20.596975326538086 },
            { x: 79.80254364013672, y: 23.055925369262695 },
            { x: 79.73239135742188, y: 25.514053344726562 },
            { x: 79.61969757080078, y: 27.970590591430664 },
            { x: 79.46099090576172, y: 30.42458152770996 },
            { x: 79.2506103515625, y: 32.87466812133789 },
            { x: 78.97956085205078, y: 35.31877136230469 },
            { x: 78.63398742675781, y: 37.75339889526367 },
            { x: 77.2433853149414, y: 39.20463943481445 },
            { x: 74.80841064453125, y: 39.54740905761719 },
            { x: 72.36260223388672, y: 39.802310943603516 },
            { x: 69.91043090820312, y: 39.98651885986328 },
            { x: 67.45458984375, y: 40.1134147644043 },
            { x: 64.99678802490234, y: 40.193912506103516 },
            { x: 62.538021087646484, y: 40.23689651489258 },
            { x: 60.078914642333984, y: 40.24994659423828 },
            { x: 57.619781494140625, y: 40.23978042602539 },
            { x: 55.16078186035156, y: 40.21240234375 },
            { x: 52.701934814453125, y: 40.173370361328125 },
            { x: 50.24319076538086, y: 40.12825393676758 },
            { x: 47.78445816040039, y: 40.08246612548828 },
            { x: 45.32564163208008, y: 40.04153823852539 },
            { x: 42.866676330566406, y: 40.01167297363281 },
            { x: 40.407554626464844, y: 40.00000762939453 },
            { x: 37.94843292236328, y: 40.01131057739258 },
            { x: 35.48944091796875, y: 40.039939880371094 },
            { x: 33.03060531616211, y: 40.079402923583984 },
            { x: 30.57185173034668, y: 40.12396240234375 },
            { x: 28.11309242248535, y: 40.16823959350586 },
            { x: 25.65424156188965, y: 40.207305908203125 },
            { x: 23.195261001586914, y: 40.236083984375 },
            { x: 20.73613929748535, y: 40.24959182739258 },
            { x: 18.27700424194336, y: 40.24214172363281 },
            { x: 15.818105697631836, y: 40.20783996582031 },
            { x: 13.359911918640137, y: 40.139854431152344 },
            { x: 10.903237342834473, y: 40.03022384643555 },
            { x: 8.449390411376953, y: 39.86946105957031 },
            { x: 6.000489711761475, y: 39.646026611328125 },
            { x: 3.5599782466888428, y: 39.34489059448242 },
            { x: 1.367630124092102, y: 38.713314056396484 },
            { x: 0.9830066561698914, y: 36.284576416015625 },
            { x: 0.6825252771377563, y: 33.84394073486328 },
            { x: 0.44851380586624146, y: 31.39600944519043 },
            { x: 0.2700898051261902, y: 28.94337272644043 },
            { x: 0.14024192094802856, y: 26.487682342529297 },
            { x: 0.05445803701877594, y: 24.030054092407227 },
            { x: 0.010028660297393799, y: 21.571334838867188 },
            { x: 0.005484375171363354, y: 19.112194061279297 },
            { x: 0.040612947195768356, y: 16.653316497802734 },
            { x: 0.11625642329454422, y: 14.195351600646973 },
            { x: 0.23477691411972046, y: 11.739079475402832 },
            { x: 0.3998337388038635, y: 9.285518646240234 },
            { x: 0.6173803210258484, y: 6.836060523986816 },
            { x: 0.8967378735542297, y: 4.392895698547363 },
            { x: 1.2527118921279907, y: 1.9597785472869873 },
            { x: 2.8866617679595947, y: 0.7684714198112488 },
            { x: 5.329389572143555, y: 0.4865400195121765 },
            { x: 7.780893802642822, y: 0.29399389028549194 },
            { x: 10.236599922180176, y: 0.16445231437683105 },
            { x: 12.694310188293457, y: 0.08101105690002441 },
            { x: 15.152958869934082, y: 0.031763285398483276 },
            { x: 17.611997604370117, y: 0.007386131677776575 },
            { x: 20.071136474609375, y: 0.0001616298541193828 },
            { x: 21.376371383666992, y: 1.8802740573883057 },
            { x: 22.70690155029297, y: 3.946941614151001 },
            { x: 24.253293991088867, y: 5.8574957847595215 },
            { x: 25.997953414916992, y: 7.588865756988525 },
            { x: 27.92256736755371, y: 9.117594718933105 },
            { x: 30.0070858001709, y: 10.419736862182617 },
            { x: 32.22844314575195, y: 11.471447944641113 },
            { x: 34.559349060058594, y: 12.25046157836914 },
            { x: 36.96796417236328, y: 12.738701820373535 },
            { x: 39.4184455871582, y: 12.925004959106445 },
            { x: 41.873268127441406, y: 12.80765438079834 },
            { x: 44.29621505737305, y: 12.395698547363281 },
            { x: 46.65583419799805, y: 11.707709312438965 },
            { x: 48.92776107788086, y: 10.769457817077637 },
            { x: 51.199920654296875, y: 10 },
            { x: 52.97412872314453, y: 8.891738891601562 },
            { x: 54.882171630859375, y: 8 },
            { x: 56.244056701660156, y: 6.587970733642578 },
            { x: 57.41999816894531, y: 4.8555908203125 },
            { x: 58.854278564453125, y: 3.2828590869903564 },
            { x: 59.99763870239258, y: 1.2670775651931763 },
            { x: 61.54353332519531, y: 0 },
            { x: 64.00270080566406, y: 0 },
            { x: 66.46185302734375, y: 0 },
            { x: 68.9210205078125, y: 0 },
            { x: 71.38017272949219, y: 0 },
            { x: 73.83932495117188, y: 0 },
            { x: 76.29849243164062, y: 0 },
            { x: 78.41999816894531, y: 1 },
        ],
    };
    AppConfig.COLORS = ["#fbff00", "#009580", "#ba00e9", "#4056f1"];
    AppConfig.RUNTIME = {
        numberDiscInGame: 0,
    };
    AppConfig.TEST = {
        count: -1,
        maximumDiscInGame: 100,
        minDistanceTime: 500,
        paths: [
            // "18 52 86 120 154 188 222 256 292 326 362 398 434 470 506 542",
            "18 52 86 120 154 188 222 256 292 328 362 398 434 470 506 542",
            // "18 52 86 120 154 188 222 256 292 328 364 398 434 470 506 542",
            // "18 52 86 120 154 188 222 256 292 328 364 400 434 470 506 542",
            // "18 52 86 120 154 188 222 256 292 328 364 400 436 470 506 542",
            // "18 52 86 120 154 188 222 256 292 328 364 400 436 472 506 542",
            // "18 52 86 120 154 188 222 256 292 328 364 400 436 472 508 542",
            // "18 52 86 120 154 188 222 258 292 326 362 398 434 470 506 542",
            // "18 52 86 120 154 188 222 258 292 328 362 398 434 470 506 542",
            // "18 52 86 120 154 188 222 258 292 328 364 398 434 470 506 542",
            // "18 52 86 120 154 188 222 258 292 328 364 400 434 470 506 542",
            // "18 52 86 120 154 188 222 258 292 328 364 400 436 470 506 542",
        ],
    };
    return AppConfig;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (AppConfig);


/***/ }),

/***/ "./src/events/BagDiscCollision.ts":
/*!****************************************!*\
  !*** ./src/events/BagDiscCollision.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configs_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../configs/app */ "./src/configs/app.ts");
/* harmony import */ var _Collision__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Collision */ "./src/events/Collision.ts");
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


var BagDiscCollision = /** @class */ (function (_super) {
    __extends(BagDiscCollision, _super);
    function BagDiscCollision() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    BagDiscCollision.prototype.init = function (disc, bag) {
        this.disc = disc;
        this.enemy = this.bag = bag;
    };
    BagDiscCollision.prototype.action = function () {
        _configs_app__WEBPACK_IMPORTED_MODULE_0__["default"].RUNTIME.numberDiscInGame--;
        this.bag.game_active = 1;
        this.bag.game_type_ball = this.disc.game_type_ball;
        this.discContainer.removeById(this.disc.id);
    };
    return BagDiscCollision;
}(_Collision__WEBPACK_IMPORTED_MODULE_1__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BagDiscCollision);


/***/ }),

/***/ "./src/events/Collision.ts":
/*!*********************************!*\
  !*** ./src/events/Collision.ts ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var Collision = /** @class */ (function () {
    function Collision(world, discContainer) {
        this.world = world;
        this.discContainer = discContainer;
    }
    return Collision;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Collision);


/***/ }),

/***/ "./src/events/CollisionProvider.ts":
/*!*****************************************!*\
  !*** ./src/events/CollisionProvider.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _BagDiscCollision__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BagDiscCollision */ "./src/events/BagDiscCollision.ts");
/* harmony import */ var _PegDiscCollision__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PegDiscCollision */ "./src/events/PegDiscCollision.ts");


var CollisionProvider = /** @class */ (function () {
    function CollisionProvider() {
    }
    CollisionProvider.getCollisionTarget = function (world, discContainer, bodyA, bodyB) {
        if ((bodyA.label == 'bag' && bodyB.label == 'disc') || (bodyA.label == 'disc' && bodyB.label == 'bag')) {
            var bag = bodyA.label == 'bag' ? bodyA : bodyB;
            var disc = bodyA.label == 'disc' ? bodyA : bodyB;
            if (!CollisionProvider.CollisionItems['BagDiscCollision']) {
                CollisionProvider.CollisionItems['BagDiscCollision'] = new _BagDiscCollision__WEBPACK_IMPORTED_MODULE_0__["default"](world, discContainer);
            }
            var c = CollisionProvider.CollisionItems['BagDiscCollision'];
            c.init(disc, bag);
            return c;
        }
        else if ((bodyA.label == 'peg' && bodyB.label == 'disc') || (bodyA.label == 'disc' && bodyB.label == 'peg')) {
            var peg = bodyA.label == 'peg' ? bodyA : bodyB;
            var disc = bodyA.label == 'disc' ? bodyA : bodyB;
            if (!CollisionProvider.CollisionItems['PegDiscCollision']) {
                CollisionProvider.CollisionItems['PegDiscCollision'] = new _PegDiscCollision__WEBPACK_IMPORTED_MODULE_1__["default"](world, discContainer);
            }
            var c = CollisionProvider.CollisionItems['PegDiscCollision'];
            c.init(disc, peg);
            return c;
        }
        return null;
    };
    CollisionProvider.CollisionItems = {};
    return CollisionProvider;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CollisionProvider);


/***/ }),

/***/ "./src/events/PegDiscCollision.ts":
/*!****************************************!*\
  !*** ./src/events/PegDiscCollision.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _sounds_PegSoundCollection__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../sounds/PegSoundCollection */ "./src/sounds/PegSoundCollection.ts");
/* harmony import */ var _Collision__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Collision */ "./src/events/Collision.ts");
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


var PegDiscCollision = /** @class */ (function (_super) {
    __extends(PegDiscCollision, _super);
    function PegDiscCollision() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    PegDiscCollision.prototype.init = function (disc, peg) {
        this.disc = disc;
        this.enemy = this.peg = peg;
    };
    PegDiscCollision.prototype.action = function () {
        this.peg.game_active = 1;
        _sounds_PegSoundCollection__WEBPACK_IMPORTED_MODULE_0__["default"].getIntance().speaker();
    };
    return PegDiscCollision;
}(_Collision__WEBPACK_IMPORTED_MODULE_1__["default"]));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PegDiscCollision);


/***/ }),

/***/ "./src/index.ts":
/*!**********************!*\
  !*** ./src/index.ts ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var p5__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! p5 */ "./node_modules/p5/lib/p5.min.js");
/* harmony import */ var p5__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(p5__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Loader */ "./src/Loader.ts");
/* harmony import */ var _P5Wrapper__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./P5Wrapper */ "./src/P5Wrapper.ts");
/* harmony import */ var _sounds_SoundManager__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./sounds/SoundManager */ "./src/sounds/SoundManager.ts");
/* harmony import */ var _sounds_SoundProvider__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./sounds/SoundProvider */ "./src/sounds/SoundProvider.ts");





var currentGame;
var gameInited = false;
function makeGame() {
    var tmp = function (p) {
        _sounds_SoundProvider__WEBPACK_IMPORTED_MODULE_4__["default"].getInstance();
        var p5w = (currentGame = new _P5Wrapper__WEBPACK_IMPORTED_MODULE_2__.P5Wrapper(p));
        p.preload = function () {
            p5w.preload();
        };
        p.setup = function () {
            p5w.setup();
        };
        p.draw = function () {
            p5w.draw();
            if (!gameInited) {
                gameInited = true;
                eventInited();
            }
        };
        p.mousePressed = function () {
            p5w.mousePressed();
        };
    };
    return new p5__WEBPACK_IMPORTED_MODULE_0__(tmp);
}
function eventInited() {
    var event = new Event("game_inited");
    document.dispatchEvent(event);
}
var hostname = window.location.hostname;
if (hostname != "localhost" &&
    hostname != "127.0.0.1" &&
    hostname != "vinlott.net" &&
    hostname != "doanso.test") {
    var content = document.createElement("span");
    content.style.color = "red";
    content.innerHTML = "Licence không hợp lệ!";
    document.body.innerHTML = "";
    document.body.appendChild(content);
}
else {
    makeGame();
}
window["ShortPlinko"] = {
    blurWhenInactive: function () { },
    getGame: function () {
        return currentGame;
    },
    createDisc: function (path, type) {
        return this.getGame().matterWrapper.discContainer.createDisc(path, type);
    },
    sound: function () {
        return _sounds_SoundManager__WEBPACK_IMPORTED_MODULE_3__["default"];
    },
    loader: function () {
        return _Loader__WEBPACK_IMPORTED_MODULE_1__["default"];
    },
    init: function () {
        this.blurWhenInactive();
    },
};
window["ShortPlinko"].init();


/***/ }),

/***/ "./src/sounds/InteractionListener.ts":
/*!*******************************************!*\
  !*** ./src/sounds/InteractionListener.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _SoundManager__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SoundManager */ "./src/sounds/SoundManager.ts");

var InteractionListener = /** @class */ (function () {
    function InteractionListener() {
        this.initEvents();
    }
    InteractionListener.prototype.handleInteraction = function () {
        _SoundManager__WEBPACK_IMPORTED_MODULE_0__["default"].USER_INTERACTION = true;
    };
    InteractionListener.prototype.initEvents = function () {
        document.body.addEventListener('keydown', this.handleInteraction);
        document.body.addEventListener('click', this.handleInteraction);
        document.body.addEventListener('touchstart', this.handleInteraction);
    };
    return InteractionListener;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (InteractionListener);


/***/ }),

/***/ "./src/sounds/PegSoundCollection.ts":
/*!******************************************!*\
  !*** ./src/sounds/PegSoundCollection.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _SoundManager__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SoundManager */ "./src/sounds/SoundManager.ts");
/* harmony import */ var _SoundProvider__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SoundProvider */ "./src/sounds/SoundProvider.ts");


var PegSound = /** @class */ (function () {
    function PegSound() {
        this.bornTime = 0;
        this.duration = 300;
        this.sound = _SoundProvider__WEBPACK_IMPORTED_MODULE_1__["default"].getInstance().getSound("col");
        this.duration = this.sound.duration() * 1000;
        this.sound.setVolume(0.2);
        this.bornTime = new Date().getTime();
    }
    PegSound.prototype.play = function (time) {
        if (this.soundExists()) {
            if (this.needRemove(time)) {
                this.sound.stop();
            }
            this.sound.play();
        }
    };
    PegSound.prototype.soundExists = function () {
        return !_SoundManager__WEBPACK_IMPORTED_MODULE_0__["default"].isTurnOff() && this.sound && this.sound.isLoaded();
    };
    PegSound.prototype.needRemove = function (time) {
        return time - this.bornTime > this.duration;
    };
    return PegSound;
}());
var PegSoundCollection = /** @class */ (function () {
    function PegSoundCollection() {
        this.sounds = [];
        for (var i = 0; i < 1; i++) {
            this.sounds.push(new PegSound());
        }
    }
    PegSoundCollection.prototype.speaker = function () {
        var time = new Date().getTime();
        for (var i = 0; i < this.sounds.length; i++) {
            var element = this.sounds[i];
            if (element) {
                element.play(time);
            }
        }
    };
    PegSoundCollection.getIntance = function () {
        if (!this.PEGSOUND) {
            this.PEGSOUND = new PegSoundCollection();
        }
        return this.PEGSOUND;
    };
    return PegSoundCollection;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PegSoundCollection);


/***/ }),

/***/ "./src/sounds/Sound.ts":
/*!*****************************!*\
  !*** ./src/sounds/Sound.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var Sound = /** @class */ (function () {
    function Sound(audio) {
        this.audio = audio;
    }
    Sound.prototype.setLoop = function (value) {
        if (value === void 0) { value = true; }
        if (this.audio) {
            this.audio.loop = value;
        }
    };
    Sound.prototype.play = function () {
        if (this.audio) {
            this.audio.play();
        }
    };
    Sound.prototype.stop = function () {
        if (this.audio) {
            this.audio.pause();
            this.audio.currentTime = 0;
        }
    };
    Sound.prototype.isPlaying = function () {
        return (this.audio &&
            this.audio.currentTime > 0 &&
            !this.audio.paused &&
            !this.audio.ended &&
            this.audio.readyState > 2);
    };
    Sound.prototype.isLoaded = function () {
        return this.audio && this.audio.readyState == 4;
    };
    Sound.prototype.setVolume = function (value) {
        if (this.audio) {
            this.audio.volume = value;
        }
    };
    Sound.prototype.duration = function () {
        return this.audio.duration;
    };
    return Sound;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Sound);


/***/ }),

/***/ "./src/sounds/SoundManager.ts":
/*!************************************!*\
  !*** ./src/sounds/SoundManager.ts ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Sound__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Sound */ "./src/sounds/Sound.ts");
/* harmony import */ var _SoundProvider__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SoundProvider */ "./src/sounds/SoundProvider.ts");


var SoundManager = /** @class */ (function () {
    function SoundManager() {
    }
    SoundManager.mute = function () {
        localStorage.setItem("plinko_mute", "1");
    };
    SoundManager.unmute = function () {
        localStorage.setItem("plinko_mute", "0");
    };
    SoundManager.isMute = function () {
        var status = localStorage.getItem("plinko_mute");
        if (!status) {
            status = "1";
        }
        return status == "1";
    };
    SoundManager.playBackgroundSound = function () {
        var sound = _SoundProvider__WEBPACK_IMPORTED_MODULE_1__["default"].getInstance().getSound('bg');
        var backgroundSound = new _Sound__WEBPACK_IMPORTED_MODULE_0__["default"](sound);
        backgroundSound.setLoop();
        if (this.exists(backgroundSound)) {
            if (!backgroundSound.isPlaying()) {
                backgroundSound.play();
            }
        }
    };
    SoundManager.playSound = function (name, loop) {
        if (loop === void 0) { loop = false; }
        var sound = _SoundProvider__WEBPACK_IMPORTED_MODULE_1__["default"].getInstance().getSound(name);
        if (this.needPlaySound(sound)) {
            if (loop)
                sound.loop();
            sound.play();
        }
    };
    SoundManager.exists = function (sound) {
        return !this.isTurnOff() && sound && sound.isLoaded();
    };
    SoundManager.needPlaySound = function (sound) {
        return (!this.isTurnOff() && sound && sound.isLoaded() && !sound.isPlaying());
    };
    SoundManager.isTurnOff = function () {
        if (!this.userHasInteraction()) {
            return true;
        }
        return (this.turnoff = this.isMute());
    };
    SoundManager.userHasInteraction = function () {
        return this.USER_INTERACTION;
    };
    SoundManager.turnoff = false;
    SoundManager.USER_INTERACTION = false;
    return SoundManager;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (SoundManager);


/***/ }),

/***/ "./src/sounds/SoundProvider.ts":
/*!*************************************!*\
  !*** ./src/sounds/SoundProvider.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _InteractionListener__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./InteractionListener */ "./src/sounds/InteractionListener.ts");
/* harmony import */ var _Sound__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Sound */ "./src/sounds/Sound.ts");


var SoundProvider = /** @class */ (function () {
    function SoundProvider() {
        this._sounds = {
            bg: "theme/frontend/plinko/assets/sounds/bg.ogg",
            big_win: "theme/frontend/plinko/assets/sounds/big_win.ogg",
            click: "theme/frontend/plinko/assets/sounds/click.ogg",
            over: "theme/frontend/plinko/assets/sounds/over.ogg",
            play: "theme/frontend/plinko/assets/sounds/play.ogg",
            win_sound: "theme/frontend/plinko/assets/sounds/win_sound.ogg",
            col: "theme/frontend/plinko/assets/sounds/col.ogg",
        };
        this.audios = {};
        this.initAudio();
        this.initInteractionListener();
    }
    SoundProvider.prototype.initInteractionListener = function () {
        new _InteractionListener__WEBPACK_IMPORTED_MODULE_0__["default"]();
    };
    SoundProvider.prototype.initAudio = function () {
        for (var _i = 0, _a = Object.entries(this._sounds); _i < _a.length; _i++) {
            var _b = _a[_i], key = _b[0], value = _b[1];
            this.audios[key] = new _Sound__WEBPACK_IMPORTED_MODULE_1__["default"](new Audio(value));
        }
    };
    SoundProvider.prototype.getSound = function (key) {
        return this.audios[key];
    };
    SoundProvider.getInstance = function () {
        if (!this.instance) {
            this.instance = new SoundProvider();
        }
        return this.instance;
    };
    SoundProvider.instance = null;
    return SoundProvider;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (SoundProvider);


/***/ }),

/***/ "./src/sprites/Broken.ts":
/*!*******************************!*\
  !*** ./src/sprites/Broken.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _BrokenBug__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BrokenBug */ "./src/sprites/BrokenBug.ts");

var Broken = /** @class */ (function () {
    function Broken(P5, x, y) {
        this.P5 = P5;
        this.x = x;
        this.y = y;
        this.bugs = [];
        this.numBugs = 40;
        this.init();
    }
    Broken.prototype.init = function () {
        if (this.bugs.length == this.numBugs)
            return;
        this.bugs = [];
        for (var i = 0; i < this.numBugs; i++) {
            var radius = this.P5.random(4, 8);
            var b = new _BrokenBug__WEBPACK_IMPORTED_MODULE_0__["default"](this.P5, this.x, this.y, radius, i % 4);
            this.bugs.push(b);
        }
    };
    Broken.prototype.show = function () {
        for (var i = this.bugs.length - 1; i >= 0; i--) {
            var bug = this.bugs[i];
            bug.move();
            bug.show();
            bug.shrink();
            if (bug.finished()) {
                this.bugs.splice(i, 1);
            }
        }
    };
    return Broken;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Broken);


/***/ }),

/***/ "./src/sprites/BrokenBug.ts":
/*!**********************************!*\
  !*** ./src/sprites/BrokenBug.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Bug__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Bug */ "./src/sprites/Bug.ts");
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

var BrokenBug = /** @class */ (function (_super) {
    __extends(BrokenBug, _super);
    function BrokenBug(P5, x, y, r, direction) {
        var _this = _super.call(this, P5, x, y, r) || this;
        _this.direction = direction;
        _this.rangex = 2;
        _this.rangey = 2;
        return _this;
    }
    BrokenBug.prototype.move = function () {
        if (this.direction == 0) {
            this.x += this.P5.random(-this.rangex, 0);
            this.y += this.P5.random(-this.rangey, 0);
        }
        else if (this.direction == 1) {
            this.x += this.P5.random(0, this.rangex);
            this.y += this.P5.random(-this.rangey, 0);
        }
        else if (this.direction == 2) {
            this.x += this.P5.random(0, this.rangex);
            this.y += this.P5.random(0, this.rangey);
        }
        else if (this.direction == 3) {
            this.x += this.P5.random(-this.rangex, 0);
            this.y += this.P5.random(0, this.rangey);
        }
    };
    BrokenBug.prototype.shrink = function () {
        this.r -= 0.4;
    };
    return BrokenBug;
}(_Bug__WEBPACK_IMPORTED_MODULE_0__.Bug));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (BrokenBug);


/***/ }),

/***/ "./src/sprites/Bug.ts":
/*!****************************!*\
  !*** ./src/sprites/Bug.ts ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Bug": () => (/* binding */ Bug)
/* harmony export */ });
var Bug = /** @class */ (function () {
    function Bug(P5, x, y, r) {
        this.P5 = P5;
        this.x = x;
        this.y = y;
        this.r = r;
        this.rangex = 3;
        this.rangey = 2;
        this.color = this.P5.color(255);
        var ran = this.P5.random(3);
        if (ran < 1) {
            this.color = this.P5.color(255, 100, 20, 255); // orange
        }
        else if (ran >= 1 && ran < 2) {
            this.color = this.P5.color(255, 200, 10, 255); // yellow
        }
        else if (ran >= 2) {
            this.color = this.P5.color(255, 80, 5, 255); // reddish
        }
    }
    Bug.prototype.show = function () {
        this.P5.push();
        // this.P5.translate(this.x, this.y);
        this.P5.noStroke();
        this.P5.fill(this.color);
        this.P5.ellipse(this.x, this.y, this.r);
        this.P5.pop();
    };
    Bug.prototype.move = function () {
        this.x += this.P5.random(-this.rangex, this.rangex);
        this.y -= this.P5.random(1, this.rangey);
    };
    Bug.prototype.shrink = function () {
        this.r -= 0.4;
    };
    Bug.prototype.finished = function () {
        return this.r < 0;
    };
    return Bug;
}());



/***/ }),

/***/ "./src/sprites/Fire.ts":
/*!*****************************!*\
  !*** ./src/sprites/Fire.ts ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "FireType": () => (/* binding */ FireType),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Bug__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Bug */ "./src/sprites/Bug.ts");

var Fire = /** @class */ (function () {
    function Fire(P5, fileType) {
        if (fileType === void 0) { fileType = FireType.NORMAL; }
        this.P5 = P5;
        this.fileType = fileType;
        this.bugs = [];
        this.numBugs = 1;
        this.numBugs = fileType;
    }
    Fire.prototype.show = function (x, y) {
        if (x === void 0) { x = 200; }
        if (y === void 0) { y = 300; }
        for (var i = this.bugs.length - 1; i >= 0; i--) {
            var bug = this.bugs[i];
            bug.move();
            bug.show();
            bug.shrink();
            if (bug.finished()) {
                this.bugs.splice(i, 1);
            }
        }
        for (var i = 0; i < this.numBugs; i++) {
            var radius = this.P5.random(5, 10);
            var b = new _Bug__WEBPACK_IMPORTED_MODULE_0__.Bug(this.P5, x, y, radius);
            this.bugs.push(b);
        }
    };
    return Fire;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Fire);
var FireType;
(function (FireType) {
    FireType[FireType["NORMAL"] = 0] = "NORMAL";
    FireType[FireType["MID"] = 1] = "MID";
    FireType[FireType["HOT"] = 2] = "HOT";
})(FireType || (FireType = {}));


/***/ }),

/***/ "./src/sprites/Light.ts":
/*!******************************!*\
  !*** ./src/sprites/Light.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Loader__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Loader */ "./src/Loader.ts");

var Light = /** @class */ (function () {
    function Light(P5, name, options) {
        if (options === void 0) { options = {
            rate: 2,
            time: 15,
            x: 0,
            y: 0,
            percentIncrement: 3,
            width: 20,
            height: 20,
        }; }
        this.P5 = P5;
        this.name = name;
        this.options = options;
        this.tick = 0;
        this.count = 0;
        this.image = _Loader__WEBPACK_IMPORTED_MODULE_0__["default"].getImage(this.name);
    }
    Light.prototype.reset = function () {
        if (this.finish) {
            this.finish();
        }
    };
    Light.prototype.show = function () {
        if (this.count > this.options.time) {
            this.reset();
            this.count = 0;
            return;
        }
        if (this.tick % this.options.rate == 0) {
            this.drawImage();
            this.count++;
        }
        this.tick++;
    };
    Light.prototype.drawImage = function () {
        var p = (100 + this.options.percentIncrement * this.count) / 100;
        var w = this.options.width * p;
        var h = this.options.height * p;
        if (this.image) {
            this.P5.image(this.image, this.options.x, this.options.y, w, h);
        }
        else {
            this.image = _Loader__WEBPACK_IMPORTED_MODULE_0__["default"].getImage(this.name);
        }
    };
    return Light;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Light);


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
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkplinko"] = self["webpackChunkplinko"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors-node_modules_matter-js_build_matter_js-node_modules_p5_lib_p5_min_js"], () => (__webpack_require__("./src/index.ts")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;