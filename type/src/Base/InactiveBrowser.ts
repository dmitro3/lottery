export default class InactiveBrowser {
    private browserPrefixes = ['moz', 'ms', 'o', 'webkit'];
    private isVisible = true;
    private hiddenPropertyName: any;
    private browserPrefix: any;
    private visibilityEventName: any;
    public onEventVisible: { (): void };
    public onEventHidden: { (): void };
    public constructor() {
        this.browserPrefix = this.getBrowserPrefix();
        this.hiddenPropertyName = this.getHiddenPropertyName(this.browserPrefix);
        this.visibilityEventName = this.getVisibilityEvent(this.browserPrefix);
        this.initEvent();
    }

    public getHiddenPropertyName(prefix: any) {
        return (prefix ? prefix + 'Hidden' : 'hidden');
    }

    public getVisibilityEvent(prefix: any) {
        return (prefix ? prefix : '') + 'visibilitychange';
    }

    public getBrowserPrefix() {
        for (var i = 0; i < this.browserPrefixes.length; i++) {
            if (this.getHiddenPropertyName(this.browserPrefixes[i]) in document) {
                return this.browserPrefixes[i];
            }
        }
        return null;
    }

    public onVisible() {
        if (this.isVisible) {
            return;
        }
        this.isVisible = true;

        if (this.onEventVisible) {
            this.onEventVisible();
        }
    }

    public onHidden() {
        if (!this.isVisible) {
            return;
        }
        this.isVisible = false;
        if (this.onEventHidden) {
            this.onEventHidden();
        }
    }

    public handleVisibilityChange(forcedFlag: any) {
        if (typeof forcedFlag === "boolean") {
            if (forcedFlag) {
                return this.onVisible();
            }

            return this.onHidden();
        }
        if ((document as any)[this.hiddenPropertyName]) {
            return this.onHidden();
        }
        return this.onVisible();
    }

    public initEvent() {
        let self = this;
        document.addEventListener(this.visibilityEventName, function () {
            self.handleVisibilityChange('khong can');
        }, false);
        document.addEventListener('focus', function () {
            self.handleVisibilityChange(true);
        }, false);
        document.addEventListener('blur', function () {
            self.handleVisibilityChange(false);
        }, false);
        window.addEventListener('focus', function () {
            self.handleVisibilityChange(true);
        }, false);
        window.addEventListener('blur', function () {
            self.handleVisibilityChange(false);
        }, false);
    }
}





