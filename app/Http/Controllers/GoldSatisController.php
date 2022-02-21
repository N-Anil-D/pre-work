<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldSatis;


class GoldSatisController extends Controller
{
    public function verigir(){

        $veriler = GoldSatis::orderBy('saticiadi')->get();
        // $veriler = GoldSatis::orderByDesc('id')->get();

        return view('goldukimsatti', ["satislar" => $veriler]);
    }

    public function verikaydet(Request $request){

        $veriler = $request->all();

        $satisEkle = new GoldSatis();
        $satisEkle->saticiadi = $veriler['satici'];
        $satisEkle->gold = $veriler['gold'];
        $satisEkle->dolarpergold = $veriler['dolarpergold'];
        $satisEkle->elegecengold = $veriler['elegecengold'];
        $satisEkle->toplandimi = 0;
        $satisEkle->tarih = $veriler['tarih'];
        $satisEkle->save();

        return redirect()->route('gold.satis.gir');
    }
}
