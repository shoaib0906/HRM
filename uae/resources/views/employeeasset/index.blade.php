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
                                    <i class="livicon" data-name="piggybank" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Compnay Assest's
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




