<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \Firebase\JWT\JWT;
use Illuminate\Support\Arr;
use App\Models\Talep;
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
}
