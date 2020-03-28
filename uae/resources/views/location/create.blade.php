@extends('admin.layouts.default')

	@section('content')
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
			                            {!! trans('messages.Add New') !!} {!! trans('messages.Location') !!}
			                        </h3>
			                    </div>
			                    <div class="panel-body">
								{!! Form::open(['route' => 'location.store','role' => 'form', 'class'=>'location-form']) !!}
						@include('location._form')
					{!! Form::close() !!}
								</div>
						    </div>

						  </div>
	</section>
	@stop