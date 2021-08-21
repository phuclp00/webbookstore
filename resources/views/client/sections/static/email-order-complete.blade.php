<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Email Template for Order Confirmation Email</title>

    <!-- Start Common CSS -->
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: Helvetica, arial, sans-serif;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        .main-temp table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            font-family: Helvetica, arial, sans-serif;
        }

        .main-temp table td {
            border-collapse: collapse;
        }

    </style>
    <!-- End Common CSS -->
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp"
        style="background-color: #d5d5d5;">
        <tbody>
            <tr>
                <td>
                    <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth"
                        style="background-color: #ffffff;">
                        <tbody>
                            <!-- Start header Section -->
                            <tr>
                                <td style="padding-top: 30px;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #eeeeee; text-align: center;">
                                        <tbody>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <a href="https://htmlcodex.com"><img
                                                            src="{{asset('images/logo/logo.png')}}"
                                                            alt="Booksto Lộc Đỗ " /></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    180 Cao Lỗ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Phường 4, Quận 8, tp. Hồ Chí Minh , 70 000
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                    Phone: 037 440 7507 | Email: locdo255@gmail.com
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                    <strong>Order Number:</strong> {{$order->id}} | <strong>Order
                                                        Date:</strong> {{$order->created_at}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End header Section -->
                            <tr>
                                <td style="padding-top:10px" align="center">
                                    <h2>CẢM ƠN BẠN ĐÃ MUA HÀNG TẠI BOOKSTO.TK</h2>
                                </td>
                            </tr>
                            <!-- Start address Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Địa Chỉ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order->address->address_line_1. "  ". $order->address->address_line_2}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{{($order->address->get_districts?$order->address->get_districts->name:$order->address->district).', '.($order->address->get_wards?$order->address->get_wards->name:$order->address->wards) . " , ".($order->address->get_city?$order->address->get_city->name:$order->address->city)}}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order->address->country." , ".$order->address->zip_code}}
                                                </td>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End address Section -->
                            <!-- Start product Section -->
                            @foreach ( $order->books as $item)
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                        <tbody>
                                            <tr>
                                                <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                    <img style="height: 80px;" src="{{asset($item->img)}}"
                                                        alt="Product Image" />
                                                </td>
                                                <td colspan="2"
                                                    style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    {{$item->book_name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                    Sô Lượng: {{$item->pivot->quantity}}
                                                </td>
                                                <td style="width: 130px;"></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                    Giá: {{$item->price}}
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                    <b style="color: #666666;">Tổng: </b>
                                                    {{number_format($item->pivot->quantity*$item->price,0,".",".")}} đ
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach

                            <!-- End product Section -->

                            <!-- Start calculation Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #bbbbbb; margin-top: -5px;">
                                        <tbody>

                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;">
                                                    Phí Vận Chuyển :
                                                </td>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">
                                                    {{number_format($order->shipping->price,0,".",".")}} đ
                                                </td>
                                            </tr>
                                            @if ($order->voucher_id !=null)
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                    Mã giảm giá :
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                    {{ $order->vouchers->data->get('code')." - ".$order->vouchers->data->get('percent')}}
                                                    %
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                    Tổng tiền:
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
                                                    {{number_format($order->final_price,0,".",".")}} đ
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End calculation Section -->

                            <!-- Start payment method Section -->
                            <tr>
                                <td style="padding: 0 10px;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                    Phương Thức Thanh Toán: {{$order->payment->name}}
                                                </td>
                                            </tr>
                                            @if($order->address->guest->count()>0)
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Email : {{ $order->address->guest[0]->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Tên Tài Khoản: {{$order->address->guest[0]->full_name}}
                                                </td>
                                            </tr>

                                            @else
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Email : {{ $order->address->user->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    Tên Tài Khoản: {{$order->address->user->user_name}}
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2"
                                                    style="width: 100%; text-align: center; font-style: italic; font-size: 13px; font-weight: 600; color: #666666; padding: 15px 0; border-top: 1px solid #eeeeee;">
                                                    <b style="font-size: 14px;">Note:</b>{{$order->note}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @if ($voucher !=null)
                            <tr>
                                <td style="padding-top:10px;text-align:center">
                                    <h4>MÃ GIẢM GIÁ {{$voucher[0]->data->get('percent')}}% TRÊN TỔNG HÓA ĐƠN CHO LẦN MUA
                                        TIẾP THEO</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <h2>{{$voucher[0]->code}}</h2>
                                </td>
                            </tr>
                            @endif

                            <!-- End payment method Section -->
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>