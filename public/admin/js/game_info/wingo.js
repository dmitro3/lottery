var GAMEINFO_WINGO = (function () {
    var currentGameInfo = {};
    var timeIntevalCurrentGame = null;
    var timeOutInitCurrentGame = null;
    var handleChangeGameType = function () {
        $("input[name=game_win_type_id]").change(function () {
            initCurrentGameTypeHistory($(this).val());
            if (timeOutInitCurrentGame) {
                clearTimeout(timeOutInitCurrentGame);
            }
            initCurrentGame();
        });
    };
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
                $(".wingo-current-item-wrapper").addClass("in-loadding");
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
        var gameType = $("input[name=game_win_type_id]:checked").val();
        $.ajax({
            url: "esystem/game-info/wingo?action=load_current_game",
            method: "get",
            global: false,
            data: {
                game_type: gameType,
            },
            dataType: "json",
        }).done(function (data) {
            if (currentGameInfo.current_game_idx != data.current_game_idx) {
                initGameTime(data.time_remaining);
                initCurrentGameTypeHistory(gameType);
            }
            currentGameInfo.current_game_idx = data.current_game_idx;
            currentGameInfo.time_remaining = data.time_remaining;
            $(".wingo-current-item-result").html(data.html);
            $(".wingo-current-item-wrapper").removeClass("in-loadding");
            timeOutInitCurrentGame = setTimeout(() => {
                initCurrentGame();
            }, 2000);
        });
    };
    var initCurrentGameTypeHistory = function (gameType) {
        $.ajax({
            url: "esystem/game-info/wingo?action=load_current_game_type_history",
            method: "get",
            global: false,
            data: {
                game_type: gameType,
            },
            dataType: "html",
        }).done(function (data) {
            $(".wingo-history-list-item-result").html(data);
        });
    };
    var initCurrentGameTypeHistoryPaginate = function () {
        $(document).on(
            "click",
            ".wingo-history-list-item-result .pagination a",
            function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("href"),
                    method: "get",
                    global: false,
                    dataType: "html",
                }).done(function (data) {
                    $(".wingo-history-list-item-result").html(data);
                });
            }
        );
    };
    var initShowHistoryContent = function () {
        $(document).on(
            "click",
            ".wingo-history-list-item .btn-show-hidden-content",
            function () {
                $(".wingo-item-history-hidden-content").slideUp(300);
                $(this).toggleClass("active");
                if ($(this).hasClass("active")) {
                    $(this)
                        .closest(".item")
                        .find(".wingo-item-history-hidden-content")
                        .slideDown(300);
                }
            }
        );
    };
    return {
        currentGameInfo: currentGameInfo,
        _: function () {
            initShowHistoryContent();
            handleChangeGameType();
            initCurrentGame();
            initCurrentGameTypeHistoryPaginate();
        },
    };
})();
$(document).ready(function () {
    GAMEINFO_WINGO._();
});
