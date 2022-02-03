@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ "Hata/Talep bildiri formu" }}</div>
                        <div class="card-body">


                            <form action="{{route('bildiri.formunu.ilet')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="type">Bildiri Türü</label>
                                        <select class="custom-select @error('type') is-invalid @enderror" name="type" id="type">
                                            <option selected disabled value="">Bildiri Türü Seçiniz</option>
                                            <option value="1">Hata Bildirimi</option>
                                            <option value="2">Geliştirme Talebi</option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Bildiri türü seçilmesi zorunludur' }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col mb-3">
                                        <label for="err_url">Hatanın bulunduğu bağlantı linki :
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Bu kısım zorunlu değildir. Eğer spesifik bir linkte hata alıyorsanız, hatanın daha hızlı anlaşılabilmesi adına adres çubuğundaki link'i kopyalayıp yapıştırınız.">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="err_url" name="url" value="{{ url()->previous() }}" autocomplete="url">
                                        @error('url')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Özel karakter kullanılamaz' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col mb-3">
                                        <label for="title">Talebin Başlığı :
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Bu kısım zorunludur. Talebinizin daha hızlı anlaşılabilmesi talebinize başlık koyunuz">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autocomplete="title">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Başlık alanı her talep için zorunludur' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col mb-3">
                                        <label for="explanation">Hatanın açıklaması :
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Hata açıklama kısmının doldurulması zorunludur. Talepleriniz tam karşılanması adına açıklamalarınızı detaylı yapınız.">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        <textarea class="form-control @error('explanation') is-invalid @enderror" id="explanation" name="explanation" value="{{ old('explanation') }}" autocomplete="explanation" rows="5"></textarea>
                                        @error('explanation')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Bir açıklama yapmanız gerekmektedir.' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-5 mb-5">
                                        <label for="date" class="form-control @error('date') is-invalid @enderror" style="border: 0px; background-color: white">Tarih :
                                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Tarih girmek için aşağıdaki kutucukta takvim ikonunua tıklayınız. Açılan ekranı kapatmak için boş bir bölüme sol tıklayınız.">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        <input type="datetime-local" id="date" name="date" value="{{date('Y-m-d\TH:i:s', strtotime('+3 hours'))}}" class="input-group date">
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Tarih (Gün.Ay.Yıl Saat.Dakika) olarak belirtilmesi zorunludur' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputFileName">Bilgisayrımdan seç : 	&nbsp;&nbsp;
                                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Bu kısım zorunlu değildir. Açıklamanızı netleştirmek için ekran görüntü(sü)leri ve kullanabilirsiniz. Son seçtiğiniz öge gönderilecektir">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                              <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="file" id="inputFileName" class="custom-file-input" aria-describedby="inputFileName">
                                                    <label class="custom-file-label" for="inputFileName">Eklenecek file < 3 MB </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('file')
                                <div class="form-row">
                                    <div class="col">
                                        <div class="alert alert-danger" role="alert">
                                            {{ 'file 3 MB nin üzerinde olduğu için bildiri alınamadı' }}
                                        </div>
                                    </div>
                                </div>
                                @enderror

                                <p class="text-break">Bildiriniz dekanlıktan onay aldı mı?
                                    <button type="button" class="btn btn-info" data-container="body" data-toggle="popover" data-placement="top" data-content="Eğer sahip olmadığınız bir kısım eklenmesini talep etmiyorsa ve bildiriniz kullandığınız alanların kapsamı içerisinde bir sorun içeriyorsa (örnek:Yeni eklenecek sorunun eklenememesi) dekanlık onayı zorunlu değildir.">
                                        Hangi durumlarda onaya ihtiyacım yok?
                                    </button>
                                </p>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input @error('dekanlikOnayi') is-invalid @enderror" type="checkbox" name="dekanlikOnayi" id="dekanlik_onayi1" value="1">
                                            <label class="form-check-label" for="dekanlik_onayi1">Onaylı</label>
                                            @error('dekanlikOnayi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Geliştirme taleplerinde dekanlık onayı olmak zorundadır' }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary send_form" type="submit">Gönder</button>
                            </form>

                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

    $(function () {
        $('[data-toggle="popover"]').popover()
    })

</script>
@endsection
