<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderDetail;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $text= "Bạn thân mến \n
        Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. \n
        Thông tin đơn hàng của bạn là: \n
        Mã đơn hàng: ".$this->data->id." \n
        Tên khách hàng: ".$this->data->firstname. " ". $this->data->lastname ." \n
        Số điện thoại: ".$this->data->phone." \n
        Địa chỉ: ".$this->data->address." \n
        Email: ".$this->data->email." \n
        ";
        return $this->from('kaiso1st@gmail.com', 'Perfume')
                    ->subject('Xác nhận đơn hàng')
                    ->view('mail')
                    ->with([
                        'text' => $text
                    ]);
    }
}
