<?php
namespace App;
use Eloquent;

class Profile extends Eloquent {

	protected $fillable = [
							'employee_code',
							'contact_number',
							'date_of_birth',
							'father_name',
							'mother_name',
							'date_of_joining',
							'date_of_leaving',
							'relationship',
							'next_kin',
							'alternate_contact_number',
							'alternate_email',
							'present_address',
							'permanent_address',
							'town',
							'country',
							'eircode',
							'skypeid',
							'gender',
							'photo',
							'facebook_link',
							'twitter_link',
							'blogger_link',
							'linkedin_link',
							'googleplus_link',
							'user_id',
							'hour_per_day',
							'hour_per_week'
						];
	protected $primaryKey = 'id';
	protected $table = 'profile';

	public function user() {
    	return $this->belongsTo('App\User');
	}

}
