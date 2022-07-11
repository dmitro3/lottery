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
};
window.addEventListener("DOMContentLoaded", function () {});
