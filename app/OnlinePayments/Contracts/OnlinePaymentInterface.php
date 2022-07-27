<?php
namespace App\OnlinePayments\Contracts;
interface OnlinePaymentInterface{
    public function createPaymentRequest($data);
}