var REGISTER_GUI = {
    registerDone(data) {
        if (data.message) {
            BASE_GUI.createFlashNotify(data.message);
        }
        if (data.code == 200) {
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            }
            if (data.redirect_url) {
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 1500);
            }
        }
    },
    validateRegister(data) {
        var registerAcceptPrivacyPolicy = document.querySelector(
            "#register-accept-privacy-policy"
        );
        if (
            !registerAcceptPrivacyPolicy ||
            registerAcceptPrivacyPolicy.getAttribute("aria-checked") == "false"
        ) {
            BASE_GUI.createFlashNotify(
                "Vui lòng xác nhận đồng ý với chính sách bảo mật!"
            );
            return false;
        }
        return true;
    },
};
var LOGIN_GUI = {
    loginDone(data) {
        if (data.message) {
            BASE_GUI.createFlashNotify(data.message);
        }
        if (data.code == 200) {
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            }
            if (data.redirect_url) {
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 1500);
            }
        }
    },
};
var ACCOUNT_GUI = {
    changeProfileDone(data) {
        if (data.message) {
            BASE_GUI.createFlashNotify(data.message);
        }
        if (data.code == 200) {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    },
    createUserBankDone(data) {
        if (data.message) {
            BASE_GUI.createFlashNotify(data.message);
        }
        if (data.code == 200) {
            setTimeout(() => {
                window.location.href = data.back_link;
            }, 1000);
        }
    },
};
var BET_HISTORY = (function () {
    var initBetHistoryTab = function () {
        var betHistoryTab = document.querySelector("#bet-history-tab");
        if (!betHistoryTab) return;
        var vanTabNav = document.querySelector(".van-tabs__nav");
        var vanTabLine = document.querySelector(".van-tabs__line");
        var listItems = betHistoryTab.querySelectorAll(".van-tab");

        var betHistoryActiveTab = document.querySelector(
            "#bet-history-tab .van-tab--active"
        );
        if (betHistoryActiveTab) {
            var vanTabLinePostionX =
                betHistoryActiveTab.offsetLeft +
                betHistoryActiveTab.clientWidth / 2;
            var style = `width: 42px; transform: translateX(${vanTabLinePostionX}px) translateX(-50%); transition-duration: 0.3s;`;
            vanTabLine.setAttribute("style", style);
        }

        listItems.forEach((element) => {
            element.addEventListener("click", function () {
                if (this.classList.contains("van-tab--active")) return;
                listItems.forEach((elm) => {
                    elm.classList.remove("van-tab--active");
                });
                this.classList.add("van-tab--active");
                var scrollLeff =
                    this.offsetLeft -
                    vanTabNav.scrollLeft -
                    betHistoryTab.clientWidth / 2 +
                    this.clientWidth / 2;
                vanTabNav.scrollBy({
                    top: 0,
                    left: scrollLeff,
                    behavior: "smooth",
                });
                var vanTabLinePostionX = this.offsetLeft + this.clientWidth / 2;
                var style = `width: 42px; transform: translateX(${vanTabLinePostionX}px) translateX(-50%); transition-duration: 0.3s;`;
                vanTabLine.setAttribute("style", style);
                initBetHistoryActiveTab();
            });
        });
    };
    var initBetHistoryActiveTab = function () {
        var betHistoryResult = document.querySelector("#bet-history-result");
        var betHistoryActiveTab = document.querySelector(
            "#bet-history-tab .van-tab--active"
        );
        if (betHistoryActiveTab && betHistoryResult) {
            BASE_GUI.showLoading();
            XHR.send({
                url: betHistoryActiveTab.dataset.action,
                method: "GET",
            }).then((res) => {
                if (res.code == 200 && res.html) {
                    if (betHistoryResult) {
                        betHistoryResult.innerHTML = res.html;
                        var listInfiniteLoadBox =
                            betHistoryResult.querySelectorAll(
                                ".infinite-load-item-module"
                            );
                        listInfiniteLoadBox.forEach(
                            (elementInfiniteLoadBox) => {
                                new infiniteLoadBox(elementInfiniteLoadBox);
                            }
                        );
                        initPaginateBox(betHistoryResult);
                        BASE_GUI.hideLoading();
                    }
                }
            });
        }
    };
    var initPaginateBox = function (element, callback = null) {
        var listPaginateBoxLinkBtn = element.querySelectorAll(
            ".paginate-box-link-btn.action"
        );
        listPaginateBoxLinkBtn.forEach((btn) => {
            if (btn.dataset.href != "") {
                btn.addEventListener("click", function () {
                    BASE_GUI.showLoading();
                    XHR.send({
                        url: this.dataset.href,
                        method: "GET",
                    }).then((res) => {
                        if (res.code == 200 && res.html) {
                            element.innerHTML = res.html;
                            initPaginateBox(element, callback);
                            if (callback) {
                                BASE_SUPPORT.callFunction(callback);
                            }
                        }
                        BASE_GUI.hideLoading();
                    });
                });
            }
        });
    };
    return {
        _: function () {
            initBetHistoryTab();
            initBetHistoryActiveTab();
        },
    };
})();
window.addEventListener("DOMContentLoaded", function () {
    BET_HISTORY._();
});
