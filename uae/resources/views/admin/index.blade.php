@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
{!! config('config.application_title') ? : config('constants.ITEM_NAME') !!}
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--Charts -->    
     <link type="text/css" rel="stylesheet" href="{{ asset('public/josh/assets/css/pages/flot.css') }}" />
    <!-- -->


    <link href="{{ asset('public/josh/assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/josh/assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('public/josh/assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('public/josh/assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/josh/assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/josh/assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

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
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.css') }}" />
    <link href="{{ asset('public/josh/assets/css/pages/alertmessage.css') }}" rel="stylesheet"  type="text/css"/>

    <link rel="stylesheet" href="{{ asset('public/josh/assets/css/pages/tab.css') }}" />

        <link href="{{ asset('public/josh/assets/vendors/summernote/summernote.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/trumbowyg/css/trumbowyg.colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/css/pages/editor.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">

/* ----------- Retina Screens ----------- */
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 2400px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (min-resolution: 192dpi) { 
      .row{
        margin-left:10%!important;
        margin-right:10%!important;
        margin-top:5%!important;
    }
}
        .slimScrollDiv #slim1{
            position: relative; overflow: hidden; width: auto; height: 31vh!important;
            
        }
        .slimScrollDiv #slim2{
            position: relative; overflow: hidden; width: auto; height: 31vh!important;
        }
        .slimScrollDiv {
            position: relative; overflow: hidden; width: auto; height: 31vh!important;
        }
        
        #training{
            position: relative; overflow: hidden; width: auto; height: 220px!important;
        }
        #mythickness{
            position: relative; overflow: hidden; width: auto; height: 235px!important;
        }
        #myleave{
            position: relative; overflow: hidden; width: auto; height: 235px!important;
        }
         #training #slim5{
            position: relative; overflow: hidden; width: auto; height: 240px!important;
        }
        .note-editable {
                height: 200px;
                width: 100%;
            }
        
    </style>
