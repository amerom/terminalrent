@extends('auth_base')

@section('content')
<div class="form-box" id="login-box">
	<div class="header">Sign In</div>

	<form role="form" method="POST" action="/auth/login">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="body bg-gray">
			<div class="form-group">
				<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="User ID"/>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password"/>
			</div>
			@if (count($errors) > 0)
				<div class="login alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<input type="checkbox" name="remember"/> Remember me
			</div>
		</div>
		<div class="footer">
			<button type="submit" class="btn bg-olive btn-block">Sign me in</button>

			<p><a href="#">I forgot my password</a></p>
		</div>
	</form>
</div>
@endsection
