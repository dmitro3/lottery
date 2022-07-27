import BaseGui from "./BaseGui";
import Selector from "./Selector";

export default class Socket {
    private connecter: any = null;
    private wsReady: boolean = false;
    private openListeners: any = [];
    private messageListeners: any = [];
    private closeListeners: any = [];
    private errorListeners: any = [];
    public constructor(private socketUrl: string = 'ws://localhost:8888/') {
    }
    public addOpenListener(callback: any) {
        if (callback) {
            this.openListeners.push(callback);
        }
    }
    public addMessageListener(callback: any) {
        if (callback) {
            this.messageListeners.push(callback);
        }
    }
    public addCloseListener(callback: any) {
        if (callback) {
            this.closeListeners.push(callback);
        }
    }
    public addErrorListener(callback: any) {
        if (callback) {
            this.errorListeners.push(callback);
        }
    }
    public sendData(data: any, showLoading: boolean = true) {
        if (showLoading) {
            BaseGui.showLoading();
        }
        if (this.wsReady) {
            this.connecter.send(data);
        } else {
            BaseGui.createFlashNotify("Không thể kết nối tới server", false);
        }
    }
    public init() {
        var userTokenIp = Selector._("input[name=auth_token]");
        if (!userTokenIp) return;
        var userToken = userTokenIp.value;
        var url = this.socketUrl + `?auth_token=${userToken}`;
        this.connecter = new WebSocket(url);
        let self = this;
        this.connecter.onopen = function (e: any) {
            self.wsReady = true;
            for (let listener of self.openListeners) {
                listener(e);
            }
        };
        this.connecter.onmessage = function (e: any) {
            for (let listener of self.messageListeners) {
                let data = {};
                if (e.data) {
                    data = JSON.parse(e.data);
                }

                listener(e, data);
            }
        };
        this.connecter.onclose = function (e: any) {
            self.wsReady = false;
            for (let listener of self.closeListeners) {
                listener(e);
            }
        };
        this.connecter.onerror = function (e: any) {
            self.wsReady = false;
            for (let listener of self.errorListeners) {
                listener(e);
            }
        };
    }
}