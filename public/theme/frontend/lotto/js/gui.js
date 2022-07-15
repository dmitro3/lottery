var TAB_PANEL = (function () {
    const _navTargets = document.querySelectorAll(".navv .nav-item");
    const _tabTargets = document.querySelectorAll(".panel .tab-panel");
    var changeStateTab = function (tab, event) {
        if (event.target.nodeName == "LABEL") {
            var input = tab.querySelector("input");
            input.checked = true;
        }
    };
    var init = function () {
        _navTargets.forEach(function (elm, idx) {
            elm.addEventListener("click", function (event) {
                event.preventDefault();
                let _target = this.dataset.target;
                let _id = this.getAttribute("id");
                if (
                    this.parentElement.querySelectorAll(".nav-item").length == 1
                ) {
                    return;
                }
                let _navs = this.parentElement.querySelectorAll(
                    "*:not(#" + _id + ")"
                );
                let _targetPanel = document.querySelector(_target);
                changeStateTab(elm, event);
                if (_targetPanel != null) {
                    this.dataset.state = "true";
                    _navs.forEach(function (e, i) {
                        e.dataset.state = "hide";
                    });
                    let _panelSiblings =
                        _targetPanel.parentElement.querySelectorAll(
                            ":scope >.panel:not(" + _target + ")"
                        );
                    _panelSiblings.forEach(function (e, i) {
                        e.style.display = "none";
                        e.dataset.state = "hide";
                    });
                    _targetPanel.style.display = "block";
                    _targetPanel.dataset.state = "show";
                } else {
                    console.log("Error Panel Empty !");
                }
            });
        });
        if (_navTargets != null) {
            var eventInit = new Event("click");
            _navTargets[0].dispatchEvent(eventInit);
        }
    };

    return {
        _: function () {
            init();
        },
    };
})();
var QUESTION = (function () {
    var showQuestion = function () {
        var btnQuestion = document.querySelectorAll(
            ".result_plot_threads .question"
        );
        btnQuestion.forEach(function (e, i) {
            e.addEventListener("click", function (event) {
                event.preventDefault();
                var _content = this.parentElement.querySelector(".s-content");
                if (!_content.classList.contains("active")) {
                    _content.classList.add("active");
                } else {
                    _content.classList.remove("active");
                }
            });
        });
    };
    return {
        _: function () {
            showQuestion();
        },
    };
})();

window.addEventListener("DOMContentLoaded", function () {
    TAB_PANEL._();
    QUESTION._();
});
