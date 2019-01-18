<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompletedForm;

class CompletedFormsController extends Controller
{
    public function submitForReview(Request $request) {
    	$data = $request->data;
    	$form = $request->form;

    	$res = new CompletedForm;
    	$res->form_id = $form['id'];
    	$res->comp_1 = $data['comp_1'];
    	$res->comp_2 = $data['comp_2'];
    	$res->comp_3 = $data['comp_3'];
    	$res->estimated_market_value = $date['estimated_market_value'];
    	$res->agent = $date['agent'];
    	$res->save();
    	return $res;
    }
}
