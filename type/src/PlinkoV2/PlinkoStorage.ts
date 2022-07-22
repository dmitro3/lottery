import PlinkoGlobal from "./PlinkoGlobal";

export default class PlinkoStorage {
    private static KEY_PLINKO_INACTIVE = "plinko_inactive";
    private static KEY_PLINKO_QTY = "plinko_qty";
    private static KEY_PLINKO_MODE = "plinko_mode";
    private static KEY_PLINKO_TYPE = "plinko_type";
    private static KEY_PLINKO_BETTED = "plinko_betted";
    public static isInactive() {
        let state: any = sessionStorage.getItem(PlinkoStorage.KEY_PLINKO_INACTIVE);
        return state != undefined && state == 1;
    }
    public static setInactive(status: any) {
        sessionStorage.setItem(PlinkoStorage.KEY_PLINKO_INACTIVE, status);
    }

    public static getQty() {
        let qty = localStorage.getItem(PlinkoStorage.KEY_PLINKO_QTY);
        return qty == undefined ? 1 : qty;
    }

    public static getMode() {
        let mode = localStorage.getItem(PlinkoStorage.KEY_PLINKO_MODE);
        return mode == undefined ? 'manual' : mode;
    }

    public static getType() {
        let type = localStorage.getItem(PlinkoStorage.KEY_PLINKO_TYPE);
        return type == undefined ? 2 : type;
    }

    public static setConfigGame(qty: any, mode: any, type: any) {
        localStorage.setItem(
            PlinkoStorage.KEY_PLINKO_QTY,
            qty
        );
        localStorage.setItem(
            PlinkoStorage.KEY_PLINKO_TYPE,
            type
        );
        localStorage.setItem(
            PlinkoStorage.KEY_PLINKO_MODE,
            mode
        );
    }
}