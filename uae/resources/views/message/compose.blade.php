@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Advanced Data Tables
@parent
@stop

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

{{-- Page content --}}
@section('content')


            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary filterable">
                            <div class="panel-heading clearfix  ">
                                <div class="panel-title pull-left">
                                       <div class="caption">
                                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    List of Message's
                                </div>
                                </div>
                            </div>
                            <div class="panel-body table-responsive">
                                <div class="col-md-2">
					<a href="/message/compose" class="btn btn-warning btn-block md-trigger"><i class="fa fa-edit"></i> Compose</a>
					<div class="list-group menu-message">
					  <a href="/message" class="list-group-item active">
						Inbox <strong>({!! $count_inbox !!})</strong>
					  </a>
					  <a href="/message/sent" class="list-group-item">Sent <strong>({!! $count_sent !!})</strong></a>
					</div>
				</div>
				
				
				<div class="col-md-10">
					
					<div class="">
				
					
					<!-- Message table -->
					{!! Form::open(['files'=>'true','route' => 'message.store','role' => 'form', 'class'=>'compose-form']) !!}
						<div class="form-group">
							{!! Form::select('to_user_id', [null=>'Please select'] + $users, '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Staff'])!!}
						</div>
						<div class="form-group">
							{!! Form::input('text','subject','',['class'=>'form-control input-lg','placeholder'=>'Message subject'])!!}
						</div>
						<div class="form-group">
							{!! Form::textarea('content','',['class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
						</div>
						<div class="form-group">
							<input type="file" name="file" id="file" class="btn btn-default" title="Select Attachment">
						</div>
						<div class="row">
							<div class="col-xs-8">
								<button type="submit" class="btn btn-success btn-sm">Send</button>
								<a href="/message/compose" class="btn btn-danger btn-sm">Discard</a>
							</div>
						</div>	

					{!! Form::close() !!}
					<!-- End message table -->
					
				</div>
					
				</div>

                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <!-- /.modal ends here -->
            </section>
            <!-- content -->
    <script type="text/javascript">
        $('button[title="Delete"]').attr('type', 'submit');
    </script>
    @stop

{{-- page level scripts --}}
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
    
    //$('input[title="Delete"]').attr("type", "submit");

    
   </script>

@stop

