<!DOCTYPE html>
<html>
	<head>
	<title>{!! config('config.application_title') ? : config('constants.ITEM_NAME') !!}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
    	<link rel="shortcut icon" href="{!! URL::to('assets/img/favicon.ico') !!}">
	<!-- BOOTSTRAP -->
	{!! HTML::style('assets/css/bootstrap.min.css') !!}
	
	{!! HTML::style('assets/third/select2/css/select2.css') !!}
	{!! HTML::style('assets/css/style.css') !!}
	{!! HTML::style('assets/css/style-responsive.css') !!}
	{!! HTML::style('assets/css/animate.css') !!}
	{!! HTML::style('assets/third/pnotify/pnotify.custom.min.css') !!}
	{!! HTML::style('assets/third/font-awesome/css/font-awesome.min.css') !!}
	{!! HTML::style('assets/third/icheck/skins/flat/blue.css') !!}
	{!! HTML::style('assets/css/custom.css') !!}
    <style type="text/css">
		#dashbord_back{
				background: #fff url('public/assets/images/') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
			}
	</style>
	<style type="text/css">
	.full-content-center{
	    margin-top:20%;
	    max-width: 400px;
	}
	.box-info h2{
	    font-size:30px!important;
	    color:#F2784B;
	}
	.login-wrap .box-info{
	   background-color:Gray;
    filter:alpha(opacity=70);
  color:black;
  opacity: 0.85;
  filter: alpha(opacity=60);
  background: #22313F;
	}
	.login-wrap .box-info .login-input{
	    color:white;
        opacity: 1;
	}
	.login-wrap .box-info input{
	    
  font-weight: bold;
  color: #000000;
	}
		.footer {
		  position: absolute;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  padding: 1rem;
		  text-align: center;
		  color:white;
		}
    .login-wrap .form-group input{
        font-weight: bold;
  color: #000000;
    }

			#background {
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    background: url(polina.jpg) no-repeat;
    background-size: cover;
}
.container h1 {
    color: white;
}
	</style>
	<!-- BODY -->
	<body class="tooltips full-content" id="dashbord_back">
	<video autoplay loop muted poster="screenshot.jpg" id="background">
<source src="/My Video-1.mp4" type="video/mp4">
	
</video>
	<!-- BEGIN PAGE -->
	<div class="container">

		@yield('content')

		<div class="footer">
				<p class="pull-right">{!! config('config.credit') !!}</p>
				</div>
	</div><!-- End div .container -->
	<!-- END PAGE -->

	<!--
	================================================
	JAVASCRIPT
	================================================
	-->
	<!-- Basic Javascripts (Jquery and bootstrap) -->
	{!! HTML::script('assets/js/jquery-1.11.3.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!} 
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/third/pnotify/pnotify.custom.min.js') !!}

	@include('notification')
	
	<!-- VENDOR -->

	<!-- Slimscroll js -->
	{!! HTML::script('assets/third/slimscroll/jquery.slimscroll.min.js') !!}

	<!-- Bootstrao selectpicker js -->
	{!! HTML::script('assets/third/select/bootstrap-select.min.js') !!}
	
	<!-- Summernote js -->
	{!! HTML::script('assets/third/summernote/summernote.js') !!}
	
	<!-- Bootstrap file input js -->
	{!! HTML::script('assets/third/input/bootstrap.file-input.js') !!}
	
	<!-- Bootstrao datepicker js -->
	{!! HTML::script('assets/third/datepicker/js/bootstrap-datepicker.js') !!}

	
	<!-- Icheck js -->
	{!! HTML::script('assets/third/icheck/icheck.min.js') !!}
	
	<!-- Form validation js -->
	{!! HTML::script('assets/js/validation-form.js') !!}
	{!! HTML::script('assets/js/wmlab.js') !!}
	
    <script>
	$(document).ready(function() { 
		Validate.init(); 
	});
	</script>

	</body>
</html>