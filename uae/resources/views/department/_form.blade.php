
			  <div class="form-group">
			    {!! Form::label('department_name',trans('messages.Department Name'),[])!!}
				{!! Form::input('text','department_name',isset($department->department_name) ? $department->department_name : '',['class'=>'form-control','placeholder'=>'Enter Department Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('department_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('department_description',isset($department->department_description) ? $department->department_description : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
			  </div>
			    {{ App\Classes\Helper::getCustomFields('department-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
