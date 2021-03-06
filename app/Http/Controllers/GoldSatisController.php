<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldSatis;


class GoldSatisController extends Controller
{
    public function index(){

        $veriler = GoldSatis::orderby('saticiadi')->get();

        $anilGoldSorgusu = GoldSatis::where('saticiadi','Anıl')->where('toplandimi',0)->get();
        $cagriGoldSorgusu = GoldSatis::where('saticiadi','Çağrı')->where('toplandimi',0)->get();
        $hilalGoldSorgusu = GoldSatis::where('saticiadi','Hilal')->where('toplandimi',0)->get();
        $anilGold = 0;
        $cagriGold = 0;
        $hilalGold = 0;
        foreach ($anilGoldSorgusu as $anilGoldArray){
            $anilGold += $anilGoldArray['elegecendolar'];
        }
        foreach ($cagriGoldSorgusu as $cagriGoldArray){
            $cagriGold += $cagriGoldArray['elegecendolar'];
        }
        foreach ($hilalGoldSorgusu as $hilalGoldArray){
            $hilalGold += $hilalGoldArray['elegecendolar'];
        }

        return view('goldukimsatti', [
            "satislar" => $veriler,
            "anilGold" => $anilGold,
            "cagriGold" => $cagriGold,
            "hilalGold" => $hilalGold
        ]);
    }

    public function verikaydet(Request $request){
        $validated = $request->validate([
            'satici' => 'required',
            'gold' => 'required|integer',
            'dolarpergold' => 'required|numeric|lt:10000',
            'elegecendolar' => 'required|numeric|lt:10000',
            'tarih' => 'required',
        ]);
        $veriler = $request->all();
        $satisEkle = new GoldSatis();
        $satisEkle->saticiadi = $veriler['satici'];
        $satisEkle->gold = $veriler['gold'];
        $satisEkle->dolarpergold = $veriler['dolarpergold'];
        $satisEkle->elegecendolar = $veriler['elegecendolar'];
        $satisEkle->toplandimi = 0;
        $satisEkle->tarih = $veriler['tarih'];
        $satisEkle->save();

        return redirect()->route('gold.satis.gir');
    }
}
