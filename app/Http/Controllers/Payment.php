<?php

namespace App\Http\Controllers;
use LiqPay;

class Payment extends LiqPay
{
    public static function newInstance() {
        return new self(env("LIQPAY_PUBLIC_KEY"), env("LIQPAY_PRIVAT_KEY"));
    }

}
