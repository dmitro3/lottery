import Selector from "../../Base/Selector";
import LottoGlobal from "../LottoGlobal";
import LottoSocket from "../LottoSocket";

export default class FormBet {
    private totalMinBet: number = 0;
    private betPerNumber: number = 0;
    private betWin: number = 0;
    constructor(private lottoSocket: LottoSocket) {
        this.initEvents();
        this.initSubmit();
        this.changeHtmlPreview();
    }
    public initEvents() {
        let self = this;
        let input = Selector._('.box_booking input[name="bet"]');
        input.addEventListener("change", function (e: any) {
            let _this = e.target;
            self.validateMoney(_this);
            self.changeHtmlPreview();
        });
    }
    protected initSubmit() {
        let self = this;
        let button = Selector._('#lotto_bet');

        button.addEventListener("click", function (e: any) {
            let _this = e.target;
            if (self.validateBetting()) {
                self.sendPlayRequest();
            }
        });
    }
    private sendPlayRequest() {
        let inputMoney = Selector._('input[name=bet]');
        let money = parseInt(inputMoney.value) || 0;
        let numbers = this.getNumberChoosen();
        let currentGameConfig = LottoGlobal.getCurrentGameConfig();
        let type = currentGameConfig.id;
        this.lottoSocket.sendPlayRequest(type, money, numbers);

    }
    private validateBetting() {
        let currentGameConfig = LottoGlobal.getCurrentGameConfig();
        let inputMoney = Selector._('input[name=bet]');
        if (!inputMoney || !currentGameConfig) return false;
        let money = parseInt(inputMoney.value) || 0;
        let numberLotto = this.getNumberChoosen().length;

        let minChoose = currentGameConfig.choose_min;
        let maxChoose = currentGameConfig.choose_max;

        let d = minChoose == maxChoose ? maxChoose : 1;

        let minMoney = numberLotto * currentGameConfig.min_bet / d;

        if (numberLotto < minChoose || numberLotto > maxChoose) {
            if (minChoose == maxChoose) {
                alert(`Bạn cần chọn ${minChoose} số!`)
            }
            else {
                alert(`Bạn cần chọn tối thiểu ${minChoose} số và tối đa ${maxChoose} số!`)
            }
            return false;
        }
        if (money < minMoney) {
            alert(`Số tiền tối thiểu là ${minMoney}k!`);
            return false;
        }
        return true;
    }
    private validateMoney(input: any) {
        let value = input.value;
        value = Math.abs(value);
        if (value > 999999999999) {
            value = 999999999999;
        }
        if (value < 1) {
            value = 1;
        }
        input.value = value;
    }
    public changeHtmlPreview() {
        this.changeHtmlMinBet();
        this.changeHtmlBetPerNumber();
        this.changeHtmlWinBet();
    }
    protected changeHtmlMinBet() {
        let text = `-`;

        let currentConfig = LottoGlobal.getCurrentGameConfig();
        if (currentConfig) {
            let minBet = parseInt(currentConfig.min_bet);
            let chooseMin = parseInt(currentConfig.choose_min);
            if (!this.hasChoosen()) {
                this.totalMinBet = minBet;
            } else {
                let numbers = this.getNumberChoosen();
                let numChoosen = numbers.length / chooseMin;
                numChoosen = numChoosen < 1 ? 1 : numChoosen;
                this.totalMinBet = minBet * numChoosen;
            }
            text = String(this.totalMinBet);
        }

        Selector._(".plot_total .min span").innerText = text;
    }
    protected changeHtmlBetPerNumber() {
        let text = ``;
        if (!this.hasChoosen()) {
            text = "-";
        } else {
            let total = this.getTotalMoney();
            this.betPerNumber = total / this.totalMinBet;
            this.betPerNumber = Math.round(this.betPerNumber * 100) / 100;

            text = String(this.betPerNumber);
        }
        Selector._(".plot_total .money span").innerText = text;
    }
    protected changeHtmlWinBet() {
        let text = ``;
        if (!this.hasChoosen()) {
            text = "-";
        } else {
            let currentConfig = LottoGlobal.getCurrentGameConfig();
            if (currentConfig) {
                let win = parseInt(currentConfig.win);
                this.betWin = this.betPerNumber * win;
                this.betWin = Math.round(this.betWin * 100) / 100
                text = String(this.betWin);
            }
        }
        Selector._(".plot_total .money_win span").innerText = text;
    }
    protected hasChoosen() {
        let items = Selector.all(".ls_lotto span.lotto");
        return items.length > 0;
    }
    protected getNumberChoosen() {
        let items = Selector.all(".ls_lotto span.lotto");
        let numbers = [];
        for (let i = 0; i < items.length; i++) {
            const element = items[i];
            numbers.push(element.innerText);
        }
        return numbers;
    }
    protected getTotalMoney() {
        let input = Selector._('.box_booking input[name="bet"]');
        let value = 1;
        if (input) {
            value = parseInt(input.value);
        }
        return value;
    }
    public updateBoxTitle() {
        LottoGlobal.updateListLotto();
        LottoGlobal.changeGameTitle();
    }
}
