
import LottoUi from "../Lotto/LottoUi";
export default class LottoUiMb extends LottoUi {
    protected getUrlHistory(): string {
        return 'get-game-lotto-mb-history';
    }
    protected getUrlLottoChoosen(): string {
        return 'get-game-lotto-mb-choosen';
    }
    protected getUrlGameContent(): string {
        return 'get-game-lotto-mb-content';
    }
}