var PLINKO = {
    _: function (selector) {
        return document.querySelector(selector);
    },
    playGame: function () {
        XHR.send({
            url: "plinko-play",
            method: "POST",
            data: {
                type: this._("[name=risk]:checked").value,
                mode: this._("[name=mode]:checked").value,
                qty: this._("[name=qty]").value,
            },
        }).then((res) => {});
    },
    testGame: function () {
        XHR.send({
            url: "testhung",
            method: "GET",
        }).then((res) => {
            if (res.path && res.type) {
                ShortPlinko.createDisc(res.path, res.type);
            }
        });
    },
};

var PLINKO_UI = {
    init: function () {
        var button = PLINKO._("button.play");
        button.addEventListener("click", function (e) {
            PLINKO.playGame();
        });
        var button = PLINKO._("button#test");
        button.addEventListener("click", function (e) {
            PLINKO.testGame();
        });
    },
};
window.addEventListener("DOMContentLoaded", function () {
    this.setTimeout(function () {
        PLINKO_UI.init();
    }, 100);
});
