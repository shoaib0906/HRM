@extends('admin.layouts.default')



    @section('content')
<style type="text/css">
@media (min-width:961px)  { 
    .row{
        margin-left:0%!important;
        margin-right:0%!important;
    }
 }
.nav-pills{
        background-color: #515763;

    }
 @media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 2400px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
      .row{
        margin-left:10%!important;
        margin-right:10%!important;
        margin-top:0%!important;
    }
}

/* ----------- Retina Screens ----------- */
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 2400px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (min-resolution: 192dpi) { 
      .row{
        margin-left:10%!important;
        margin-right:10%!important;
        margin-top:5%!important;
    }
}
    h4,h3,h5{
        color: white;
        letter-spacing:2px;
    }
    .nav-pills li a{
        color: #01BC8C;
    }
    .form-group .col-md-8{
        background-color:;
        letter-spacing:2px;
    }
    .nav-pills>li>a{
        border-radius: 0px!important;
    }
    .form-group .col-md-4,.form-group .col-md-8{
        padding:0px!important;
        margin:0px!important;
        letter-spacing:2px;
    }
    .col-md-7{
        color:#95A5A6;   
    }
    .col-md-5{
        color:#95A5A6;
    }
    hr{
        
        margin-top:0px;
    }
    .col-md-12 .user-profile-content {
        background-color: #2C3E50!important;
    }
    #basic{
        background-color:#;color:white;font-family: "Times New Roman", Georgia, Serif;
        letter-spacing:1px;font-weight:bold;
    }
    table {
        display: block;
        overflow: scroll;
    }

</style>
            <style>
 
        label {
            font-weight: normal !important;
        }

      
        table.info {
            width: 100%;
            border-spacing: 10px;
            border-collapse: separate;
        }
        table.info_edit {
            width: 100%;
            border-spacing: 0px;
            border-collapse: separate;
        }
        .info {
            background: #16262d;
        }
        table.info td {
            color: #;
            font-size: 11px;
            border: solid 1px #eee; /*eff3f7*/
            padding-left: 1px;
            line-height: 20px;
            vertical-align: middle;
            padding: 1px !important;
            margin: 1px;
        }

        table.info td:first-child, table.info_edit td:first-child {
            color: gray;
            background-color: transparent;
            width: 30%;
            white-space: nowrap;
            padding: 1px;
            border: none;

        }
        table.info td:nth-child(2), table.info_edit td:nth-child(2) {
            color:white;
            background-color: transparent;
            width: 60%;
            white-space: nowrap;
            padding: 1px;
            border: 1px ;
            background-color: #34495E;
        }
        table.info_edit td {
            color: #;
            font-size: 13px;
            padding-left: 3px;
            line-height: 20px;
            vertical-align: middle !important;
            padding: 5px !important;
            margin: 2px;
        }

        tr,td{
            text-align: center;
        }
    </style>
