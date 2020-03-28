
			  <div class="form-group">
			    {!! Form::label('title',trans('messages.Title'),[])!!}
				{!! Form::input('text','title',isset($notice->title) ? $notice->title : '',['class'=>'form-control','placeholder'=>'Enter Title'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_date',trans('messages.From Date'),[])!!}
				{!! Form::input('text','from_date',isset($notice->from_date) ? $notice->from_date : '',['class'=>'form-control ','id'=>'rangepicker4','placeholder'=>'Enter From Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('to_date',trans('messages.To Date'),[])!!}
				{!! Form::input('text','to_date',isset($notice->to_date) ? $notice->to_date : '',['class'=>'form-control','id'=>'datetime1','placeholder'=>'Enter To Date'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('designation_id',trans('messages.Designation'),['class' => 'control-label'])!!}
			    {!! Form::select('designation_id[]', $designations, isset($selected_designation) ? $selected_designation : '',['class'=>'form-control demo-default','id'=>'selectize-tags2','placeholder'=>'Select Designation','multiple' => true])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('content',trans('messages.Content'),[])!!}
			    {!! Form::textarea('content',isset($notice->content) ? $notice->content : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Content'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('notice-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
