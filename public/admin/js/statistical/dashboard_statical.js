var DASHBOARD_STATICAL = (function () {
    var initModulePaginateAjax = function () {
        if ($(".module-paginate-ajax:not(.initialized)").length > 0) {
            $(".module-paginate-ajax:not(.initialized)").each(function (
                index,
                el
            ) {
                var _this = $(this);
                _this.addClass("initialized");
                _this.addClass("in-loading-item");
                $.ajax({
                    url: _this.data("action"),
                    type: "GET",
                    dataType: "html",
                    global: false,
                    data: { info: _this.data("info") },
                }).done(function (data) {
                    _this.removeClass("in-loading-item");
                    _this.html(data);
                });
            });
        }
        $(document).on(
            "click",
            ".module-paginate-ajax .pagination a",
            function (event) {
                event.preventDefault();
                var resultBox = $(this).closest(".module-paginate-ajax");
                resultBox.addClass("in-loading-item");
                resultBox.data("currenturl", $(this).attr("href"));
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    global: false,
                    dataType: "html",
                }).done(function (data) {
                    resultBox.html(data);
                    resultBox.removeClass("in-loading-item");
                    var offsettop =
                        resultBox.offset().top -
                        $(".top_menu").innerHeight() -
                        50;
                    $("html,body").animate(
                        {
                            scrollTop: offsettop,
                        },
                        700
                    );
                });
            }
        );
    };
    return {
        _: function () {
            initModulePaginateAjax();
        },
        initModulePaginateAjax() {
            initModulePaginateAjax();
        },
    };
})();
$(document).ready(function () {
    DASHBOARD_STATICAL._();
    $(".module-admin-statical-box").each(function (index, element) {
        new SimpleStaticalBox($(element));
    });
});
