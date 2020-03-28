<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
        <link rel="shortcut icon" href="{!! URL::to('assets/img/favicon.ico') !!}">
    <title>{!! config('config.application_title') ? : config('constants.ITEM_NAME') !!}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/third/pnotify/pnotify.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/josh/assets/css/pages/only_dashboard.css') }}"/>
    <link href="{{ asset('public/josh/assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    @yield('header_styles')
    <style type="text/css">
        .nav-pills{
            border-radius: 0px!important;
        }
        .content-header{
            min-height: 700px;
            border: none;
        }
        
        ::-webkit-scrollbar {
    width: 4px;
    height: 5px;
}
::-webkit-scrollbar-button {
    background: #
}
::-webkit-scrollbar-track-piece {
    background: #
}
::-webkit-scrollbar-thumb {
    background: green;
}​

    </style>
            <!--end of page level css-->


<body class="skin-josh">
<header class="header">
    <a href="{{url('dashboard')}}" class="logo" style="padding-left:0px;">
         <h3>{!! config('config.application_name') !!}</h3>
        
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @include('admin.layouts._messages')
                @include('admin.layouts._notifications')
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(1)
                            {!! \App\Classes\Helper::getAvatar(Auth::user()->id) !!}
                        @else
                            <img src="{!! asset('public/josh/assets/img/authors/avatar3.jpg') !!} " width="35"
                                 class="img-circle img-responsive pull-left" height="35" alt="riot">
                        @endif
                        <div class="riot">
                            <div>
                                <p class="user_name_max">{!! Auth::user()->first_name!!} {!! Auth::user()->last_name !!}</p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(1)
                                {!! \App\Classes\Helper::getAvatar1(Auth::user()->id) !!}
                            @else
                                <img src="{!! asset('public/josh/assets/img/authors/avatar3.jpg') !!}"
                                     class="img-responsive img-circle" alt="User Image">
                            @endif
                            <p class="topprofiletext">{!! Auth::user()->first_name!!} {!! Auth::user()->last_name !!}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="{{url('profile')}}">
                                <i class="livicon" data-name="user" data-s="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
                                My Profile
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="{{url('change_password')}}">
                                <i class="livicon" data-name="gears" data-s="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
                                Password Settings
                            </a>
                        </li><br>
                        <li>
                            <a href="{{url('logout')}}">
                                <i class="livicon" data-name="sign-out" data-s="18" data-c="red" data-hc="red"
               data-loop="true"></i>
                                Logout
                            </a>
                        </li>
                        <!-- Menu Footer-->
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left" >
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas" >
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                    <li>
                            <a href="{!! URL::to('/employee') !!}">
                                <i class="livicon" data-name="users" title="Employee's" data-loop="true"
                                   data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('message') }}">
                                <i class="livicon" data-name="mail" title="Send Message" data-loop="true"
                                   data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('notice') }}">
                                <i class="livicon" data-name="pin-on" title="Notice List" data-loop="true"
                                   data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('ticket') }}">
                                <i class="livicon" data-name="medal" title="Ticket's" data-loop="true"
                                   data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layouts._left_menu')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">
          <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header alert-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title ">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <h5><strong>Are you sure to remove parmanently ?</strong></h5>
                </div>
                <div class="modal-footer alert-success">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>

        </div>
    </div>
        <!-- Notifications -->
        @include('notifications')
        
                <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
<!--<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="top">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>-->
<div class="footer">
        <p class="pull-right">{!! config('config.credit') !!}</p>
        </div>
<!-- global js -->


<script src="{{ asset('public/josh/assets/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/third/pnotify/pnotify.custom.min.js')}}"></script>
<script src="https://raw.githubusercontent.com/mistic100/Bootstrap-Confirmation/master/bootstrap-confirmation.min.js"></script>
@yield('footer_scripts')


</body>
<script type="text/javascript">   
$("#rangepicker5").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
</script>

</html>
