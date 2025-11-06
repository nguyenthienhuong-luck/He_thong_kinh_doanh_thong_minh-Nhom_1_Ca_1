<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $report;

    /**
     * Khởi tạo Mail — nhận user và dữ liệu báo cáo
     */
    public function __construct($user, array $report)
    {
        $this->user = $user;
        $this->report = $report;
    }

    /**
     * Xây dựng email
     */
    public function build()
    {
        return $this->subject('📊 Báo cáo thu/chi ngày ' . ($this->report['date'] ?? now()->toDateString()))
                    ->markdown('emails.daily_report')
                    ->with([
                        'user'   => $this->user,
                        'report' => $this->report,
                    ]);
    }
}
