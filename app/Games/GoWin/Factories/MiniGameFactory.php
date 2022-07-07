<?php
namespace App\Games\GoWin\Factories;
use Exception;
use App\Games\GoWin\MiniGames\{
    Color,
    Number,
    Size
};
class MiniGameFactory {
	public static function getMiniGame($type)
	{
		if ($type == 'color') {
			return new Color;
		}
        if ($type == 'number') {
			return new Number;
		}
        if ($type == 'size') {
			return new Size;
		}
		return null;
	}
}