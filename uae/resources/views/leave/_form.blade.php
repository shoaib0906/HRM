
			  <div class="form-group">
			    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
			    {!! Form::select('user_id', [null=>'Please select'] + $users, isset($leave->user_id) ? $leave->user_id : Auth::user()->id,['class'=>'form-control select2','id'=>'select21','placeholder'=>'Select User'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('leave_type_id',trans('messages.Leave Type'),['class' => 'control-label'])!!}
			    {!! Form::select('leave_type_id', [''=>''] + $leave_types, isset($leave->leave_type_id) ? $leave->leave_type_id : '',['class'=>'form-control select2me','id'=>'select22','placeholder'=>'Select Leave Type'])!!}
			  	@if(Entrust::hasRole('admin'))
			  	<p class="help-block">{!! trans('messages.To add new leave type') !!} <a href="/configuration#leave">{!! trans('messages.Click here') !!}</a>
			  	@endif
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_date',trans('messages.From Date'),[])!!}
				{!! Form::input('text','from_date',isset($leave->from_date) ? $leave->from_date : '',['class'=>'form-control ','placeholder'=>'Enter From Date','id'=>'rangepicker4','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('to_date',trans('messages.To Date'),[])!!}
				{!! Form::input('text','to_date',isset($leave->to_date) ? $leave->to_date : '',['class'=>'form-control datepicker-input','id'=>'rangepicker5','placeholder'=>'Enter To Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('leave_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('leave_description',isset($leave->leave_description) ? $leave->leave_description : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('leave-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
