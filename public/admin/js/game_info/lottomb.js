var GAMEINFO_LOTTOmbMB = (function () {
    var currentGameInfo = {};
    var timeIntevalCurrentGame = null;
    var timeOutInitCurrentGame = null;
    var initGameTime = function (second) {
        var anchorTime = second;
        if (timeIntevalCurrentGame) {
            clearInterval(timeIntevalCurrentGame);
        }
        function gameTimer() {
            minutes = (anchorTime / 60) | 0;
            seconds = anchorTime % 60 | 0;
            minutes = minutes < 10 ? "0" + minutes : String(minutes);
            seconds = seconds < 10 ? "0" + seconds : String(seconds);
            if (anchorTime <= 0) {
                $(".lottomb-current-item-wrapper").addClass("in-loading-item");
                if (timeIntevalCurrentGame) {
                    clearInterval(timeIntevalCurrentGame);
                }
                if (timeOutInitCurrentGame) {
                    clearTimeout(timeOutInitCurrentGame);
                }
                initCurrentGame();
            } else {
                $(".current-game-countdown-timebox").html(`
                    <div class="item">${minutes.substr(0, 1)}</div>
                    <div class="item">${minutes.substr(1, 1)}</div>
                    <div class="item c-row c-row-middle">:</div>
                    <div class="item">${seconds.substr(0, 1)}</div>
                    <div class="item">${seconds.substr(1, 1)}</div>
                `);
            }
            anchorTime--;
        }
        gameTimer();
        timeIntevalCurrentGame = setInterval(() => {
            gameTimer();
        }, 1000);
    };
    var initCurrentGame = function () {
        $.ajax({
            url: "esystem/game-info/lottomb?action=load_current_game",
            method: "get",
            global: false,
            dataType: "json",
        }).done(function (data) {
            if (currentGameInfo.current_game_idx != data.current_game_idx) {
                initGameTime(data.time_remaining);
                initCurrentGameTypeHistory();
            }
            currentGameInfo.current_game_idx = data.current_game_idx;
            currentGameInfo.time_remaining = data.time_remaining;
            $(".lottomb-current-item-result").html(data.html);
            $(".lottomb-current-item-wrapper").removeClass("in-loading-item");
            timeOutInitCurrentGame = setTimeout(() => {
                initCurrentGame();
            }, 2000);
        });
    };
    var initCurrentGameTypeHistory = function () {
        $(".lottomb-history-list-item-result").addClass("in-loading-item");
        $.ajax({
            url: "esystem/game-info/lottomb?action=load_current_game_type_history",
            method: "get",
            global: false,
            dataType: "html",
        }).done(function (data) {
            $(".lottomb-history-list-item-result").html(data);
            $(".lottomb-history-list-item-result").removeClass(
                "in-loading-item"
            );
        });
    };
    var initCurrentGameTypeHistoryPaginate = function () {
        $(document).on(
            "click",
            ".lottomb-history-list-item-result .pagination a",
            function (e) {
                e.preventDefault();
                $(".lottomb-history-list-item-result").addClass(
                    "in-loading-item"
                );
                $.ajax({
                    url: $(this).attr("href"),
                    method: "get",
                    global: false,
                    dataType: "html",
                }).done(function (data) {
                    $(".lottomb-history-list-item-result").html(data);
                    $(".lottomb-history-list-item-result").removeClass(
                        "in-loading-item"
                    );
                });
            }
        );
    };
    var initShowHistoryContent = function () {
        $(document).on(
            "click",
            ".lottomb-history-list-item .btn-show-hidden-content",
            function () {
                $(".lottomb-item-history-hidden-content").slideUp(300);
                $(this).toggleClass("active");
                if ($(this).hasClass("active")) {
                    $(this)
                        .closest(".item")
                        .find(".lottomb-item-history-hidden-content")
                        .slideDown(300);
                }
            }
        );
    };
    return {
        currentGameInfo: currentGameInfo,
        _: function () {
            initShowHistoryContent();
            initCurrentGame();
            initCurrentGameTypeHistoryPaginate();
        },
    };
})();
$(document).ready(function () {
    GAMEINFO_LOTTOmbMB._();
});
