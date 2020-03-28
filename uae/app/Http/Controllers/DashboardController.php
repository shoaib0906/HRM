<?php



namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

use DB;

use Auth;
use App\Leave;
use Entrust;

use App\Clock;

use App\User;

use App\Department;

use App\Designation;

use App\Task;

use App\Holiday;

use App\Todo;
use App\Document;//by Dev@4489
use App\Dependent;//by Dev@4489
use App\Classes\Helper;



class DashboardController extends Controller

{



   public function index(){



 $clock = Clock::where('user_id','=',Auth::user()->id)

            ->where('date','=',date('Y-m-d'))

            ->first();

        $user_count = User::count();

        $dept_count = Department::count();

        $task_count = Task::where('task_progress','<',100)->count();

        $present_count =  DB::table('schedule')->where('date','=',date('Y-m-d'))->count();

        $employee = User::find(Auth::user()->id);



        for($i=6;$i>=0;$i--){

            $day = date('Y-m-d', strtotime('-'.$i.' days'));
            $day123 = '"'.$day.'"';

            $present = Clock::where('date','=',$day)->count();

            $absent = $user_count-$present;

            $dayw = date('d M Y',strtotime($day));
            $dayw = '"'.$dayw.'"';
            //$graph_data[] = "{ y:'$day',a:$present,b:$absent}";


            $graph_data[] = "[$day123,$present]";
        }

        $graph_data = implode(',',$graph_data);
        
        $graph_data = ("[".$graph_data."]");//[["Jan", 5],["Feb", 8],["Mar", 6],["Apr", 9],["May", 6],["Jun", 8],["Jul", 6],["Aug", 5],["Sep", 8],["Oct", 6],["Nov", 9],["Dec", 6]];//($graph_data);
        $graph_data = $graph_data;// [["16",0],["17",1],["18",0],["19",1],["20",0],["21",1],["22",1]];
        //dd($graph_data);

        if(Entrust::hasRole('admin'))

        $tasks = Task::where('task_progress','<',100)->get();

        else

        $tasks = Task::where('task_progress','<',100)->whereHas('user', function($q){

                $q->where('user_id','=',Auth::user()->id);

            })->get();

        if(!$clock)

            $clock_status = 'NA';

        elseif($clock->clock_out == null)

            $clock_status = 'IN';

        else

            $clock_status = 'OUT';



        $notices = \App\Notice::with('designation')->where('from_date','<=',date('Y-m-d'))

                ->where('to_date','>=',date('Y-m-d'))->whereHas('designation',function($query) {

                    $query->where('designation_id','=',Auth::user()->designation_id);

                })->get();



        $users = User::join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name," ",last_name," ",designation," (",department_name,")") AS name,username'))

            ->lists('name','username');

        

        $query = DB::table('activity_log')

