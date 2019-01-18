<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Form;
use App\User;
use App\Cart;
use Stripe;
use Illuminate\Support\Facades\DB;
use Storage;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerMail;

class OrdersController extends Controller
{
    public function orderCart(Request $request) {
    	$userId = $request->user_id;
    	$data = $request->data;
    	$billing = $request->billing;
    	$card = $request->card;

    	// if ($billing['payment_type'] == 'Credit/Debit') {
    	// 	\Stripe\Stripe::setApiKey ( 'sk_test_ZUuuUgd0YaHQjYLTOG4EX6ie' );
		   //  try {
		   //      \Stripe\Charge::create ( array (
		   //              "amount" => 300 * 100,
		   //              "currency" => "usd",
		   //              "source" => "", // obtained with Stripe.js
		   //              "description" => "Test payment." 
		   //      ) );
		   //      // Session::flash ( 'success-message', 'Payment done successfully !' );
		   //      // return Redirect::back ();
		   //  } catch ( Exception $e ) {
		   //      return 'error-credit';
		   //  }
    	// }

    	if ($userId != 'guest') {
    		$user = User::find($userId);
    	}
    	$forms = [];
    	$price = 0;
    	foreach($data as $out) {
    		$res = new Form;
    		if ($userId != 'guest') {
	    		$res->user_id = $userId;
	    	}
    		$res->user_email = $billing['email'];
    		$res->user_name = $billing['full_name'];
    		$res->form_type = $out['form_type'];
    		$res->turnaround = $out['turnaround'];
    		if (isset($out['county'])) {
    			$res->county = $out['county'];
    		}
    		$res->property_owner = $out['property_owner'];
			$res->property_address = $out['property_address'];
			$res->parcel_id = $out['parcel_id'];
			$res->city = $out['city'];
			$res->state = $out['state'];
			$res->zip = $out['zip'];
			$res->zoning = $out['zoning'];
			$res->bedrooms = $out['bedrooms'];
			$res->bathrooms = $out['bathrooms'];
			$res->square_feet = $out['square_feet'];
			$res->lot_size = $out['lot_size'];
			$res->basement = $out['basement'];
			$res->year_built = $out['year_built'];
			$res->condition = $out['condition'];
			$res->pricing = $out['pricing'];
			$res->additional_comments = $out['additional_comments'];
			$res->company = $out['company'];
			$res->branch = $out['branch'];
			$res->company_contact_name = $out['company_contact_name'];
			$res->company_contact_email = $out['company_contact_email'];
			$res->status = 'open';
			$res->save();

			$price += (int)$out['pricing'];

			array_push($forms, $res->id);

			if ($userId != 'guest') {
				$cart = Cart::find($out['id'])->delete();
			}
    	}

        $token = md5(microtime().rand());
    	$order = new Order;
    	$order->forms = $forms;
    	if ($userId != 'guest') {
	    	$order->user_id = $userId;
	    }
    	$order->user_name = $billing['full_name'];
    	$order->user_email = $billing['email'];
    	$order->payment_type = $billing['payment_type'];
    	$order->status = 'open';
    	$order->price = $price;
        $order->full_name = $billing['full_name'];
        $order->company = $billing['company'];
        $order->email = $billing['email'];
        $order->address = $billing['address'];
        $order->city = $billing['city'];
        $order->state = $billing['state'];
        $order->zip_code = $billing['zip_code'];
        $order->payment_status = 'bill_later';
        $order->token = $token;
    	$order->save();

        // $emailOrderHash = md5($billing['email'] . $order->id);

    	return $order;
    }

    public function confirmOrderPayment(Request $request) {
        
        $orderId = $request->order_id;
        $res = Order::find($orderId);
        $res->payment_status = 'approved';
        
        $price = (int)$res->price;

        \Stripe\Stripe::setApiKey ( 'sk_test_ZUuuUgd0YaHQjYLTOG4EX6ie' );
        try {
            $stripe = \Stripe\Charge::create ( array (
                    "amount" => $price * 100,
                    "currency" => "usd",
                    "source" => $request->token, // obtained with Stripe.js
                    "description" => 'marketpriceopinion.com - ORDER #' . $orderId
            ) );
            // Session::flash ( 'success-message', 'Payment done successfully !' );
            // return Redirect::back ();
            $res->stripe_charge = $stripe->id;
        } catch ( Exception $e ) {
            return 'error-credit';
        }
        $res->save();
        if ($res) {
            return $res;
        } else {
            return 'error';
        }
    }

