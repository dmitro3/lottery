export default class InteractionListener {
    private lastId: any = Date.now();
    private callbacks: any = {};
    public constructor() {
        this.initEvents();
    }
    public onInteraction = (callback: any) => {
        this.lastId++;
        this.callbacks[++this.lastId] = callback;
        return
    };

    private handleInteraction = () => {
        console.log('Interaction')
        for (let i in this.callbacks) {
            if (typeof this.callbacks[i] === 'function') {
                this.callbacks[i]();
            } else {
                delete this.callbacks[i];
            }
        }
    };
    private initEvents() {
        document.body.addEventListener('keydown', this.handleInteraction);
        document.body.addEventListener('click', this.handleInteraction);
        document.body.addEventListener('touchstart', this.handleInteraction);
    }
}