@include('layouts.head')





	<!-- BODY -->

	<body class="tooltips k-rtl">

	

	<!-- BEGIN PAGE -->

	<div class="container">

		<!-- Your logo goes here -->

		<div class="logo-brand header sidebar rows">

			<div class="logo">

				<h1><a href="{!! URL::to('/') !!}">
				
				</a></h1>

				

			</div>

		</div><!-- End div .header .sidebar .rows -->



		@include('layouts.sidebar')

		

		<!-- BEGIN CONTENT -->

        <div class="right content-page">



			@include('layouts.header')	

			

			<!-- ============================================================== -->

			<!-- START YOUR CONTENT HERE -->

			<!-- ============================================================== -->

            <div class="body content rows scroll-y" >

				
                <div  style="min-height:92%;">
				@yield('content')
                </div>
			
                	<div class="footer">
		<p class="pull-right">{!! config('config.credit') !!}</p>
		</div>

            </div>
                
			<!-- ============================================================== -->

			<!-- END YOUR CONTENT HERE -->

			<!-- ============================================================== -->
            
        </div>

		<!-- END CONTENT -->
        
		

	</div><!-- End div .container -->


		


	

	@include('layouts.foot')	



		

	

	

	