<?php

namespace App\Http\Livewire;

use App\Models\GoldSatis;
use Livewire\Component;

class LaGold extends Component
{

    public function goldTopla($id){

        $goldToplandi = GoldSatis::find($id);
        $goldToplandi->toplandimi = 1;
        $goldToplandi->save();

    }
    public function render()
    {
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

        return view('livewire.la-gold', [
            "satislar" => $veriler,
            "anilGold" => $anilGold,
            "cagriGold" => $cagriGold,
            "hilalGold" => $hilalGold
        ]);
    }
}
