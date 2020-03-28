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
    <link href="{{ asset('public/josh/assets/vendors/summernote/summernote.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/css/pages/editor.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
    	.the-notes{
    		margin:5px;
    		padding: 2px 10px;
    	}
    </style>
    @stop
	@section('content')
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="trophy" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										{!! trans('messages.List All Employee Assets') !!}
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<div class="row">
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Job') !!}
					</h2>
					@if(count($jobs) == 0)
					<div class="alert alert-danger">No Job Advertisement Found!! </div>
					@endif

					@foreach($jobs as $job)
					<div class="the-notes success">
						<h4>{!! $job->job_title !!}</h4>
						<span class="label label-danger">{!! $job->numbers !!} Vacancy</span>
						<p>
						{!! $job->job_description !!}
						</p>
						<p class="pull-right"><i class="fa fa-clock-o"></i> Posted On {!! date('d M Y',strtotime($job->created_at)) !!}</p>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Apply') !!}</strong>
					</h2>
					

					@if(Auth::check())
						<div class="alert alert-danger"><strong>Alert!</strong> You are applying for this job as staff!!</div>
					@endif
					{!! Form::open(['files' => 'true','route' => 'job.saveApplication','role' => 'form', 'class'=>'job-application-form']) !!}
					  <div class="form-group">
					    {!! Form::label('job_id',trans('messages.Select Job'),[])!!}
						{!! Form::select('job_id', [''=>''] + $job_lists,'',['class'=>'form-control input-xlarge select2','id'=>'select21','placeholder'=>'Select Job'])!!}
					  </div>
					  @if(!Auth::check())
					  <div class="form-group">
					    {!! Form::label('name',trans('messages.Name'),[])!!}
						{!! Form::input('text','name','',['class'=>'form-control','placeholder'=>'Enter Your Name'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('contact_number',trans('messages.Contact Number'),[])!!}
						{!! Form::input('text','contact_number','',['class'=>'form-control','placeholder'=>'Enter Your Contact Number'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('email',trans('messages.Email'),[])!!}
						{!! Form::input('email','email','',['class'=>'form-control','placeholder'=>'Enter Your Email'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('address',trans('messages.Address'),[])!!}
					    {!! Form::textarea('address','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Address'])!!}
					  </div>
					  @endif
					  <div class="form-group">
					    {!! Form::label('app_description',trans('messages.Description'),[])!!}
					    {!! Form::textarea('app_description','',['size' => '30x3', 'class' => 'form-control summernote-small', 'id'=>'summernote', 'placeholder' => 'Enter Description'])!!}
					  </div>
					  {{ App\Classes\Helper::getCustomFields('job-application-form',$custom_field_values) }}
					  <div class="form-group">
						<input type="file" name="resume" id="resume" class="btn btn-default" title="Select Resume">
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Apply'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
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

<script  src="{{ asset('public/josh/assets/vendors/bootstrap3-wysihtml5-bower/js/bootstrap3-wysihtml5.all.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/bootstrap3-wysihtml5-bower/js/bootstrap3-wysihtml5.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/summernote/summernote.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.base64.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.colors.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.noembed.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.pasteimage.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.preformatted.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/vendors/trumbowyg/js/trumbowyg.upload.min.js') }}"  type="text/javascript"></script>
    <script  src="{{ asset('public/josh/assets/js/pages/editor2.js') }}"  type="text/javascript"></script>
	@stop
