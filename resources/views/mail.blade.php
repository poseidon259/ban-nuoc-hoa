<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
</head>
<body>
Kính gửi: <b>{{ $name }}</b> <br/>
Cửa hàng chúng tôi gửi đến quý khách hàng lá thư này nhằm xác nhận về việc đặt hàng của quý khách hàng vào {{$date}}. <br>
Đính kèm theo thư này là Đơn đặt hàng có chứa các điều khoản đã nêu. Trong trường hợp không nhận được thông báo nào về việc thay đổi hoặc huỷ bỏ đơn hàng trong vòng mười ngày (10) kể từ ngày quý khách hàng nhận được lá thư này, chúng tôi sẽ tiến hành giao hàng mà quý khách hàng đã đặt vào ngày đã nêu.
<br> Nếu có thắc mắc xin vui lòng liên hệ: <b>098.868.8686</b> 
<br> <i>Trân trọng cảm ơn</i> 

<br> Đơn hàng
<br> Họ và tên: <b>{{ $name }}</b>
<br> Địa chỉ: {{ $address }}
<br> Số điện thoại: {{ $phone }}
<br> Email: {{ $email }}
<br> Ngày đặt: {{ $date }}
<br><b>Sản Phẩm</b>
@foreach($order_details as $value)
<br> Tên sản phẩm: <b>{{ $value->product_name }}</b> - Số lượng: <b>{{ $value->quantity }}</b> - Giá: <b>{{ $value->price}}</b>
@endforeach
<br> Tổng tiền: <b>{{ $total }}</b>
</body>
</html>