import BaseGui from "./BaseGui";
import Socket from "./Socket";

export default abstract class BaseGameSocket {
    public constructor(
        protected psocket: Socket
    ) {
    }

    public init() {
        this.psocket.init();
        this.psocket.addOpenListener((e: any) => {
            this.onOpenSocket(e);
        });
        this.psocket.addCloseListener((e: any) => {
            this.onCloseSocket(e);
        });
        this.psocket.addErrorListener((e: any) => {
            this.onErrorSocket(e);
        });
        this.psocket.addMessageListener((e: any, data: any) => {
            this.onMessageSocket(e, data);
        });
    }
    public onOpenSocket(e: any) {
        BaseGui.hideLoading();
    }
    public onCloseSocket(e: any) {
        BaseGui.showLoading();
        BaseGui.createFlashNotify("Không thể kết nối tới server", false);
    }
    public onErrorSocket(e: any) {
        BaseGui.showLoading();
        BaseGui.createFlashNotify("Không thể kết nối tới server", false);
    }
    public onMessageSocket(e: any, data: any) {
        BaseGui.hideLoading();
        if (data.success && data.action) {
            this.processMessageData(data);
        } else {
            if (data.message) {
                BaseGui.createFlashNotify(data.message);
            } else {
                BaseGui.createFlashNotify("Lỗi không xác đinh!");
            }
        }
    }
    public sendData(data: any) {
        this.psocket.sendData(data);
    }
    public abstract processMessageData(data: any): void;

}