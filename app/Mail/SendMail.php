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
        $name = $this->data->firstname . ' ' . $this->data->lastname;
        $date = $this->data->created_at;
        $address = $this->data->address;
        $phone = $this->data->phone;
        $email = $this->data->email;
        $total = 0;
        $id = $this->data->id;
        $order_details = OrderDetail::where('order_id', $id)
            ->join('product', 'product.product_id', '=', 'order_detail.product_id')
            ->select('product.product_name', 'order_detail.quantity', 'order_detail.price')
            ->get();
        foreach ($order_details as $value) {
            $total += $value->quantity * ($value->price - $value->price * $value->sale);
        }
        return $this->from('kaiso1st@gmail.com', 'Perfume')
                    ->subject('Xác nhận đơn hàng')
                    ->view('mail')
                    ->with([
                        'id' => $id,
                        'name' => $name,
                        'date' => $date,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'total' => $total,
                        'order_details' => $order_details,
                    ]);
    }
}
