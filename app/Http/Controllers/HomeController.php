<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \Firebase\JWT\JWT;
use Illuminate\Support\Arr;
use App\Models\Talep;
use App\Models\User;
use App\Models\UserLocations;
use App\Models\Urunler;
use App\Models\Siparislerim;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function locations(){

        return view('addlocation');
    }

    public function addLocation(Request $request){

        $add_location_to_db = new UserLocations();
        $add_location_to_db->user_id = Auth::user()->id;
        $add_location_to_db->country = $request->input()['country'];
        $add_location_to_db->city = $request->input()['city'];
        $add_location_to_db->location =$request->input()['location'];
        $add_location_to_db->save();

        return view('addlocation');
    }

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
        ]);
    }

    public function products()
    {
        $user_info = User::find(Auth::user()->id);

        $avaliable_balance = $user_info->balance;

        $product = Urunler::get();

        $locations = UserLocations::where('user_id', Auth::user()->id)->get();

        $bilgiler = [
            'avaliable_balance' => $avaliable_balance,
            'product' => $product,
            'locations' => $locations,
        ];

        return view('shoping', $bilgiler);
    }

    public function buyCripto(Request $request)
    {
        $buy_request = $request->all();

        $user_info = User::select('id','balance')->find($buy_request['uye_id']);

        $coin_info = Urunler::select('id','name','price_wcs')->find($buy_request['cripto_id']);

        $coin_count = $buy_request['demand']/$coin_info->price_wcs;
        $is_balance_ok = $user_info->balance - $buy_request['demand'];

        if ($is_balance_ok>=0){
            $balance_ok = new Siparislerim();
            $balance_ok->user_id = $user_info->id;
            $balance_ok->product_id = $buy_request['cripto_id'];
            $balance_ok->adet = round($coin_count,8);
            $balance_ok->fiyat = $buy_request['demand'];
            $balance_ok->odeme = 1;
            $balance_ok->status = 1;
            $balance_ok->save();

            $decrease_user_balance = User::find($user_info->id);
            $decrease_user_balance->balance = $is_balance_ok;
            $decrease_user_balance->save();

            return response()->json([
                'status'=>200,
            ]);    
        }else{
            $balance_out = new Siparislerim();
            $balance_out->user_id = $user_info->id;
            $balance_out->product_id = $buy_request['cripto_id'];
            $balance_out->adet = round($coin_count,8);
            $balance_out->fiyat = $buy_request['demand'];
            $balance_out->odeme = 0;
            $balance_out->status = 0;
            $balance_out->save();
            return response()->json([
                'status'=>400,
            ]);    

        }

    }


    public function myOrders(){

        
        $user_orders = Siparislerim::where('user_id',Auth::user()->id)
        ->orderByDesc('id')
        ->where('status','<>', 0)
        ->with(['urun' => function($query){
            $query->select('id','name','price_wcs');
        }])
        ->get();
        $dt_array = [];

        foreach($user_orders as $user_order){

            $add=[
                $user_order->urun->name,
                $user_order->adet,
                $user_order->fiyat,
                $user_order->created_at->format('Y-m-d H:i:s'),
            ];

            array_push($dt_array, $add);
        }
        return view('orderlist', ['dt_array' => $dt_array]);
    }

}
