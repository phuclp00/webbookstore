@extends('master')
@section('content')

@include('public.slide.slide_header')


<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-12">
				<div class="my__account__wrapper">
					<h3 class="account__title">Login</h3>
					<form action="{{route('login_signin')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="account__form">
							<div class="input__box">
								<label>Username or email address <span>*</span></label>
								<input type="text" name="username">
							</div>
							<div class="input__box">
								<label>Password<span>*</span></label>
								<input type="password" name="password"autocomplete="on">
							</div>
							<div class="form__btn">
								<button>Login</button>
								<input type="hidden" name="Submit" value="Login">
								<label class="label-for-checkbox">
									<input id="rememberme" class="input-checkbox" name="rememberme" value="forever"
										type="checkbox">
									<span>Remember me</span>
								</label>
							</div>
							<a class="forget_pass" href="#">Lost your password?</a>
						</div>
					</form>
					@if(session()->has('login_status'))
						{!!session()->get('login_status')!!}
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-12">
				<div class="my__account__wrapper">
					<h3 class="account__title">Register</h3>
					<form action="{{route('login_signup')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="account__form">
							<div class="input__box">
								<label>User Name <span>*</span></label>
								<input type="text" name="username_register" value="{{old('username_register')}}">
							</div>
							<div class="input__box">
								<label>Email address <span>*</span></label>
								<input type="email" name="email_register" value="{{old('email_register')}}">
							</div>
							<div class="input__box">
								<label>Password<span>*</span></label>
								<input type="password" name="password_register" value="{{old('password_register')}}" autocomplete="on">
							</div>						
							<div class="form__btn">
								<button type="submit">Register</button>
								<input type="hidden" name="Submit" value="Register">
							</div>
						</div>
					</form>
					@if(session()->has('logout_status'))
						{!!session()->get('logout_status')!!}
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End My Account Area -->



@endsection