<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon"
                                                                   data-name="gears"
                                                                   data-loop="true" data-color="#42aaca"
                                                                   data-hovercolor="#42aaca"
                                                                   data-size="28"></i>
        <span class="label label-success"></span>
    </a>
    @if(Entrust::hasRole('admin') || Entrust::can('manage_custom_field') || Entrust::can('manage_sms_template') || Entrust::can('manage_template'))
    <ul class="dropdown-menu dropdown-messages pull-right">
        
        @if(Entrust::hasRole('admin'))
                <li><a href="{!! URL::to('/configuration') !!}">{!! trans('messages.Configuration') !!}</a></li>
        @endif
        @if(Entrust::can('manage_custom_field'))
            <li><a href="{!! URL::to('/custom_field') !!}">{!! trans('messages.Custom Fields') !!}</a></li>
        @endif
        @if(Entrust::can('manage_template'))
        <li><a href="{!! URL::to('/template') !!}">{!! trans('messages.Email Template') !!}</a></li>
        @endif
        @if(Entrust::can('manage_sms_template'))
        <li><a href="{!! URL::to('/sms_template') !!}">{!! trans('messages.SMS Template') !!}</a></li>
        @endif
    </ul>
    @endif
</li>
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon"
                                                                   data-name="message-flag"
                                                                   data-loop="true" data-color="#42aaca"
                                                                   data-hovercolor="#42aaca"
                                                                   data-size="28"></i>
        <span class="label label-success">{!! ($header_inbox_count) ? '<span class="label label-danger absolute">'.$header_inbox_count.'</span>' : '' !!}</span>
    </a>
    <ul class="dropdown-menu dropdown-messages pull-right">
        <li class="dropdown-title">{!! ($header_inbox_count) !!} New Messages</li>
        @foreach($header_inbox as $inbox)
                                        <li class="unread">
                                            <a href="{!! URL::to('/message/view/'.$inbox->id.'/'.$token) !!}">
                                                {!! \App\Classes\Helper::getAvatar($inbox->user_id) !!}
                                                <div style="margin-left:75px;">
                                                    <strong>{!! $inbox->name !!}</strong><br />
                                                    <p><i>{!! \App\Classes\Helper::showDateTime($inbox->time) !!}</i><br />
                                                    {!! $inbox->subject !!}</p>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach

                                        @if($header_inbox_count > count($header_inbox))
                                        <li class="dropdown-footer">
                                            <a href="/message">
                                                <i class="fa fa-share"></i> See all messages
                                            </a>
                                        </li>
                                        @endif
        
        <li class="footer">
            <a href="/message">View all</a>
        </li>
    </ul>
</li>