<section class="content-header">
                <!--section starts-->
                <h1>Profile Information</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/dashboard">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    
                </ol>
            </section>
                <div class="row ">

                    <div class="col-sm-12" align="left" >

                        <!-- Begin user profile -->

                        <div class="panel-body text-center user-profile-2" style="background-color:#0484c9;">

                          <div class="col-md-3">
                            <div class="avatar-wrap pull-left" >
                            <br/>
                            <!--<img src="{!! App\Classes\Helper::getAvatar($employee->id) !!}" class="img-circle profile-avatar" alt="User avatar" />-->
                            {!! App\Classes\Helper::getAvatarpro($employee->id) !!}

                            </div>
                           </div>
                            
                            <div class="pull-left " align="left">
                            <h3><strong> {!! $employee->first_name !!} {!! $employee->last_name !!}</strong></h3>
                            <h5> <span class="icon fa fa-briefcase"></span> {!! $employee->Designation->designation." in ".$employee->Designation->Department->department_name!!} {!! trans('messages.Department') !!}</h5>
                            <h5><span class="icon  fa fa-envelope"></span> {!! $employee->email !!}<h5>
                            <h5><span class="icon  fa fa-map-marker"></span> {!!$profile->present_address!!}<h5>
                            

                            {!! ($employee->Profile->date_of_leaving == null) ? '<span class="label label-success">
                            '.trans('messages.active').'</span>' : '<span class="label label-danger">'.trans('messages.in-active').'</span>' !!}
                            </div>
                            

                        </div><!-- End div .box-info -->

                        

                        

                        <!-- Begin user profile -->

                    </div><!-- End div .col-sm-4 -->

                    <div class="clear">
                        <br/>               
                    </div>

                    <div class="" >

                        

                            <!-- Nav tab -->
                            <div class="col-md-3" >
                            <div class="page-sidebar-menu"> 
                            <ul class="nav nav-pills  nav-stacked" style="background-color:#515763;">

                              <li class="active"><a href="#basic" data-toggle="tab"><i class="livicon" data-name="user" data-c="#F89A14" data-hc="#F89A14"
               data-size="18" data-loop="true"></i> Profile</a></li>
                             
                              
                              <li><a href="#bank-account" data-toggle="tab"><i class="livicon" data-name="money" data-c="#6CC66C" data-hc="#6CC66C"
               data-size="18" data-loop="true"></i> Payee Accounts</a></li>

                              <li><a href="#document" data-toggle="tab"><i class="livicon" data-name="doc-landscape" data-c="#EF6F6C" data-hc="#EF6F6C"
               data-size="18" data-loop="true"></i> My Documents</a></li>

                              <!--<li><a href="#salary" data-toggle="tab"><i class="icon fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>-->
                              <li><a href="#Schedule" data-toggle="tab"><i class="livicon" data-name="stopwatch" data-c="#418BCA" data-hc="#418BCA"
               data-size="18" data-loop="true"></i>Schedule</a></li>
                                
                              
                              <li><a href="#mytask" data-toggle="tab"><i class="livicon" data-name="user" data-c="#EF6F6C" data-hc="#EF6F6C"
               data-size="18" data-loop="true"></i> My Tasks</a></li>
                              
                              <li><a href="#mymessage" data-toggle="tab"><i class="livicon" data-name="mail" data-c="#6CC66C" data-hc="#6CC66C"
               data-size="18" data-loop="true"></i> My Messages </a></li>

                              <li><a href="#mytraining" data-toggle="tab"><i class="livicon" data-name="notebook" data-c="#6CC66C" data-hc="#6CC66C"
               data-size="18" data-loop="true"></i> My Trainings</a></li>

                              <!--<li><a href="#salary" data-toggle="tab"><i class="icon fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>-->
                              <li><a href="#myaward" data-toggle="tab"><i class="livicon" data-name="trophy" data-c="#F89A14" data-hc="#F89A14"
               data-size="18" data-loop="true"></i>My Awards</a></li>
                            </ul>
                            </div>
                            </div>
                            <!-- End nav tab -->



                            <!-- Tab panes -->
                            <div class="col-md-9" > 
                            <div class="" >
                            <div class="tab-content">

                            

                                

                                <!-- Tab basic -->

                                <div class="tab-pane animated fadeInRight active" id="basic" style="">

                                

                                    <div class="">

                                        {!! Form::model($employee,['files' => true, 'method' => 'PATCH','action' => ['EmployeeController@profileUpdate',$employee->id] ,'class' => 'employee-form', 'role' => 'form']) !!}
                                            
                                            
                                            <div class="table-responsive col-sm-12" style="background-color:#2C3E50;">
                                                    <div class="col-md-5 table-responsive">       
                                                          <table class="info table" border="1">
                                                            <h4>Personal Info</h4>
                                                            <tbody>
                                                             <tr>
                                                                                <td>Name</td>
                                                                                <td>{!! $employee->first_name !!} {!! $employee->last_name !!}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>D.O.B</td>
                                                                                <td>
                                                                                    {!! $profile->date_of_birth !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Gender</td>
                                                                                <td>{!! $profile->gender !!}</td>
                                                                            </tr>
                                                            </tbody>
                                                          </table>
                                                          </div>
                                                    <div class="col-md-7 table-responsive">        
                                                          <table class="info table" border="1">
                                                            <h4>Contact Info</h4>
                                                            <tbody>
                                                                <tr>
                                                                                    <td> Phone</td>
                                                                                    <td>{!! $profile->contact_number !!}</td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td>Email</td>
                                                                                    <td>{!! $employee->email !!}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Skype</td>
                                                                                    <td>{!! $profile->skypeid !!}</td>
                                                                                </tr>
                                                            </tbody>
                                                          </table>
                                                          </div>
                                                        <div class="col-md-5 table-responsive">          
                                                          <table class="info table" border="1">
                                                            <h4>Address</h4>
                                                            <tbody>
                                                                    <tr>
                                                                                        <td>Address</td>
                                                                                        <td>{!! $profile->present_address !!}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Town/City</td>
                                                                                        <td>
                                                                                            {!! $profile->town !!}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>County</td>
                                                                                        <td>{!! $profile->country !!}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Eircode</td>
                                                                                        <td>{!! $profile->eircode !!}</td>
                                                                                    </tr>
                                                            </tbody>
                                                          </table>
                                                          </div>
                                                          <div class="col-md-7 table-responsive">          
                                                          <table class="info table" border="1">
                                                            <h4>Emergency Info</h4>
                                                            <tbody>
                                                                    <tr>
                                                                                            <td>Next of Kin</td>
                                                                                            <td>{!! $profile->next_kin !!}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <td>Phone</td>
                                                                                            <td>{!! $profile->alternate_contact_number !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Relationship</td>
                                                                                            <td>{!! $profile->relationship !!}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Alt. Email</td>
                                                                                            <td>{!! $profile->alternate_email !!}</td>
                                                                                        </tr>
                                                            </tbody>
                                                          </table>
                                                          </div>
                                                                                  
                                                
                                                

                                            </div>

                                            <div class="col-sm-0" style="background-color:#2C3E50;"><br/>

                                              
                                                
                                            {{ App\Classes\Helper::getCustomFields('employee-form',$custom_field_values) }}

                                            <!--{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}-->
        
                                            </div>

                                        {!! Form::close() !!}
                                        <br/>
                                    </div>
                                    
                                </div>

                                <!-- End Tab basic -->
                                <div class=" tab-pane animated fadeInRight" id="mytask" >

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content" style="background-color:#;">
                                    
                                            <div class="">

                                            <div class="clear"></div>
                                            <h2>List of All Task's</h2>
                                        
                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>Task Title</th>

                                                        <th>Start Date</th>

                                                        <th>Due Date</th>

                                                        <th>Hours</th>

                                                        <th>Progress</th>

                                                        <th>Description</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($tasks as $task)

                                                    <tr>

                                                        <td>{!! $task->task_title !!}</td>

                                                        <td>{!! $task->start_date !!}</td>

                                                        <td>{!! $task->due_date !!}</td>

                                                        <td>{!! $task->hours !!}</td>

                                                        <td>{!! $task->task_progress !!}</td>

                                                        <td>{!! $task->task_description !!}</td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>  
                                        
                                    </div>
                                                

                                        

                                    </div>

                                </div>
                                <div class=" tab-pane animated fadeInRight" id="mytraining" style="background-color:#;color:;font-family: "Times New Roman";">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content" >
                                    
                                            <div class="">

                                            <div class="clear"></div>

                                        <h2>List of all Training</h2>

                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>Training Name</th>

                                                        <th>Start Date</th>

                                                        <th>End Date</th>

                                                        <th>Duration</th>

                                                        <th>Result</th>

                                                        <th>Description</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($training as $training)

                                                    <tr>

                                                        <td>{!! $training->training_name !!}</td>

                                                        <td>{!! $training->start_date !!}</td>

                                                        <td>{!! $training->end_date !!}</td>

                                                        <td>{!! $training->duration !!}</td>

                                                        <td>{!! $training->result !!}</td>

                                                        <td>{!! $training->description !!}</td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>  
                                        
                                    </div>
                                                

                                        

                                    </div>

                                </div>
                                <div class=" tab-pane animated fadeInRight" id="mymessage" style="background-color:#2C3E50;color:;font-family: "Times New Roman";">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content" >
                                    
                                            <div class="">

                                            <div class="clear"></div>

                                        <h2>List of all Messages</h2>
                                        <div class="col-md-12">
                                            
                                                    <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>Send At</th>

                                                        <th>Subject</th>

                                                        <th>From/To</th>

                                                        <th>Attachment</th>

                                                        <th>View</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                @foreach($messages12 as $message)

                                                    <tr>

                                                        <td>{!! date('d M Y, h:i A',strtotime($message->created_at)) !!}</td>

                                                        <td>{!! $message->subject !!}</td>

                                                        <td>{!! $message->full_name !!}</td>

                                                        <td>@if($message->attachment)
                                                                <a href="{!! URL::to('/assets/attachments/'.$message->attachment) !!}"><strong>Download</strong></a>        
                                                                @endif</td>

                                                        <td><a href="{!! URL::to('message/view/'.$message->id.'/'.$token) !!}" class='btn btn-default btn-xs' data-toggle='tooltip' title='View'> <i class='fa fa-share'></i></a></td>

                                                        

                                                    </tr>

                                                    @endforeach
                                                    

                                                </tbody>

                                            </table>
                                                </div>
                                                
                                            
                                        
                                    </div>
                                                

                                        

                                    </div>

                                </div>
                                <div class=" tab-pane animated fadeInRight" id="myaward" style="background-color:#;color:;font-family: "Times New Roman";">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content" >
                                    
                                            <div class="">

                                            <div class="clear"></div>

                                        <h2>List of all Award</h2>

                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>Training Name</th>

                                                        <th>Start Date</th>

                                                        <th>End Date</th>

                                                        <th>Duration</th>

                                                        <th>Result</th>

                                                        <th>Description</th>

                                                    </tr>

                                                </thead>

                                                <tbody>
                                                @foreach($awards as $award)

                                                    <tr>

                                                        <td>{!! $award->award_name !!}</td>

                                                        <td>{!! $award->gift !!}</td>

                                                        <td>{!! $award->cash !!}</td>

                                                        <td>{!! $award->month !!},{!! $award->year !!}</td>

                                                        <td>{!! $award->award_description !!}</td>

                                                        <td>{!! $award->award_date !!}</td>
                                                        

                                                    </tr>

                                                    @endforeach
                                                    

                                                </tbody>

                                            </table>

                                        </div>  
                                        
                                    </div>
                                                

                                        

                                    </div>

                                </div>
                                <!-- Tab bank-account -->

                                <div class="tab-pane animated fadeInRight" id="bank-account">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content">

                                        



                                        <div class="clear"></div>

                                        <h2>{!! trans('messages.List All Bank Accounts') !!}</h2>

                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>{!! trans('messages.Bank Name') !!}</th>

                                                        <th>{!! trans('messages.Account Name') !!}</th>

                                                        <th>{!! trans('messages.Account Number') !!}</th>

                                                        <th>{!! trans('messages.IFSC Code') !!}</th>

                                                        <th>{!! trans('messages.Branch') !!}</th>

                                                        <th>{!! trans('messages.Option') !!}</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($employee->BankAccount as $bankAccount)

                                                    <tr>

                                                        <td>{!! $bankAccount->bank_name !!}</td>

                                                        <td>{!! $bankAccount->account_name !!}</td>

                                                        <td>{!! $bankAccount->account_number !!}</td>

                                                        <td>{!! $bankAccount->ifsc_code !!}</td>

                                                        <td>{!! $bankAccount->bank_branch !!}</td>

                                                        <td>{!! delete_form(['bank_account.destroy',$bankAccount->id]) !!}</td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                                <!-- End Tab bank-account -->
                                
                                <!-- Tab document -->

                                <div class="tab-pane animated fadeInRight" id="document">

                                    

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content">




                                        <div class="clear"></div>

                                        <h2>{!! trans('messages.List All Documents') !!}</h2>

                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>{!! trans('messages.Document Type') !!}</th>

                                                        <th>{!! trans('messages.Title') !!}</th>

                                                        <th>{!! trans('messages.Expiry Date') !!}</th>

                                                        <th>{!! trans('messages.Description') !!}</th>

                                                        <th>{!! trans('messages.File') !!}</th>

                                                        <th>{!! trans('messages.Option') !!}</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($employee->Document as $document)

                                                    <tr>

                                                        <td>{!! $document->DocumentType->document_type_name !!}</td>

                                                        <td>{!! $document->document_title !!}</td>

                                                        <td>{!! App\Classes\Helper::showDate($document->expiry_date) !!}</td>

                                                        <td>{!! $document->document_description !!}</td>

                                                        <td><a target=_blank href="/uploads/document/{!! $document->document !!}">Click here</a></td>

                                                        <td>{!! delete_form(['document.destroy',$document->id]) !!} </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="tab-pane animated fadeInRight" id="Schedule">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content">
                                    
                                        <h2>Schedule:<strong> {{$month}} - {{$year}}</strong></h2>
                                        <hr>
                                        <div class="">
                                             
                                                    
                                                    <div class="col-xs-6">
                                                        {!! Form::select('year', [''=>''] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control select2','id'=>'select21_year','placeholder'=>'Select Year'])!!}
                                                    </div>
                                                    <div class="col-xs-6">
                                                        {!! Form::select('month', [''=>''] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control select2','id'=>'select40','placeholder'=>'Select Month'])!!}<br/>
                                                    </div><br/>
                                            <table class="table table-hover table-striped schedule_table">
                                              
                                               <?php $i=0; ?>
                                                @foreach($schedule as $array2)
                                                
                                                 
                                                  <td>
                                                    <?php $i=$i+1; 
                                                if ($i==32) {
                                                    echo "<tr>";
                                                }
                                                ?>
                                                  <?php $time = explode(",",$array2) ;
                                                            echo '<strong>'.
                                                            date("D",strtotime($time[3])).'</strong><br/>' .date("d-m-y",strtotime($time[3]))         
                                                                    
                                                            .'<hr style="padding:0px;margin:0px;background-color:#0484C9;">'."\n"; 
                                                            echo '<strong>'.$time[0]."-";
                                                            echo $time[1]."\n".'</strong>';
                                                             ?>
                                                      
                                                             </td>
                                                              <?php 
                                                if ($i%7==0) {
                                                    echo "</tr>";
                                                }
                                                ?>
                                                @endforeach
                                                
                                            </table>

                                        </div>

                                    </div>

                                </div>

                                <!-- End Tab asset -->
                                
                                <!-- Tab document -->

                                <div class="tab-pane animated fadeInRight" id="dependent">

                                    <div class="panel  panel-primary filterable col-md-12 user-profile-content">
                                        <div id="dependent-eform">
                                        @if(Input::old('dep_id'))
                                        <h2>{!! trans('messages.Edit Dependent') !!}</h2>
                                        <div align="right"><a href="{!! URL::to('/dependent/add/'.$employee->id) !!}" class='btn btn-xs btn-default dependent_edit'> <i class='fa fa-edit'></i> {!! trans('messages.Add New') !!}</a></div>
                                        @else
                                        <h2>{!! trans('messages.Add New Dependent') !!}</h2>
                                        @endif
                                        {!! Form::open(['files'=>true, 'route' => 'dependent.store','role' => 'form', 'class'=>'dependent-form']) !!}
                                            @include('dependent._form')
                                        {!! Form::close() !!}
                                        </div>



                                        <div class="clear"></div>

                                        <h2>{!! trans('messages.List All Dependents') !!}</h2>

                                        <div class="table-responsive">

                                            <table class="table table-hover table-striped">

                                                <thead>

                                                    <tr>

                                                        <th>{!! trans('messages.Name') !!}</th>

                                                        <th>{!! trans('messages.Relationship') !!}</th>

                                                        <th>{!! trans('messages.Visa Provided by') !!}</th>

                                                        <th>{!! trans('messages.Issue Date') !!}</th>
                                                        <th>{!! trans('messages.Expiry Date') !!}</th>
                                                        <th>{!! trans('messages.File') !!}</th>

                                                        <th>{!! trans('messages.Option') !!}</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($employee->Dependent as $dependent)

                                                    <tr>

                                                        <td>{!! $dependent->name !!}</td>
                                                        <td>{!! $dependent->relation !!}</td>
                                                        <td>{!! $dependent->visa !!}</td>
                                                        <td>{!! App\Classes\Helper::showDate($dependent->issue_date) !!}</td>
                                                        <td>{!! App\Classes\Helper::showDate($dependent->expiry_date) !!}</td>
                                                        <td><a target=_blank href="/uploads/dependent/{!! $dependent->document !!}">Click here</a></td>
                                                        <td>
                                                        <a href="{!! URL::to('/dependent/'.$dependent->id.'/edit') !!}" class='btn btn-xs btn-default dependent_edit'> <i class='fa fa-edit'></i> Edit</a>
                                                        {!! delete_form(['dependent.destroy',$dependent->id]) !!} </td>
                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                                <!-- End Tab document -->

                                

                            </div><!-- End div .tab-content -->
                            </div>
                        </div><!-- End div .box-info -->

                    </div>

                </div>

                

    @stop
    @section('footer_scripts')
    <script type="text/javascript">
    
    $(function() {
    $("#select40").change(function() {
        $value = $('option:selected', this).text() ;
        $year = $('#select21_year').val();
        //alert($year);
        $value = $value.concat($year);

        //alert($value);
         $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#category_product_code').empty();
            $caterory_in = 0;
            $.ajax({
                url: 'user_wise_schedule/'.concat($value),
                type: 'get',
                contentType: 'application/json',
                data: {_token: CSRF_TOKEN},
                //dataType: 'JSON',
                success: function (data) {

                    //$('#category_product_code').append("<option value="+data+">"+data+"</option>");
                    //$('#schedule').html(data);
                    window.location.reload()
                }
            });
            
    });
});
</script>
  @stop