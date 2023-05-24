<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password - {{getSite('site_name','Myber')}}</title>
	<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
	<link href="{{ asset('packages/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/core.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<style>
		@font-face {
            font-family: poppins;
            src: url({{ asset('packages/poppins/Poppins-Regular.ttf') }});
        }
		*{
			font-family: poppins;
		}
	</style>
</head>

<body class="login-container">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content pb-20">
					<form action="{{ route('post.password.reset') }}" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="{{ asset(getSite('logo','img/logo_light.png',true)) }}" alt="Logo" width="120">
							</div>
							<div class="text-center" style="margin:20px;">
								<h5 class="content-group-lg">Reset Password <small class="display-block">Masukkan Password Baru Anda</small></h5>
							</div>
							@if ($errors->any())
							<div class="alert alert-danger">{{$errors->first()}}</div>
							@endif
							@if(Session::has('status'))
							<div class="alert alert-success">{{Session::get('status')}}</div>
							@endif
							<input type="hidden" name="token" value="{{ $token }}">
							<input type="hidden" name="email" value="{{ $email }}">
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password Baru" name="password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Ulangi Password" name="password_confirmation">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">Reset <i class="icon-reset position-right"></i></button>
							</div>
							<span class="help-block text-right no-margin">
								<a href="{{ route('login') }}">Login</a>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
