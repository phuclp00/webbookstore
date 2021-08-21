@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<div class="page-section inner-page-sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="#dashboad" class="active" data-toggle="tab"><i class="fas fa-tachometer-alt"></i>
                                Dashboard</a>
                            <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn Hàng Của
                                Tôi</a>
                            <a href="#download" data-toggle="tab"><i class="fas fa-download"></i> Vouchers Của Tôi</a>
                            <a href="#favorite" data-toggle="tab"><i style="color:red" class="fa fa-heart"></i>Danh
                                sách yêu thích của tôi</a>
                            <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i>
                                Phương Thức Thanh Toán
                            </a>
                            <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                                Địa Chỉ Giao Hàng</a>
                            <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Thông Tin Tài Khoản
                            </a>
                            {{-- <logout><template v-slot:icon> <i class="fas fa-sign-out-alt"></i></template>
                            </logout> --}}
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12 mt--30 mt-lg--0">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <notification-list
                                    :user="{{Auth::user()->load('notifications','membership','points','address.orders')}}">
                                </notification-list>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <my-order :user="{{Auth::user()}}"></my-order>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="favorite" role="tabpanel">
                                <favorite></favorite>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="download" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Vouchers Của Tôi</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Code</th>
                                                    <th>Giảm Giá (%)</th>
                                                    <th>Giá Trị Đơn Hàng Tối Thiểu</th>
                                                    <th>Số Lần Sử Dụng</th>
                                                    <th>Ngày Hết Hạn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1 ?>
                                                @foreach (Auth::user()->vouchers as $value)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$value->code}}</td>
                                                    <td>{{$value->data->get('percent')}}</td>
                                                    <td>{{$value->data->get('minium_total')}}</td>
                                                    <td>{{$value->number_of_uses >0?$value->number_of_uses:"Đã hết lượt sử dụng"}}
                                                    </td>
                                                    <td>{{$value->expires_at < now()?"Đã Hết Hạn":$value->expires_at}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Payment Method</h3>
                                    <p class="saved-message">Hiện tại hệ thống chưa hỗ trợ chức năng này.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                <address-billing
                                    :user="{{Auth::user()->load('address.get_wards','address.get_city','address.get_districts')}}">
                                </address-billing>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                <my-information :user="{{Auth::user()}}"></my-information>
                            </div>
                            <!-- Single Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection