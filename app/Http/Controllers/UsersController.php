<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;

class UsersController extends Controller
{
    public function fetchUser(Request $request) {
    	$user = User::find($request->user);
    	$emailCheck = substr($user->email, strpos($user->email, "@") + 1);
    	if ($emailCheck) {
	   //  	$res = Customer::select()->where('email_domain', $emailCheck)->first();
	   //  	if ($res) {
	   //  		$obj = (object)[];
	   //  		$obj->admin = $user['admin'];
	   //  		$obj->created_at = $user['created_at'];
	   //  		$obj->email = $user['email'];
	   //  		$obj->id = $user['id'];
	   //  		$obj->name = $user['name'];
	   //  		$obj->photo_url = $user['photo_url'];
	   //  		$obj->updated_at = $user['updated_at'];
	   //  		$obj->is_customer = 'yes';
	   //  		$obj->company = $res->company;
	   //  		$obj->branch = $res->branch;
				// $obj->company_contact_name = $res->company_contact_name;
				// $obj->company_contact_email = $res->company_contact_email;
	   //  		$obj->customer_domain = $res->email_domain;
	   //  		$obj->customer_name = $res->name;
	   //  		$obj->pricing_standard = $res->pricing_standard;
	   //  		$obj->pricing_rush = $res->pricing_rush;
	   //  		$obj->pricing_drive_by_1 = $res->pricing_drive_by_1;
	   //  		$obj->pricing_drive_by_2 = $res->pricing_drive_by_2;
	   //  		$obj->pricing_drive_by_3 = $res->pricing_drive_by_3;
	   //  		$obj->pricing_comps_only = $res->pricing_comps_only;
	   //  		$obj->bill_to_user_id = $res->bill_to_user_id;
	   //  		$obj->bill_to_user_name = $res->bill_to_user_name;
	   //  		$obj->bill_to_address = $res->bill_to_address;
	   //  		$obj->bill_to_city = $res->bill_to_city;
	   //  		$obj->bill_to_state = $res->bill_to_state;
	   //  		$obj->bill_to_zip_code = $res->bill_to_zip_code;
	   //  		return json_encode($obj);
	   //  	} else {
	   //  		$obj = (object)[];
	   //  		$obj->admin = $user['admin'];
	   //  		$obj->created_at = $user['created_at'];
	   //  		$obj->email = $user['email'];
	   //  		$obj->id = $user['id'];
	   //  		$obj->name = $user['name'];
	   //  		$obj->photo_url = $user['photo_url'];
	   //  		$obj->updated_at = $user['updated_at'];
	   //  		$obj->is_customer = 'no';
	   //  		return json_encode($obj);
	   //  	}
    		return $user;
	    } else {
	    	return 'false';
	    }
    }
}
