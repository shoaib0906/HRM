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
    <link href="{{ asset('public/josh/assets/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css') }}"  rel="stylesheet" media="screen"/>
    <link href="{{ asset('public/josh/assets/vendors/summernote/summernote.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/css/pages/editor.css') }}" rel="stylesheet" type="text/css"/>
    @stop
	@section('content')
	<section class="content-header">
		
		<div class="tab-pane animated fadeInRight" id="sms">

						    <div class="panel panel-success">
						    	<div class="panel-heading">
			                        <h3 class="panel-title">
			                            <i class="livicon" data-name="sandglass" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										SMS Template
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									<div class="row">
						<div class="col-md-5">
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								@foreach($sms_templates as $key => $template)
								<li class="@if($key == 0) active @endif">
									<a data-toggle="tab" href="#tab_{!! $key !!}">
									<i class="fa fa-check"></i> {!! $template[1] !!} </a>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="col-md-7">
							<div class="tab-content">
								@foreach($sms_templates as $key => $template)
								<div id="tab_{!! $key !!}" class="tab-pane @if($key == 0) active @endif">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												Update "{!! $template[1] !!}" Template</a>
												</h4>
											</div>
											<div id="accordion1_1" class="panel-collapse collapse in">
												<div class="panel-body">
													{!! Form::model($template,['method' => 'PATCH','route' => ['sms_template.update',$key] ,'class' => 'template-form']) !!}
														
													  <div class="form-group">
													    {!! Form::label('template_description','SMS Content',[])!!}
													    {!! Form::textarea('template_description',(array_key_exists($template[0],$template_content)) ? $template_content[$template[0]] : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'id'=>'summernote', 'placeholder' => 'Enter Description'])!!}
													  </div>
													  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Save',['class' => 'btn btn-primary']) !!}

													{!! Form::close() !!}
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
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
