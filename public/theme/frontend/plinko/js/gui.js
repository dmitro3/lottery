var _GAME_PLINKO = (function () {
    var _ = function (querySelectorAll) {
        return document.querySelector(querySelectorAll);
    };
    var _All = function (querySelectorAll) {
        return document.querySelectorAll(querySelectorAll);
    };
    var changeInput = function () {
        var minus = _(".minus");
        var plus = _(".plus");
        var inputQty = _(".qty_bet input");
        let min = inputQty.getAttribute("min");
        let max = inputQty.getAttribute("max");
        minus.addEventListener("click", function () {
            let valueInput = parseInt(inputQty.value);
            if (valueInput == 1 || valueInput < 1) {
                inputQty.value = 1;
                return false;
            }
            valueInput--;
            valueInput = Math.max(valueInput, min);
            inputQty.value = valueInput;
            inputQty.dispatchEvent(new Event("input"));
        });
        plus.addEventListener("click", function () {
            let valueInput = parseInt(inputQty.value);
            valueInput++;
            valueInput = Math.min(valueInput, max);
            inputQty.value = valueInput;
            inputQty.dispatchEvent(new Event("input"));
        });
    };
    var changeMode = function () {
        var lsMode = _All(".label_choose.mode");
        var autoMode = _(".qty_box");
        var inputQty = _(".qty_box input[name='qty']");
        lsMode.forEach(function (e, i) {
            e.addEventListener("click", function () {
                let _modeInput = e.querySelector("input");
                let _modeValue = _modeInput.value;
                if (_modeValue == "auto") {
                    autoMode.classList.add("none");
                    autoMode.classList.remove("show");
                    inputQty.disabled = false;
                } else {
                    inputQty.disabled = true;
                    autoMode.classList.remove("none");
                    autoMode.classList.add("show");
                }
            });
        });
    };
    return {
        _: function () {
            changeInput();
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    _GAME_PLINKO._();
});
