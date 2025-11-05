<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayOS\PayOS;

class PayosController extends Controller
{
  static $payOS;
  public function __construct()
  {
    $this->payOS = new PayOS(
      env("PAYOS_CLIENT_ID"),
      env("PAYOS_API_KEY"),
      env("PAYOS_CHECKSUM_KEY")
    );
  }
  public static function handleException(\Throwable $th)
  {
    return response()->json([
      "error" => $th->getCode(),
      "message" => $th->getMessage(),
      "data" => null
    ]);
  }
}
