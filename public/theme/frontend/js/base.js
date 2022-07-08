BASE_GUI = {
    html: document.querySelector("html"),
    init: function () {
        BASE_GUI.initSiteSize();
        BASE_GUI.initVanNoticeBarContent();
        BASE_GUI.initBaseCheckBox();
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
                }, 1500);
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
};
window.addEventListener("DOMContentLoaded", function () {
    BASE_GUI.init();
});
