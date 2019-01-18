<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
		public function getCustomers(Request $request) {
			$res = Customer::all();
			if ($res) {
				return $res;
			} else {
				return $res;
			}
		}

    public function addNewCustomer(Request $request) {
    	$customer = $request->customer;

    	$res = new Customer;
    	$res->name = $customer['name'];
    	$res->email_domain = $customer['email_domain'];
    	$res->pricing_standard = $customer['pricing_standard'];
    	$res->pricing_rush = $customer['pricing_rush'];
    	$res->pricing_drive_by_1 = $customer['pricing_drive_by_1'];
    	$res->pricing_drive_by_2 = $customer['pricing_drive_by_2'];
    	$res->pricing_drive_by_3 = $customer['pricing_drive_by_3'];
    	$res->pricing_comps_only = $customer['pricing_comps_only'];
    	$res->save();

    	return $res;
    }

    public function saveCustomer(Request $request) {
    	$customer = $request->customer;
    	$res = Customer::find($customer['id']);
    	$res->name = $customer['name'];
    	$res->email_domain = $customer['email_domain'];
    	$res->pricing_standard = $customer['pricing_standard'];
    	$res->pricing_rush = $customer['pricing_rush'];
    	$res->pricing_drive_by_1 = $customer['pricing_drive_by_1'];
    	$res->pricing_drive_by_2 = $customer['pricing_drive_by_2'];
    	$res->pricing_drive_by_3 = $customer['pricing_drive_by_3'];
    	$res->pricing_comps_only = $customer['pricing_comps_only'];
    	$res->save();

    	if ($res) {
    		return $res;
    	}
    }

    public function getCompanies(Request $request) {
        $comp = [];
        $email = [];
        $res = Customer::all();
        foreach($res as $out) {
            $obj = (object)['company' => $out->company, 'company_contact_email' => $out->company_contact_email];
            array_push($comp, $obj);
        }
        return json_encode($comp);
    }
}
