var USER_INFO = (function () {
    var initModulePaginateAjax = function () {
        if ($(".module-paginate-ajax").length > 0) {
            $(".module-paginate-ajax").each(function (index, el) {
                var _this = $(this);
                $.ajax({
                    url: _this.data("action"),
                    type: "GET",
                    dataType: "html",
                    data: { info: _this.data("info") },
                }).done(function (data) {
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
                resultBox.data("currenturl", $(this).attr("href"));
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: "html",
                }).done(function (data) {
                    resultBox.html(data);
                    var offsettop =
                        resultBox.offset().top - $("header").innerHeight() - 50;
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
    };
})();
$(document).ready(function () {
    USER_INFO._();
});
