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
										Job Detail's
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<div class="row">
					<div class="col-sm-4">
						<div class="box-info text-center user-profile-2">
							<h4> Job # {!! str_pad($job->id, 3, 0, STR_PAD_LEFT) !!} </h4>
							<h5>{!! $job->job_title !!}</h5>
							<ul class="list-group">
							  <li class="list-group-item">
								<span class="badge success">{!! App\Classes\Helper::showDate($job->created_at) !!}</span>
								Posted On
							  </li>
							  <li class="list-group-item">
								<span class="badge success">{!! $job->Designation->designation !!}</span>
								Post
							  </li>
							  <li class="list-group-item">
								<span class="badge success">{!! $job->numbers !!}</span>
								Number of Posts
							  </li>
							</ul>

							<p>{!! $job->job_description !!}</p>
						</div>
					</div>
					
					<div class="modal fade" id="myModal" role="basic" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							</div>
						</div>
					</div>
					
					<div class="col-sm-8">
						<div class="box-info">
							<h2><strong>Application</strong> List</h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Name') !!}</th>
												<th>{!! trans('messages.Email') !!}</th>
												<th>{!! trans('messages.Contact') !!}</th>
												<th>{!! trans('messages.Status') !!}</th>
												<th>{!! trans('messages.Resume') !!}</th>
												<th>{!! trans('messages.Option') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($applications as $application)
												<tr>
													<td>{!! $application->name !!}</td>
													<td>{!! $application->email !!}</td>
													<td>{!! $application->contact_number !!}</td>
													<td>{!! \App\Classes\Helper::getApplicationStatus($application->status) !!}</td>
													<td><a href="{!! URL::to('/uploads/resume/'.$application->resume) !!}">Click Here</a></td>
													<td>
														<a href="{!! URL::to('/application/'.$application->id) !!}" class='DTTT_button_small' data-toggle='modal' data-target='#myModal' > <i class='fa fa-share'></i></a>
														{!! delete_form(['application.deleteApplication',$application->id]) !!}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
						</div>
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