            ->join('users','users.id','=','activity_log.user_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name) AS employee_name,activity_log.created_at AS created_at,text,user_id'));

        $child_designation = Helper::childDesignation(Auth::user()->designation_id,1);

        $child_staff_count = User::whereIn('designation_id',$child_designation)->count();

        $child_users = User::whereIn('designation_id',$child_designation)->lists('id')->all();

        array_push($child_users,Auth::user()->id);

        if(!Entrust::hasRole('admin'))

            $query->whereIn('user_id',$child_users);

        $activities = $query->latest()->limit(100)->get();

        $compose_users = DB::table('users')

            ->where('users.id','!=',Auth::user()->id)

            ->join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))

            ->lists('full_name','user_id');



        $birthdays = DB::table('profile')

            ->join('users','users.id','=','profile.user_id')

            ->join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->where('date_of_birth','!=','null')

            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS name,users.id AS user_id,profile.date_of_birth'))

            ->orderBy('date_of_birth','asc')

            ->get();



        $holidays = Holiday::all();

        $todos = Todo::where('user_id','=',Auth::user()->id)

            ->orWhere(function ($query)  {

                $query->where('user_id','!=',Auth::user()->id)

                    ->where('visibility','=','public');

            })->get();

        $leaves = Leave::where('leave_status','=','approved')->get();

        $events = array();
        
        foreach($leaves as $leaves){
            $employee = $leaves->User;
            $name = $employee->first_name." ".$employee->last_name;
            $leave_type = $leaves->LeaveType;
            $leave_type_name = $leave_type->leave_name;
            $color = $leave_type->color;
            /*
            if (($leaves->to_date > $leaves->from_date)) {

                while ( $leaves->from_date <= $leaves->to_date  ) {
                        
                    

                    $start = $leaves->from_date;

                    $title = 'Leave: '. $name .' on '.$leave_type_name;

                    $color = '#67C5DF';

                    $events[] = array('title' => $title, 'start' => $start, 'backgroundColor' => $color);

                    $leaves->from_date=date('Y-m-d', strtotime($leaves->from_date. ' + 1 days'));
                }
            
            }
            else*/
            {
                $start = $leaves->from_date . " 00:00:00";
                $end = $leaves->to_date . " 23:59:59";

                $title = 'Leave: '. $name .' on '.$leave_type_name;

                $events[] = array('title' => $title, 'start' => $start,'end'=>$end, 'backgroundColor' => $color);   
            }
        }
        
        

        foreach($holidays as $holiday){

            $start = $holiday->date;

            $title = 'Holiday: '.$holiday->holiday_description;

            $color = '#418BCA';

            $events[] = array('title' => $title, 'start' => $start, 'backgroundColor' => $color);

        }
        //dd($events);
        /*foreach($todos as $todo){

            $start = $todo->date;

            $title = 'To do: '.$todo->todo_title.' '.$todo->todo_description;

            $color = '#ff0000';

            $url = '/todo/'.$todo->id.'/edit';

            $events[] = array('title' => $title, 'start' => $start, 'color' => $color);

        }*/
        //dd($events);


        $tree = array();

        $designations = Designation::all();

        foreach ($designations as $designation){

            $tree[$designation->id] = array(

                'parent_id' => $designation->top_designation_id,

                'name' => $designation->designation.' ('.$designation->Department->department_name.')'

            );

        }
        //by Dev@4489
        //Expire Documents before 30days
        $exdate = date('Y-m-d');
        $docexpire_count = Document::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
        $empdepend_expire_count = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
        $expire_count=$docexpire_count+$empdepend_expire_count;
        
        $assets = ['graph','calendar'];

        return view('admin.index',compact(

            'assets','clock_status','user_count','dept_count','task_count','present_count','expire_count',

            'activities','employee','compose_users','graph_data','tasks','notices',

            'birthdays','holidays','users','events','tree','child_staff_count'

            ));

   }
   public function josh(){



        $clock = Clock::where('user_id','=',Auth::user()->id)

            ->where('date','=',date('Y-m-d'))

            ->first();

        $user_count = User::count();

        $dept_count = Department::count();

        $task_count = Task::where('task_progress','<',100)->count();

        $present_count = Clock::where('date','=',date('Y-m-d'))->count();

        $employee = User::find(Auth::user()->id);



        for($i=6;$i>=0;$i--){

            $day = date('M', strtotime('-'.$i.' days'));

            $present = Clock::where('date','=',$day)->count();

            $absent = $user_count-$present;

            $dayw = date('d M Y',strtotime($day));

            //$graph_data[] = "{ y:'$day',a:$present,b:$absent}";
            $graph_data[] = " [$day : $absent]";
        }

        $graph_data = implode(',',$graph_data);
        //[["Jan", 5],["Feb", 8],["Mar", 6],["Apr", 9],["May", 6],["Jun", 8],["Jul", 6],["Aug", 5],["Sep", 8],["Oct", 6],["Nov", 9],["Dec", 6]];
        $graph_data = ($graph_data);

        dd($graph_data);

        if(Entrust::hasRole('admin'))

        $tasks = Task::where('task_progress','<',100)->get();

        else

        $tasks = Task::where('task_progress','<',100)->whereHas('user', function($q){

                $q->where('user_id','=',Auth::user()->id);

            })->get();

        if(!$clock)

            $clock_status = 'NA';

        elseif($clock->clock_out == null)

            $clock_status = 'IN';

        else

            $clock_status = 'OUT';



        $notices = \App\Notice::with('designation')->where('from_date','<=',date('Y-m-d'))

                ->where('to_date','>=',date('Y-m-d'))->whereHas('designation',function($query) {

                    $query->where('designation_id','=',Auth::user()->designation_id);

                })->get();



        $users = User::join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name," ",last_name," ",designation," (",department_name,")") AS name,username'))

            ->lists('name','username');

        

        $query = DB::table('activity_log')

            ->join('users','users.id','=','activity_log.user_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name) AS employee_name,activity_log.created_at AS created_at,text,user_id'));

        $child_designation = Helper::childDesignation(Auth::user()->designation_id,1);

        $child_staff_count = User::whereIn('designation_id',$child_designation)->count();

        $child_users = User::whereIn('designation_id',$child_designation)->lists('id')->all();

        array_push($child_users,Auth::user()->id);

        if(!Entrust::hasRole('admin'))

            $query->whereIn('user_id',$child_users);

        $activities = $query->latest()->limit(100)->get();

        $compose_users = DB::table('users')

            ->where('users.id','!=',Auth::user()->id)

            ->join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))

            ->lists('full_name','user_id');



        $birthdays = DB::table('profile')

            ->join('users','users.id','=','profile.user_id')

            ->join('designations','designations.id','=','users.designation_id')

            ->join('departments','departments.id','=','designations.department_id')

            ->where('date_of_birth','!=','null')

            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS name,users.id AS user_id,profile.date_of_birth'))

            ->orderBy('date_of_birth','asc')

            ->get();



        $holidays = Holiday::all();

        $todos = Todo::where('user_id','=',Auth::user()->id)

            ->orWhere(function ($query)  {

                $query->where('user_id','!=',Auth::user()->id)

                    ->where('visibility','=','public');

            })->get();

        $leaves = Leave::where('leave_status','=','approved')->get();

        $events = array();
        
        foreach($leaves as $leaves){
            $employee = $leaves->User;
            $name = $employee->first_name." ".$employee->last_name;
            $leave_type = $leaves->LeaveType;
            $leave_type_name = $leave_type->leave_name;
            /*
            if (($leaves->to_date > $leaves->from_date)) {

                while ( $leaves->from_date <= $leaves->to_date  ) {
                        
                    

                    $start = $leaves->from_date;

                    $title = 'Leave: '. $name .' on '.$leave_type_name;

                    $color = '#67C5DF';

                    $events[] = array('title' => $title, 'start' => $start, 'backgroundColor' => $color);

                    $leaves->from_date=date('Y-m-d', strtotime($leaves->from_date. ' + 1 days'));
                }
            
            }
            else*/
            {
                $start = $leaves->from_date;

                $title = 'Leave: '. $name .' on '.$leave_type_name;

                $color = '#67C5DF';

                $events[] = array('title' => $title, 'start' => $start, 'backgroundColor' => $color);   
            }
        }
        
        

        foreach($holidays as $holiday){

            $start = $holiday->date;

            $title = 'Holiday: '.$holiday->holiday_description;

            $color = '#418BCA';

            $events[] = array('title' => $title, 'start' => $start, 'backgroundColor' => $color);

        }
        //dd($events);
        /*foreach($todos as $todo){

            $start = $todo->date;

            $title = 'To do: '.$todo->todo_title.' '.$todo->todo_description;

            $color = '#ff0000';

            $url = '/todo/'.$todo->id.'/edit';

            $events[] = array('title' => $title, 'start' => $start, 'color' => $color);

        }*/
        //dd($events);


        $tree = array();

        $designations = Designation::all();

        foreach ($designations as $designation){

            $tree[$designation->id] = array(

                'parent_id' => $designation->top_designation_id,

                'name' => $designation->designation.' ('.$designation->Department->department_name.')'

            );

        }
        //by Dev@4489
        //Expire Documents before 30days
        $exdate = date('Y-m-d');
        $docexpire_count = Document::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
        $empdepend_expire_count = Dependent::whereRaw("(expiry_date - INTERVAL 30 DAY)<='".$exdate."'")->count();
        $expire_count=$docexpire_count+$empdepend_expire_count;
        
        $assets = ['graph','calendar'];

        return view('admin.index',compact(

            'assets','clock_status','user_count','dept_count','task_count','present_count','expire_count',

            'activities','employee','compose_users','graph_data','tasks','notices',

            'birthdays','holidays','users','events','tree','child_staff_count'

            ));

   }
}