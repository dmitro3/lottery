<?php

namespace realtimemodule\pushserver\Factories;

use Exception;
use realtimemodule\pushserver\Connecters\Games\GoWinGame;
use realtimemodule\pushserver\Connecters\Games\Lotto\LottoConnector;
use realtimemodule\pushserver\Connecters\Games\Lotto\LottoMbConnector;
use realtimemodule\pushserver\Connecters\Games\PlinkoConnector;
use realtimemodule\pushserver\PushServerProvider;

class ConnecterFactory
{
	public static function getConnection($type)
	{
		if ($type == PushServerProvider::TYPE_GAME_WIN) {
			return new GoWinGame;
		}
		if ($type == PushServerProvider::TYPE_GAME_PLINKO) {
			return new PlinkoConnector;
		}
		if ($type == PushServerProvider::TYPE_GAME_LOTTO) {
			return new LottoConnector;
		}
		if ($type == PushServerProvider::TYPE_GAME_LOTTO_MB) {
			return new LottoMbConnector;
		}
		throw new Exception("Method not exists!");
	}
}
