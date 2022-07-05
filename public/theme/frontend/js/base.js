BASE_GUI = {
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
};
