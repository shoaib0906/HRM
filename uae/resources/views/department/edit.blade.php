@extends('admin.layouts.default')

	@section('content')
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="sitemap" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Department') !!}
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									{!! Form::model($department,['method' => 'PATCH','route' => ['department.update',$department] ,'class' => 'department-form']) !!}
										@include('department._form', ['buttonText' => 'Update Department'])
									{!! Form::close() !!}
								</div>
						    </div>

						  </div>
	</section>
	@stop