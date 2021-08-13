<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Email Template For Laravel Email</title>

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
                        <tbody align="center">
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
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End header Section -->
                            <tr>
                                <td style="padding-top:10px">
                                    <h2>TÀI KHOẢN {{$user->user_name}} CỦA BẠN TẠI BOOKSTO.TK ĐÃ ĐƯỢC KHÔI PHỤC MẬT KHẨU
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: bold; color: #666666; padding-top: 10px;">
                                    Tên Tài Khoản: {{$user->user_name}}
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: bold; color: #666666; padding-top: 10px;">
                                    Mật khẩu: booksto1234
                                </th>
                            </tr>
                            <!-- End payment method Section -->
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>