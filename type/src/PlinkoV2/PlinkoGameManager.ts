import Socket from "../Base/Socket";
import PlinkGameTimer from "../PlinkoV2/PlinkoGameTimer";
import PlinkoSocket from "../PlinkoV2/PlinkoSocketV2";
import PlinkoUi from "../PlinkoV2/PlinkoUi";

export default class PlinkoGameManager {
    static init() {
        const socket: Socket = new Socket(SOCKET_URL);
        const plinkoSocket = new PlinkoSocket(socket);
        const plinkoUi = new PlinkoUi(plinkoSocket);
        const plinkoGameTimer = new PlinkGameTimer(plinkoSocket, plinkoUi);
        plinkoSocket.onOpenSocketCallback = function () {
            plinkoUi.init();
        }
        plinkoSocket.onInitGameCallback = function (data: any) {
            plinkoGameTimer.initInfo(data);
            plinkoUi.loadPlinkoHistoryGame();
        }
        plinkoSocket.init();
    }
    static switchAudio() {
        if (typeof ShortPlinko != 'undefined') {
            ShortPlinko.sound().playBackgroundSound();
            if (ShortPlinko.sound().isMute()) {
                ShortPlinko.sound().mute();
            }
            else {
                ShortPlinko.sound().unmute();

            }
        }
    }
}