@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Welcome to Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Dashboard
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <!-- Trans label pie charts strats here-->
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Department's</span>

                                    <div class="number" id="myTargetElement1">{!! $dept_count !!}</div>
                                </div>
                                <i class="livicon  pull-right" data-name="sitemap" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                <!-- Trans label pie charts strats here-->
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>{!! trans('messages.Total Staff') !!}</span>

                                    <div class="number" id="myTargetElement2">{!! $user_count !!}</div>
                                </div>
                                <i class="livicon pull-right" data-name="users-add" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                <!-- Trans label pie charts strats here-->
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>{!! trans('messages.Present Staff') !!}</span>

                                    <div class="number" id="myTargetElement3">{!! $present_count !!}</div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>{!! trans('messages.Expire List') !!}</span>

                                    <div class="number" id="myTargetElement4">{!! $expire_count !!}</div>
                                </div>
                                <i class="livicon pull-right" data-name="plane-up" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
        <div class="row ">
            
            <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="panel panel-warning todolist">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="pin-on" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Notice Board
                        </h4>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="">
                            <div class=" panel-info">
                                
                                <div class="panel-body c2" id="slim1">
                                   @if(count($notices))

                                        @foreach($notices as $notice)

                                            <div class="alert-message alert-message-success">

                                                <h4>{!! $notice->title !!}</h4>

                                                <p>

                                                {!! $notice->content !!}

                                                </p>

                                                <p class="time pull-right">{!! trans('Published by') !!} {!! $users[$notice->username] !!}</p>

                                            </div>

                                        @endforeach

                                    @else

                                        <div class="alert alert-danger">

                                          {!! trans('No content found!!') !!}

                                        </div>

                                    @endif
                                   
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="panel  panel-primary">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Tasks
                        </h4>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="">
                            <div class=" panel-info">
                                
                                <div class="panel-body c2" id="slim2">
                                   @foreach($tasks as $task)
                                   <p>{!! $task->task_title !!} <strong>{!! $task->task_progress!!}% {!! trans('messages.Complete') !!}</strong></p>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar" role="progressbar" data-transitiongoal="{!! $task->task_progress!!}"></div>
                                    </div>
                                    @endforeach
                                   
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <div class="panel panel-success panel-border">
                    <div class="panel-heading  border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="calendar" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Calendar
                        </h4>
                    </div>
                    <div class="panel-body" >
                        <div id='external-events'></div>
                        <div id="calendar"></div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-md-12 col-sm-12">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="panel panel-default  panel-border" style="">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="hammer" data-size="18" data-color="black" data-hc="black"
                               data-l="true"></i>
                            Recent Activity
                        </h4>
                    </div>
                    
                    <div class="  " id="">
                        <div class="panel-body panel-info " style="overflow-y: scroll; height:250px;" >
                                   <ul class="">

                        @foreach($activities as $activity)

                          <li class="media">

                            <a class="pull-{!! App\Classes\Helper::activityShow() !!}" href="#">

                            {!! \App\Classes\Helper::getAvatar2($activity->user_id) !!}

                            </a>

                            <div class=" alert-message media-body {!! App\Classes\Helper::activityColorShow() !!}">

                              <strong>@if(Auth::user()->id == $activity->user_id) Me @else {!! $activity->employee_name !!} @endif</strong><br />

                              {!! $activity->text !!}

                              <p class="time">{!! App\Classes\Helper::showDateTime($activity->created_at) !!}</p>

                            </div>

                          </li>

                        @endforeach

                        </ul>
                                </div>
                    </div>
                </div>
                <div class=" panel panel-primary">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="mail" data-size="18" data-color="gold" data-hc="white"
                               data-l="true"></i>
                            Training 
                        </h4>
                    </div>
                    <div class="panel-body no-padding " id="training">
                    <center><h3 style="margin-top:0px;"><i class="fa fa-graduation-cap icon" data-name="plane-up" data-size="30" data-color="black" data-hc="black"
                               data-l="true"></i>0 requests </h3>
                               Awaiting Approval                             </center><br/>
                    <hr style="padding:0px;margin:0px;">                    
                    <center><h4>125 Courses Completed this Year.</h4></center>
                    <hr style="padding:0px;margin:5px;"><br/>
                        <center><button type="submit" class="btn btn-primary">Request a Training >></button></center>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-sm-12">
                <div class="panel panel-danger">
                    <div class="panel-heading border-light" >
                        <h4 class="panel-title">
                            <i class="livicon" data-name="mail" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Quick Message
                        </h4>
                    </div>
                    <div class="panel-body no-padding" style="height:533px">
                    {!! Form::open(['route' => 'message.store','role' => 'form', 'class'=>'compose-form']) !!}
                        <div class="compose row">
                            <label class="col-md-2">To:</label>
                            <div class="col-md-10">
                            {!! Form::select('to_user_id', [null=>''] + $compose_users, '',['class'=>'form-control col-md-9 col-xs-9 select2','id'=>'select22','placeholder'=>''])!!}
                            </div>
                            <div class="clear"><br/></div>
                            <label class="col-md-2 hidden-xs" style="padding: 0">Subject:</label>
                            <div class="col-md-10">
                            {!! Form::input('text','subject','',['class'=>'form-control col-md-9 col-xs-9','placeholder'=>'Message subject'])!!}
                            </div>
                            <div class="clear"></div>
                            <div class='col-md-12' >
                              

                                {!! Form::textarea('content','',['class' => 'form-control summernote-small','style'=>'height:220px;' ,'id'=>'summernote', 'rows'=>'2','placeholder' => 'Enter Description'])!!}<br/>
                            </div>
                            
                            
                            <div class="pull-right">
                                
                                <button type="submit" class="btn btn-success">{!! trans('messages.Send') !!}</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                
            </div>
            <div class="col-sm-12 col-md-4 col-sm-12" style="">
                
                <div class="panel panel-success  panel-border" style="">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="plane-up" data-size="18" data-color="black" data-hc="black"
                               data-l="true"></i>
                            My Leave
                        </h4>
                    </div>
                    
                    <div class="  " id="">
                        <div class="panel-body panel-info" id="myleave" >
                        <center><h3 style="margin-top:0px;"><i class="fa fa-plane icon" data-name="plane-up" data-size="30" data-color="black" data-hc="black"
                               data-l="true"></i> 20 Day's</h3> Holiday Available</center><br/>
                        <hr style="padding:0px;margin:0px;">
                    <center><h4>0 days requested 0 days booked</h4></center>
                    <hr style="padding:0px;margin:5px;">
                    <center><a class="btn" href="#"> Manage Leave >></a> Or <a class="btn" href="#">View Calendar >></a></center><br/>
                        <center><button href="asd" class="btn btn-success">Make a New Leave Request >></button></center>

                        
                        </div>
                    </div>
                </div>
                <div class="panel panel-danger  panel-border" style="">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="thumbs-up" data-size="18" data-color="black" data-hc="black"
                               data-l="true"></i>
                            Attendance
                        </h4>
                    </div>
                    
                    <div class="panel-body panel-info">

				<div class="box-info">

					@if($clock_status == 'NA')

					<a href="{!! URL::to('/clock/in/'.$token) !!}" class="btn btn-success btn-md" role="button"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.Clock in') !!}</a>

					@elseif($clock_status == 'IN')

					<button class="btn btn-success btn-md"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.You are clocked in !!') !!}</button>

					<a href="{!! URL::to('/clock/out/'.$token) !!}" class="btn btn-danger btn-md" role="button"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.Clock Out') !!}</a>

					@else

					<button class="btn btn-danger btn-md"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.You are clocked out !!') !!}</button>

					@endif


                    
					<div class="clear"></div>



					<br />

					@if(Entrust::can('upload_attendance'))

						{!! Form::open(['files' => 'true','route' => 'clock.uploadAttendance','role' => 'form', 'class'=>'form-inline upload-attendance-form']) !!}

						  <div class="form-group">

							<label class="sr-only" for="file">Upload File</label>

							<input type="file" name="file" id="file" class="btn btn-info" title="Select File">

						  </div>
                          <hr>
						  <button type="submit" class="btn btn-default">Upload Attendance</button>

						  <div class="help-block"><strong>Note!</strong> Only xls or xlsx file is allowed!! <a href="{!! URL::to('/sample.xlsx') !!}">Click here for Sample File.</a></div>

						{!! Form::close() !!}

					@endif

				</div>



				

			</div>
                </div>
            </div>
             
        </div>
           
            <div class="col-lg-12 col-sm-12 col-md-12" style="">
            <!-- Tracking charts strats here-->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                        Employee Static
                    </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                </div>
                <div class="panel-body">
                    
                    <div id="spline-chart" class="flotChart1 "></div>
                </div>
            </div>
           </div>
        
        
    </section>

