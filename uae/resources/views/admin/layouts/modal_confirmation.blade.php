<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">@lang($model.'/modal.title')</h4>
</div>
<div class="modal-body">
{!! Session::get('errors')->First() !!}
              {!! Session::get('success') !!}
{!! Session::get('status') !!}
    @if($error)
        <div>{!! dd($error) !!}

        </div>
    @else
        @lang($model.'/modal.body')
    @endif
   
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang($model.'/modal.cancel')</button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-danger">@lang($model.'/modal.confirm')</a>
  @endif
</div>
