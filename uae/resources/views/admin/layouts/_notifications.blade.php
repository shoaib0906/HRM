@if(Entrust::hasRole('admin'))
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f"
           data-hovercolor="#e9573f" data-size="28"></i>
        <span class="label label-warning">{!! ($header_leave_count) !!}</span>
    </a>
    <ul class=" notifications dropdown-menu drop_notify">
        <li class="dropdown-title">You have {!! ($header_leave_count) !!} Leave Pending</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                    @if(!$header_leave_count)
                    <li class="dropdown-header notif-header">
                        No pending leave
                    </li>
                    @endif
                    @foreach($header_leave as $leave)
                    <li>
                        <i class="livicon danger" data-n="timer" data-s="20" data-c="white"
                           data-hc="white"></i>
                        <strong>{!! $leave->User->first_name !!}</strong>
                        <small class="pull-right">
                            <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                            {!! \App\Classes\Helper::showDateTime($leave->created_at) !!}
                        </small>
                        <p><small>
                                                        {!! $leave->LeaveType->leave_type_name.' 
                                                        From '.\App\Classes\Helper::showDate($leave->from_date).' 
                                                        to '.\App\Classes\Helper::showDate($leave->to_date) !!}</small></p>
                    </li>
                    @endforeach
                
            </ul>
        </li>
        <li class="footer">
            <a href="/leave">View all</a>
        </li>
    </ul>
</li>
@endif