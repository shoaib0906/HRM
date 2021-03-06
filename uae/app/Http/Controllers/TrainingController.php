<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\LeaveStatusRequest;
use DB;
use Entrust;
use App\Leave;
use App\LeaveType;
use App\Manage_training;
use App\TrainingType;
use App\User;
use Config;
use Auth;
use Activity;
use App\Classes\Helper;

Class TrainingController extends Controller{

	protected $form = 'leave-form';

	public function edit($id){				
			$training = DB::table('training_details')->where('id','=',$id)->get();	
			return view('training.edit',compact('training'));
	}
	public function manage_training(Request $request){
				if(Entrust::can('Add_Training_Name')){
				$training_title = $request->input('training_title');	
				DB::table('training_details')->insert(['training_name'=>$training_title]);
				return redirect()->back()->withSuccess('New Training successfully Added.');		
			}
	}

	public function store(Request $request){
				if(Entrust::can('Add_Training_Name')){
				$training_title = $request->input('training_title');
				if(isset($training_title) && !empty($training_title)){	
					DB::table('training_details')->insert(['training_name'=>$training_title]);
					return redirect()->back()->withSuccess('New Training successfully Added.');		
				}
				else
				{
					return redirect()->back()->withErrors('Training Name is empty.');		
				}
				
			}
	}
	public function store_123(Request $request)
	{
		$input=$request->all();
		dd($input);
	}
	public function show(Leave $leave){

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('view_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$employee = $leave->User;
		$designation = $employee->Designation;
    	$department = $designation->Department;

    	$other_leaves = Leave::where('id','!=',$leave->id)
    		->where('user_id','=',$leave->user_id)
    		->get();

        $data = [
        	'leave' => $leave,
        	'employee' => $employee,
        	'designation' => $designation,
        	'department' => $department,
        	'other_leaves' => $other_leaves
        	];

		return view('leave.show',$data);
	}

	public function add_new(){
		if(Entrust::can('Employee_Training')){
		if(!Entrust::can('create_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $query = DB::table('users');

        if(!Entrust::hasRole('admin'))
        	$query->where('users.id','=',Auth::user()->id);

        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
        //$leave_types = LeaveType::lists('leave_name','id')->all();
        $leave_types = TrainingType::lists('training_name','id')->all();
        //dd($leave_types);
		return view('training.create',compact('users','leave_types'));
	}
	}
	public function add_training(){
			if(Entrust::can('Add_Training_Name')){					
        $query = DB::table('users');       
        	$query->where('users.id','=',Auth::user()->id);
        $users= $query->join('designations','designations.id','=','users.designation_id')
        	->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
        //$leave_types = LeaveType::lists('leave_name','id')->all();
        $leave_types = db::table('training_details')->select('training_name','id')->get();
        //dd($leave_types);
		return view('training.training_create',compact('users','leave_types'));
	}
	}
	public function report(Manage_training $manage_training){
		if(Entrust::can('Training_Report')){
		
		if(Entrust::hasRole('admin')){
			$leaves = DB::table('training_manage')
				->select("training_manage.start_date",
							"training_manage.id",
							"training_manage.end_date",
							"training_manage.result",
							"training_manage.duration","users.first_name",
							"training_manage.description","training_details.training_name"
							)
				->join('training_details','training_details.id','=','training_manage.training_id')
				->join('users','training_manage.user_id','=','users.id')->get();
			}
		else
		{
			$leaves = DB::table('training_manage')
				->select("training_manage.start_date",
							"training_manage.id",
							"training_manage.end_date",
							"training_manage.result",
							"training_manage.duration","users.first_name || users.last_name as name",
							"training_manage.description","training_details.training_name"
							)->where('training_manage.user_id','=',Auth::user()->id)
				->join('training_details','training_details.id','=','training_manage.training_id')
				->join('users','training_manage.user_id','=','users.id')->get();
				
		}
		
        //dd($leaves);
        $col_data=array();
        $col_heads = array(   
        		trans('messages.Options'),     		
        		trans('messages.Staff Name'),
        		trans('messages.Training Name'),
        		trans('messages.From Date'),
        		trans('messages.To Date'),
        		trans('messages.Training Duration'),
        		trans('messages.Training Result')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);
        //dd($leaves);
        foreach($leaves as $leave){
        	//$employee = $leave->User;
        	//$name = $employee->first_name." ".$employee->last_name;
        	//$leave_type = $leave->LeaveType;
        	//$leave_type_name = $leave_type->leave_name;
        	//$designation = $employee->Designation;
        	//$department = $designation->Department;

			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					
					'<a href="/training_manage/'.$leave->id.'/edit" class="btn btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					'<a href="/training/'.$leave->id.'/delete" class="btn btn-default" data-toggle="tooltip" title="Delete"> <i class=" fa fa-trash"  ></i></a></div> ',
					$leave->first_name,
					$leave->training_name,
					Helper::showDate($leave->start_date),
					Helper::showDate($leave->end_date),
					$leave->duration,
					$leave->result
					
					);	
			$id = $leave->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

		return view('training.report_show',compact('col_heads'));
       } 	
	}

	public function manage(Request $request){	
		if(!Entrust::can('Employee_Training'))
			$input=$request->all();
			dd($input);
		return redirect()->back()->withSuccess('Training Added for the specific Employee');		
	}

	public function update(LeaveRequest $request, Leave $leave){

		$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
		$child_users = User::whereIn('designation_id',$child_designations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($leave->leave_status != 'pending' && $leave->user_id == Auth::user()->id)
			return redirect('leave')->withErrors('This leave cannot be edited. It is either approved or rejected. ');
		
		$user_id = $request->input('user_id');
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$leaves = Leave::where('id','!=',$leave->id)
			->where('user_id','=',$user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date)  {
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query) use($from_date,$to_date)  {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves)
			return redirect()->back()->withErrors('Leave already requested for some of this duration.');
		
		$data = $request->all();
		$leave->fill($data);
		$leave->save();
		Helper::updateCustomField($this->form,$leave->id, $data);

		$activity = 'Updated a leave request';
		Activity::log($activity);
		return redirect('/leave')->withSuccess(config('constants.UPDATED'));
	}

	public function updateStatus(LeaveStatusRequest $request){

		$id = $request->input('id');
		$leave = Leave::find($id);

		if(!$leave)
			return redirect('/leave')->withErrors(config('constants.INVALID_LINK'));

		if(!Entrust::can('edit_leave_status') || $leave->user_id == Auth::user()->id)
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$leave->leave_status = $request->input('leave_status');
		$leave->leave_comment = $request->input('leave_comment');
		$leave->save();

		return redirect()->back()->withSuccess('Leave status updated successfully. ');
	}

	public function destroy($id,Manage_training $Manage_training){
		if(Entrust::can('Add_Training_Name'))
		$Manage_training  = Manage_training::find($id);		
        $Manage_training->delete();

		$activity = 'Deleted a Training';
		Activity::log($activity);
        return redirect()->back()->withSuccess(config('constants.DELETED'));
	}
	
}
?>