var USER_INFO = (function () {
    var initModulePaginateAjax = function () {
        if ($(".module-paginate-ajax").length > 0) {
            $(".module-paginate-ajax").each(function (index, el) {
                var _this = $(this);
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
    var initChangeStatusWithdawlRequest = function () {
        $(document).on(
            "change",
            ".item-withdrawal-request-status",
            function (event) {
                event.preventDefault();
                var _this = $(this);
                var contentBox = _this.closest(".module-paginate-ajax");
                contentBox.addClass("in-loading-item");
                $.ajax({
                    url: _this.data("action"),
                    method: "post",
                    data: {
                        item: _this.data("item"),
                        status: _this.val(),
                    },
                    dataType: "json",
                }).done(function (data) {
                    if (data.code == 200) {
                        loadMoneyInpage();
                        $.simplyToast(data.message, "success");
                        var resultBox = _this.closest(".module-paginate-ajax");
                        $.ajax({
                            url: resultBox.data("currenturl"),
                            type: "GET",
                            dataType: "html",
                        }).done(function (data) {
                            resultBox.html(data);
                            contentBox.removeClass("in-loading-item");
                        });
                    } else {
                        $.simplyToast(data.message, "danger");
                        contentBox.removeClass("in-loading-item");
                    }
                });
            }
        );
    };
    var initChangeStatusRechargeRequest = function () {
        $(document).on(
            "change",
            ".item-recharge-request-status",
            function (event) {
                event.preventDefault();
                var _this = $(this);
                var contentBox = _this.closest(".module-paginate-ajax");
                contentBox.addClass("in-loading-item");
                $.ajax({
                    url: _this.data("action"),
                    method: "post",
                    data: {
                        item: _this.data("item"),
                        status: _this.val(),
                    },
                    dataType: "json",
                }).done(function (data) {
                    if (data.code == 200) {
                        loadMoneyInpage();
                        $.simplyToast(data.message, "success");
                        var resultBox = _this.closest(".module-paginate-ajax");
                        $.ajax({
                            url: resultBox.data("currenturl"),
                            type: "GET",
                            dataType: "html",
                        }).done(function (data) {
                            resultBox.html(data);
                            contentBox.removeClass("in-loading-item");
                        });
                    } else {
                        $.simplyToast(data.message, "danger");
                        contentBox.removeClass("in-loading-item");
                    }
                });
            }
        );
    };
    var initFormUserInfo = function () {
        $(document).on("submit", ".form-user-info", function (event) {
            event.preventDefault();
            var _this = $(this);
            _this.addClass("in-loading-item");
            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                dataType: "json",
                data: $(this).serialize(),
            }).done(function (data) {
                if (data.code == 200) {
                    $.simplyToast(data.message, "success");
                    var isReload = _this.attr("reload");
                    if (typeof isReload !== "undefined" && isReload !== false) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        _this.removeClass("in-loading-item");
                        loadMoneyInpage();
                    }
                } else {
                    _this.removeClass("in-loading-item");
                    $.simplyToast(data.message, "danger");
                }
            });
        });
    };
    var initChangeStatusUserBtn = function () {
        $(document).on("click", ".btn-lock-account-user", function (event) {
            event.preventDefault();
            var confirm = window.confirm($(this).data("text"));
            if (!confirm) {
                return;
            }
            var _this = $(this);
            _this.addClass("in-loading-item");
            $.ajax({
                url: $(this).data("action"),
                type: "post",
                dataType: "json",
            }).done(function (data) {
                if (data.code == 200) {
                    $.simplyToast(data.message, "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    _this.removeClass("in-loading-item");
                    $.simplyToast(data.message, "danger");
                }
            });
        });
    };
    var loadMoneyInpage = function () {
        $.ajax({
            url: "esystem/user-manage/load-user-statical-money",
            type: "post",
            dataType: "json",
            data: {
                user: $("#current_user").val(),
            },
        }).done(function (data) {
            if (data.user_amount && $("#user_amount").length > 0) {
                $("#user_amount").html(data.user_amount);
            }
            if (data.total_collect && $("#total_collect").length > 0) {
                $("#total_collect").html(data.total_collect);
            }
            if (data.total_spend && $("#total_spend").length > 0) {
                $("#total_spend").html(data.total_spend);
            }
            if (data.profit_final && $("#profit_final").length > 0) {
                $("#profit_final").html(data.profit_final);
            }
        });
    };
    return {
        _: function () {
            initModulePaginateAjax();
            initChangeStatusWithdawlRequest();
            initChangeStatusRechargeRequest();
            initFormUserInfo();
            initChangeStatusUserBtn();
            loadMoneyInpage();
        },
    };
})();
$(document).ready(function () {
    USER_INFO._();
});
