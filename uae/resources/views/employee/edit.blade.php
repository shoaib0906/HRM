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
										{!! trans('messages.Edit') !!} {!! trans('messages.Employee') !!}
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									{!! Form::model($employee,['method' => 'PATCH','route' => ['employee.update',$employee->id] ,'class' => 'employee-form form-horizontal']) !!}

						  <div class="form-group">

						    {!! Form::label('first_name',trans('messages.First Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','first_name',isset($employee->first_name) ? $employee->first_name : '',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}

							</div>

						  </div>

						  <div class="form-group">

						    {!! Form::label('last_name',trans('messages.Last Name'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','last_name',isset($employee->last_name) ? $employee->last_name : '',['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}

							</div>

						  </div>
                          <div class="form-group">

						    {!! Form::label('location_id',trans('messages.Location'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('location_id', [null=>'Please Select'] + $locations,isset($employee->location_id) ? $employee->location_id : '',['class'=>'form-control select2','id'=>'select22','placeholder'=>'Select Location'])!!}

							</div>

						  </div>
                          <div class="form-group">

						    {!! Form::label('alias_id',trans('messages.Alias'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('alias_id', [null=>'Please Select'] + $alias_list,isset($employee->alias_id) ? $employee->alias_id : '',['class'=>'form-control select2','id'=>'select23','placeholder'=>'Select Alias'])!!}

							</div>

						  </div>	

						  <div class="form-group">

						    {!! Form::label('designation_id',trans('messages.Designation'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('designation_id', [null=>'Please Select'] + $designations,isset($employee->designation_id) ? $employee->designation_id : '',['class'=>'form-control select2','id'=>'select24','placeholder'=>'Select Designation'])!!}

							</div>

						  </div>

						  @if(Entrust::can('manage_all_employee'))

						  <div class="form-group">

						    {!! Form::label('role_id',trans('messages.Role'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('role_id', [''=>''] + $roles, isset($role_id) ? $role_id : '',['class'=>'form-control input-xlarge select2','id'=>'select25','placeholder'=>'Select Role'])!!}

							</div>

						  </div>

						  @endif

						  <div class="form-group">

						    {!! Form::label('email',trans('messages.Email'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','email',isset($employee->email) ? $employee->email : '',['class'=>'form-control','placeholder'=>'Enter Email'])!!}

							</div>

						  </div>
                          <div class="form-group">

						    {!! Form::label('payment_mode',trans('messages.Payment Mode'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('payment_mode', [''=>'Select','Cash'=>'Cash', 'Bank'=>'Bank', 'Check'=>'Check','Partial'=>'Partial'],isset($employee->payment_mode) ? $employee->payment_mode : '',['class'=>'form-control select2','id'=>'select26','placeholder'=>'Select Payment Mode'])!!}

							</div>

						  </div>
                          <!--<div class="form-group">

						    {!! Form::label('iban_number',trans('messages.IBAN Number'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','iban_number',isset($employee->iban_number) ? $employee->iban_number : '',['class'=>'form-control','placeholder'=>'Enter IBAN Number'])!!}

							</div>

						  </div>-->
                          <div class="form-group">

						    {!! Form::label('emptype',trans('messages.Employment Type'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

							{!! Form::select('emptype', [1=>'Limited',0=>'Unlimited'],isset($employee->emp_type) ? $employee->emp_type : '',['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select type'])!!}

							</div>

						  </div>
                          <div class="form-group{{ ((isset($employee->emp_type) && $employee->emp_type) || Input::old('emptype')==1)? '' : ' hide' }}" id="divemptype">

						    {!! Form::label('emp_type',trans('messages.No.of Months'),['class' => 'col-sm-2 control-label'])!!}

						    <div class="col-sm-10">

								{!! Form::input('text','emp_type',isset($employee->emp_type) ? $employee->emp_type : '',['class'=>'form-control','placeholder'=>'Enter no.of months'])!!}

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