<section class="content" style="display:none!important;">
    <div class="row">
        <div class="col-lg-6">
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Stacked Bar Chart
                    </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                </div>
                <div class="panel-body">
                    <div id="basicFlotLegend" class="flotLegend"></div>
                    <div id="bar-chart-stacked" class="flotChart1"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
           
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Bar Chart
                    </h3>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                                </span>
                </div>
                <div class="panel-body">
                    <div id="bar-chart" class="flotChart"></div>
                </div>
            </div>
        </div>
    </div>
   

    
    
</section> 
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!--for calendar-->
    <script src="{{ asset('public/josh/assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/josh/assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
 
     <script type='text/javascript' src="{{ asset('public/josh/assets/vendors/bootstrap-progressbar/js/bootstrap-progressbar.js') }}" ></script>
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
    <script type="text/javascript" src="{{ asset('public/josh/assets/js/pages/general.js') }}" ></script>
    <script src="{{ asset('public/josh/assets/js/pages/tabs_accordions.js') }}" type="text/javascript"></script>


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
    <!--CHARTS-->
        <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.stack.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.crosshair.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.time.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.selection.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.symbol.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.resize.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flotchart/js/jquery.flot.categories.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/splinecharts/jquery.flot.spline.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/vendors/flot.tooltip/js/jquery.flot.tooltip.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('public/josh/assets/js/pages/customcharts.js') }}" ></script>
    <!--CHARTS-->

    <script type="text/javascript">
        @if(in_array('calendar',$assets))
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                events: {!! json_encode($events) !!},
                eventRender: function(event, element) {
                    $(element).tooltip({title: event.title});             
                }
            });
        @endif
        var s1 =  {!! ($graph_data) !!};//[["Jan", 5],["Feb", 8],["Mar", 6],["Apr", 9],["May", 6],["Jun", 8],["Jul", 6],["Aug", 5],["Sep", 8],["Oct", 6],["Nov", 9],["Dec", 6]];
        //var s2 = [["Jan", 70],["Feb", 100],["Mar", 80],["Apr", 100],["May", 80],["Jun", 90],["Jul", 80]];
        //var s3 = [["Jan", 32],["Feb", 41],["Mar", 36],["Apr", 39],["May", 30],["Jun", 44],["Jul", 26]];
        $.plot("#spline-chart", [{
            data: s1,
            label: "",
            color: "#01bc8c"
        }], {
            series: {
                lines: {
                    show: !1
                },
                splines: {
                    show: !0,
                    tension: .5,
                    lineWidth: 4,
                    fill: 0
                },
                points: {
                    show: !0,
                    radius: 4
                }
            },
            grid: {
                borderColor: "#fafafa",
                borderWidth: 1,
                hoverable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x : %y",
                defaultTheme: false
            },
            xaxis: {
                tickColor: "#fafafa",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#fafafa"
            },
            shadowSize: 0
        });
        $('#recent_act123').slimScroll({
            height: '400px'
        });
    </script>
@stop