<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use Storage;
use File;

class AnimalsController extends Controller
{
    public function addAnimal(Request $request) {
    	$image = $request->file('image');
    	$form = $request->all();

		$upload = Storage::disk()->putFile('', $image, 'public');
        $url = Storage::disk()->url($upload);

        $res = new Animal;
        $res->user_id = $request->user_id;
        $res->user = $request->user;
        $res->animal_type = $form['animal_type'];
        $res->size = $form['size'];
        $res->weapon = $form['weapon'];
        $res->team = $request->team;

        $points = '';

        switch ($form['animal_type']) {
        	case 'Whitetail-Doe': {
        		$points = 50;
        		break;
        	}
        	case 'Whitetail-Buck': {
        		if ((int)$form['size'] > 150) {
        			$points = 150;
        		} else {
        			$points = 100;
        		}
        		break;
        	}
        	case 'Fish-Bass': {
        		if ((int)$form['size'] >= 5) {
        			$points = 10;
        		} else {
        			$points = 2;
        		}
        		break;
        	}
        	case 'Fish-Trout': {
        		$points = 1;
        		break;
        	}
        	case 'Fish-Crappie': {
        		$points = .25;
        		break;
        	}
        	case 'Turkey': {
        		$points = 50;
        		break;
        	}
        	default: {
        		$points = 0;
        		break;
        	}
        }
        $res->points = $points;
        $res->image = $url;
        $res->save();

        return $res;
    }

    public function getScores(Request $request) {
    	$austin = Animal::select()->where('team', 'Austin')->get();
    	$nick = Animal::select()->where('team', 'Nick')->get();
    	return compact('austin', 'nick');
    }
}
