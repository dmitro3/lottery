import Socket from "./Base/Socket";
import PlinkGameTimer from "./PlinkoV2/PlinkoGameTimer";
import PlinkoSocket from "./PlinkoV2/PlinkoSocketV2";
import PlinkoUi from "./PlinkoV2/PlinkoUi";

const socket: Socket = new Socket('ws://localhost:8888/');
const plinkoSocket = new PlinkoSocket(socket);
const plinkoGameTimer = new PlinkGameTimer(plinkoSocket);
const plinkoUi = new PlinkoUi(plinkoSocket);
plinkoSocket.onOpenSocketCallback = function () {
    plinkoUi.init();
}
plinkoSocket.onInitGameCallback = function (data: any) {
    plinkoGameTimer.initInfo(data);
    plinkoUi.loadPlinkoHistoryGame();
}
plinkoSocket.init();
