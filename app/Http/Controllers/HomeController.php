<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \Firebase\JWT\JWT;
use Illuminate\Support\Arr;
use App\Models\Talep;
use App\Models\User;
use App\Models\Urunler;
use App\Models\Siparislerim;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show()
    {

        return view('talep');
    }

    public function send(Request $request)
    {
        // Validate
        $request->validate([
            'type' => 'required',
            'title' => 'required',
        ]);


        // POST Data
        $postInput = $request->input();
        array_shift($postInput);

        $br = ['SECRETKEY' => 'CE7AB4E9FCE93E53F4790AC3226CA9CC5095F721A1E2A9DCFC775BEFCFF623EE'];
        $dataForPost = Arr::add($postInput, 'header', $br);

        $kaydet = $this->kaydet($dataForPost);
        if ($kaydet) {
            $details = [
                'title' => $postInput['title'],
                'body' => 'Talebiniz başarıyla oluşturulmuştur'
            ];

            \Mail::to('aratumu@hotmail.com')->send(new SendMail($details));

            return redirect('dashboard');
        } else {
            $details = [
                'title' => 'Talep oluşturma başarısız.',
                'body' => 'Talebinizi oluştururken bir hata oluştu. Talebinizi tekrar oluştunuz.'
            ];

            \Mail::to('aratumu@hotmail.com')->send(new SendMail($details));

            return redirect('dashboard');
        }
    }

    public function kaydet(array $data)
    {
        if ($data['header']['SECRETKEY'] === 'CE7AB4E9FCE93E53F4790AC3226CA9CC5095F721A1E2A9DCFC775BEFCFF623EE') {

            return Talep::create([
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'type' => $data['type'],
                'title' => $data['title'],
                'note' => $data['explanation'],
            ]);
        } else {
            return 0;
        }
    }

    public function list()
    {
        // $talepler = Talep::orderByDesc('id')->get();

        // return view('talepler', ["talepler" => $talepler]);
        return view('talepler');
    }

    public function details($id = null)
    {
        if ($id == null) {
            return response()->json([
                'status' => 400
            ]);;
        }

        $talep = Talep::select('id', 'note', 'title')
            ->find($id);

        return response()->json([
            'status' => 200,
            'talep' => $talep
        ]);;
    }

    public function urunler()
    {
        $uye_bilgileri = User::find(Auth::user()->id);

        $kullanilabilir_miktar = $uye_bilgileri->balance;

        $product = Urunler::get();

        $bilgiler = [
            'kullanilabilir_miktar' => $kullanilabilir_miktar,
            'product' => $product,
        ];

        return view('shoping', $bilgiler);
    }

    public function buyCripto(Request $request)
    {
        $alim_istegi = $request->all();

        $uye_bilgileri = User::select('id','balance')->find($alim_istegi['uye_id']);

        $coin_bilgisi = Urunler::select('id','name','price_wcs')->find($alim_istegi['cripto_id']);

        $ne_kadar_coin_aldi = $alim_istegi['miktar']/$coin_bilgisi->price_wcs;
        $bakiye_yeterli_mi = $uye_bilgileri->balance - $alim_istegi['miktar'];

        if ($bakiye_yeterli_mi>=0){
            $bakiye_var = new Siparislerim();
            $bakiye_var->user_id = $uye_bilgileri->id;
            $bakiye_var->product_id = $alim_istegi['cripto_id'];
            $bakiye_var->adet = round($ne_kadar_coin_aldi,8);
            $bakiye_var->fiyat = $alim_istegi['miktar'];
            $bakiye_var->odeme = 1;
            $bakiye_var->status = 1;
            $bakiye_var->save();

            $uyenin_parasini_azalt = User::find($uye_bilgileri->id);
            $uyenin_parasini_azalt->balance = $bakiye_yeterli_mi;
            $uyenin_parasini_azalt->save();

            return response()->json([
                'status'=>200,
            ]);    
        }else{
            $bakiye_yok = new Siparislerim();
            $bakiye_yok->user_id = $uye_bilgileri->id;
            $bakiye_yok->product_id = $alim_istegi['cripto_id'];
            $bakiye_yok->adet = round($ne_kadar_coin_aldi,8);
            $bakiye_yok->fiyat = $alim_istegi['miktar'];
            $bakiye_yok->odeme = 0;
            $bakiye_yok->status = 0;
            $bakiye_yok->save();
            return response()->json([
                'status'=>400,
            ]);    

        }

    }
}
