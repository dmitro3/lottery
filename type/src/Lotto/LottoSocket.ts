import BaseGameSocket from "../Base/BaseGameSocket";
import BaseGui from "../Base/BaseGui";
import Selector from "../Base/Selector";
import Socket from "../Base/Socket";
import LottoGlobal from "./LottoGlobal";

export default class LottoSocket extends BaseGameSocket {
    public onOpenSocketCallback: { (e: any): void };
    public onInitGameCallback: { (e: any): void };

    public constructor(
        psocket: Socket
    ) {
        super(psocket);
    }
    public onOpenSocket(e: any) {
        super.onOpenSocket(e);

        this.initGame();
        if (this.onOpenSocketCallback) {
            this.onOpenSocketCallback(e);
        }
    }
    public initGame() {
        let data: any = {};
        data.type = connectionGameType;
        data.action = LOTTO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO;
        this.sendData(JSON.stringify(data));
    }
    public retrieveResult() {
        let data: any = {};
        data.type = connectionGameType;
        data.currentGame = LottoGlobal.currentGameInfo;
        data.action = LOTTO_STATUS.GAME_ACTION_RETRIEVE_RESULT;
        this.sendData(JSON.stringify(data));
    }
    public sendPlayRequest(type: any, money: number, numbers: any) {
        let data: any = {};
        data.type = connectionGameType;
        data.action = LOTTO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = LottoGlobal.currentGameInfo;
        var gameData = {
            type,
            money,
            numbers,
        };
        data.gameData = gameData;
        this.sendData(JSON.stringify(data));
    }

    public betSuccess(data: any) {
        BaseGui.createFlashNotify("Bet thành công.");
        window.location.href = window.location.href;
    }
    public processMessageData(data: any) {
        switch (data.action) {
            case LOTTO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                let dataAttachment = data.data;
                LottoGlobal.currentGameInfo.current_game_idx =
                    dataAttachment.current_game_idx ?? "";
                if (this.onInitGameCallback) {
                    this.onInitGameCallback(dataAttachment);
                }
                break;
            case LOTTO_STATUS.GAME_ACTION_DO_BET:
                this.betSuccess(data.data);
                break;
            case LOTTO_STATUS.GAME_ACTION_RETRIEVE_RESULT:
                break;
            default:
                break;
        }
    }

}