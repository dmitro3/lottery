<?php
namespace realtimemodule\pushserver\Contracts;
interface ConnecterInterface {
	public function setData($connection,$clients,$connectionList,$messageInfo,$from);
	public function response();
}