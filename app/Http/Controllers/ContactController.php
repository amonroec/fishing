<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactRequest;

class ContactController extends Controller
{
    public function submitContactRequest(Request $request) {
    	$form = $request->form;
    	$res = new ContactRequest;
    	$res->name = $form['name'];
    	$res->subject = $form['subject'];
    	$res->email = $form['email'];
    	$res->message = $form['message'];
    	$res->save();
    	return $res;
    }
}
