<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function getInvoiceNumber(Request $request) {
    	$userName = $request->user_name;
    	$userId = $request->user_id;
    	$company = $request->company;
    	$company_contact_email = $request->company_contact_email;

    	$res = new Invoice;
    	$res->user_name = $userName;
    	$res->user_id = $userId;
    	$res->company = $company;
    	$res->company_email = $company_contact_email;
    	$res->save();
    	return $res;
    }

    public function submitInvoice(Request $request) {

    	$image = $request->image;

    	$image = str_replace('data:application/pdf;base64,', '', $image);
		$decoded = base64_decode($image);
		$imageName = $request->invoice_id . "_orders_invoice.pdf";
		$url = file_put_contents(storage_path() . "/app/public/" . $imageName, $decoded, LOCK_EX);

		$res = Invoice::find($request->invoice_id);
		$res->pdf_url = '/storage/' . $imageName;
		$res->save();

		return $res;

    }
}
