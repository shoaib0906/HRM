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
			                            <i class="livicon" data-name="user-remove" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										{!! trans('messages.Request') !!} {!! trans('messages.Leave') !!}
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<div class="row">
					<div class="col-sm-3">
						<!-- Begin user profile -->
						<div class="box-info">
							
							<div style="margin-left:75px;">
								<h4>{!! trans('messages.Leave Request') !!} # {!! str_pad($leave->id, 3, 0, STR_PAD_LEFT) !!}</h4>
								<h5><strong></strong></h5>
								
							</div>
						</div><!-- End div .box-info -->
						<!-- Begin user profile -->
					</div><!-- End div .col-sm-4 -->
					
					<div class="col-sm-9">
						<div class="box-info full">
							<!-- Nav tab -->
							<ul class="nav nav-tabs nav-justified">
							  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-pencil"></i> {!! trans('messages.Leave Detail') !!}</a></li>
							  <li><a href="#other" data-toggle="tab"><i class="fa fa-coffee"></i> {!! trans('messages.Other Leave') !!}</a></li>
							</ul>
							<!-- End nav tab -->

							<!-- Tab panes -->
							<div class="tab-content">
							
								
								<br/><hr>
								<!-- Tab timeline -->
								<div class="tab-pane animated active fadeInRight" id="detail">
									<div class="user-profile-content">
										<div class="row">
											<div class="col-sm-6">
												<h5><strong>{!! trans('messages.Leave') !!}</strong> {!! trans('messages.Type') !!}</h5>
													<address>
														<strong>{!! $leave->LeaveType->leave_name !!}</strong>
													</address>
													<address>
														<strong>From {!! date('d M Y',strtotime($leave->from_date)) !!} To 
														{!! date('d M Y',strtotime($leave->to_date)) !!}</strong>
													</address>
													<address>
														<strong>{!! trans('messages.Reason') !!}</strong><br>
														{!! $leave->leave_description !!}
													</address>
											</div>
											<div class="col-sm-6">
												@if(Entrust::can('edit_leave_status') && $leave->user_id != Auth::user()->id)
												{!! Form::open(['route' => 'leave.updateStatus','role' => 'form', 'class'=>'leave-form']) !!}
												  <div class="form-group">
												    {!! Form::label('leave_status',trans('messages.Leave Status'),[])!!}
													{!! Form::radio('leave_status', 'pending', ($leave->leave_status == 'pending') ? 'checked' : '') !!} Pending
													{!! Form::radio('leave_status', 'approved', ($leave->leave_status == 'approved') ? 'checked' : '') !!} Approved
													{!! Form::radio('leave_status', 'rejected', ($leave->leave_status == 'rejected') ? 'checked' : '') !!} Rejected
												  </div>
												  <div class="form-group">
												    {!! Form::label('leave_comment',trans('messages.Comment'),[])!!}
												    {!! Form::textarea('leave_comment',isset($leave->leave_comment) ? $leave->leave_comment : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
												  </div>
												  {!! Form::hidden('id',$leave->id) !!}
												  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
												{!! Form::close() !!}
												@else
												<h5><strong>Leave</strong> Status</h5>
													@if($leave->leave_status == 'pending')
														<span class="label label-info btn-lg">{!! trans('messages.Pending') !!}</span>
													@elseif($leave->leave_status == 'approved')
														<span class="label label-success btn-lg">{!! trans('messages.Approved') !!}</span>
													@else
														<span class="label label-danger btn-lg">{!! trans('messages.Rejected') !!}</span>
													@endif

													<p>{!! $leave->leave_comment !!}</p>
												@endif
											</div>
										</div><!-- End div .row -->
									</div><!-- End div .user-profile-content -->
								</div><!-- End div .tab-pane -->
								<!-- End Tab timeline -->
								<div class="tab-pane animated fadeInRight" id="other"><br/>
									<div class="user-profile-content">
										@if(count($other_leaves))
										<div class="table-responsive">
											<table class="table table-hover table-striped">
												<thead>
													<tr>
														<th>{!! trans('messages.From') !!}</th>
														<th>{!! trans('messages.To') !!}</th>
														<th>{!! trans('messages.Description') !!}</th>
														<th>{!! trans('messages.Status') !!}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($other_leaves as $other_leave)
														<tr>
															<td>{!! date('d M Y',strtotime($other_leave->from_date)) !!}</td>
															<td>{!! date('d M Y',strtotime($other_leave->to_date)) !!}</td>
															<td>{!! $other_leave->leave_description !!}</td>
															<td>{!! ucfirst($other_leave->leave_status) !!}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										@else
											<div class="alert alert-danger alert-dismissable">
											  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											  <strong>{!! trans('messages.Info') !!}!</strong> This employee has not yet applied for any other leave!!
											</div>
										@endif
									</div>
								</div>
								
							</div><!-- End div .tab-content -->
						</div><!-- End div .box-info -->
					</div>
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

				
				
