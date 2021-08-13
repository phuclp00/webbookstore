@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Order Summary</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- order complete Page Start -->
<section class="order-complete inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order-complete-message text-center">
                    <h1>Cảm Ơn Bạn Đã Mua Hàng !</h1>
                    <p>Đơn hàng của bạn đã được đặt thành công và đang chờ xác nhận.</p>
                </div>
                <ul class="order-details-list">
                    <li>Mã Đơn Hàng: <strong>{{$order->id}}</strong></li>
                    <li>Ngày đặt hàng: <strong>{{$order->created_at}}</strong></li>
                    <li>Tổng tiền: <strong>{{number_format($order->final_price,0,".",".")}} đ</strong></li>
                    <li>Phương Thức Thanh Toán: <strong>{{$order->payment->name}}</strong></li>
                    <li>Địa chỉ đặt hàng
                        :<b>{{$order->address->address_line_1." ".$order->address->address_line_2 . " - Xã/phường: ".
                        ($order->address->get_wards!=null?$order->address->get_wards->name:$order->address->wards)." - Quận/huyện: ".
                         ($order->address->get_districts!=null?$order->address->get_districts->name:$order->address->district)." - Tỉnh/thành: ".
                        ($order->address->get_city!=null?$order->address->get_city->name:$order->address->city)}}
                        </b>
                    </li>
                    <li>Số điện thoại : <b>{{$phone}}</b></li>
                </ul>
                <h3 class="order-table-title">Chi Tiết Đơn Hàng</h3>
                <div class="table-responsive">
                    <table class="table order-details-table">
                        <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Số Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->books as $item )
                            <tr>
                                <td>
                                    <a href="single-product.html">{{$item->book_name}}</a>
                                    <strong>× {{$item->pivot->quantity}}</strong>
                                </td>
                                <td><span>{{number_format($item->price,0,".",".")}} đ</span></td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{-- <tr>
                                <th>Tạm tính :</th>
                                <td><span>{{number_format($total,0,".",".")}} đ</span>
                            </td>
                            </tr> --}}
                            <tr>
                                <th>Hình Thức Vận Chuyển: {{$order->shipping->method}}</th>
                                <td>{{number_format($order->shipping->price,0,".",".")}} đ</td>
                            </tr>
                            @if ($order->voucher_id !=null)
                            <tr>
                                <th>Mã giảm giá: {{$order->vouchers->code}}
                                </th>
                                <td> -
                                    {{ number_format($order->final_price* ($order->vouchers->data->get("percent")/100),0,".",".")}}
                                    đ</td>
                            </tr>
                            @endif

                            <tr>
                                <th>Tổng:</th>
                                <td><span>{{number_format($order->final_price,0,".",".")}} đ</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- order complete Page End -->
@endsection