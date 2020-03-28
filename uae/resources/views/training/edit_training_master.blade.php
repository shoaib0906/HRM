@extends('admin.layouts.default')
@section('header_styles')
	  <!--Dropdown-->
      <script type="text/javascript">
          #rangepicker5 = #rangepicker4;
      </script>
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
			                            <i class="livicon" data-name="sitemap" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
										Update Training
			                        </h3>
			                    </div>
			                    <div class="panel-body">
									
                            			<form action="{{url('training_info_update')}}" method="post"> 
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                          <div class="form-group">
                                            {!! Form::label('from_date','Staff',[])!!}
                                            <select type="text" name="user_id" class="form-control select2" id="select21">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                            @endforeach
                                            </select>
                                          </div>
                                           <div class="form-group">
                                                {!! Form::label('from_date','Training Title',[])!!}
                                                <select type="text" name="training_id" class="form-control select2" id="select22">
                                                    @foreach($trainings as $training)
                                                    <option value="{{$training->id}}">{{$training->training_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @foreach($trainging as $trainging)
                                          <div class="form-group">
                                            {!! Form::label('from_date',trans('messages.From Date'),[])!!}
                                           <input type="text" name="start_date" id="rangepicker4" value="{{$trainging->start_date}}" class="form-control">
                                           <input type="hidden" name="id"  value="{{$trainging->id}}" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            {!! Form::label('to_date',trans('messages.To Date'),[])!!}
                                            <input type="text" name="end_date" id="rangepicker5" value="{{$trainging->end_date}}" class="form-control">
                                          </div>
                                           <div class="form-group">
                                            {!! Form::label('hours',trans('messages.Training Duration'),[])!!}
                                            <input type="text" name="duration" value="{{$trainging->duration}}" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            {!! Form::label('hours',trans('messages.Training Result'),[])!!}
                                            <input type="text" name="result" value="{{$trainging->result}}" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            {!! Form::label('leave_description',trans('messages.Description'),[])!!}
                                           <input type="text" name="description" value="{{$trainging->description}}" class="form-control">
                                          </div>
                                          @endforeach
                                            {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

										 </form>                           	
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
