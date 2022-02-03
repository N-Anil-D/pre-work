@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "INVAMED Talep Formu" }}</div>
                <div class="card-body">
                    <form action="{{route('send.ticket')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="type">Talep Türü</label>
                                <select class="custom-select @error('type') is-invalid @enderror" name="type" id="type">
                                    <option selected disabled value="">Bildiri Türü Seçiniz</option>
                                    <option value="1">Değişim</option>
                                    <option value="2">Teknik destek talebi</option>
                                    <option value="3">Teknik destek takibi</option>
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
                                <label for="title">Talep Başlığı :
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Bu kısım zorunludur. Talebinizin daha hızlı anlaşılabilmesi talebinize başlık koyunuz">
                                    </span>
                                    <i class="fa fa-info fa-xs" aria-hidden="true" style="font-size: 0.7rem;" title="Talbinizin başlığı"></i>
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
                                <label for="explanation">Talep açıklaması :
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Hata açıklama kısmının doldurulması zorunludur. Talepleriniz tam karşılanması adına açıklamalarınızı detaylı yapınız.">
                                        <i class="fa fa-info fa-xs" aria-hidden="true" style="font-size: 0.7rem;" title="Talbinizin açıklaması"></i>
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

                        <!-- <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputFileName">Bilgisayrımdan seç : &nbsp;&nbsp;
                                            </span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="file" id="inputFileName" class="custom-file-input" aria-describedby="inputFileName">
                                            <label class="custom-file-label" for="inputFileName">Eklenecek Dosya < 3 MB </label>
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
                        @enderror -->

                        <br>
                        <button class="btn btn-primary send_form" type="submit">Gönder</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection