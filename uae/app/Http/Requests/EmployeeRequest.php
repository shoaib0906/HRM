<?php



namespace App\Http\Requests;

use App\Http\Requests\Request;



class EmployeeRequest extends Request

{

    /**

     * Determine if the user is authorized to make this request.

     *

     * @return bool

     */

    public function authorize()

    {

        return true;

    }



    /**

     * Get the validation rules that apply to the request.

     *

     * @return array

     */

    public function rules()

    {

        $employee = $this->route('employee');

        return [

                    'first_name' => 'required',
                    'last_name' => 'required',
					'location_id' => 'required',//by Dev@4489
                    'designation_id' => 'required',
					'payment_mode' => 'required',//by Dev@4489
					'emp_type' => 'required',//by Dev@4489
                    'email' => 'required|unique:users,email,'.$employee->id

                ];

    }

}

