@extends('admin.layouts.default')
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
            <link href="{{ asset('public/josh/assets/vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/josh/assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/josh/assets/vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/josh/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    @stop
	@section('content')
	<style type="text/css">
	h3,h5{
		color: white;
	}
</style>
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	
			                    <div class="panel-body ">
									<div class="col-sm-12 " align="left"  style="background-color:#336E7B;padding
									:10px;">

						<!-- Begin user profile -->

						<div class="panel-green" >

						  <div class="col-md-2">
							<div class="avatar-wrap pull-left" >

							<!--<img src="{!! App\Classes\Helper::getAvatar($employee->id) !!}" class="img-circle profile-avatar" alt="User avatar" />-->
                            {!! App\Classes\Helper::getAvatar($employee->id) !!}

							</div>
						   </div>
							
							<div class="pull-left " align="left">
							<h3><strong> {!! $employee->first_name !!} {!! $employee->last_name !!}</strong></h3>
							<h5> <span class="icon fa fa-briefcase"></span> {!! $employee->Designation->designation." in ".$employee->Designation->Department->department_name!!} {!! trans('messages.Department') !!}</h5>
							
							<h5><span class="icon  fa fa-map-marker"></span> {!!$profile->present_address!!}<h5>
							<h5> <span class="icon  fa fa-phone"></span> {!! $profile->contact_number !!}</h5>

							{!! ($employee->Profile->date_of_leaving == null) ? '<span class="label label-success">
							'.trans('messages.active').'</span>' : '<span class="label label-danger">'.trans('messages.in-active').'</span>' !!}
							<br>
							</div>
							

						</div><!-- End div .box-info -->

						<!--<div class="box-info">

							<h4>Send SMS</h4>

							{!! Form::model($employee,['files' => true, 'method' => 'PATCH','action' => ['SMSController@sendEmployeeSMS',$employee->id] ,'class' => 'sms-form', 'role' => 'form']) !!}

		    				  	<div class="form-group">

									{!! Form::textarea('sms','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter SMS','onkeyup'=>'countChar(this)','maxlength' => 160])!!}

					  				<div class="help-box" id="charNum"></div>

								</div>

								{!! Form::submit(isset($buttonText) ? $buttonText : 'Send SMS',['class' => 'btn btn-primary']) !!}

							{!! Form::close() !!}

							<script>

						      function countChar(val) {

						        var len = val.value.length;

						          $('#charNum').text(160 - len + ' characters left');

						      };

						    </script>

						</div>-->

						@if(Entrust::can('reset_employee_password') && $employee->id != Auth::user()->id)

						<div class="">

							<h4>Reset Password</h4>

							{!! Form::model($employee,['method' => 'PATCH','route' => ['change_employee_password',$employee->id] ,'class' => 'change_password-form']) !!}

							  <div class="form-group">

								{!! Form::input('password','new_password','',['class'=>'form-control','placeholder'=>'Enter New Password'])!!}

							  </div>

							  <div class="form-group">

								{!! Form::input('password','new_password_confirmation','',['class'=>'form-control','placeholder'=>'Enter New Confirm Password'])!!}

							  </div>

							  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

							{!! Form::close() !!}

						</div>

						@endif

						<!-- Begin user profile -->

					</div><!-- End div .col-sm-4 -->

					

					<div class="col-sm-12">

						<div class="box-info full">

							<!-- Nav tab -->

							<ul class="nav nav-tabs nav-justified">

							  <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-user"></i> {!! trans('messages.Basic') !!}</a></li>

							  <li><a href="#bank-account" data-toggle="tab"><i class="fa fa-laptop"></i> {!! trans('messages.Account') !!}</a></li>

							  <li><a href="#document" data-toggle="tab"><i class="fa fa-file"></i> {!! trans('messages.Documents') !!}</a></li>

							  <li><a href="#salary" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>
                              <li><a href="#asset" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Asset') !!}</a></li>
                              <li><a href="#dependent" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Dependent') !!}</a></li>

							</ul>

							<!-- End nav tab -->



							<!-- Tab panes -->

							<div class="tab-content">

							

								

								<!-- Tab basic -->

								<div class="tab-pane animated fadeInRight active" id="basic">

									<h2>{!! trans('messages.Basic Information') !!}</h2>

									<div class="user-profile-content">

										{!! Form::model($employee,['files' => true, 'method' => 'PATCH','action' => ['EmployeeController@profileUpdate',$employee->id] ,'class' => 'employee-form', 'role' => 'form']) !!}

					    				  	<div class="col-sm-6">

						    				  	

						    				  	<div class="form-group">

												    {!! Form::label('father_name','First Name')!!}

													{!! Form::input('text','father_name',isset($profile->father_name) ? $profile->father_name : '',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}

												</div>

						    				  	<div class="form-group">

												    {!! Form::label('mother_name','Surname')!!}

													{!! Form::input('text','mother_name',isset($profile->mother_name) ? $profile->mother_name : '',['class'=>'form-control','placeholder'=>'Enter Surname'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('date_of_birth',trans('messages.Date of Birth'))!!}

													{!! Form::input('text','date_of_birth',isset($profile->date_of_birth) ? $profile->date_of_birth : '',['class'=>'form-control','id'=>'rangepicker4','placeholder'=>'Enter Date of Birth','readonly' => 'true'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('date_of_joining',trans('messages.Date of Joining'))!!}

													{!! Form::input('date','date_of_joining',isset($profile->date_of_joining) ? $profile->date_of_joining : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date of Joining'])!!}

													<div class="help-block"><span id="reset-date-of-joining" class="btn btn-xs" href='#'>Reset</span></div>

												</div>

												<div class="form-group">

												    {!! Form::label('date_of_leaving',trans('messages.Date of Leaving'))!!}

													{!! Form::input('date','date_of_leaving',isset($profile->date_of_leaving) ? $profile->date_of_leaving : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date of Leaveing'])!!}

													<div class="help-block"><span id="reset-date-of-leaving" class="btn btn-xs" href='#'>Reset</span></div>

												</div>
												<div class="form-group">

												    {!! Form::label('contact_number','Gender')!!}

													
													<select class="form-control input-xlarge select2me" name="gender">
													@if(!empty($profile->gender=='male'))
													<option selected="selected" value="Male">Male</option>
													<option value="Female">Female</option>
													@elseif(!empty($profile->gender=='male'))
													<option selected="selected" value="Female">Female</option>
													<option value="Male">Male</option>
													@else
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													@endif
													</select>
												</div>
						    				  	<div class="form-group">

												    {!! Form::label('contact_number',trans('messages.Contact Number'))!!}

													{!! Form::input('text','contact_number',isset($profile->contact_number) ? $profile->contact_number : '',['class'=>'form-control','placeholder'=>'Enter Contact Number'])!!}

												</div>
												<div class="form-group">

												    {!! Form::label('contact_number','Skype ID')!!}

													{!! Form::input('text','skypeid',isset($profile->skypeid) ? $profile->skypeid : '',['class'=>'form-control','placeholder'=>'Enter skype id'])!!}

												</div>
												
												<div class="form-group">

												    {!! Form::label('alternate_email',trans('messages.Alternate Email'))!!}

													{!! Form::input('text','alternate_email',isset($profile->alternate_email) ? $profile->alternate_email : '',['class'=>'form-control','placeholder'=>'Enter Alternate Email'])!!}

												</div>
												<div class="box-info">
												<h2>{!! 'Address' !!}</h2>
												<div class="form-group">

												    {!! Form::label('present_address','Address',[])!!}

												    {!! Form::textarea('present_address',isset($profile->present_address) ? $profile->present_address : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Present Address'])!!}

												</div>

												
												<div class="form-group">

												    {!! Form::label('alternate_email','Town/City')!!}

													{!! Form::input('text','town',isset($profile->town) ? $profile->town : '',['class'=>'form-control','placeholder'=>'Enter Town/City'])!!}

												</div>
												<div class="form-group">

												    {!! Form::label('alternate_email','County')!!}

												
														<select class="form-control input-xlarge select2" id="select21" name="country">
													@if(!empty($profile->country=='Antrim'))
													<option selected="selected" value="Antrim">Antrim</option>
														
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Armagh'))
													<option selected="selected" value="Armagh">Armagh</option>
														<option value="Antrim">Antrim</option>
														
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Carlow'))
													<option selected="selected" value="Carlow">Carlow</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Cavan'))
													<option selected="selected" value="Cavan">Cavan</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
													
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Clare'))
													<option selected="selected" value="Clare">Clare</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Cork'))
													<option selected="selected" value="Cork">Cork</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Derry'))
													<option selected="selected" value="Derry">Derry</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Donegal'))
													<option selected="selected" value="Donegal">Donegal</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Down'))
													<option selected="selected" value="Down">Down</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Dublin'))
													<option selected="selected" value="Dublin">Dublin</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Fermanagh'))
													<option selected="selected" value="Fermanagh">Fermanagh</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Galway'))
													<option selected="selected" value="Galway">Galway</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Kerry'))
													<option selected="selected" value="Kerry">Kerry</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Kildare'))
													<option selected="selected" value="Kildare">Kildare</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Kilkenny'))
													<option selected="selected" value="Kilkenny">Kilkenny</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Laois'))
													<option selected="selected" value="Laois">Laois</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Leitrim'))
													<option selected="selected" value="Leitrim">Leitrim</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Limerick'))
													<option selected="selected" value="Limerick">Limerick</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Louth'))
													<option selected="selected" value="Louth">Louth</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Mayo'))
													<option selected="selected" value="Mayo">Mayo</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Meath'))
													<option selected="selected" value="Meath">Meath</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Monaghan'))
													<option selected="selected" value="Monaghan">Monaghan</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Offaly'))
													<option selected="selected" value="Offaly">Offaly</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Roscommon'))
													<option selected="selected" value="Roscommon">Roscommon</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Sligo'))
													<option selected="selected" value="Sligo">Sligo</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Tipperary'))
													<option selected="selected" value="Tipperary">Tipperary</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Tyrone'))
													<option selected="selected" value="Tyrone">Tyrone</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Waterford'))
													<option selected="selected" value="Waterford">Waterford</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Westmeath'))
													<option selected="selected" value="Westmeath">Westmeath</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Wexford'))
													<option selected="selected" value="Wexford">Wexford</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wicklow">Wicklow</option>
													@elseif(!empty($profile->country=='Wicklow'))
													<option selected="selected" value="Wicklow">Wicklow</option>
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
													@else
														<option value="Antrim">Antrim</option>
														<option value="Armagh">Armagh</option>
														<option value="Carlow">Carlow</option>
														<option value="Cavan">Cavan</option>
														<option value="Clare">Clare</option>
														<option value="Cork">Cork</option>
														<option value="Derry">Derry</option>
														<option value="Donegal">Donegal</option>
														<option value="Down">Down</option>
														<option value="Dublin">Dublin</option>
														<option value="Fermanagh">Fermanagh</option>
														<option value="Galway">Galway</option>
														<option value="Kerry">Kerry</option>
														<option value="Kildare">Kildare</option>
														
														<option value="Kilkenny">Kilkenny</option>
														<option value="Laois">Laois</option>
														<option value="Leitrim">Leitrim</option>
														<option value="Limerick">Limerick</option>
														<option value="Longford">Longford</option>
														<option value="Louth">Louth</option>
														<option value="Mayo">Mayo</option>
														<option value="Meath">Meath</option>
														<option value="Monaghan">Monaghan</option>
														<option value="Offaly">Offaly</option>
														<option value="Roscommon">Roscommon</option>
														<option value="Sligo">Sligo</option>
														<option value="Tipperary">Tipperary</option>
														<option value="Tyrone">Tyrone</option>
														<option value="Waterford">Waterford</option>
														<option value="Westmeath">Westmeath</option>
														<option value="Wexford">Wexford</option>
														<option value="Wicklow">Wicklow</option>
													@endif
													</select>


												</div>
												<div class="form-group">

												    {!! Form::label('alternate_email','Eircode')!!}

													{!! Form::input('text','eircode',isset($profile->eircode) ? $profile->eircode : '',['class'=>'form-control','placeholder'=>'Enter Eircode'])!!}

												</div>
												</div>
											</div>

											<div class="col-sm-6">

						    				  
												<div class="box-info">
													<h2>{!! 'Emergency Contact' !!}</h2>
												<div class="form-group">

												    {!! Form::label('alternate_contact_number','Next of Kin')!!}

													{!! Form::input('text','next_kin',isset($profile->next_kin) ? $profile->next_kin : '',['class'=>'form-control','placeholder'=>'Enter Next of Kin'])!!}

												</div>
												<div class="form-group">

												    {!! Form::label('alternate_contact_number','Emergency Contact Number')!!}

													{!! Form::input('text','alternate_contact_number',isset($profile->alternate_contact_number) ? $profile->alternate_contact_number : '',['class'=>'form-control','placeholder'=>'Enter Alternate Contact Number'])!!}

												</div>
												<div class="form-group">

												    {!! Form::label('alternate_contact_number','Relationship')!!}

													{!! Form::input('text','relationship',isset($profile->relationship) ? $profile->relationship : '',['class'=>'form-control','placeholder'=>'Enter Relationship with next of kin'])!!}

												</div>
												</div>
												<div class="form-group">

												    {!! Form::label('facebook_link',trans('messages.Facebook Profile'))!!}

													{!! Form::input('text','facebook_link',isset($profile->facebook_link) ? $profile->facebook_link : '',['class'=>'form-control','placeholder'=>'Enter Facebook Profile'])!!}

												</div>

						    				  	<div class="form-group">

												    {!! Form::label('twitter_link',trans('messages.Twitter Profile'))!!}

													{!! Form::input('text','twitter_link',isset($profile->twitter_link) ? $profile->twitter_link : '',['class'=>'form-control','placeholder'=>'Enter Twitter Profile'])!!}

												</div>

						    				  	<div class="form-group">

												    {!! Form::label('blogger_link',trans('messages.Blogger Profile'))!!}

													{!! Form::input('text','blogger_link',isset($profile->blogger_link) ? $profile->blogger_link : '',['class'=>'form-control','placeholder'=>'Enter Blogger Profile'])!!}

												</div>

						    				  	<div class="form-group">

												    {!! Form::label('linkedin_link',trans('messages.LinkedIn Profile'))!!}

													{!! Form::input('text','linkedin_link',isset($profile->linkedin_link) ? $profile->linkedin_link : '',['class'=>'form-control','placeholder'=>'Enter LinkedIn Profile'])!!}

												</div>

						    				  	<div class="form-group">

												    {!! Form::label('googleplus_link',trans('messages.Google Plus Profile'))!!}

													{!! Form::input('text','googleplus_link',isset($profile->googleplus_link) ? $profile->googleplus_link : '',['class'=>'form-control','placeholder'=>'Enter Google Plus Profile'])!!}

												</div>
													<div class="form-group">

													<input type="file" name="photo" id="photo" class="btn btn-default" title="Select Profile Photo">

													@if($profile->photo != null)

														<div class="checkbox">

															<label>

															  {!! Form::checkbox('remove_photo', 1) !!} {!! trans('messages.Remove Photo') !!}

															</label>

														</div>

													@endif

												</div>
											{{ App\Classes\Helper::getCustomFields('employee-form',$custom_field_values) }}

											{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

											</div>

										{!! Form::close() !!}

									</div>

								</div>

								<!-- End Tab basic -->

								<!-- Tab bank-account -->

								<div class="tab-pane animated fadeInRight" id="bank-account">

									<h2>{!! trans('messages.Add Bank Account') !!}</h2>

									<div class="user-profile-content">

										{!! Form::open(['route' => 'bank_account.store','role' => 'form', 'class'=>'bank-account-form']) !!}

					    				  	<div class="col-sm-6">

						    				  	<div class="form-group">

												    {!! Form::label('bank_name',trans('messages.Bank Name'))!!}

													{!! Form::input('text','bank_name','',['class'=>'form-control','placeholder'=>'Enter Bank Name'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('account_name',trans('messages.Account Name'))!!}

													{!! Form::input('text','account_name','',['class'=>'form-control','placeholder'=>'Enter Account Name'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('account_number',trans('messages.Account Number'))!!}

													{!! Form::input('text','account_number','',['class'=>'form-control','placeholder'=>'Enter Account Number'])!!}

												</div>

											</div>

											<div class="col-sm-6">

												<div class="form-group">

												    {!! Form::label('ifsc_code',trans('messages.IFSC Code'))!!}

													{!! Form::input('text','ifsc_code','',['class'=>'form-control','placeholder'=>'Enter IFSC Code'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('bank_branch',trans('messages.Branch Name'))!!}

													{!! Form::input('text','bank_branch','',['class'=>'form-control','placeholder'=>'Enter Branch Name'])!!}

												</div>

												{!! Form::hidden('user_id',$employee->id)!!}

												{!! Form::submit(trans('messages.Add'),['class' => 'btn btn-primary']) !!}

											</div>

										{!! Form::close() !!}



										<div class="clear"></div>

										<h2>{!! trans('messages.List All Bank Accounts') !!}</h2>

										<div class="table-responsive">

											<table class="table table-hover table-striped">

												<thead>

													<tr>

														<th>{!! trans('messages.Bank Name') !!}</th>

														<th>{!! trans('messages.Account Name') !!}</th>

														<th>{!! trans('messages.Account Number') !!}</th>

														<th>{!! trans('messages.IFSC Code') !!}</th>

														<th>{!! trans('messages.Branch') !!}</th>

														<th>{!! trans('messages.Option') !!}</th>

													</tr>

												</thead>

												<tbody>

													@foreach($employee->BankAccount as $bankAccount)

													<tr>

														<td>{!! $bankAccount->bank_name !!}</td>

														<td>{!! $bankAccount->account_name !!}</td>

														<td>{!! $bankAccount->account_number !!}</td>

														<td>{!! $bankAccount->ifsc_code !!}</td>

														<td>{!! $bankAccount->bank_branch !!}</td>

														<td>{!! delete_form(['bank_account.destroy',$bankAccount->id]) !!}</td>

													</tr>

													@endforeach

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<!-- End Tab bank-account -->
                                
								<!-- Tab document -->

								<div class="tab-pane animated fadeInRight" id="document">

									<h2>{!! trans('messages.Add New Document') !!}</h2>

									<div class="user-profile-content">

										{!! Form::open(['files'=>true, 'route' => 'document.store','role' => 'form', 'class'=>'document-form']) !!}

					    				  	<div class="col-sm-6">

						    				  	<div class="form-group">

												    {!! Form::label('document_type_id',trans('messages.Document Type'),[])!!}

													{!! Form::select('document_type_id', [null=>'Please Select'] + $document_types,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Document Type'])!!}

												</div>

				  								<div class="form-group">

													<input type="file" name="file" id="file" class="btn btn-default" title="Select Document">

												</div>

												<div class="form-group">

												    {!! Form::label('document_title',trans('messages.Document Title'))!!}

													{!! Form::input('text','document_title','',['class'=>'form-control','placeholder'=>'Enter Document Title'])!!}

												</div>

												<div class="form-group">

												    {!! Form::label('expiry_date',trans('messages.Expiry Date'))!!}

													{!! Form::input('text','expiry_date','',['class'=>'form-control datepicker-input','placeholder'=>'Enter Document Expiry Date','readonly' => 'true'])!!}

												</div>

											</div>

											<div class="col-sm-6">	

												<div class="form-group">

												    {!! Form::label('document_description',trans('messages.Document Description'),[])!!}

												    {!! Form::textarea('document_description','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Document Description'])!!}

												</div>

												{!! Form::hidden('user_id',$employee->id)!!}

												{!! Form::submit(trans('messages.Add'),['class' => 'btn btn-primary']) !!}

											</div>

										{!! Form::close() !!}



										<div class="clear"></div>

										<h2>{!! trans('messages.List All Documents') !!}</h2>

										<div class="table-responsive">

											<table class="table table-hover table-striped">

												<thead>

													<tr>

														<th>{!! trans('messages.Document Type') !!}</th>

														<th>{!! trans('messages.Title') !!}</th>

														<th>{!! trans('messages.Expiry Date') !!}</th>

														<th>{!! trans('messages.Description') !!}</th>

														<th>{!! trans('messages.File') !!}</th>

														<th>{!! trans('messages.Option') !!}</th>

													</tr>

												</thead>

												<tbody>

													@foreach($employee->Document as $document)

													<tr>

														<td>{!! $document->DocumentType->document_type_name !!}</td>

														<td>{!! $document->document_title !!}</td>

														<td>{!! App\Classes\Helper::showDate($document->expiry_date) !!}</td>

														<td>{!! $document->document_description !!}</td>

														<td><a target=_blank href="/uploads/document/{!! $document->document !!}">Click here</a></td>

														<td>{!! delete_form(['document.destroy',$document->id]) !!} </td>

													</tr>

													@endforeach

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<!-- End Tab document -->

								<!-- Tab salary -->

								<div class="tab-pane animated fadeInRight" id="salary">
									<h2>{!! trans('messages.Earning Salary') !!}</h2>

									<div class="user-profile-content">

										{!! Form::open(['route' => 'salary.store','role' => 'form', 'class'=>'salary-form']) !!}

					    				  	

					    				  		<div class="col-sm-6">

					    				  			
							    				  	@foreach($earning_salary_types as $earning_salary_type)

							    				  	<div class="form-group">

													    {!! Form::label($earning_salary_type->id,$earning_salary_type->salary_head,[])!!}

														{!! Form::input('number',$earning_salary_type->id,array_key_exists($earning_salary_type->id, $salary) ? round($salary[$earning_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$earning_salary_type->salary_head])!!}

													</div>

													@endforeach

												</div>
												@foreach($deduction_salary_types as $deduction_salary_type)

							    				  	<div class="form-group">

													    {!! Form::label($deduction_salary_type->id,$deduction_salary_type->salary_head,[])!!}

														{!! Form::input('number',$deduction_salary_type->id,array_key_exists($deduction_salary_type->id, $salary)  ? round($salary[$deduction_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$deduction_salary_type->salary_head])!!}

													</div>

													@endforeach
					    				  		<div class="col-sm-6">

												@if(count($earning_salary_types) || count($deduction_salary_types))

												{!! Form::hidden('user_id',$employee->id)!!}

												{!! Form::submit(trans('messages.Save'),['class' => 'btn btn-primary']) !!}

												@endif

												</div>

										{!! Form::close() !!}

										<div class="clear"></div>

									</div>

								</div>

								<!-- End Tab salary -->
                                
                                <!-- Tab asset -->

								<div class="tab-pane animated fadeInRight" id="asset">

									<div class="user-profile-content">
                                    
										<h2>{!! trans('messages.List All Assets') !!}</h2>

										<div class="table-responsive">

											<table class="table table-hover table-striped">

												<thead>

													<tr>

														<th>{!! trans('messages.Asset Code') !!}</th>

														<th>{!! trans('messages.Asset Name') !!}</th>

														<th>{!! trans('messages.Issue Date') !!}</th>

														<th>{!! trans('messages.Return Date') !!}</th>
                                                        <th>{!! trans('messages.Comment') !!}</th>

														<th>{!! trans('messages.Status') !!}</th>

														

													</tr>

												</thead>

												<tbody>
                                                    
                                                    @foreach($employee->EmployeeAsset as $easset)

													<tr>

														<td>{!! $easset->AssetType->asset_code !!}</td>

														<td>{!! $easset->AssetType->asset_name !!}</td>

														<td>{!! App\Classes\Helper::showDate($easset->issue_date) !!}</td>

														<td>{!! $easset->return_date !!}</td>                                                        
                                                        <td>{!! $easset->comments !!}</td>
                                                        <td>
                                                        	@if($easset->status==1)
                                                            <span class="label label-success">Returned</span>                                                            @endif
                                                        </td>
													</tr>

													@endforeach

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<!-- End Tab asset -->
                                
                                <!-- Tab document -->

								<div class="tab-pane animated fadeInRight" id="dependent">

									<div class="user-profile-content">
										<div id="dependent-eform">
                                        @if(Input::old('dep_id'))
                                        <h2>{!! trans('messages.Edit Dependent') !!}</h2>
                                        <div align="right"><a href="{!! URL::to('/dependent/add/'.$employee->id) !!}" class='btn btn-xs btn-default dependent_edit'> <i class='fa fa-edit'></i> {!! trans('messages.Add New') !!}</a></div>
                                        @else
                                        <h2>{!! trans('messages.Add New Dependent') !!}</h2>
                                        @endif
										{!! Form::open(['files'=>true, 'route' => 'dependent.store','role' => 'form', 'class'=>'dependent-form']) !!}
											@include('dependent._form')
										{!! Form::close() !!}
                                        </div>



										<div class="clear"></div>

										<h2>{!! trans('messages.List All Dependents') !!}</h2>

										<div class="table-responsive">

											<table class="table table-hover table-striped">

												<thead>

													<tr>

														<th>{!! trans('messages.Name') !!}</th>

														<th>{!! trans('messages.Relationship') !!}</th>

														<th>{!! trans('messages.Visa Provided by') !!}</th>

														<th>{!! trans('messages.Issue Date') !!}</th>
                                                        <th>{!! trans('messages.Expiry Date') !!}</th>
														<th>{!! trans('messages.File') !!}</th>

														<th>{!! trans('messages.Option') !!}</th>

													</tr>

												</thead>

												<tbody>

													@foreach($employee->Dependent as $dependent)

													<tr>

														<td>{!! $dependent->name !!}</td>
														<td>{!! $dependent->relation !!}</td>
                                                        <td>{!! $dependent->visa !!}</td>
                                                        <td>{!! App\Classes\Helper::showDate($dependent->issue_date) !!}</td>
														<td>{!! App\Classes\Helper::showDate($dependent->expiry_date) !!}</td>
														<td><a target=_blank href="/uploads/dependent/{!! $dependent->document !!}">Click here</a></td>
														<td>
                                                        <a href="{!! URL::to('/dependent/'.$dependent->id.'/edit') !!}" class='btn btn-xs btn-default dependent_edit'> <i class='fa fa-edit'></i> Edit</a>
                                                        {!! delete_form(['dependent.destroy',$dependent->id]) !!} </td>
													</tr>

													@endforeach

												</tbody>

											</table>

										</div>

									</div>

								</div>

								<!-- End Tab document -->

								

							</div><!-- End div .tab-content -->

						</div><!-- End div .box-info -->

					</div>
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
<script src="{{ asset('public/josh/assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/josh/assets/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/josh/assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('public/josh/assets/vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/josh/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/josh/assets/js/pages/datepicker.js') }}" type="text/javascript"></script>
	@stop