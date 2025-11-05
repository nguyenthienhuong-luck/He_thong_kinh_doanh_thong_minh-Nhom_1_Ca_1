<?php

namespace App\Helpers;

class Helper
{
  public static function getExchangeRate($toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];
    if ($toCurrency === 'USD') {
      return 1;
    }

    return 1 * $exchangeRates[$toCurrency];
  }
}
