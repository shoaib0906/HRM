@extends('admin.layouts.default')

	@section('content')
	@section('header_styles')
	  <!--Dropdown-->
        <link type="text/css" href="{{ asset('public/josh/assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/selectize/css/selectize.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/iCheck/css/line/line.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/vendors/switchery/css/switchery.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/josh/assets/css/pages/formelements.css') }}" rel="stylesheet" />
        <!--End of Dropdown-->
    @stop
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										{!! trans('messages.Add New') !!} Employee
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<form method="POST" action="{{url('/auth/register')}}" accept-charset="UTF-8" class="form-horizontal employee-form">

    				  	{!! csrf_field() !!}

						  <div class="form-group">

						    {!! Form::label('first_name',trans('messages.First Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','first_name','',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.Last Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','last_name','',['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}

							</div>

						  </div>

						  
                          
                          <div class="form-group">

						    {!! Form::label('alias_id',trans('messages.Alias'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('alias_id', [null=>'Please Select'] + $alias_list,isset($employee->alias_id) ? $employee->alias_id : '',['class'=>'form-control select2','id'=>'select22','placeholder'=>'Select Alias'])!!}

							</div>

						  </div>	
                          <div class="form-group">

						    {!! Form::label('location_id',trans('messages.Location'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('location_id', [null=>'Please Select'] + $locations,isset($employee->location_id) ? $employee->location_id : '',['class'=>'form-control select2','id'=>'select23','placeholder'=>'Select Location'])!!}

							</div>

						  </div>	

						  <div class="form-group">

						    {!! Form::label('designation_id',trans('messages.Designation'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('designation_id', [''=>''] + $designations,'',['class'=>'form-control input-xlarge select2','id'=>'select24','placeholder'=>'Select Designation'])!!}

							</div>

						  </div>	

						  <div class="form-group">

						    {!! Form::label('role_id',trans('messages.Role'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('role_id', [''=>''] + $roles,'',['class'=>'form-control select2','id'=>'select25','placeholder'=>'Select Role'])!!}

							</div>

						  </div>	

						  <div class="form-group">

						    {!! Form::label('username',trans('messages.Username'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','username','',['class'=>'form-control','placeholder'=>'Enter Username'])!!}

								<div class="help-box">It should be unique to every user.</div>

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('email',trans('messages.Email'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','email','',['class'=>'form-control','placeholder'=>'Enter Email'])!!}

								<div class="help-box">It should be unique to every user.</div>

							</div>

						  </div>
                          
                          <div class="form-group">

						    {!! Form::label('payment_mode',trans('messages.Payment Mode'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('payment_mode', [''=>'Select','Cash'=>'Cash', 'Bank'=>'Bank', 'Check'=>'Check','Partial'=>'Partial'],'',['class'=>'form-control input-xlarge select2','id'=>'select26','placeholder'=>'Select Payment Mode'])!!}

							</div>

						  </div>
                          
                          <div class="form-group">

						    {!! Form::label('emptype',trans('messages.Employment Type'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('emptype', [1=>'Limited',0=>'Unlimited'],0,['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select type'])!!}

							</div>

						  </div>
                          <div class="form-group{{ (Input::old('emptype')!=0)? '' : ' hide' }}" id="divemptype">

						    {!! Form::label('emp_type',trans('messages.No.of Months'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','emp_type','',['class'=>'form-control','placeholder'=>'Enter no.of months'])!!}

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('password',trans('messages.Password'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('password','password','',['class'=>'form-control','placeholder'=>'Enter Password'])!!}

								<div class="help-box">Minimum 4 characters.</div>

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('password_confirmation',trans('messages.Confirm Password'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('password','password_confirmation','',['class'=>'form-control','placeholder'=>'Enter Confirm Password'])!!}

							</div>

						  </div>

						  <div class="col-sm-offset-2 col-sm-10">

						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

						  </div>

					{!! Form::close() !!}
								</div>
						    </div>

						  </div>
	</section>
	@stop
@section('footer_scripts')
	 <!--Drop DOwn -->
        <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/select2/js/select2.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/sifter/sifter.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/microplugin/microplugin.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/selectize/js/selectize.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/switchery/js/switchery.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/card/lib/js/jquery.card.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/js/pages/custom_elements.js') }}"></script>
    <!--End of Drop DOwn -->

	@stop

