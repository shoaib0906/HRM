<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Role;
use App\Designation;
use App\Location;//by Dev@4489
use App\Alias;//by Dev@4489
use App\Http\Requests\RegisterRequest;
use Entrust;
use App\Profile;
use App\Classes\Helper;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getRegister','postRegister']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister()
    {
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(Entrust::can('manage_all_employee'))
            $designations = Designation::lists('designation','id')->all();
        else
            $designations = Helper::childDesignation(Auth::user()->designation_id);
        
        if(Entrust::hasRole('admin'))
            $roles = Role::lists('name','id')->all();
        else
            $roles = Role::where('name','!=','admin')->lists('name','id')->all();
			
		//by Dev@4489
		$locations = Location::lists('location_name','id')->all();
		$alias_list = Alias::lists('alias_name','id')->all();
		////		

        return view('employee.create',compact('designations','roles','locations','alias_list'));
    }

    public function postRegister(RegisterRequest $request, User $user){
        
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));
		$user->location_id = $request->input('location_id');//by Dev@4489
		$user->payment_mode = $request->input('payment_mode');//by Dev@4489
		$user->iban_number = $request->input('iban_number');//by Dev@4489
		$user->emp_type = $request->input('emp_type');//by Dev@4489
		$user->alias_id = $request->input('alias_id');//by Dev@4489
        $user->save();
        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->employee_code = $request->input('employee_code');
        $profile->save();
        $user->attachRole($request->input('role_id'));
        return redirect()->back()->withSuccess('Employee created successfully. ');
    }
    
    protected $username = 'username';
    protected $redirectPath = '/dashboard';
    protected $loginPath = '/login';
      public function destroy($id,User $employee){

    dd($id);

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
