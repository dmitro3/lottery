<?php
namespace App\Games\GoWin\Contracts;
interface GoWinMiniGameInterface {
	public function setValue($value);
	public function validateValue();
	public function toDatabase($gameWinType,$currentGame,$user,$qty,$amoutItem);
	public function getValuePreviewName();
	public function isWin($number);
	public function calculationAmountWin($number,$amountBet);
	public function getHistoryHtml($winNumber);
	public function getUserBetHistoryHtml();
}