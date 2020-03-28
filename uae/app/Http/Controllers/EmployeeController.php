<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EmployeeRequest;

use App\Http\Requests\EmployeeProfileRequest;

use App\Classes\Helper;

use App\User;

use App\Template;
use App\Task;
use Entrust;

use Auth;
use Session;
use Config;
use App\Award;
use App\SalaryType;

use App\Salary;
use App\Alias;//by Dev@4489
use App\Location;//by Dev@4489
use App\EmployeeAsset;//by Dev@4489

use App\DocumentType;

use Image;

use Activity;

use File;

use Mail;

use DB;


class EmployeeController extends Controller

{

  protected $form = 'employee-form';

  public function profile(User $employee,Award $award){
      //$user = DB::table('users')->where('id','=',Auth::user())->get();
      $user = Auth::user();
      $employee = $user;

       $document_types = DocumentType::lists('document_type_name','id')->all();

      $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();

      $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();

      $salary = Salary::where('user_id','=',$employee->id)

          ->lists('amount','salary_type_id')->all();

      $tasks = Task::whereHas('user', function($q){
          $q->where('user_id','=',Auth::user()->id);
      })->get();

      $training = DB::table('training_manage')->select('training_details.training_name','training_manage.start_date',
                'training_manage.end_date','training_manage.result','training_manage.duration','training_manage.description')
                ->where('user_id','=',Auth::user()->id)
                ->join('training_details','training_details.id','=','training_manage.training_id')
                ->get();
      $awards = $award->with('user')->whereHas('user', function($q){
          $q->where('user_id','=',Auth::user()->id);
      })->join('award_types','award_types.id','=','awards.award_type_id')
      ->get();
      $messages12 = DB::table('messages')
      ->where('to_user_id','=',Auth::user()->id)
      ->where('delete_receiver','=','0')
      ->join('users','users.id','=','messages.from_user_id')
          ->join('designations','designations.id','=','users.designation_id')
          ->join('departments','departments.id','=','designations.department_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", designation, " in ", department_name, " Department)") AS full_name,messages.created_at,messages.subject,messages.id,messages.read,attachment'))
      ->get();
      $token = csrf_token();
      //dd($messages);
      $profile =  $employee->Profile;   
      /*==============*/ 
      /*   Schedule   */
      /*==============*/
      if(!empty(Session::get('user_wise_schedule_mm')))
      {
       $month = Session::get('user_wise_schedule_mm');
        //$month = "06";
        $year = Session::get('user_wise_schedule_yy');
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
    
      for($j=$start_time; $j<$end_time; $j+=86400)
        {
          $sch = DB::table('schedule')
              ->select('from_time','to_time')
              ->where('user_id','=',Auth::user()->id)
              ->where('date','=',date('Y/m/d',$j))->get();
          //dd($schedule);
          if(!empty($sch)){
          $from_time = $sch[0]->from_time;
          $to_time = $sch[0]->to_time;
          $schedule[] = $from_time.','.$to_time.','.Auth::user()->id.','.date('m/d/Y',$j);
          }
          else
          {
           $schedule[] = ' '.','.''.','.Auth::user()->id.','.date('m/d/Y',$j);
          }
          //$schedule[$i][] = '9.00pm 9.00am'.','.$user->id.','.'<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myModal123">+</button>';
           
        }
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
    
    //dd($schedule);
      /* =======================================
      /*=========End of Schedule ==============*/
      /*=======================================*/
      $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);

