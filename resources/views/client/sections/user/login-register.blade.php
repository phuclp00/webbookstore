@extends('client.sections.static.index')
@section('main-body')
<!--=============================================
    =            Login Register page content         =
    =============================================-->
<main class="page-section inner-page-sec-padding-bottom">
	<div class="container">
		<div class="row">
			<register-form></register-form>
			<login-form></login-form>
		</div>
	</div>
</main>
@endsection