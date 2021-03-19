@extends('master')
@section('content')
@include('public.slide.slide_header')
<!-- cart-main-area start -->
<?php $content = Cart::content() ?>
<div class="cart-main-area section-padding--lg bg--white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 ol-lg-12">

                <div class="table-content wnro__table table-responsive">
                    <table>
                        <thead>
                            <tr class="title-top">
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove Item </th>
                                <th class="product-remove">Update Quantity</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($content as $item)

                            <tr>

                                <td class="product-thumbnail"><a href="#"><img
                                            src="{{asset('images/product/sm-3/'.$item->options->image)}}"
                                            alt="product img"></a></td>
                                <td class="product-name"><a href="#">{{$item->name}}</a></td>
                                <td class="product-price"><span
                                        class="amount">{{number_format(($item->price),2) ." $"}}</span></td>
                                <form action="{{route('update_cart')}}" method="GET"> {{csrf_field()}}
                                    <td class="product-quantity"><input id="{{$item->rowId}}" name="cart_quantity"
                                            type="number" value="{{$item->qty}}"></td>
                                    <td class="product-subtotal">
                                        {{number_format(($item->price * $item->qty),2) ." $"}}</td>
                                    <input type="hidden" name="cart_rowId" value="{{$item->rowId}}">

                                    <td class="product-remove"><input type="submit" name="remove_cart" value="Remove"
                                            style="padding: 0px;border:1px solid black"></td>
                                    <td class="product-remove"><input type="submit" name="update_cart" value="Update"
                                            style="padding: 0px;border:1px solid black"></td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                </form>
                <div class="cartbox__btn">
                    <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                        <li><a href="#">Coupon Code</a></li>
                        <li><a href="#">Apply Code</a></li>
                        <li><a href="#">Update Cart</a></button></li>
                        <li><a href="{{route('checkout_view')}}">Check Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="cartbox__total__area">
                    <div class="cartbox-total d-flex justify-content-between">
                        <ul class="cart__total__list">
                            <li>Cart total</li>
                            <li>Sub Total</li>
                        </ul>
                        <ul class="cart__total__tk">
                            <li>{{Cart::subtotal()."$"}}</li>
                            <li>{{Cart::subtotal()."$"}}</li>
                        </ul>
                    </div>
                    <div class="cart__total__amount">
                        <span>Grand Total</span>
                        <span>{{Cart::subtotal()."$"}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

@endsection