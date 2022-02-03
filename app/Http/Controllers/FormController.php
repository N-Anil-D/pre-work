<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;


class FormController extends Controller
{
    public function formuAlIsle(Request $request)
    {
        $request->header('SECRETKEY') === 'CE7AB4E9FCE93E53F4790AC3226CA9CC5095F721A1E2A9DCFC775BEFCFF623EE';
        $asd = $request->files->get('formData');
        // $asd = $request->getBody();
        // $asd = $request->all()["formData"];


        return json_encode($asd);
    }
}
