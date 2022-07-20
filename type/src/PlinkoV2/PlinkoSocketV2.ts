import BaseGameSocket from "../Base/BaseGameSocket";
import BaseGui from "../Base/BaseGui";
import Selector from "../Base/Selector";
import Socket from "../Base/Socket";
import PlinkoSocket from "../Plinko/PlinkoSocket";
import PlinkoGlobal from "./PlinkoGlobal";
import PlinkoStorage from "./PlinkoStorage";

export default class PlinkoSocketV2 extends PlinkoSocket {


    public retrieveResult() {
        return;
    }
    public sendPlayRequest(showLoading: boolean = true) {
        PlinkoStorage.setGameStateBet(1);
        let data: any = {};
        data.type = connectionGameType;
        data.action = PLINKO_STATUS.GAME_ACTION_DO_BET;
        data.currentGame = PlinkoGlobal.currentGameInfo;
        var gameData = {
            type: Selector._("[name=risk]:checked").value,
            mode: Selector._("[name=mode]:checked").value,
            qty: Selector._("[name=qty]").value,
        };
        data.gameData = gameData;
        this.sendData(JSON.stringify(data), showLoading);
    }

    public betSuccess(data: any) {
        BaseGui.createFlashNotify("Bet thành công.");
    }
    public processMessageData(data: any) {
        switch (data.action) {
            case PLINKO_STATUS.GAME_ACTION_GET_CURRENT_GAME_INFO:
                let dataAttachment = data.data;
                PlinkoGlobal.currentGameInfo.current_game_idx =
                    dataAttachment.current_game_idx ?? "";
                if (this.onInitGameCallback) {
                    this.onInitGameCallback(dataAttachment);
                }
                break;
            case PLINKO_STATUS.GAME_ACTION_DO_BET:
                this.betSuccess(data.data);
                break;
            default:
                break;
        }
    }
    public async renderBall(data: any) {
        let games = data.games;
        if (!games) return;
        for (let index = 0; index < games.length; index++) {
            const item = games[index];
            ShortPlinko.createDisc(item.path, item.type);
            await this.sleep(400);
        }
    }
    public sleep(ms: number) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }
}