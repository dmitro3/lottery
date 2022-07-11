var RECHARGE_BASE = (function () {
    var initSelectRechargeMethod = function () {
        var listItemRechargeMethod = document.querySelectorAll(
            ".item-recharge-method"
        );
        listItemRechargeMethod.forEach((element) => {
            element.addEventListener("click", function () {
                if (this.classList.contains("action")) return;
                var elementImg = element.querySelector("img");
                listItemRechargeMethod.forEach((elm) => {
                    var elmImg = elm.querySelector("img");
                    var elmIcon = elm.querySelector(".icon");
                    elm.classList.remove("action");
                    if (elmImg) {
                        elmImg.setAttribute("src", elm.dataset.disable);
                    }
                    if (elmIcon) {
                        elmIcon.remove();
                    }
                });
                this.classList.add("action");
                if (elementImg) {
                    elementImg.setAttribute("src", element.dataset.active);
                }
                this.insertAdjacentHTML(
                    "beforeend",
                    `<div class="icon">
                        <i class="van-icon van-icon-success" style="color: rgb(255, 255, 255); font-size: 14px;"></i>
                    </div>`
                );
                initActiveRechargeMethod();
            });
        });
    };
    var initActiveRechargeMethod = function () {
        var itemRechargeMethodActive = document.querySelector(
            ".item-recharge-method.action"
        );
        if (!itemRechargeMethodActive) return;
        XHR.send({
            url: "tai-khoan/init-recharge-method",
            method: "GET",
            data: {
                idx: itemRechargeMethodActive.dataset.idx,
            },
        }).then((res) => {
            var payBoxContentResult = document.querySelector(
                "#pay-box-content-result"
            );
            if (res.html && payBoxContentResult) {
                payBoxContentResult.innerHTML = res.html;
            }
            initAmountSelecter();
        });
    };
    var _initInputAmountSelecter = function (input, listAmountSelecter) {
        console.log(input, listAmountSelecter);
    };
    var initAmountSelecter = function () {
        var listAmountSelecter = document.querySelectorAll(".amount-selecter");
        var amountSelecterTarget = document.querySelector(
            ".amount-selecter-target"
        );
        if (amountSelecterTarget && listAmountSelecter) {
            amountSelecterTarget.addEventListener("change", function () {
                _initInputAmountSelecter(this, listAmountSelecter);
            });
            amountSelecterTarget.addEventListener("input", function () {
                _initInputAmountSelecter(this, listAmountSelecter);
            });
            listAmountSelecter.forEach((element) => {
                element.addEventListener("click", function () {
                    if (this.classList.contains("action")) return;
                    listAmountSelecter.forEach((elm) => {
                        elm.classList.remove("action");
                    });
                    element.classList.add("action");
                    amountSelecterTarget.value = element.dataset.amout;
                });
            });
        }
    };
    return {
        _: function () {
            initSelectRechargeMethod();
            initActiveRechargeMethod();
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    RECHARGE_BASE._();
});
