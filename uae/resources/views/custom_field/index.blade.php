@extends('admin.layouts.default')
{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/josh/assets/css/pages/tables.css') }}" />
@stop
	@section('content')

		<div class="row panel-heading ">

			<div class="col-sm-8">
			<div class="panel-heading clearfix  ">
                                <div class="panel-title  pull-left">
                                       <div class="caption">
                                    <i class="livicon" data-name="pin-on" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    List of Location's
                                </div>
                                </div>
                            </div>
				<div class="panel-body table-responsive">
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
			<div class="col-sm-4">
				<div class="box-info">
				<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Custom Fields') !!}
					</h2>
					{!! Form::open(['route' => 'custom_field.store','role' => 'form', 'class'=>'designation-form']) !!}
					
					  <div class="form-group">
					    {!! Form::label('form',trans('messages.Form'),[])!!}
						{!! Form::select('form', [
							''=>'',
							'employee-form' => 'Employee Form',
							'department-form' => 'Department Form',
							'designation-form' => 'Designation Form',
							'leave-form' => 'Leave Form',
							'holiday-form' => 'Holiday Form',
							'ticket-form' => 'Ticket Form',
							'task-form' => 'Task Form',
							'job-application-form' => 'Job Application Form',
							'notice-form' => 'Notice Form',
							'award-form' => 'Award Form',
							'expense-form' => 'Expense Form',
							'job-form' => 'Job Form',
							],'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Field Type'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_type',trans('messages.Field Type'),[])!!}
						{!! Form::select('field_type', [
							''=>'',
							'text' => 'Text Box',
							'number' => 'Number',
							'email' => 'Email',
							'url' => 'URL',
							'select' => 'Select Box',
							'radio' => 'Radio Button',
							'checkbox' => 'Check Box',
							'textarea' => 'Textarea'
							],'',['id' => 'field_type', 'class'=>'form-control input-xlarge select2me','placeholder'=>'Select Field Type'])!!}
					  </div>
					  <div class="showhide-textarea">
						<div class="form-group">
						    {!! Form::label('field_value',trans('messages.Options'),[])!!}
						    {!! Form::textarea('field_value','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Options'])!!}
							<div class="help-block">Enter values separated by comma(,).</div>
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_title',trans('messages.Field Title'),[])!!}
						{!! Form::input('text','field_title','',['class'=>'form-control','placeholder'=>'Enter Field Title'])!!}
					  </div>
					  <div class="form-group">
					   <div class="checkbox">
							<label>
							  <input type="checkbox" name="field_required" value="1"> Required
							</label>
						</div>
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary pull-right']) !!}
	
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@stop
	@section('footer_scripts')

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
    
   </script>
@stop