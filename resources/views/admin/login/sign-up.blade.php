@extends('admin.login.master')
@section('login')
<!-- Sign up Start -->
<section class="sign-in-page">
    <div class="container p-0">
        <div class="row no-gutters height-self-center">
            <div class="col-sm-12 align-self-center page-content rounded">
                <div class="row m-0">
                    <div class="col-sm-12 sign-in-page-data">
                        <div class="sign-in-from bg-primary rounded">
                            <h3 class="mb-0 text-center text-white">Sign Up</h3>
                            <p class="text-center text-white">Enter your email address and password to access admin
                                panel.</p>
                            @include('post.create')
                            <form action="{{route('admin.register')}}" class="mt-4 form-text" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username"> User Name</label>
                                    <input type="text" name="username" class="form-control mb-0" id="username"
                                        placeholder="Your Full Name" value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <label for="level"> Level </label>
                                    <select  class="form-control mb-0" name="level" id="level">
                                        <option value="admin">Admin</option>
                                        <option value="user">Guest</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control mb-0" id="email"
                                        placeholder="Enter email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control mb-0"
                                        id="password" placeholder="Password" value="{{old('password')}}">
                                </div>
                                <div class="form-group">
                                    <label for="repassword">Password</label>
                                    <input type="password" name="repassword" class="form-control mb-0"
                                        id="repassword" placeholder="Re-Password"
                                        value="{{old('repassword')}}">
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" name="checkTC" id="checkTC" >
                                        <label class="custom-control-label" for="checkTC">I accept <a href="#"
                                                class="text-light">Terms and Conditions</a></label>
                                    </div>
                                </div>
                                <div class="sign-info text-center">
                                    <button type="submit" class="btn btn-white d-block w-100 mb-2">Sign Up</button>
                                    <span class="text-dark d-inline-block line-height-2">Already Done ? <a
                                            href="{{route('admin.dashboard')}}" class="text-white">Go Back </a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign up END -->
@endsection