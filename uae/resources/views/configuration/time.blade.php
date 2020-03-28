<div class="form-group">
					    {!! Form::label('clock_in',trans('messages.Clock in'),[])!!}
		                <div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="clock_in" data-link-format="HH:ii p">
		                    <input class="form-control" size="16" id="clockface2"  type="text" value="{{config('config.in_time')}}" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						
						{!! Form::input('hidden','in_time',config('config.in_time'),['class'=>'form-control'])!!}
						<br/>
					  </div>
					  <div class="form-group">
					    {!! Form::label('clock_out',trans('messages.Clock out'),[])!!}
		                <div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="clock_out" data-link-format="HH:ii p">
		                    <input class="form-control" size="16" id="clockface1"  type="text" value="{{config('config.out_time')}}" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						{!! Form::input('hidden','out_time',config('config.out_time'),['class'=>'form-control'])!!}<br/>
					  </div>
				
				     






			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}