      return view('employee.profile',compact('month','year','custom_field_values','schedule','token','awards','messages12','training','tasks','employee','salary','profile','document_types','earning_salary_types','deduction_salary_types','employeeassets'));
  }


  public function index(User $employee){



        if(!Entrust::can('manage_employee'))

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(Entrust::can('manage_all_employee'))

          $employees = $employee->get();

        elseif(Entrust::can('manage_subordinate')){

          $childs = Helper::childDesignation(Auth::user()->designation_id,1);

          $employees = $employee->with('roles')->whereIn('designation_id',$childs)->get();

        } else

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        $col_data=array();

        $col_heads = array(

                'Employeements_Action',

             

                trans('messages.First Name'),

                trans('messages.Last Name'),

                trans('messages.Username'),

                trans('messages.Email'),

                trans('messages.Role'),
				trans('messages.Alias'),//by Dev@4489
				trans('messages.Location'),//by Dev@4489				
                trans('messages.Designation'),
				trans('messages.Payment Mode'),
				trans('messages.Employment Type'),
                trans('messages.Status'));



        $token = csrf_token();

        foreach ($employees as $employee){

            foreach($employee->roles as $role)

              $role_name = $role->display_name;

            $designation = $employee->Designation;
			$alias_data = $employee->Alias;
			
			$location = Location::where('id',$employee->location_id)->first();//by Dev@4489
			
            $status = ($employee->Profile->date_of_leaving == null) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">in-active</span>';

            $col_data[] = array(

                    '<div class="btn-group btn-group-xs">'.

                    '<a href="employee/'.$employee->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-user"></i></a> '.

                    '<a href="employee/welcomeEmail/'.$employee->id.'/'.$token.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="Send Welcome Email"> <i class="fa fa-envelope"></i></a>'.
                    '<a href="employee/welcomesms/'.$employee->id.'/'.$token.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="Send Welcome SMS"> 
                    <i class="fa fa-comment-o"></i></a>'.
                    '<a href="employee/'.$employee->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.'<a href="employee/'.$employee->id.'/delete" class="btn btn-default btn-xs" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></a> '.

                    '</div>',

                   

                    $employee->first_name,

                    $employee->last_name,

                    $employee->username,

                    $employee->email,

                    $role_name,
					$alias_data?$alias_data->alias_name:'',//by Dev@4489
					$location?$location->location_name:'',//by Dev@4489

                    $designation->designation,
					$employee->payment_mode,//by Dev@4489
					$employee->emp_type?'Limited('.$employee->emp_type.'M)':'Unlimited',//by Dev@4489

                    $status

                    );    

            }



        Helper::writeResult($col_data);



        return view('employee.index',compact('col_heads'));

  }



  public function show(User $employee){



      if(!Entrust::can('view_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



      $document_types = DocumentType::lists('document_type_name','id')->all();

      $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();

      $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();

      $salary = Salary::where('user_id','=',$employee->id)

          ->lists('amount','salary_type_id')->all();

      

      $profile = $employee->Profile;	  

      $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);

      return view('employee.show',compact('custom_field_values','employee','salary','profile','document_types','earning_salary_types','deduction_salary_types','employeeassets'));

  }



  public function edit(User $employee){

      $child_designations = Helper::childDesignation(Auth::user()->designation_id,1);



      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !in_array($employee->designation_id, $child_designations) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



      if(!Helper::getMode())

          return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



      foreach($employee->roles as $role)

        $role_id = $role->id;



      $query = \App\Designation::whereNotNull('designations.id');



      if(!Entrust::can('manage_all_employee'))

        $query->whereIn('designations.id',$child_designations);



      $designations = $query->join('departments','departments.id','=','designations.department_id')

        ->select(DB::raw('CONCAT(designation, " (", department_name, ")") AS full_designation,designations.id AS designation_id'))

        ->lists('full_designation','designation_id')->all();
		
	  //by Dev@4489
	  $query = \App\Location::whereNotNull('locations.id');
	  $locations = $query->select(DB::raw('location_name,id AS location_id'))
        ->lists('location_name','location_id')->all();
	  $alias_list = Alias::lists('alias_name','id')->all();	
	  ////	



      $roles = \App\Role::lists('display_name','id')->all();



      return view('employee.edit',compact('employee','designations','roles','role_id','locations','alias_list'));

  }



  public function profileUpdate(EmployeeProfileRequest $request, $id){



        $employee = User::find($id);



        if(!$employee)

            return redirect('employee')->withErrors(config('constants.INVALID_LINK'));



        if(!Entrust::can('profile_update_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

            return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(!Helper::getMode())

            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



        Activity::log('Profile updated');

        $profile = $employee->Profile ?: new Profile;

        $photo = $profile->photo;

        $data = $request->all();

        $profile->fill($data);

        if($request->input('date_of_birth') == '')

            $profile->date_of_birth = null;

        if($request->input('date_of_joining') == '')

            $profile->date_of_joining = null;

        if($request->input('date_of_leaving') == '')

            $profile->date_of_leaving = null;



        if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {

            $filename = $request->file('photo')->getClientOriginalName();

            $extension = $request->file('photo')->getClientOriginalExtension();

            $filename = uniqid();

            $file = $request->file('photo')->move('uploads/user/', $filename.".".$extension);

            $img = Image::make('uploads/user/'.$filename.".".$extension);

            $img->resize(200, null, function ($constraint) {

                $constraint->aspectRatio();

            });

            $img->save('uploads/user/'.$filename.".".$extension);

            $profile->photo = $filename.".".$extension;

        } elseif($request->input('remove_photo') == 1){

            File::delete('uploads/user/'.$profile->photo);

            $profile->photo = null;

        }

        else

        $profile->photo = $photo;



        Helper::updateCustomField($this->form,$employee->id, $data);



        $employee->profile()->save($profile);



        return redirect('/employee/'.$id.'/#basic')->withSuccess(config('constants.SAVED'));

  }



  public function update(EmployeeRequest $request, User $employee){

      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(!Helper::getMode())

            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



        $employee->first_name = $request->input('first_name');

        $employee->last_name = $request->input('last_name');

        $employee->email = $request->input('email');

        $employee->designation_id = $request->input('designation_id');
		
		$employee->location_id = $request->input('location_id');//by Dev@4489
		$employee->alias_id = $request->input('alias_id');//by Dev@4489
		$employee->payment_mode = $request->input('payment_mode');//by Dev@4489
		$employee->iban_number = $request->input('iban_number');//by Dev@4489
		$employee->emp_type = $request->input('emp_type');//by Dev@4489



        if(Entrust::hasRole('admin')){

          $roles[] = $request->input('role_id');

          $employee->roles()->sync($roles);

        }

        $employee->save();



        return redirect('/employee')->withSuccess(config('constants.SAVED'));

  }



  public function changePassword(){

      return view('auth.change_password');

  }



  

  public function doChangePassword(Request $request)

  {

    if(!Helper::getMode())

        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



    $this->validate($request, [

            'old_password' => 'required|valid_password',

            'new_password' => 'required|confirmed|different:old_password|min:4',

            'new_password_confirmation' => 'required|different:old_password|same:new_password'

        ]);

        $credentials = $request->only(

                'new_password', 'new_password_confirmation'

        );



        $user = Auth::user();

        

        $user->password = bcrypt($credentials['new_password']);

        $user->save();

        return redirect('change_password')->withSuccess('Password has been changed.');    

  }



  public function doChangeEmployeePassword(Request $request, $id)

  {

    $employee = User::find($id);

        

    if(!Helper::getMode())

        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



    if(!Entrust::can('reset_employee_password') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



    $this->validate($request, [

            'new_password' => 'required|confirmed|min:4',

            'new_password_confirmation' => 'required|same:new_password'

        ]);

        $credentials = $request->only(

                'new_password', 'new_password_confirmation'

        );



        $employee->password = bcrypt($credentials['new_password']);

        $employee->save();

        return redirect()->back()->withSuccess('Password has been changed.');    

  }



  public function destroy($id,User $employee){

    

        if(!Entrust::can('delete_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->designation_id) ))

          return redirect('/dashboard')->withErrors(config('constants.NA'));



        if(!Helper::getMode())

            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));



        if($employee->id == Auth::user()->id)

            return redirect('/employee')->withErrors('You cannot delete yourself. ');

		$empasset = DB::select( DB::raw("SELECT status FROM  employeeasset WHERE employee_id = ".(int)$id));
		if($empasset) return redirect('/configuration#asset')->withErrors("Employee have Assets.");

        Helper::deleteCustomField($this->form, $id);
        $employee = User::find($id);
        $employee->delete();

        return redirect('/employee')->withSuccess(config('constants.DELETED'));

  }

}