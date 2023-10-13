<?php

namespace App\Http\Controllers;

use App\Shops\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    function ajaxDelete($id) {
        if(Picture::findOrFail($id)->delete()) {
            return response('{"status": 200}', 200);
        } else {
            return response('{"status": 404}','404');
        }
    }
}
