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
        PlinkoGlobal.setTimeBet();
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
        let game = data.games;
        if (game) {
            this.renderBall(game);
        }
        // BaseGui.createFlashNotify("Bet thành công.");
        console.log("bet thanh cong");
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
    public async renderBall(game: any) {
        if (typeof ShortPlinko != 'undefined') {
            ShortPlinko.createDisc(game.path, game.type);
        }
        await this.sleep(500);
    }
    public sleep(ms: number) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }
}
