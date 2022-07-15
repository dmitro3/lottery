BASE_GUI = {
    html: document.querySelector("html"),
    init: function () {
        BASE_GUI.initSiteSize();
        BASE_GUI.initVanNoticeBarContent();
        BASE_GUI.initBaseCheckBox();
        BASE_GUI.initBasePopup();
        BASE_GUI.initBaseLoadNotify();
    },
    initBaseLoadNotify: function () {
        if (messageNotify && messageNotify != "") {
            BASE_GUI.createFlashNotify(messageNotify);
        }
    },
    initSiteSize: function () {
        BASE_GUI._calculateSiteSize();
        var rtime;
        var timeout = false;
        var delta = 200;
        window.addEventListener("resize", function () {
            rtime = new Date();
            if (timeout === false) {
                timeout = true;
                setTimeout(resizeend, delta);
            }
        });
        function resizeend() {
            if (new Date() - rtime < delta) {
                setTimeout(resizeend, delta);
            } else {
                timeout = false;
                BASE_GUI._calculateSiteSize();
            }
        }
    },
    _calculateSiteSize: function () {
        var currentSize = window.innerWidth / 10;
        currentSize = currentSize > 54 ? 54 : currentSize;
        if (BASE_GUI.html) {
            BASE_GUI.html.style.fontSize = currentSize + "px";
        }
    },
    initVanNoticeBarContent: function () {
        var vanNoticeBarContent = document.querySelector(
            ".van-notice-bar__content"
        );
        if (vanNoticeBarContent) {
            const parentWidth = vanNoticeBarContent.parentElement.clientWidth;
            const contentWidth = vanNoticeBarContent.clientWidth;
            const duration = contentWidth / 50;
            function resetMarqueeContent(durationReset) {
                vanNoticeBarContent.setAttribute(
                    "style",
                    `transition-duration: 0s; transform: translateX(${parentWidth}px);`
                );
                setTimeout(() => {
                    vanNoticeBarContent.setAttribute(
                        "style",
                        `transition-duration: ${durationReset}s; transform: translateX(-${contentWidth}px);`
                    );
                }, 300);
            }
            if (duration > 0) {
                setTimeout(() => {
                    vanNoticeBarContent.setAttribute(
                        "style",
                        `transition-duration: ${duration}s; transform: translateX(-${contentWidth}px);`
                    );
                    const duration2nd = (contentWidth + parentWidth) / 50;
                    setTimeout(() => {
                        resetMarqueeContent(duration2nd);
                        setInterval(() => {
                            resetMarqueeContent(duration2nd);
                        }, (duration2nd + 0.3) * 1000);
                    }, duration * 1000);
                }, 2000);
            }
        }
    },
    initBaseCheckBox: function () {
        var listCheckBox = document.querySelectorAll(".van-checkbox");
        listCheckBox.forEach((element) => {
            element.addEventListener("click", function () {
                var vanCheckboxIcon = this.querySelector(".van-checkbox__icon");
                var vanIcon = this.querySelector(".van-icon");
                if (this.getAttribute("aria-checked") == "false") {
                    this.setAttribute("aria-checked", "true");
                    this.question;
                    if (vanCheckboxIcon) {
                        vanCheckboxIcon.classList.add(
                            "van-checkbox__icon--checked"
                        );
                    }
                    if (vanIcon) {
                        vanIcon.classList.add("van-icon-success");
                    }
                } else {
                    this.setAttribute("aria-checked", "false");
                    if (vanCheckboxIcon) {
                        vanCheckboxIcon.classList.remove(
                            "van-checkbox__icon--checked"
                        );
                    }
                    if (vanIcon) {
                        vanIcon.classList.remove("van-icon-success");
                    }
                }
            });
        });
    },
    createFlashNotify: function (message, autoHide = true) {
        var listOldFlashNotify = document.querySelectorAll(".flash-msg");
        listOldFlashNotify.forEach((element) => {
            element.remove();
        });
        var elementFlashNotify = document.createElement("div");
        elementFlashNotify.classList.add("msg");
        elementFlashNotify.classList.add("flash-msg");
        elementFlashNotify.innerHTML = `<div class="msg-content">${message}`;
        var body = document.querySelector("body");
        if (body) {
            body.appendChild(elementFlashNotify);
            if (autoHide) {
                setTimeout(() => {
                    elementFlashNotify.remove();
                }, 2500);
            }
        }
    },
    showLoading: function () {
        var loaddingBox = document.querySelector(".Loading");
        if (loaddingBox) {
            loaddingBox.style.display = "flex";
        }
    },
    hideLoading: function () {
        var loaddingBox = document.querySelector(".Loading");
        if (loaddingBox) {
            loaddingBox.style.display = "none";
        }
    },
    fadeIn: function (element, time = null) {
        var baseFadeTime = time ? time / 1000 + "s" : ".3s";
        element.style.opacity = 0;
        element.style.transition = baseFadeTime;
        element.style.display = "block";
        setTimeout(() => {
            element.style.opacity = 1;
        }, 10);
    },
    fadeOut: function (element, time = null) {
        var baseFadeTime = time ?? 300;
        element.style.opacity = 1;
        element.style.transition = baseFadeTime / 1000 + "s";
        setTimeout(() => {
            element.style.opacity = 0;
            setTimeout(() => {
                element.style.display = "none";
            }, baseFadeTime);
        }, 10);
    },
    initBasePopup: function () {
        var listBtnShowVanPopup = document.querySelectorAll(
            ".btn-show-van-popup"
        );
        listBtnShowVanPopup.forEach((element) => {
            var mainPopupOverlay = document.querySelector(
                element.dataset.target + "-overlay"
            );
            var mainPopup = document.querySelector(element.dataset.target);
            element.addEventListener("click", function () {
                if (mainPopupOverlay) {
                    BASE_GUI.fadeIn(mainPopupOverlay);
                }
                if (mainPopup) {
                    BASE_GUI.fadeIn(mainPopup);
                }
            });
            var listBtnClosePopup =
                mainPopup.querySelectorAll(".btn-close-popup");
            listBtnClosePopup.forEach((element) => {
                var mainPopup = element.closest(".van-popup");
                var mainPopupOverlay = null;
                if (mainPopup) {
                    mainPopupOverlay = document.querySelector(
                        "#" + mainPopup.getAttribute("id") + "-overlay"
                    );
                }
                element.addEventListener("click", function () {
                    if (mainPopupOverlay) {
                        BASE_GUI.fadeOut(mainPopupOverlay);
                    }
                    if (mainPopup) {
                        BASE_GUI.fadeOut(mainPopup);
                    }
                });
            });
        });
    },
    formatCurrency: function (number) {
        var n = number.toString().split("").reverse().join("");
        var n2 = n.replace(/\d\d\d(?!$)/g, "$&.");
        return n2.split("").reverse().join("") + " đ";
    },
    reloadUserMoney(element = null) {
        if (element && element.classList.contains("in-reload")) return;
        if (element) {
            element.classList.add("in-reload");
            setTimeout(() => {
                element.classList.remove("in-reload");
            }, 500);
        }
        XHR.send({
            url: "get-user-money",
            method: "GET",
        }).then((res) => {
            if (res.code == 200 && res.money) {
                var listUserMoneyPreview = document.querySelectorAll(
                    ".user-money-preview"
                );
                listUserMoneyPreview.forEach((elm) => {
                    elm.innerHTML = res.money;
                });
            } else {
                if (res.message) {
                    BASE_GUI.createFlashNotify(res.message);
                }
                if (res.redirect) {
                    setTimeout(() => {
                        window.location.href = res.redirect;
                    }, 1500);
                }
            }
        });
    },
    copyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.style.position = "fixed";
        textArea.style.top = 0;
        textArea.style.left = 0;
        textArea.style.width = "2em";
        textArea.style.height = "2em";
        textArea.style.padding = 0;
        textArea.style.border = "none";
        textArea.style.outline = "none";
        textArea.style.boxShadow = "none";
        textArea.style.background = "transparent";
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            var successful = document.execCommand("copy");
            if (successful) {
                BASE_GUI.createFlashNotify("Sao chép thành công");
            }
            document.body.removeChild(textArea);
            return true;
        } catch (err) {
            document.body.removeChild(textArea);
            return false;
        }
    },
    initCopyTextbtn() {
        var listCopyTextBtn = document.querySelectorAll(".copy-text-btn");
        listCopyTextBtn.forEach((element) => {
            element.onclick = function () {
                var text = this.getAttribute("data-clipboard-text");
                if (text) {
                    BASE_GUI.copyTextToClipboard(text);
                }
            };
        });
    },
};
BASE_SUPPORT = {
    getCookie: function (cname) {
        var name = cname + "=";
        decodedCookie = document.cookie;
        var ca = decodedCookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ") {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    setCookie: function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    _dispatchEvent: function (element, eventName) {
        if (typeof Event == "function") {
            const event = new Event(eventName);
            element.dispatchEvent(event);
        } else {
            if ("createEvent" in document) {
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent(eventName, false, true);
                element.dispatchEvent(evt);
            } else {
                element.fireEvent("on" + eventName);
            }
        }
    },
    callFunction(func, data) {
        var arrayFunc = func.split(".");
        if (arrayFunc.length === 1) {
            var func = arrayFunc[0];
            return (
                null != window[func] &&
                typeof window[func] === "function" &&
                window[func](data)
            );
        } else if (arrayFunc.length === 2) {
            var obj = arrayFunc[0];
            func = arrayFunc[1];
            return (
                window[obj] != null &&
                typeof window[obj] === "object" &&
                null != window[obj][func] &&
                typeof window[obj][func] === "function" &&
                window[obj][func](data)
            );
        }
    },
};
BASE_GUI_HOME = {
    elelemtExist: function (selecter) {
        var element = document.querySelector(selecter);
        if (element) {
            return true;
        }
        return false;
    },
    init: function () {
        BASE_GUI_HOME.sliderBanerHome();
        BASE_GUI_HOME.sliderTopWithdrawl();
        BASE_GUI_HOME.sliderHomeHowListSlider();
        BASE_GUI_HOME.initHomeTimeBox();
    },
    sliderBanerHome() {
        if (!BASE_GUI_HOME.elelemtExist(".slider-home-main-banner")) return;
        const swiperBannerHome = new Swiper(".slider-home-main-banner", {
            slidesPerView: 1,
            loop: false,
            disableOnInteraction: true,
            speed: 800,
            spaceBetween: 0,
            pagination: {
                el: ".pagination-banner-home",
                clickable: true,
            },
        });
    },
    sliderHomeHowListSlider() {
        if (!BASE_GUI_HOME.elelemtExist(".home-how-list-slider")) return;
        const swiperHomeHowListSlider = new Swiper(".home-how-list-slider", {
            slidesPerView: 1,
            loop: true,
            disableOnInteraction: true,
            speed: 100,
            spaceBetween: 0,
            navigation: {
                prevEl: ".how-list .arrow .left",
                nextEl: ".how-list .arrow .right",
            },
        });
        var homeHowListItemInfo = document.querySelectorAll(
            ".home-how .info .item "
        );
        homeHowListItemInfo.forEach((element, index) => {
            element.addEventListener("click", function () {
                homeHowListItemInfo.forEach((elm) => {
                    elm.classList.remove("action");
                });
                this.classList.add("action");
                swiperHomeHowListSlider.slideTo(index + 1);
            });
        });
        swiperHomeHowListSlider.on(
            "slideChange",
            function (swiperHomeHowListSlider) {
                const currentSlide =
                    swiperHomeHowListSlider.slides[
                        swiperHomeHowListSlider.activeIndex
                    ];
                if (currentSlide) {
                    homeHowListItemInfo.forEach((element) => {
                        element.classList.remove("action");
                    });
                    if (
                        homeHowListItemInfo[
                            parseInt(currentSlide.dataset.index)
                        ]
                    ) {
                        homeHowListItemInfo[
                            parseInt(currentSlide.dataset.index)
                        ].classList.add("action");
                    }
                }
            }
        );
    },
    sliderTopWithdrawl() {
        if (!BASE_GUI_HOME.elelemtExist(".slider-home-top-with-drawl")) return;
        const swiperBannerHome = new Swiper(".slider-home-top-with-drawl", {
            direction: "vertical",
            slidesPerView: 4,
            slidesPerGroup: 4,
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
            },
            allowTouchMove: false,
            noSwiping: true,
        });
    },
    initHomeTimeBox: function () {
        var homeTimeBox = document.querySelector("#home-time-box");
        if (!homeTimeBox) return;
        var starDate = new Date(homeTimeBox.getAttribute("start"));

        var dayTop = homeTimeBox.querySelector(".day .top");
        var dayBottomCard = homeTimeBox.querySelector(".day .bottom-card");
        var dayNumber = homeTimeBox.querySelector(".day .number");

        var hourTop = homeTimeBox.querySelector(".hour .top");
        var hourBottomCard = homeTimeBox.querySelector(".hour .bottom-card");
        var hourNumber = homeTimeBox.querySelector(".hour .number");

        var minuteTop = homeTimeBox.querySelector(".minute .top");
        var minuteBottomCard = homeTimeBox.querySelector(
            ".minute .bottom-card"
        );
        var minuteNumber = homeTimeBox.querySelector(".minute .number");

        var secondTop = homeTimeBox.querySelector(".second .top");
        var secondBottomCard = homeTimeBox.querySelector(
            ".second .bottom-card"
        );
        var secondNumber = homeTimeBox.querySelector(".second .number");

        var now = new Date();
        var diffSseconds = parseInt(
            (now.getTime() - starDate.getTime()) / 1000
        );
        var baseDay = parseInt(diffSseconds / 86400);
        var baseHour = parseInt((diffSseconds - baseDay * 86400) / 3600);
        var baseMinute = parseInt(
            (diffSseconds - baseDay * 86400 - baseHour * 3600) / 60
        );
        var baseSecond =
            (diffSseconds -
                baseDay * 86400 -
                baseHour * 3600 -
                baseMinute * 60) %
            60;
        dayTop.innerHTML = baseDay;
        hourTop.innerHTML = baseHour;
        minuteTop.innerHTML = baseMinute;
        secondTop.innerHTML = baseSecond;
        setInterval(() => {
            diffSseconds = diffSseconds + 1;
            var nowDay = parseInt(diffSseconds / 86400);
            var nowHour = parseInt((diffSseconds - nowDay * 86400) / 3600);
            var nowMinute = parseInt(
                (diffSseconds - nowDay * 86400 - nowHour * 3600) / 60
            );
            var nowSecond =
                (diffSseconds -
                    nowDay * 86400 -
                    nowHour * 3600 -
                    nowMinute * 60) %
                60;
            if (parseInt(dayTop.innerHTML) != nowDay) {
                dayBottomCard.classList.remove("flipX");
                setTimeout(() => {
                    dayTop.innerHTML = nowDay < 10 ? "0" + nowDay : nowDay;
                }, 900);
                setTimeout(() => {
                    dayNumber.innerHTML = nowDay < 10 ? "0" + nowDay : nowDay;
                    dayBottomCard.classList.add("flipX");
                }, 100);
            }
            if (parseInt(hourTop.innerHTML) != nowHour) {
                hourBottomCard.classList.remove("flipX");
                setTimeout(() => {
                    hourTop.innerHTML = nowHour < 10 ? "0" + nowHour : nowHour;
                }, 900);
                setTimeout(() => {
                    hourNumber.innerHTML =
                        nowHour < 10 ? "0" + nowHour : nowSecond;
                    hourBottomCard.classList.add("flipX");
                }, 100);
            }
            if (parseInt(minuteTop.innerHTML) != nowMinute) {
                minuteBottomCard.classList.remove("flipX");
                setTimeout(() => {
                    minuteTop.innerHTML =
                        nowMinute < 10 ? "0" + nowMinute : nowMinute;
                }, 900);
                setTimeout(() => {
                    minuteNumber.innerHTML =
                        nowMinute < 10 ? "0" + nowMinute : nowMinute;
                    minuteBottomCard.classList.add("flipX");
                }, 100);
            }
            if (parseInt(secondTop.innerHTML) != nowSecond) {
                secondBottomCard.classList.remove("flipX");
                setTimeout(() => {
                    secondTop.innerHTML =
                        nowSecond < 10 ? "0" + nowSecond : nowSecond;
                }, 900);
                setTimeout(() => {
                    secondNumber.innerHTML =
                        nowSecond < 10 ? "0" + nowSecond : nowSecond;
                    secondBottomCard.classList.add("flipX");
                }, 100);
            }
        }, 1000);
    },
};
window.addEventListener("DOMContentLoaded", function () {
    BASE_GUI.init();
    BASE_GUI_HOME.init();
});
