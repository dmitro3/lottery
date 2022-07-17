import Selector from "../../Base/Selector";
import LottoGlobal from "../LottoGlobal";

export default class FormBet {
    private totalMinBet: number = 0;
    private betPerNumber: number = 0;
    private betWin: number = 0;
    constructor() {
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
        let button = Selector._(".btn_all.book");
        button.addEventListener("click", function (e: any) {
            let _this = e.target;
            self.validateSubmit();
        });
    }
    validateSubmit() {
        let currentConfig = LottoGlobal.getCurrentGameConfig();
        if (currentConfig) {
            let chooseMin = parseInt(currentConfig.choose_min);
            let num = this.getNumberChoosen().length;
            if (num < chooseMin) {
                alert(`Chọn tối thiểu ${chooseMin} số!`);
            }
        }
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
