@extends('admin.layouts.default')

	@section('content')
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="shield" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										{!! trans('messages.Edit') !!} Assigned
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									{!! Form::model($designation,['method' => 'PATCH','route' => ['designation.update',$designation] ,'class' => 'designation-form']) !!}
						@include('designation._form', ['buttonText' => 'Update Designation'])
					{!! Form::close() !!}
								</div>
						    </div>

						  </div>
	</section>
	@stop
