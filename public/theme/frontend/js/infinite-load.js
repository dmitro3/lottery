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
        _defineProperty(this, "initFunc", void 0);
        _defineProperty(this, "loadSuccessFunc", void 0);
        this.element = element;
        this.initFunc = this.element.dataset.init;
        this.loadSuccessFunc = this.element.dataset.success;
        console.log(this);
        if (this.initFunc && this.initFunc != "") {
            this.callFunction(this.initFunc);
        }
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
                if (this.loadSuccessFunc && this.loadSuccessFunc != "") {
                    this.callFunction(this.loadSuccessFunc);
                }
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
