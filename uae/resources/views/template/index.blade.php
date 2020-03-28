@extends('admin.layouts.default')

	@section('content')
	@section('header_styles')
	    <link href="{{ asset('public/josh/assets/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css') }}"  rel="stylesheet" media="screen"/>
    <link href="{{ asset('public/josh/assets/vendors/summernote/summernote.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/css/pages/editor.css') }}" rel="stylesheet" type="text/css"/>
    @stop
<section class="content-header">
		<div class="row">
        <div class="col-md-12">
            <div class="box box-solid box-primary">
				<div class=" ">

					<div class="row">
						<div class="col-md-5">
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								@foreach($templates as $key => $template)
								<li class="@if($key == 0) active @endif">
									<a data-toggle="tab" href="#tab_{!! $key !!}">
									<i class="fa fa-check"></i> {!! $template[1] !!} </a>
								</li>
								@endforeach
							</ul>
						</div>
						<div class="col-md-7">
							<div class="tab-content">
								@foreach($templates as $key => $template)
								<div id="tab_{!! $key !!}" class="tab-pane @if($key == 0) active @endif">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												Update "{!! $template[1] !!}" Template</a>
												</h4>
											</div>
											<div id="" class=" panel-collapse collapse in">
												<div class="panel-body">
													{!! Form::model($template,['method' => 'PATCH','route' => ['template.update',$key] ,'class' => 'template-form']) !!}
														
													  <div class="form-group">
													    {!! Form::label('template_subject',trans('messages.Subject'),[])!!}
														{!! Form::input('text','template_subject',$template[1] ? : $template[1],['class'=>'form-control','placeholder'=>'Enter Subject','required' => 'true'])!!}
													  </div>
													  <div class="form-group" >
													    {!! Form::label('template_description','Mail Body',[])!!}
													    {!! Form::textarea('template_description',(array_key_exists($template[0],$template_content)) ? $template_content[$template[0]] : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'id'=>'summernote','placeholder' => 'Enter Description'])!!}
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
		</div>
</section>
		@stop
			@section('footer_scripts')
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