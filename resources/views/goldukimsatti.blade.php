@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Gold satış" }}</div>
                <div class="card-body">
                    <form action="{{route('gold.satis.kaydet')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- <div class="row"></div> -->
                        <label for="satici" class="col-sm-2 col-form-label col-form-label-lg">Oyun içi</label>
                        <div class="input-group" style="width:800px;">
                            <span class="input-group-text">Satıcı / Gold</span>
                            <input id="satici" type="text" aria-label="satici" name="satici" class="form-control">
                            <input type="number" aria-label="gold" name="gold" class="form-control">
                        </div>
                        <label for="satici" class="col-sm-2 col-form-label col-form-label-lg">G2G</label>
                        <div class="input-group">
                            <span class="input-group-text col-sm-2">G2G - USD / Gold</span>
                            <input id="dolarpergold" type="text" aria-label="dolarpergold" name="dolarpergold" class="form-control col-sm-4">
                        </div>
                        <br />
                        <div class="input-group">
                            <span class="input-group-text col-sm-2">Ele geçen $</span>
                            <input id="dolarpergold" type="text" aria-label="dolarpergold" name="elegecengold" class="form-control col-sm-4">
                        </div>
                        <br />
                        <div class="input-group">
                            <span class="input-group-text col-sm-2">Tarih</span>
                            <input type="date" name="tarih">
                        </div>
                        <!-- </div> -->
                        <br>
                        <button class="btn btn-primary send_form" type="submit">Gönder</button>
                    </form>

                </div>
            </div>
            <hr />
        </div>
        <div class="alert alert-dark w-100" role="alert">
            A simple dark alert—check it out!
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Satıcı</th>
                    <th scope="col">Satılan Gold</th>
                    <th scope="col">G2G'ye eklenen $</th>
                    <th scope="col">Tarih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($satislar as $satis)
                <tr class="table-{{ $satis->toplandimi ? 'success':'warning' }}">
                    <td>{{$satis->id}}</td>
                    <td>{{$satis->saticiadi}}</td>
                    <td>{{$satis->gold}}</td>
                    <td>{{$satis->elegecengold}}</td>
                    <td>{{$satis->tarih}}</td>
                    <td>@if(!$satis->toplandimi)<button class="btn btn-light">toplandı</button>@endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection