
			  <div class="form-group">
			    {!! Form::label('task_title',trans('messages.Title'),[])!!}
				{!! Form::input('text','training_title',isset($task->task_title) ? $task->task_title : '',['class'=>'form-control',
				'placeholder'=>'Enter Training Title'])!!}
			  </div>
			  
			  
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
