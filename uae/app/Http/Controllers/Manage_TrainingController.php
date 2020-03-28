<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\LeaveStatusRequest;
use DB;
use Entrust;
use App\Leave;
use App\LeaveType;
use App\TrainingType;
use App\User;
use App\Manage_training;
use Config;
use Auth;
use Activity;
use App\Classes\Helper;

Class Manage_TrainingController extends Controller{

	protected $form = 'training-form';

	public function store(Request $request){	
	if(Entrust::can('Employee_Training')){			
			$input=$request->all();
			//dd($input);

			$from_date = date('Y-m-d',strtotime($request->input('from_date')));
			$to_date = date('Y-m-d',strtotime($request->input('end_date')));

			DB::table('training_manage')->insert([
				'user_id'=>$request->input('user_id'),
				'training_id'=>$request->input('leave_type_id'),
				'start_date'=>$from_date,
				'end_date'=>$to_date,
				'duration'=>$request->input('training_duration'),
				'result'=>$request->input('training_result'),
				'description'=>$request->input('training_desc')
				]);	 
			return redirect()->back()->withSuccess('New Training successfully Added for Specific Employee');		
		}
	}
	public function update(Request $request){
	    $input=$request->all();
	    $training_title=$request->input('training_name');
	    $id = $request->input('id');
	    DB::table('training_details')->where('id','=',$id)->update(['training_name'=>$training_title]);
	    return redirect('/training/add')->withSuccess('Training Name successfully Updated');
	}
	public function manage_edit($id,Manage_training $Manage_training)
	{
		$trainging = DB::table('training_manage')
				->select("training_manage.start_date",
							"training_manage.id",
							"training_manage.end_date",
							"training_manage.result",
							"training_manage.duration","users.first_name || users.last_name as name",
							"training_manage.description","training_details.training_name","training_manage.user_id"
							)->where('training_manage.id','=',$id)
				->join('training_details','training_details.id','=','training_manage.training_id')
				->join('users','training_manage.user_id','=','users.id')->get();

		$start_date = date('m/d/Y',strtotime(($trainging[0]->start_date)));
			$end_date = date('m/d/Y',strtotime(($trainging[0]->end_date)));
		
		$trainging[0]->start_date=$start_date;
		$trainging[0]->end_date=$end_date;
		//dd($trainging);
		$users=DB::table('users')->select('first_name','id')->get();
		$trainings =DB::table('training_details')->select('training_name','id')->get();
		//dd($users);
		//$custom_field_values = Helper::getCustomFieldValues($this->form,$trainging[0]->id);
		return view('training.edit_training_master',compact('trainging','custom_field_values'))
				->with('users',$users)->with('trainings',$trainings);
	}
	public function update_traingin(Request $request)
	{
		if(Entrust::can('Employee_Training')){			
			$input=$request->all();
			dd($input);

			$from_date = date('Y-m-d',strtotime($request->input('start_date')));
			$to_date = date('Y-m-d',strtotime($request->input('end_date')));

			DB::table('training_manage')->insert([
				'user_id'=>$request->input('user_id'),
				'training_id'=>$request->input('training_id'),
				'start_date'=>$from_date,
				'end_date'=>$to_date,
				'duration'=>$request->input('duration'),
				'result'=>$request->input('result'),
				'description'=>$request->input('description')
				]);	 
			return redirect()->back()->withSuccess('Training successfully updated for Specific Employee');		
		}
	}
}
?>