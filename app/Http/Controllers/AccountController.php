<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AccountUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use PayOS\PayOS;

class AccountController extends Controller
{
  private $payOS;
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
  public function index()
  {
    return view('account.index');
  }
  public function edit()
  {
    $user = User::find(Auth::user()->user_id);
    return view('account.edit', compact('user'));
  }
  public function update(AccountUpdateRequest $request, string $id)
  {
    try {
      $user = User::find($id);

      // Validate the request
      $validatedData = $request->validate([
        'birthday' => 'required|date',
        'gender' => 'required|in:0,1',
        'identify_card' => 'nullable|string',
        'isStudent' => 'nullable|file|mimes:jpeg,png,jpg|max:2048'
      ]);

      // Prepare data for update
      $data = [
        'birthday' => $request->birthday,
        'gender' => $request->gender,
      ];

      // Handle identify_card update
      if ($request->identify_card !== 'Chưa có thông tin' && !$user->identify_card) {
        $data['identify_card'] = $request->identify_card;
      }

      // Handle student verification if file is uploaded
      if ($request->hasFile('isStudent')) {
        try {
          $file = $request->file('isStudent');

          // Create HTTP client
          $client = new \GuzzleHttp\Client();

          // Prepare multipart form data
          Log::info("Hello - 1");
          $formData = [
            [
              'name' => 'image',
              'contents' => fopen($file->getPathname(), 'r'),
              'filename' => $file->getClientOriginalName()
            ],
            [
              'name' => 'name',
              'contents' => $user->name
            ]
          ];

          Log::info("Hello - 2");
          // Send request to Python API
          $response = $client->post('http://localhost:5000/verify-student', [
            'multipart' => $formData,
            'timeout' => 30, // Add timeout of 30 seconds
          ]);

          Log::info("Hello - 3");
          // Parse JSON response
          $result = json_decode($response->getBody(), true);

          if (!$result || !isset($result['success'])) {
            throw new Exception("Invalid API response");
          }
          Log::info("Hello - 4");

          if (!$result['success']) {
            throw new Exception($result['message']);
          }

          Log::info("Hello - 5");
          // Update isStudent status based on verification result
          $data['isStudent'] = $result['is_valid'] ? 1 : 0;
          Log::info("Hello - 5");

          // If verification failed, throw an exception with the message
          if (!$result['is_valid']) {
            throw new Exception($result['message']);
          }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
          Log::error("API request error: " . $e->getMessage());
          throw new Exception("Lỗi kết nối đến server xác thực");
        } catch (Exception $e) {
          Log::error("Student verification error: " . $e->getMessage());
          throw new Exception("Lỗi xác thực sinh viên: " . $e->getMessage());
        }
      }

      // Perform the update
      $user->update($data);

      return redirect()->back()
        ->with('type', 'success')
        ->with('message', 'Cập nhật thông tin người dùng thành công.');
    } catch (Exception $e) {
      Log::error("Error in AccountController@update: " . $e->getMessage());
      return redirect()->back()
        ->with('type', 'danger')
        ->with('message', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
  }
  public function createPaymentLink(Request $request)
  {
    try {
      $user = Auth::user();
      $YOUR_DOMAIN = $request->getSchemeAndHttpHost();

      $amount = $user->isStudent == 1 ? 48000 : 60000;

      $data = [
        "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
        "amount" => $amount,
        "description" => "Nâng cấp tài khoản",
        "returnUrl" => $YOUR_DOMAIN . "/accounts/handlePaymentSuccess",
        "cancelUrl" => $YOUR_DOMAIN . "/account"
      ];

      $response = $this->payOS->createPaymentLink($data);
      Log::info("Response from PayOS: " . json_encode($response));
      return response()->json([
        'success' => true,
        'checkoutUrl' => $response['checkoutUrl']
      ]);
    } catch (\Throwable $th) {
      return PayosController::handleException($th);
    }
  }
  public function handlePaymentSuccess(Request $request)
  {
    try {
      $isPaid = $request->get('status');
      $user = User::find(Auth::user()->user_id);
      if ($isPaid) {
        $user->isPremium = true;
        $user->save();
      }

      return redirect()->route('accounts.index')
        ->with('type', 'success')
        ->with('message', 'Nâng cấp tài khoản thành công');
    } catch (Exception $e) {
      Log::error("Loi tu verify: " . $e->getMessage());
      return redirect()->route('accounts.index')
        ->with('type', 'danger')
        ->with('message', 'Có lỗi xảy ra, vui lòng thử lại sau');
    }
  }
}
