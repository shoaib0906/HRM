<?php
namespace App;
use Eloquent;

class Department extends Eloquent {

	protected $fillable = [
							'department_name',
							'department_description'
						];
	protected $primaryKey = 'id';
	protected $table = 'departments';

	protected  function designation(){
        return $this->hasMany('App\Designation','department_id','id');
    }

}
