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
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="legal" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										Payroll
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Select') !!} </strong> </h2>
					
					{!! Form::open(['route' => 'payroll.create','role' => 'form', 'class'=>'payroll-form']) !!}
						<div class="form-group">
					    {!! Form::label('month_year',trans('messages.Month & Year'),[])!!}
					    <div class="row">
							<div class="col-xs-6">
								{!! Form::select('month', [''=>''] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select Month'])!!}
							</div>
							<div class="col-xs-6">
								{!! Form::select('year', [''=>''] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control select2','id'=>'select22','placeholder'=>'Select Year'])!!}
							</div>
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
					    {!! Form::select('user_id', [''=>''] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control select2','id'=>'select24','placeholder'=>'Select User'])!!}
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Get'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			@if(isset($user_id) && isset($month) && isset($year))
			<div class="col-sm-8">
				<div class="box-info full">
					
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#summary" data-toggle="tab"><i class="fa fa-arrows"></i> {!! trans('messages.Summary') !!}</a></li>
					  <li><a href="#salary" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>
					</ul>

					<div class="tab-content">
					<br/><br/>
						<div class="tab-pane animated active fadeInRight" id="summary">
							<div class="user-profile-content">
								<h5><strong>{!! trans('messages.Attendance') !!}</strong> {!! trans('messages.Summary for') !!} {!! ucfirst($month). " ".$year !!}</h5>
								@if(isset($att_summary))
									<div class="col-sm-6">
										<ul class="list-group">
										  <li class="list-group-item">
											<span class="badge badge-danger">{!! $att_summary['A'] !!}</span>
											Absent
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-info">{!! $att_summary['H'] !!}</span>
											Holiday
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-success">{!! $att_summary['P'] !!}</span>
											Present
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-default">{!! $att_summary['W'] !!}</span>
											Total Working Days
										  </li>
										</ul>
									</div>
								@endif
								@if(isset($summary))
									<div class="col-sm-6">
										<ul class="list-group">
										  <li class="list-group-item">
											<span class="badge badge-danger">{!! array_key_exists('total_late',$summary) ? $summary['total_late'] : '-' !!}</span>
											Total Late
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-info">{!! array_key_exists('total_early',$summary) ? $summary['total_early'] : '-' !!}</span>
											Total Early
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-default">{!! array_key_exists('total_overtime',$summary) ? $summary['total_overtime'] : '-' !!}</span>
											Total Overtime
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-success">{!! array_key_exists('total_working',$summary) ? $summary['total_working'] : '-' !!}</span>
											Total Working Duration
										  </li>
										</ul>
									</div>
								@endif
								<h5><strong>{!! trans('messages.Monthly') !!}</strong> {!! trans('messages.Salary of') !!} {!! $user->first_name." ".$user->last_name !!}</h5>
								@if(count($salary))
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Salary Head') !!}</th>
												<th>{!! trans('messages.Type') !!}</th>
												<th>{!! trans('messages.Amount') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($salary as $sal)
												<tr>
													<td>{!! $sal->salary_head !!}</td>
													<td>{!! ucfirst($sal->salary_type) !!}</td>
													<td>{!! round($sal->amount,2) !!}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@else
								<div class="alert alert-danger"><strong>{!! trans('messages.Salary not yet set!!') !!}</strong></div>
								@endif
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="salary">
							<div class="user-profile-content">
								<h3 class="text-center ">{!! $user->first_name." ".$user->last_name !!}</h3>
								<h4 class="text-center ">{!! $user->Designation->designation." in ".$user->Designation->Department->department_name !!} Department</h4>
								<h4 class="text-center ">Salary Slip {!! ucfirst($month)." ".$year !!}</h4>
									@if(Entrust::hasRole('admin'))
									{!! Form::open(['route' => 'payroll.store','role' => 'form', 'class'=>'payroll-store-form']) !!}
								  		<div class="col-sm-6">
								  			<h2>{!! trans('messages.Earning Salary') !!}</h2>
					    				  	@foreach($earning_salary_types as $earning_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($earning_salary_type->id,$earning_salary_type->salary_head,[])!!}
												{!! Form::input('number',$earning_salary_type->id,array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$earning_salary_type->salary_head])!!}
											</div>
											@endforeach
										</div>
								  		<div class="col-sm-6">
								  			<h2>{!! trans('messages.Deduction Salary') !!}</h2>
					    				  	@foreach($deduction_salary_types as $deduction_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($deduction_salary_type->id,$deduction_salary_type->salary_head,[])!!}
												{!! Form::input('number',$deduction_salary_type->id,array_key_exists($deduction_salary_type->id, $payroll)  ? round($payroll[$deduction_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$deduction_salary_type->salary_head])!!}
											</div>
											@endforeach
										</div>
										<h2>{!! trans('messages.Actual Contribution') !!}</h2>
										<div class="col-sm-12">
											<div class="form-group">
											    {!! Form::label('employee_contribution','Employee Contribution',[])!!}
												{!! Form::input('number','employee_contribution',isset($payroll_slip->employee_contribution) ? round($payroll_slip->employee_contribution,2) : '',['class'=>'form-control','placeholder'=>'Enter Employee Contribution'])!!}
											</div>
											<div class="form-group">
											    {!! Form::label('employer_contribution','Employer Contribution',[])!!}
												{!! Form::input('number','employer_contribution',isset($payroll_slip->employer_contribution) ? round($payroll_slip->employer_contribution,2) : '',['class'=>'form-control','placeholder'=>'Enter Employer Contribution'])!!}
											</div>
											<div class="form-group">
											    {!! Form::label('date_of_contribution','Date of Contribution',[])!!}
												{!! Form::input('text','date_of_contribution',isset($payroll_slip->date_of_contribution) ? $payroll_slip->date_of_contribution : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Employer Contribution','readonly' => 'true'])!!}
											</div>
											<div class="checkbox">
												<label>
												  <input type="checkbox" name="sms" value="yes"> Send SMS
												</label>
												<label>
												  <input type="checkbox" name="mail" value="yes"> Send Mail
												</label>
											</div>

										{!! Form::hidden('user_id',$user_id)!!}
										{!! Form::hidden('month',$month)!!}
										{!! Form::hidden('year',$year)!!}
										{!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
									{!! Form::close() !!}	
								<div class="clear"></div>
								@endif

								@if($payroll)
									<?php $total_earning = $total_deduction = 0; ?>
									<h2><strong>{!! trans('messages.Final Salary Sheet') !!}</strong>
										<a href="/payroll/generate/print/{!! $payroll_slip->id !!}" class="DTTT_button_small pull-right"><i class="fa fa-print"></i></a>
										<a href="/payroll/generate/pdf/{!! $payroll_slip->id !!}" class="DTTT_button_small pull-right"><i class="fa fa-file"></i></a>
									</h2>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											@foreach($earning_salary_types as $earning_salary_type)
											<dt>{!! $earning_salary_type->salary_head !!}</dt>
											<dd>{!! array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0 !!}</dd>
											<?php $total_earning += array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0; ?>
											@endforeach
										</dl>
									</div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											@foreach($deduction_salary_types as $deduction_salary_type)
											<dt>{!! $deduction_salary_type->salary_head !!}</dt>
											<dd>{!! array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0 !!}</dd>
											<?php $total_deduction += array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0; ?>
											@endforeach
										</dl>
									</div>
									<hr />
									<div class="clear"></div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt>{!! trans('messages.Total Earning') !!}</dt>
											<dd>{!! $total_earning !!}</dd>
										</dl>
									</div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt>{!! trans('messages.Total Deduction') !!}</dt>
											<dd>{!! $total_deduction !!}</dd>
										</dl>
									</div>
									<div class="clear"></div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt><big>NET SALARY</big></dt>
											<dd>{!! $total_earning - $total_deduction !!}</dd>
										</dl>
									</div>
									<div class="clear"></div>

								@else
								<div class="alert alert-danger"><strong>{!! trans('messages.Payroll not generated for this month!!') !!}</strong></div>
								@endif
							</div>
						</div>
					</div>

								
				</div>
			</div>
			@endif
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
		
