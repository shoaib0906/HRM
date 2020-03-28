@extends('admin.layouts.default')


	
	@section('content')
	      <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
	<style type="text/css">
		<style type="text/css">
	.pricing-table {
    margin: 0 10px;
    text-align: center;
    width: 200px!important;
    float: left;
    -webkit-box-shadow: 0 0 15px rgba(0,0,0,0.4);
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
    -webkit-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
}
	.table-list li:before {
    content: none;
    font-family: '';
    color: none;
    
	}
	.select2-results__option{
		color: black;
		font-size: 12px;
	}
	.alert-success {
    color: #fff;
    font-size: 12px;
    background-color: #22ddad;
    border-color: #acf6ac;
}
.alert-danger {
    color: #fff;
    font-size: 12px;
    background-color: #22ddad;
    border-color: #acf6ac;
}
	.schedule_edit{
		/*padding-left: 20px!important;*/
		margin-left: 10px!important;
		display: none;
		background-color: gray;


	}
	.table>tbody>tr>td:hover .schedule_edit {
	   display: block; /* On :hover of div show button */
	   border:1px;
	   opacity: .8;
	}
	.edit_schedule_btn{
	margin: -9px 0px;
	z-index: 1000;
	/*background-color: gray;*/
}
	.img-circle{		
		border-radius: 50%;
	}
	.modal-title{
		color: black;
	}
	.modal-body{
		color: black;
		font-size: 12px;
	}
	.emp-img{
		float: left;
		padding-left: 8px;
		padding-right: 10px;
	}

.pricing-title1 {
    color: #FFF;
    background: #e95846;
    padding: 0px 0px;
    padding-bottom: 5px;
    font-size: 2em;
    text-transform: uppercase;
    text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}
