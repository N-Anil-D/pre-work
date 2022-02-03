<?php

namespace App\Http\Livewire;

use App\Models\Talep;
use Livewire\Component;
use App\Mail\SendMail;


class Talepler extends Component
{
    public function cevap($data)
    {
        $details = [
            'cevap' => $data
        ];

        \Mail::to('aratumu@hotmail.com')->send(new SendMail($details));
    }

    public function render()
    {
        $talepler = Talep::orderByDesc('id')->get();

        return view('livewire.talepler', ["talepler" => $talepler]);
    }
}
