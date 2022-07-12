<?php

namespace realtimemodule\pushserver\Enums\Plinko;

use App\Games\Plinko\Enums\BaseEnum;

class Status extends BaseEnum
{
    const END_TIME_CHECK = 5;

    const GAME_CONNECT_STATUS_SUCCESS = 200;
    const GAME_CONNECT_STATUS_NOT_LOGIN = 401;
    const GAME_CONNECT_STATUS_UNKNOWN_ERROR = 603;
    const GAME_CONNECT_STATUS_DATA_NOT_FOUND = 604;
    const GAME_CONNECT_CURRENT_GAME_INVALID = 605;
    const GAME_CONNECT_GAME_DATA_INVALID = 606;
    const GAME_CONNECT_NOT_ENOUGH_MONEY = 607;

    const GAME_ACTION_GET_CURRENT_GAME_INFO = 1;
    const GAME_ACTION_DO_BET = 2;
}
