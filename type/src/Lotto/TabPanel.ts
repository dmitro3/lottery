import Selector from "../Base/Selector";

export default class TabPanel {
    constructor(private selector: string = ".nav-item") {
        this.initEvents();
    }

    initEvents() {
        let self = this;
        Selector.on('click', this.selector, function (e: any) {
            let _this = e.target;
            let _targetId = _this.dataset.target;
            let _target = Selector._(_targetId);
            if (!_target) {
                return;
            }
            let parent = _target.parentElement;
            let allPanel = parent.querySelectorAll(':scope > .panel');
            allPanel.forEach(function (panel: any, i: number) {
                panel.style.display = "none";
                panel.dataset.state = "hide";
            });
            _target.style.display = "block";
            _target.dataset.state = "show";
            let allNavs = _this.parentElement.querySelectorAll(':scope > ' + self.selector);
            allNavs.forEach(function (panel: any, i: number) {
                panel.dataset.state = "false";
            });
            _this.dataset.state = "true";

        })

    }

}