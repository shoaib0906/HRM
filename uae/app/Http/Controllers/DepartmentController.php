<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Entrust;
use App\Classes\Helper;
use App\Department;
use Activity;
use Config;
use DB;

Class DepartmentController extends Controller{

	protected $form = 'department-form';

	public function index(Department $department){

		if(!Entrust::can('manage_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $departments = $department->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Department Name'),
        		trans('messages.Description'),
        		trans('messages.Designation')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($departments as $department){
        	$des = $department->Designation;

        	$designation_name = "<ol>";
        	foreach($des as $designation)
        		$designation_name .= "<li>$designation->designation</li>";
        	$designation_name .= "</ol>";

			$linkToEdit = "";
			$cols = array(
				'<div class="btn-group btn-group-xs">'.
				'<a href="/department/'.$department->id.'/edit" class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				'<a href="/department/'.$department->id.'/delete" class="btn btn-xs btn-default" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></a> '.
				'</div>',
				$department->department_name,
				$department->department_description,
				$designation_name
				);
			$id = $department->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('department.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('department.create');
	}

	public function edit(Department $department){

		if(!Entrust::can('edit_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$department->id);
		return view('department.edit',compact('department','custom_field_values'));
	}

	public function store(DepartmentRequest $request, Department $department){	

		if(!Entrust::can('create_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$department->fill($data)->save();

		Helper::storeCustomField($this->form,$department->id, $data);

		$activity = 'New department "'.$request->input('department_name').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(DepartmentRequest $request, Department $department){

		if(!Entrust::can('edit_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$department->fill($data)->save();

		Helper::updateCustomField($this->form,$department->id, $data);

		$activity = 'Department "'.$request->input('department_name').'" updated';
		Activity::log($activity);
		
		return redirect('/department')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy($id,Department $department){
		if(!Entrust::can('delete_department'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $id);
	    $department = Department::find($id);
		$department->delete();
		$activity = 'Deleted a Department';
		Activity::log($activity);

        return redirect('/department')->withSuccess(config('constants.DELETED'));
	}
}
?>