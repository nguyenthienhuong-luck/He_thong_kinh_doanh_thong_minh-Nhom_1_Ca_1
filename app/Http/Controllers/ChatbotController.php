<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\ChatBotLog;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatbotController extends Controller
{
  protected $openAIService;

  public function __construct(OpenAIService $openAIService)
  {
    $this->openAIService = $openAIService;
  }
  public function createTransaction(Request $request)
  {
    $userId = Auth::user()->user_id;
    $userCurrency = Auth::user()->currency;
    $message = $request->input('message');
    $response = null; // Initialize response variable

    DB::beginTransaction(); // Start transaction at beginning
    // Log user message
    ChatBotLog::create([
      'user_id' => $userId,
      'message' => $message,
      'is_bot' => false,
      'created_at' => now()
    ]);

    try {

      $response = $this->openAIService->processMessage($message);
      if (str_contains($response, 'Transaction generated:')) {
        $transactionData = $this->parseTransactionResponse($response);

        if (!$transactionData['category_id']) {
          throw new \Exception("Category không hợp lệ hoặc không tồn tại");
        }

        $category = Category::find($transactionData['category_id']);
        if (!$category) {
          throw new \Exception("Không tìm thấy danh mục");
        }

        $amount = $transactionData['amount'];
        if ($category->group_type_id == 1 || $category->group_type_id == 3) {
          $amount = -abs($amount);
        }

        $amountInUSD = $amount / $this->getExchangeRate($userCurrency, 'USD');
        $date = Carbon::createFromFormat('Y-m-d', $transactionData['date']);

        $transaction = Transaction::create([
          'category_id' => $transactionData['category_id'],
          'wallet_id' => $transactionData['wallet_id'],
          'amount' => $amountInUSD,
          'date' => $date,
          'note' => $transactionData['note'],
        ]);

        // Update wallet balance
        $wallet = Wallet::find($transactionData['wallet_id']);
        if (!$wallet) {
          throw new \Exception("Không tìm thấy ví");
        }
        $wallet->balance += $amountInUSD;
        $wallet->save();

        // Log bot response
        ChatBotLog::create([
          'user_id' => $userId,
          'message' => $response,
          'is_bot' => true,
          'created_at' => now()
        ]);

        DB::commit();

        return response()->json([
          'message' => $response,
          'data' => [
            'id' => $transaction->id,
            'amount' => $amountInUSD,
            'date' => $transaction->date->format('Y-m-d')
          ]
        ]);
      } else {
        // Just log chat response
        ChatBotLog::create([
          'user_id' => $userId,
          'message' => $response,
          'is_bot' => true,
          'created_at' => now()
        ]);

        DB::commit();

        return response()->json([
          'message' => $response
        ]);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error("Error in createTransaction: " . $e->getMessage());
      return response()->json([
        'error' => "Không thể xử lý: " . $e->getMessage()
      ], 400);
    }
  }
  private function parseTransactionResponse($response)
  {
    Log::info("OpenAI Response Raw: " . $response);

    $parsed = [];

    // Updated regex patterns to match new format
    preg_match('/Date: (\d{4}-\d{2}-\d{2})/', $response, $date);
    preg_match('/Description: (.+)/', $response, $description);
    preg_match('/Category: (.+)/', $response, $category);
    preg_match('/Amount: ([\d,\.]+) VND/', $response, $amount);

    // Parse date
    $parsed['date'] = $date[1] ?? now()->format('Y-m-d');

    // Parse description as note
    $parsed['note'] = $description[1] ?? null;

    // Parse category
    $categoryName = trim($category[1] ?? '');
    $parsed['category_id'] = $this->getCategoryId($categoryName);

    // Parse amount
    if (isset($amount[1])) {
      $parsed['amount'] = str_replace(',', '', $amount[1]);
    } else {
      throw new \Exception("Số tiền không hợp lệ hoặc không tồn tại");
    }

    // Set wallet ID
    $parsed['wallet_id'] = $this->getDefaultWalletId();

    return $parsed;
  }
  private function getDefaultWalletId()
  {
    // Fetch the wallet ID with the minimum ID for the authenticated user
    $userId = Auth::user()->id;
    return DB::table('wallets')
      ->where('user_id', $userId)
      ->orderBy('wallet_id', 'asc')
      ->value('wallet_id');
  }
  private function getCategoryId($categoryName)
  {
    $categoryId = DB::table('categories')->where('name', $categoryName)->value('category_id');

    if (!$categoryId) {
      Log::warning("Category không tồn tại trong cơ sở dữ liệu: " . $categoryName);
    }

    return $categoryId;
  }
  protected function getExchangeRate($fromCurrency, $toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];

    if ($fromCurrency === $toCurrency) {
      return 1;
    }

    return $exchangeRates[$fromCurrency] / $exchangeRates[$toCurrency];
  }
  public function getChatHistory()
  {
    Carbon::setLocale('vi'); // Set Vietnamese locale
    $userId = Auth::user()->user_id;

    $chatLogs = ChatBotLog::where('user_id', $userId)
      ->orderBy('created_at', 'asc')
      ->get()
      ->map(function ($log) {
        $createdAt = Carbon::parse($log->created_at);
        return [
          'message' => $log->message,
          'is_bot' => $log->is_bot,
          'time' => $createdAt->format('H:i'),
          'date' => $createdAt->translatedFormat('l, d/m/Y'), // Thứ Hai, 01/01/2024
          'timestamp' => $createdAt->timestamp
        ];
      });

    return response()->json($chatLogs);
  }
}
