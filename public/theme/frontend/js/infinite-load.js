function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {
            value: value,
            enumerable: true,
            configurable: true,
            writable: true,
        });
    } else {
        obj[key] = value;
    }
    return obj;
}
class infiniteLoadBox {
    constructor(element) {
        _defineProperty(this, "element", void 0);
        _defineProperty(this, "io", void 0);
        this.element = element;
        this.initLoadAction();
        return this;
    }
    insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(
            newNode,
            referenceNode.nextSibling
        );
    }
    initLoadAction() {
        var _this = this;
        var loadPointElement = document.createElement("div");
        loadPointElement.style.height = "1px";
        this.insertAfter(loadPointElement, this.element);
        this.io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }
                _this.loadItem();
            });
        });
        this.io.observe(loadPointElement);
    }
    loadItem() {
        var _this = this;
        var pagenigationBox = _this.element.querySelector(
            ".pagination-hidden-box"
        );
        if (!pagenigationBox) {
            return;
        }
        var nextPage = pagenigationBox.querySelector("a.next-page");
        if (!nextPage) {
            return;
        }
        this.startLoad();
        pagenigationBox.remove();
        XHR.send({
            url: nextPage.getAttribute("href") + "&type=load_item",
            method: "GET",
        }).then((res) => {
            _this.endLoad();
            if (res.code == 200 && res.html) {
                this.element.insertAdjacentHTML("beforeend", res.html);
            }
        });
    }
    startLoad() {
        var loadingElement = document.createElement("div");
        loadingElement.classList.add("in-loading");
        loadingElement.classList.add("in-loading");
        loadingElement.innerHTML = `
            <div class="loader-dot">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>`;
        this.element.appendChild(loadingElement);
    }
    endLoad() {
        var loaddingIcon = this.element.querySelector(".in-loading");
        if (loaddingIcon) {
            loaddingIcon.remove();
        }
    }
}
window.addEventListener("DOMContentLoaded", function () {
    var listInfiniteLoadBox = document.querySelectorAll(
        ".infinite-load-item-module"
    );
    listInfiniteLoadBox.forEach((element) => {
        var infiniteLoad = new infiniteLoadBox(element);
    });
});
