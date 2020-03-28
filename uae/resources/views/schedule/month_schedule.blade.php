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

				<div ><strong>{{$user123->first_name}} </strong>{{$user123->last_name}}<br/><span>24.25Hrs/ €0.00</span></div>
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
	