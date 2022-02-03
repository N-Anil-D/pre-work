<div class="container">
    <!-- Modal -->
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="note">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cevap('Talebiniz işleme alınmıştır.')" data-dismiss="modal">İşlemde</button>
                    <button type="button" class="btn btn-success" wire:click="cevap('Bakım İşleminiz Tamamlanmıştır.')" data-dismiss="modal">Tamamlandı</button>
                    <button type="button" class="btn btn-success" wire:click="cevap('Talepteki işlemler başaralı bir şekilde sonuçlanmıstır.')" data-dismiss="modal">Sonuçlandı</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "INVAMED Müşteri Talepleri" }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Gönrderen isim / mail</th>
                                <th scope="col">Talep Türü</th>
                                <th scope="col">Talep Başlığı</th>
                                <th scope="col">İncele</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($talepler as $talep)
                            <tr>
                                <th>{{$talep->id}}</th>
                                <td>{{$talep->name .' / '. $talep->email}}</td>
                                <td>@if($talep->type=="1") Değişim @elseif($talep->type=="2") Teknik destek talebi @elseif($talep->type=="3") Teknik destek takibi @endif</td>
                                <td>{{$talep->title}}</td>
                                <td><button class="inspect btn btn-info inspect" value="{{$talep->id}}">İncele</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.inspect', function(e) {
        e.preventDefault();
        var talep_id = $(this).val();
        $('#myModal').modal('show');

        $.ajax({
            type: "GET",
            url: "/talep-detaylari/" + talep_id,
            success: function(response) {
                if (response.status == 404) {
                    $('#myModal').modal('hide');
                }
                if (response.status == 200) {
                    $("#note").text(response.talep.note);
                    $(".modal-title").text(response.talep.title);
                }
            }
        });
    });
</script>