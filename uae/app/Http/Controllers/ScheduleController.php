<?php
namespace App\Http\Controllers;
use DB;
use App\Clock;
use Auth;
use Activity;
use Profile;
use Session;
use Entrust;
use Config;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\Holiday;
use App\User;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\AttendanceMonthlyRequest;
use App\Http\Requests\AttendanceUploadRequest;

Class ScheduleController extends Controller{
    public function test_invoice()
    {
        $bal_invoice = DB::table('bal_invoice')->get();
        //dd($bal_invoice);
         $col_data=array();

        $col_heads = array(

               'Invoice',

                'TID',

                'Details',

                'Date',
                'Total',
                'Paid',
                'Balance',
                'Amount');

              



        $token = csrf_token();

        foreach ($bal_invoice as $bal_invoice){

            

            $col_data[] = array(

                    
                   

                    $bal_invoice->invoice,

                    $bal_invoice->tid,

                    $bal_invoice->details,

                    $bal_invoice->date,
                    $bal_invoice->total,

                    $bal_invoice->paid,

                    $bal_invoice->bal,

                    $bal_invoice->amount,

                   

                    );    

            }



        Helper::writeResult($col_data);



        return view('employee.index',compact('col_heads'));
    }
	public function user_det($id)
	{
		$user = DB::table('users')->select('daily_hr_limit','weekly_hour_limit','hour_rate')->where('id','=',$id)->get();

		return 'Daily Hour Limit of this user - <strong>'.$user[0]->daily_hr_limit.' hr/Day</strong> <br/>
				Weekly Hour Limit of this user -<strong>'.$user[0]->weekly_hour_limit.' hr/Week</strong><br/>
				Hourly Rate of this user -<strong>'.$user[0]->hour_rate.' €/hr</strong> <br/>';
	}
	public function month_schedule($monthyear)
	{
		$month=substr($monthyear, 0,3);
		$year=substr($monthyear, 3,4);
		//dd($year);
		if ($month=='Jan')
		{
			$month=1;	
		}
		elseif ($month=='Feb') {
			$month=2;
		}
		elseif ($month=='Mar') {
			$month=3;
		}
		elseif ($month=='Apr') {
			$month=4;
		}
		elseif ($month=='May') {
			$month=5;
		}
		elseif ($month=='Jun') {
			$month=6;
		}
		elseif ($month=='Jul') {
			$month=7;
		}
		elseif ($month=='Aug') {
			$month=8;
		}
		elseif ($month=='Sep') {
			$month=9;
		}
		elseif ($month=='Oct') {
			$month=10;
		}
		elseif ($month=='Nov') {
			$month=11;
		}
		elseif ($month=='Dec') {
			$month=12;
		}
		Session::set('schedule_mon',$month);
		Session::set('schedule_year',$year);
		return redirect('/Schedule');
		
	}
	public function user_wise_schedule($monthyear)
	{
		$month=substr($monthyear, 0,3);
		$year=substr($monthyear, 3,4);
		//dd($year);
		if ($month=='Jan')
		{
			$month=1;	
		}
		elseif ($month=='Feb') {
			$month=2;
		}
		elseif ($month=='Mar') {
			$month=3;
		}
		elseif ($month=='Apr') {
			$month=4;
		}
		elseif ($month=='May') {
			$month=5;
		}
		elseif ($month=='Jun') {
			$month=6;
		}
		elseif ($month=='Jul') {
			$month=7;
		}
		elseif ($month=='Aug') {
			$month=8;
		}
		elseif ($month=='Sep') {
			$month=9;
		}
		elseif ($month=='Oct') {
			$month=10;
		}
		elseif ($month=='Nov') {
			$month=11;
		}
		elseif ($month=='Dec') {
			$month=12;
		}
		Session::set('user_wise_schedule_mm',$month);
		Session::set('user_wise_schedule_yy',$year);
		return redirect('/profile');
		
	}
	public function index(){
		$user=DB::table('users as u')
				->select('u.id','u.first_name','u.last_name','p.hour_per_week','p.hour_per_day')
				->join('profile as p','p.user_id','=','u.id')
				->get();
				
		//dd(Session::get('schedule_mon'));
		if(!empty(Session::get('schedule_mon')))
		{
			$month = Session::get('schedule_mon');
		//$month = "06";
		$year = Session::get('schedule_year');
		}
		else{
		$month = date('m');
		//$month = "06";
		$year = date('Y');
		}
		$start_date = "01-".$month."-".$year;
		$start_time = strtotime($start_date);

		$end_time = strtotime("+1 month", $start_time);

		for($i=$start_time; $i<$end_time; $i+=86400)
		{
		   $list[] = date('D d', $i);
		}
		$i=0;
		foreach ($user as $user) {
			$i=$i+1;
			for($j=$start_time; $j<$end_time; $j+=86400)
				{
					$sch = DB::table('schedule')
							->select('from_time','to_time')
							->where('user_id','=',$user->id)
							->where('date','=',date('Y/m/d',$j))->get();
					//dd($schedule);
					if(!empty($sch)){
					$from_time = $sch[0]->from_time;
					$to_time = $sch[0]->to_time;
					$schedule[$i][] = $from_time.','.$to_time.','.$user->id.','.date('m/d/Y',$j);
					}
					else
					{
				   $schedule[$i][] = ' +'.','.'+'.','.$user->id.','.date('m/d/Y',$j);
					}
					//$schedule[$i][] = '9.00pm 9.00am'.','.$user->id.','.'<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myModal123">+</button>';
				   
				}
			
		}
		$user=DB::table('users as u')
				->select('u.id','u.first_name','u.last_name','p.hour_per_week','p.hour_per_day')
				->join('profile as p','p.user_id','=','u.id')
				->get();
		$first_day = '01-'.$month.'-'.$year ;

		$first_day = date('Y-m-d',strtotime($first_day));
		$last_day  = '31-'.$month.'-'.$year ;
		$last_day = date('Y-m-d',strtotime($last_day));
		foreach ($user as $user_hour) {
			$hour = DB::table('schedule')
							->select('from_time','to_time')
							->where('user_id','=',$user_hour->id)
							->where('date','>=',$first_day)
							->where('date','<=',$last_day)
							->get();
			if(!empty($hour)){
			$from_time = strtotime($hour[0]->from_time);
			$to_time = strtotime($hour->to_time);
			$timeDiff=$to_time-$from_time;
			$user_hour->hour_per_week = $timeDiff;
			}
			
		}
		//dd($user_hour);
		
		if ($month=='01')
		{
			$month='January';	
		}
		elseif ($month=='02') {
			$month='February';
		}
		elseif ($month=='03') {
			$month='March';
		}
		elseif ($month=='04') {
			$month='April';
		}
		elseif ($month=='05') {
			$month='May';
		}
		elseif ($month=='06') {
			$month='June';
		}
		elseif ($month=='07') {
			$month='July';
		}
		elseif ($month=='08') {
			$month='August';
		}
		elseif ($month=='09') {
			$month='September';
		}
		elseif ($month=='10') {
			$month='October';
		}
		elseif ($month=='11') {
			$month='November';
		}
		elseif ($month=='12') {
			$month='December';
		}
		return view('schedule.index')
			->with('schedule',$schedule)
			->with('month',$month)
			->with('year',$year)
			->with('list',$list)->with('user',$user);
	}
	public function store(Request $request)
	{
		$input = $request->all();
		//dd($input);
		
		$user_id = $request->input('user_id');
		$date = $request->input('date');
		//dd($date);
		$time = strtotime($date);
		$date = date('Y-m-d',$time);

		$from_time = $request->input('time1');
		$to_time = $request->input('time2');
		if($request->input('button') == 'save'){
			$count = DB::table('schedule')->where('user_id','=',$user_id)->where('date','=',$date)->count();
			if ($count == 0) {
			DB::table('schedule')->insert(['user_id'=>$user_id,'date'=>$date,'from_time'=>$from_time,'to_time'=>$to_time]);
			}
			else
				DB::table('schedule')->where('user_id','=',$user_id)->where('date','=',$date)->update(['from_time'=>$from_time,'to_time'=>$to_time]);
			return redirect('/Schedule')->withSuccess('Schedule Saved successfully');
		}
		else
		{
			DB::table('schedule')->where('user_id','=',$user_id)->where('date','=',$date)->delete();
			return redirect('/Schedule')->withErrors('Schedule Deleted successfully');
		}

	}
	public function show(){
	}

	public function in($token){
		$date = date('Y-m-d');
    
    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		$clocks = Clock::where('user_id','=',Auth::user()->id)
			->where('date','=',$date)->count();

		if($clocks)
			return redirect('/dashboard')->withErrors('You have already clocked in today. ');

		$clock = new Clock;
		$clock->date = $date;
		$clock->clock_in = date('Y-m-d H:i:s');
		$clock->user_id = Auth::user()->id;
		$clock->save();
		Activity::log('Clocked in');
		return redirect('/dashboard')->withSuccess('You have successfully clocked in. ');
	}

	public function out($token){
		$date = date('Y-m-d');

    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		$clock = Clock::where('user_id','=',AutH::user()->id)
			->where('date','=',$date)
			->where('clock_out','=',null)
			->first();

		if(!$clock)
			return redirect('/dashboard')->withErrors('Either you have not clocked in or you have already clocked out today. ');

		$clock->clock_out = date('Y-m-d H:i:s');
		$clock->save();

		Activity::log('Clocked out');
		return redirect('/dashboard')->withSuccess('You have successfully clocked out. ');
	}

	public function attendance(Request $request){

		if(!Entrust::can('daily_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$date = $request->input('date');
		$date = isset($date) ? $date : date('Y-m-d');

		if(Entrust::can('manage_everyone_attendance'))
			$clocks = Clock::where('date','=',$date)->get();
		else {
			
			if(Entrust::can('manage_subordinate_attendance')){
				$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
				$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
				array_push($child_users, Auth::user()->id);
			} else
				$child_users = array(Auth::user()->id);
			$clocks = Clock::where('date','=',$date)->whereIn('user_id',$child_users)->get();
		}

		$page_title = "Attendance for ".Helper::showDate($date);

        $cols=array();
        $cols_summary=array();
        $col_heads = array(
        		'Employee Name',
        		'Designation',
        		'Department',
        		'Clock in',
        		'Clock out',
        		'Late',
        		'Early Leaving',
        		'Overtime',
        		'Total Work',
        		'Status');
        $clocked_user = array();
        $in_time = $date.' '.config('config.in_time');
        $out_time = $date.' '.config('config.out_time');

        $holiday = Holiday::where('date','=',$date)->count();

        $total_late = 0;
        $total_early = 0;
        $total_overtime = 0;
        $total_working = 0;
		
        $users = User::all();

        if($holiday){
        	$attendance = 'H';
        	$attendance_label = '<span class="badge badge-info">Holiday</span>';
        }
        elseif(!$holiday && $date < date('Y-m-d')){
        	$attendance = 'A';
        	$attendance_label = '<span class="badge badge-danger">Absent</span>';
        }
        else{
        	$attendance = '';
        	$attendance_label = '';
        }

        foreach($users as $user){
        	$name = $user->first_name." ".$user->last_name;
        	$designation = $user->Designation->designation;
        	$department = $user->Designation->Department->department_name;
			if(Entrust::can('manage_everyone_attendance') || 
				(Entrust::can('manage_subordinate_attendance') && in_array($user->id, $child_users)) ||
				Auth::user()->id == $user->id
			){
				$cols[$user->id] = array($name,$designation,$department,'','','','','','',$attendance_label);
        		$cols_summary[$user->id] = $attendance;
			}
        }

		foreach($clocks as $clock){
			$clocked_user[] = $clock->user_id;
			$user = $clock->User;
			$designation = $user->Designation;
			$department = $designation->Department;

			$late = (strtotime($in_time) < strtotime($clock->clock_in)) ? round(abs(strtotime($in_time) - strtotime($clock->clock_in)) / 60,2) : '';
			$early = ($clock->clock_out != null && strtotime($clock->clock_out) < strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
			$overtime = ($clock->clock_out != null && strtotime($clock->clock_out) > strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
			$working = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
			$total = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
			
			$total_late += $late;
			$total_early += $early;
			$total_overtime += $overtime;
			$total_working += $working;

			$cols[$clock->user_id] = array(
					$user->first_name." ".$user->last_name,
					$designation->designation,
					$department->department_name,
					Helper::showTime($clock->clock_in),
					($clock->clock_out != null) ? Helper::showTime($clock->clock_out) : 'Not Yet',
					$late,
					$early,
					$overtime,
					$total,
					'<span class="badge badge-success">Present</span>'
					);	
			$cols_summary[$user->id] = 'P';
		}

		$col_data = array_values($cols);
        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads,
        	'date' => $date,
        	'cols_summary' => array_count_values($cols_summary),
        	'page_title' => $page_title
        	];

		return view('employee.attendance',$data);
	}

	public function attendanceMonthly(){

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
			$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $col_data=array();
        $col_heads = array(
        		'Date',
        		'Clock in',
        		'Clock out',
        		'Late',
        		'Early Leaving',
        		'Total Work');
        Helper::writeResult($col_data);  

		$data = ['users' => $users,
			'col_heads' => $col_heads
        	];

		return view('employee.attendance_monthly',$data);
	}

	public function attendanceMonthlyReport(AttendanceMonthlyRequest $request){

		$user_id = $request->input('user_id');
		$month = $request->input('month');
		$year = $request->input('year');

        $cols=array();
        $cols_summary=array();
        $col_heads = array(
        		'Date',
        		'Clock in',
        		'Clock out',
        		'Late','Early Leaving','Overtime','Total Work','Status');

		$day = $year."-".$month."-1";
		$month_number = date('m',strtotime($day));
		$no_of_days = cal_days_in_month(CAL_GREGORIAN,$month_number,$year);

		$first_day = $year."-".$month_number."-1";
		$last_day = $year."-".$month_number."-".$no_of_days;

		$clocks = Clock::where('user_id','=',$user_id)
			->where('date','>=',$first_day)
			->where('date','<=',$last_day)
			->get();

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
			$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, "(", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $user = User::find($user_id);
        $clocked_user = array();

        for($i = 1; $i <= $no_of_days; $i++){
        	$date = $year."-".$month_number."-".str_pad($i, 2, 0, STR_PAD_LEFT);
        	if($date < date('Y-m-d')){
        		$cols[$date] = array(date('d M Y',strtotime($date)),'','','','','','','<span class="badge badge-danger">Absent</span>');
        		$cols_summary[$date] = 'A';
        	}
        	else{
        		$cols[$date] = array(date('d M Y',strtotime($date)),'','','','','','','');
        		$cols_summary[$date] = '';
        	}
        }

        $holidays = Holiday::where( DB::raw('MONTH(date)'), '=', date('n',strtotime($first_day)) )
            ->where( DB::raw('YEAR(date)'), '=', $year )
            ->orderBy('date','asc')
            ->get();

        foreach($holidays as $holiday){
        	$cols[$holiday->date] = array(date('d M Y',strtotime($holiday->date)),'','','','','','','<span class="badge badge-info">Holiday</span>');
        	$cols_summary[$holiday->date] = 'H';
        }

        $total_late = 0;
        $total_early = 0;
        $total_overtime = 0;
        $total_working = 0;

		foreach($clocks as $clock){
        	$in_time = $clock->date.' '.config('config.in_time');
	        $out_time = $clock->date.' '.config('config.out_time');
			
			$late = (strtotime($in_time) < strtotime($clock->clock_in)) ? round(abs(strtotime($in_time) - strtotime($clock->clock_in)) / 60,2) : '';
	        $early = ($clock->clock_out != null && strtotime($clock->clock_out) < strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
	        $overtime = ($clock->clock_out != null && strtotime($clock->clock_out) > strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
	        $working = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
	        $cols_summary[$clock->date] = 'P';
	        $cols[$clock->date] = array(
					Helper::showDate($clock->date),
					Helper::showTime($clock->clock_in),
					($clock->clock_out != null) ? Helper::showTime($clock->clock_out) : 'Not Yet',
					$late,
					$early,
					$overtime,
					$working,
					'<span class="badge badge-success">Present</span>'
					);	

			$total_late += $late;
			$total_early += $early;
			$total_working += $working;
			$total_overtime += $overtime;
		}

		$col_data = array_values($cols);

        Helper::writeResult($col_data);    

        $col_foots = array(
        			'',
        			'',
        			'',
        			Helper::convertToHoursMins($total_late,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_early,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_overtime,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_working,'%01d hr %01d min'),
        			''
        		);
		$data = [
			'col_heads'=> $col_heads,
			'user_id' => $user_id,
			'month' => $month,
			'year'=>$year,
			'users' => $users,
			'user' => $user,
        	'col_foots' => $col_foots,
        	'cols_summary' => array_count_values($cols_summary)
			];
		return view('employee.attendance_monthly',$data);
	}

	public function updateAttendance(){
		//dd('sdf');
		if(!Entrust::can('update_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
			$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
			//array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, "(", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $assets = ['datetimepicker'];
        return view('employee.update_attendance',compact('users','assets'));
	}

	public function uploadAttendance(AttendanceUploadRequest $request){
		
		if(!Entrust::can('upload_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$filename = uniqid();
		$extension = $request->file('file')->getClientOriginalExtension();
	 	$file = $request->file('file')->move('uploads/attendance',$filename.".".$extension);
	 	$filename_extension = 'uploads/attendance/'.$filename.'.'.$extension;
		$xls_datas = Excel::load($filename_extension, function($reader) { })->toArray();
		if(count($xls_datas) > 0)
		{
			$employees = User::join('profile','profile.user_id','=','users.id')
				->select(DB::raw('users.id AS user_id,employee_code'))
				->lists('user_id','employee_code')->all();

		    $data = array();
		    foreach($xls_datas as $xls_data)
		    {
		      $employee_code = $xls_data['employee_code'];
		      $user_id = (isset($employees[$employee_code])) ? $employees[$employee_code] : NULL;
		      $date = date('Y-m-d',strtotime($xls_data['date']));
		      $clock_in = date('H:i',strtotime($xls_data['clock_in']));
		      $clock_in = date('Y-m-d H:i:s',strtotime($date.' '.$clock_in));
		      $clock_out = date('H:i',strtotime($xls_data['clock_out']));
		      $clock_out = date('Y-m-d H:i:s',strtotime($date.' '.$clock_out));
		      
		      $clock = Clock::where('user_id','=',$user_id)
		      	->where('date','=',$date)
		      	->lists('id');
		      if($user_id != null && !count($clock) && strtotime($clock_in) < strtotime($clock_out))
		      $data[] = array(
		      		'user_id' => $user_id,
		      		'date' => $date,
		      		'clock_in' => $clock_in,
		      		'clock_out' => $clock_out,
		      		'created_at' => date('Y-m-d H:i:s'),
		      		'updated_at' => date('Y-m-d H:i:s')
		      		);
		    }
		    if(count($data))
		    	Clock::insert($data);
		}
		if (File::exists($filename_extension))
			File::delete($filename_extension);

		return redirect('/dashboard')->withSuccess(count($data).' attendance uploaded successfully out of '.count($xls_datas).' attendance.');
	}

	public function updateStaffAttendance(AttendanceRequest $request){
		
		if(!Entrust::can('update_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$clock = Clock::where('user_id','=',$request->input('user_id'))
			->where('date','=',$request->input('date'))
			->first();

		if(!$clock){
			$clock = new Clock;
			$clock->user_id = $request->input('user_id');
		}
		//dd($request->all());
		if($request->input('clock_in') == '' && $request->input('clock_out') == '')
			return redirect()->back()->withInput()->withErrors('Please enter clock in or clock out. ');

		if($request->input('clock_in') == '' && $clock->clock_in == '' && $request->input('clock_out') != '')
			return redirect()->back()->withInput()->withErrors('This user has not clocked in, Please clock in first then clock out.');

		if($request->input('clock_in') == '')
			$clock_in = strtotime($clock->clock_in);
		else
			$clock_in = strtotime($request->input('date')." ".$request->input('clock_in'));

		if($request->input('clock_out') == '')
			$clock_out = isset($clock->clock_out) ? strtotime($clock->clock_out) : NULL;
		else
			$clock_out = strtotime($request->input('date')." ".$request->input('clock_out'));

		if($clock_out != NULL && $clock_in > $clock_out)
			return redirect()->back()->withInput()->withErrors('In time cannot be greater than out time. ');

		$clock->date = date('Y-m-d',strtotime($request->input('date')));
		$clock->clock_in = date('Y-m-d H:i:s',$clock_in);
		$clock->clock_out = isset($clock_out) ? date('Y-m-d H:i:s',$clock_out) : NULL;
		$clock->save();

		return redirect()->back()->withSuccess(config('constants.SAVED'));

	}
}
?>