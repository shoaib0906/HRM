<?php
namespace App;
use Eloquent;

class Emp extends Eloquent {

    protected $fillable = [
                            'emp_status',
                            'emp_email'
                        ];
    protected $primaryKey = 'id';
    protected $table = 'birthday_info';

    /*public function document()
    {
        return $this->hasMany('App\Document'); 
    }*/
}
