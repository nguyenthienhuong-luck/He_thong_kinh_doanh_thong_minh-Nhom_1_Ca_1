<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatBotLog;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    // --- Tạo giao dịch từ chatbot ---
    public function createTransaction(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['reply' => '⚠️ Vui lòng đăng nhập để tiếp tục.'], 401);
        }

        $message = trim($request->input('message'));
        $transactionData = $this->parseTransactionMessage($message);

        if (!$transactionData) {
            return response()->json(['reply' => '❗ Vui lòng nhập đầy đủ *danh mục* và *số tiền*. Ví dụ: "ăn sáng 30000"']);
        }

        $wallet = Wallet::where('user_id', $user->id)->first();
        if (!$wallet) {
            return response()->json(['reply' => '⚠️ Bạn chưa có ví nào. Vui lòng tạo ví trước.']);
        }

        $category = Category::where('name', 'LIKE', '%' . $transactionData['category_name'] . '%')->first();
        if (!$category) {
            return response()->json(['reply' => "❌ Danh mục *{$transactionData['category_name']}* chưa tồn tại."]);
        }

        DB::beginTransaction();
        try {
            $amount = (int) $transactionData['amount'];

            // ✅ Không quy đổi tiền nữa — coi như VND
            // Nếu là chi tiêu => trừ, nếu là thu nhập => cộng
            if ($category->type === 'expense') {
                $wallet->balance -= $amount;
            } else {
                $wallet->balance += $amount;
            }

            $wallet->save();

            // Lưu giao dịch
            Transaction::create([
                'category_id' => $category->category_id,
                'wallet_id' => $wallet->wallet_id,
                'amount' => $amount,
                'date' => $transactionData['date'],
                'note' => $transactionData['note'] ?: $message,
            ]);

            DB::commit();

            // Ghi log hội thoại
            ChatBotLog::create(['user_id' => $user->id, 'message' => $message, 'is_bot' => false]);
            ChatBotLog::create([
                'user_id' => $user->id,
                'message' => "✅ Đã thêm giao dịch *{$category->name}* với số tiền " . number_format($amount, 0, ',', '.') . " VND.\n💰 Số dư hiện tại: " . number_format($wallet->balance, 0, ',', '.') . " VND",
                'is_bot' => true
            ]);

            return response()->json([
                'reply' => "✅ Giao dịch *{$category->name}* thành công!\n💵 Số tiền: " . number_format($amount, 0, ',', '.') . " VND\n💰 Số dư ví: " . number_format($wallet->balance, 0, ',', '.') . " VND"
            ]);
} catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Chatbot createTransaction error: ' . $e->getMessage());
            return response()->json(['reply' => '❌ Bot gặp lỗi khi tạo giao dịch.']);
        }
    }

    // --- Lấy lịch sử chat ---
    public function getChatHistory()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([]);
        }

        $logs = ChatBotLog::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get(['message', 'is_bot', 'created_at']);

        return response()->json($logs);
    }

    // --- Phân tích tin nhắn người dùng ---
    private function parseTransactionMessage($message)
    {
        $amount = null;
        $category_name = null;
        $date = now()->format('Y-m-d');
        $note = $message;

        // Xóa dấu ngăn cách tiền tệ
        $cleanedMessage = str_replace(['.', ','], '', $message);

        // Tìm số tiền trong tin nhắn
        if (preg_match('/\d+/', $cleanedMessage, $m)) {
            $amount = (int)$m[0];
            $pos = strpos($cleanedMessage, $m[0]);
        } else {
            return false;
        }

        // Danh mục là phần trước số tiền
        $category_name = trim(substr($message, 0, $pos));

        if (!$amount || !$category_name) {
            return false;
        }

        return compact('amount', 'category_name', 'date', 'note');
    }
}