    public function getOrder(Request $request) {
    	$id = $request->id;
    	$res = Order::find($id);
    	$res->form_orders = $this->getForms($id);
    	return $res;
    }

    public function getOrderSummary(Request $request) {
        $token = $request->token;
        $res = Order::select()->where('token', $token)->first();

        if ($res->payment_type == 'Credit/Debit') {
            \Stripe\Stripe::setApiKey ('sk_test_ZUuuUgd0YaHQjYLTOG4EX6ie');
            $stripe = \Stripe\Charge::retrieve($res->stripe_charge);
        } else {
            $stripe = NULL;
        }
        $formsArray = [];
        foreach($res->forms as $out) {
            $form = Form::find($out);
            array_push($formsArray, $form);
        }
        $res->forms_array = $formsArray;

        return compact('res', 'stripe');
    }

    public function getOrders(Request $request) {
    	$res = Order::all();
    	foreach($res as $out) {
    		$out->form_orders = $this->getForms($out->id);
    	}
    	return $res;
    }

    public function getForm(Request $request) {
    	$id = $request->id;
    	$res = Form::find($id);
    	return $res;
    }

    public function submitRejection(Request $request) {
    	$data = $request->data;
    	$reason = $request->cancel_reason;

    	$res = Form::find($data['id']);
    	$res->rejected_reason = $reason;
    	$res->status = 'canceled';
    	$res->save();
    	return $res;
    }

    public function getFormsTable(Request $request) {
    	if (!isset($request->statusType)) {
    		$res = Form::all();
    	} else {
    		$res = Form::select()->where('status', 'submitted_for_review')->get();
    	}
    	return $res;
    }

    protected function getForms($id) {
    	$res = Order::find($id);
    	$arr = [];
    	foreach($res->forms as $out) {
    		$r = Form::find($out);
    		array_push($arr, $r);
    	}
    	return $arr;
    }

    public function submitForReview(Request $request) {
        $form = $request->all();

        // Getting the PDF SCREENSHOT
        $image = $request->image;

    	$image = str_replace('data:application/pdf;base64,', '', $image);
		$decoded = base64_decode($image);
		$imageName = $form['id'] . "_review_pdf.pdf";
		$url = file_put_contents(storage_path() . "/app/public/" . $imageName, $decoded, LOCK_EX);

        $res = Form::find($form['id']);
        if (isset($request->reject)) {
            $res->status = 'rejected';
            $res->rejected_reason = $form['reject_reason'];
            $res->agent = $form['agent'];
            $res->form_pdf_url = '/storage/' . $imageName;
        } else {
            $res->comp_1 = $form['comp_1'];
            $res->comp_2 = $form['comp_2'];
            $res->comp_3 = $form['comp_3'];
			
			// if (isset($request->file('images'))) {
				// $file = $request->file('images');
				// $imageName = $form['id'] . '.' . File::extension($file->getClientOriginalName());
				// $upload = Storage::disk('public')->putFile('/', $decoded);
				// $url = Storage::disk('public')->url($upload);

				$res->form_pdf_url = '/storage/' . $imageName;
			// }

            $res->estimated_market_value = $form['estimated_market_value'];
            $res->agent = $form['agent'];
            $res->status = 'submitted_for_review';
        }

        $res->save();
        return $res;
    }

    public function submitToCustomer(Request $request) {
    	
    	$order = $request->order;
    	$res = Order::find($order['id']);
    	$res->status = 'complete';

    	$obj = (object)[];
    	$obj->forms = [];
    	foreach($res->forms as $out) {
    		$f = Form::find($out);
    		array_push($obj->forms, $f->form_pdf_url);
    	}
	    Mail::to('acoleman@paifashion.com')
            ->send(new CustomerMail($obj));

    	$res->save();
    	return $res;
    }

    public function getMyOrders(Request $request) {
    	$id = $request->user_id;
    	$res = Order::select()->where('user_id', $id)->get();
    	if ($res) {
    		foreach($res as $out) {
	    		$out->form_orders = $this->getForms($out->id);
	    	}
    		return $res;
    	} else {
    		return 'no-orders';
    	}
    }

    public function getInvoice(Request $request) {
    	$startDate = $request->startDate . ' 00:00:00';
    	$endDate = $request->endDate . ' 23:59:59';

    	$res = Order::select()
    				->where('payment_status', 'bill_later')
    				->where('company', $request->company)
    				->where('created_at', '>=', $startDate)
    				->where('created_at', '<=', $endDate)
    				->get();
    	if ($res) {
    		foreach($res as $out) {
	    		$out->form_orders = $this->getForms($out->id);
	    	}
    		return $res;
    	}
    }
}