.employee_list {
    color: #FFF;
    width: 100%;
    
    padding: 1px 0;
    font-size: 10px;
    color: black;
    background-color: gray;
}
.employee_list tr{
	padding: 2px;
	margin: 2px;
	border:black;
	border-style: solid;
    border-bottom-style: solid;
}
.clockface .inner {
    width: 22px;
    height: 22px;
    color: black;
    line-height: 22px;
    cursor: default;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.td_emp{
	padding: 3% 0%;
}
.pricing-wrapper {
    
    margin: 5px 5px;

}
table{
	background-color: white;
	color: black;
	border: 1px;
	font-size: 12px;
}
.theader th{
	width: 80px;
	padding: 13px 11px;

}
tr td{

	padding: 5px 1px;

}
.btn-group-sm>.btn, .btn-sm {
    padding: 7px 2px;
    font-size: 12px;
    line-height: 1.0;
    border-radius: 3px;
    margin: 9px  5px;
    background-color: white;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 5px;
    }
.table-buy {
    background: #FFF;
     padding: 0px!important; 
    text-align: left;    
    overflow: scroll;  
}
 .table>tbody>tr>th, .table>thead>tr>th {
    padding: 0px;
    margin: 0px;
    color: gray;

    text-align: center;
    line-height: 3.3;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.table>tbody>tr>td {
    padding: 1px 0px;
    font-size: 7px;
    text-align: center;
    line-height: 390%;
    border-style: solid 1px black;
    vertical-align: center;
    overflow: auto;
    color: black;
    
}

.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 0px; 
    padding-left: 0px; 
}
.row{
	margin: 1px;
}
.btn-group-sm>.btn1, .btn-sm1 {
    padding: 0px 2px;
    font-size: 10px;
    line-height: 1.0;
    border-radius: 0px;
    margin: -10px 0px;
    border:0px;
    background-color: white;
}

	</style>
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
        
    <!--Advence Date Picker-->
     <link href="{{ asset('public/josh/assets/vendors/pickadate/css/default.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/pickadate/css/default.date.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/pickadate/css/default.time.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/josh/assets/vendors/flatpickrCalendar/css/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/josh/assets/vendors/airDatepicker/css/datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    @stop
	    <section class="content-header">
        <h1>Schedule {{$month}}-{{$year}} </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="stopwatch" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Schedule
                </a>
            </li>
        </ol>
    </section>
    <div class="form-group">
					    
					    <div class="row">
							
							<div class="col-xs-6">
								{!! Form::select('year', [''=>''] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control select2','id'=>'select22','placeholder'=>'Select Year'])!!}
							</div>
							<div class="col-xs-6">
								{!! Form::select('month', [''=>''] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select Month'])!!}
							</div>
						</div>
					  </div>

	<div id="schedule">
	<div class=" row">

	<div class=""  >
		
		<div class="col-md-2 col-sm-2 col-lg-2">
			<h1 class="pricing-title">
			 <i class="livicon" data-name="users" data-c="#6CC66C" data-hc="#6CC66C"
               data-size="30" data-loop="true"></i>
			Employee List
			</h1>

			<!-- Lista de Caracteristicas / Propiedades -->
			<table class="employee_list" >
				@foreach($user as $user123)
				<tr>
				<td class="td_emp">
				<div class="emp-img">
				{!! \App\Classes\Helper::getAvatar($user123->id) !!}
				</div>

				<div ><strong>{{$user123->first_name}} </strong>{{$user123->last_name}}<br/><span>{{$user123->hour_per_week}}Hrs/ €0.00</span></div>
				</td>
				</tr>
				@endforeach
				
			</table>
			
			
			
		</div>
		
		
		<div class="col-md-10 col-lg-10 col-sm-10" >
			
			
			<!--<ul class="table-list">
				<li>35 GB <span>De almacenamiento</span></li>
				<li>5 Dominios <span>incluidos</span></li>
				<li>100 GB <span>De transferencia mensual</span></li>
				<li>Base de datos </li>
				<li>Cuentas de correo </li>
				<li>CPanel <span>incluido</span></li>
			</ul>
			 Contratar / Comprar -->
			<div class="">
				<table class="table table-responsive">
				<thead class="theader">
						@foreach($list as $list)
						<th>{{strtoupper($list)}}</th>
						@endforeach
				</thead>
				
					
					<!--<td><button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myModal123">+</button> </td>		-->
					
					
					@foreach($schedule as $array2)
					<tr>
					 @foreach($array2 as $value)
					  <td><?php $time = explode(",",$value) ;
					  			echo $time[0]."\n";
					  			
					  			 ?>
					  		<div class="edit_schedule_btn">
					  		<button type="hidden" id="{{$time[2]}}" class="btn1 btn-sm1 schedule_edit" data-toggle="modal" data-target="#myModal123"
                              data-date="{{$time[3]}}"
                              data-time1="{{$time[0]}}"
                              data-time2="{{$time[1]}}"
                              ><i class="fa fa-pencil"></i></button>
                              </div>
                              <?php $time = explode(",",$value) ;
						  			echo $time[1];
					  			 ?>
					  			 </td>
					  		
					  
					 @endforeach
					 </tr>
					@endforeach
				
				
			</table>
			</div>
		</div>

		
	</div>
	</div>
	</div>
<!-- Modal -->
<div id="myModal123" class="modal fade" role="dialog">
  <div class="modal-dialog">
{!! Form::open(['route' => 'schedule.store','role' => 'form', 'class'=>'designation-form']) !!}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal">Close</button>
        <h4 class="modal-title">Schedule Edit</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Date:</label>
		    <div class="col-sm-6"> 
		      
		      <input type="text" class="form-control" name="date" id="date">
		    </div>
		  </div><br/><br/>
      <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Employee</label>
		    <div class="col-sm-6"> 
		      <select class="form-control select2" id="user_id" name="user_id" >
		      	@foreach($user as $user123)
		      		<option value="{{$user123->id}}">{{$user123->first_name}} {{$user123->last_name}}</option>
		      	@endforeach
		      </select>
		    </div><br/><br/>

		  </div><br/>
        <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">From Time:</label>
		    <div class="col-sm-6"> 
		      <input class="form-control" size="16" id="clockface1" name="time1" type="text" value="" >
		    </div>
		  </div><br/><br/>
		  
        <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">To Time: </label>
		    <div class="col-sm-6"> 
		      <input class="form-control timepicker" type="text" placeholder="Try me..">
                                        <input class="form-control timepicker" type="text" placeholder="Try me..">
		      <input class="form-control" size="16" id="clockface2" name="time2" type="text" value="" ><br/><br/>
		    </div>
		  </div><br/>

        <div class="form-group">
		    <div class="col-sm-6"> 
		      <div  id="details" style="padding:0px;color:red;background-color:;font-size:14px;">
		  	
		  	</div>
		  	
		    </div>
		  </div>
		  
      </div>
      <div class="modal-footer">
      <button type="submit" name="button" value="delete" class="btn btn-danger" ><i class="fa fa-trash"> </i> Delete</button>
      <button type="submit" name="button" value="save" class="btn btn-success" ><i class="fa fa-save"> </i> Save </button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"> </i> Close</button>
      </div>
    </div>
{!! Form::close() !!}
  </div>
</div>
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
    

<!--Advanve Date Picker-->
<script src="{{ asset('public/josh/assets/vendors/pickadate/js/picker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/josh/assets/vendors/pickadate/js/picker.date.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/josh/assets/vendors/pickadate/js/picker.time.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/josh/assets/vendors/airDatepicker/js/datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/josh/assets/vendors/airDatepicker/js/datepicker.en.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('public/josh/assets/vendors/flatpickrCalendar/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/josh/assets/js/pages/custom_datepicker.js') }}" type="text/javascript"></script>

<script type="text/javascript">
	
	$(function() {
    $("#select21").change(function() {
        $value = $('option:selected', this).text() ;
        $year = $('#select22').val();
        //alert($year);
        $value = $value.concat($year);

        //alert($value);
         $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#category_product_code').empty();
            $caterory_in = 0;
            $.ajax({
                url: 'month_schedule/'.concat($value),
                type: 'get',
                contentType: 'application/json',
                data: {_token: CSRF_TOKEN},
                //dataType: 'JSON',
                success: function (data) {

                    //$('#category_product_code').append("<option value="+data+">"+data+"</option>");
                    //$('#schedule').html(data);
                    window.location.reload()
                }
            });
            
    });
});
</script>
<script type="text/javascript">
     $('.schedule_edit').click(function(){
    
    $("#myModal123 #user_id").val( null );
    $("#myModal123 #date").val( null );
    $("#myModal123 #clockface1").val( null );
    $("#myModal123 #clockface2").val( null );

      var id=$(this).attr('id');
      var  date= $(this).attr("data-date");
      var  time1= $(this).attr("data-time1");
      var  time2= $(this).attr("data-time2");

    $("#myModal123 #user_id").val( id );
    $("#myModal123 #date").val( date );
    $("#myModal123 #clockface1").val( time1 );
    $("#myModal123 #clockface2").val( time2 );

     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#category_product_code').empty();
            $caterory_in = 0;
            $.ajax({
                url: 'schedule_details/'.concat(id),
                type: 'get',
                contentType: 'application/json',
                data: {_token: CSRF_TOKEN},
                //dataType: 'JSON',
                success: function (data) {

                    //$('#category_product_code').append("<option value="+data+">"+data+"</option>");
                    $('#details').html(data);

                }
            });

     // window.location.href='product_edit/'.concat(id);
  });
</script>
	@stop
