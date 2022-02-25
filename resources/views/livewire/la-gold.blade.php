<div>
    <div class="modal" id="emin_misin" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Para hesabına geçti mi</h5>
                    <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div id="modal-yazi" class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hayır</button>
                    <button type="button" class="btn btn-primary">Evet</button>
                </div>
            </div>
        </div>
    </div>

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
                                <select class="form-select" aria-label="Default select example" name="satici" style="width: 150px;" required>
                                    <option value="" selected disabled>SATICI</option>
                                    <option value="Anıl">Anıl</option>
                                    <option value="Çağrı">Çağrı</option>
                                    <option value="Hilal">Hilal</option>
                                </select>
                                <input type="number" aria-label="gold" name="gold" class="form-control" required>
                            </div>
                            <label for="satici" class="col-sm-2 col-form-label col-form-label-lg">G2G</label>
                            <div class="input-group">
                                <span class="input-group-text col-sm-2">G2G - USD / Gold</span>
                                <input id="dolarpergold" type="text" aria-label="dolarpergold" name="dolarpergold" class="form-control col-sm-4">
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-text col-sm-2">Ele geçen $</span>
                                <input id="elegecendolar" type="text" aria-label="elegecendolar" name="elegecendolar" class="form-control col-sm-4" required>
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-text col-sm-2">Tarih</span>
                                <input type="date" name="tarih">
                            </div>
                            <!-- </div> -->
                            <br>
                            <button class="btn btn-primary send_form" type="submit">EKLE</button>
                        </form>

                    </div>
                </div>
                <hr />
            </div>
            <div class="alert alert-dark w-200" role="alert">
                <p class="text-center" style="height: 25px; font-size: 20px; font-size: x-large; font-weight: bolder">Toplanmamış bakiye $$$</p>
                <br>
                <span class="badge bg-dark toplanmamis-gold-badge" style="margin-right: 335px">Anıl : {{$anilGold}} $</span>
                <span class="badge bg-dark toplanmamis-gold-badge" style="margin-right: 335px">Hilal : {{$hilalGold}} $</span>
                <span class="badge bg-dark toplanmamis-gold-badge">Çağrı : {{$cagriGold}} $</span>
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
                        <td>{{$satis->elegecendolar}} $</td>
                        <td>{{$satis->tarih}}</td>
                        <td>@if(!$satis->toplandimi)<button class="btn btn-light" wire:click="goldTopla({{$satis->id}})">Toplandı</button>@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
