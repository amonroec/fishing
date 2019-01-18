<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartsController extends Controller
{
    public function create(Request $request) {
    	$form = $request->form;
    	$res = new Cart;
    	$res->user_id = $form['user_id'];
			$res->form_type = $form['form_type'];
			if ($form['form_type'] != 'drive_by') {
				$res->turnaround = $form['turnaround'];
			} else {
				$res->turnaround = $form['turnaround'];
				if ($form['turnaround'] == 'drive_by_1') {
					$res->county = 'Crawford, Franklin, Gasconade, Phelps, Washington';
				} else if ($form['turnaround'] == 'drive_by_2') {
					$res->county = 'Dent, Iron, Jefferson, Lincoln, Maries, Montgomery, Osage, Ste Genevieve, St Charles, St Francois, St Louis, St Louis City, Warren';
				} else if ($form['turnaround'] == 'drive_by_3') {
					$res->county = 'Pike';
				}
			}
			$res->property_owner = $form['property_owner'];
			$res->property_address = $form['property_address'];
			$res->parcel_id = $form['parcel_id'];
			$res->city = $form['city'];
			$res->state = $form['state'];
			$res->zip = $form['zip'];
			$res->zoning = $form['zoning'];
			$res->bedrooms = $form['bedrooms'];
			$res->bathrooms = $form['bathrooms'];
			$res->square_feet = $form['square_feet'];
			$res->lot_size = $form['lot_size'];
			$res->basement = $form['basement'];
			$res->year_built = $form['year_built'];
			$res->condition = $form['condition'];
			$res->pricing = $form['pricing'];
			$res->additional_comments = $form['additional_comments'];
			$res->company = $form['company'];
			$res->branch = $form['branch'];
			$res->company_contact_name = $form['company_contact_name'];
			$res->company_contact_email = $form['company_contact_email'];
			$res->save();
		return $res;
    }

    public function removeCartItem(Request $request) {
    	$value = $request->value;
    	$res = Cart::find($value['id'])->delete();
    	return;
    }

    public function getCart(Request $request) {
    	$id = $request->id;

    	$res = Cart::select()->where('user_id', $id)->get();
    	return $res;
    }
}
