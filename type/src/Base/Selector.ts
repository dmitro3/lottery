export default class Selector{
    public static _(selector:any){
        return document.querySelector(selector);
    }
    public static flex(item:any){
        item.style.display = "flex";
    }
    public static none(item:any){
        item.style.display = "none";
    }
}