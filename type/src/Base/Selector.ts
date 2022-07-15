export default class Selector {
    public static all(selector: any) {
        return document.querySelectorAll(selector);
    }
    public static _(selector: any) {
        return document.querySelector(selector);
    }
    public static flex(item: any) {
        item.style.display = "flex";
    }
    public static none(item: any) {
        item.style.display = "none";
    }
    static on(eventName: string, elementSelector: string, callback: any): void {
        document.addEventListener(eventName, function (e: any) {
            for (var target = (e.target); target && target != this; target = target.parentNode as HTMLElement) {
                if (target.matches(elementSelector)) {
                    callback(e);
                    break;
                }
            }
        }, false);
    }
}