import Socket from "./Base/Socket";
import FormBet from "./Lotto/Games/FormBet";
import GameChoose from "./Lotto/Games/GameChoose";
import GameSelect from "./Lotto/Games/GameSelect";
import LottoSocket from "./Lotto/LottoSocket";
import TabPanel from "./Lotto/TabPanel";
import LottoMbGameTimer from "./LottoMb/LottoMbGameTimer";
import LottoUiMb from "./LottoMb/LottoUiMb";

let tabPanel = new TabPanel();

const socket: Socket = new Socket(SOCKET_URL);
const lottoSocket = new LottoSocket(socket);
const plinkoGameTimer = new LottoMbGameTimer(lottoSocket);
lottoSocket.onOpenSocketCallback = function () { };
lottoSocket.onInitGameCallback = function (data: any) {
    plinkoGameTimer.initInfo(data);
};
lottoSocket.init();
let formBet = new FormBet(lottoSocket);
let gameChoose = new GameChoose(formBet);
let gameSelect = new GameSelect(formBet);
let lottoUi = new LottoUiMb(formBet, gameChoose, gameSelect);
lottoUi.init();
