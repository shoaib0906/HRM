
@extends('admin.layouts.default')
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/css/pages/tables.css') }}" />
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
@stop
	@section('content')
		
<section class="content-header">
        
        <div class="tab-pane animated fadeInRight" id="sms">

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        Monthly Attendance
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
            <div class="col-sm-10">
                <div class="box-info">
                    <h2><strong>{!! trans('messages.Select Month & Year') !!}</strong></h2>
                    {!! Form::open(['route' => 'clock.attendanceMonthlyReport','role' => 'form','class'=>'form-inline']) !!}
                      <div class="form-group">
                        {!! Form::select('month', [null=>'Please select'] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select Month'])!!}
                        {!! Form::select('year', [null=>'Please select'] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control select2','id'=>'select22','placeholder'=>'Select Year'])!!}
                      </div>
                      <div class="form-group">
                        {!! Form::select('user_id', [null => 'Please Select'] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control  select2','id'=>'select24','placeholder'=>'Select User'])!!}
                      </div>
                      {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Get'),['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            @if(isset($cols_summary))
            <div class="col-sm-2">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge badge-danger">{!! array_key_exists('A',$cols_summary) ? $cols_summary['A'] : '-' !!}</span>
                    Absent
                  </li>
                  <li class="list-group-item">
                    <span class="badge badge-info">{!! array_key_exists('H',$cols_summary) ? $cols_summary['H'] : '-' !!}</span>
                    Holiday
                  </li>
                  <li class="list-group-item">
                    <span class="badge badge-success">{!! array_key_exists('P',$cols_summary) ? $cols_summary['P'] : '-' !!}</span>
                    Present
                  </li>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h2><strong>{!! trans('messages.Attendance') !!}</strong> @if(isset($user)) {!! trans('messages.of') !!} {!! $user->first_name." ".$user->last_name." (".$user->Designation->designation." in ".$user->Designation->Department->department_name.") for ".ucfirst($month)." ".$year !!} @endif</h2></div>
                    <table class="table table-striped table-bordered datatable" id="">
                                    <thead>
                                        <tr>

                                            @foreach($col_heads as $col_head)
                                            @if($col_head == 'Option')
                                            <th style="width:120px;">{!! $col_head !!}</th>
                                            @else
                                            <th>{!! $col_head !!}</th>
                                            @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                         @if(isset($col_foots))
                                        <tfoot>
                                            <tr>
                                                @foreach($col_foots as $col_foot)
                                                <th>{!! $col_foot !!}</th>
                                                @endforeach
                                            </tr>
                                        </tfoot>
                                        @endif
                                       
                                    
                                </table>
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
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/jeditable/js/jquery.jeditable.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/js/pages/table-advanced.js') }}" ></script>
       <script type="text/javascript">
       

    $('.datatable').DataTable({
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'li><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title:"{!! $page_title !!}",
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title:"{!! $page_title !!}",
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    text: '<i class="fa fa-files-o"></i>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>'
                }
            ],
            "ajax": "{{ url('data.txt') }}",
            "ordering": true,
            "autoWidth": true,
            "columnDefs": [
                { "orderable": false, "targets": 0 }
            ]
        });
    
    //$('input[title="Delete"]').attr("type", "submit");

    
   </script>

@stop