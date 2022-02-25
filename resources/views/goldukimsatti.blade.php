@extends('layouts.app')

@section('content')
    <style>
        .toplanmamis-gold-badge{
            height: 30px;
            font-size: 17px;
            color: #00ff00;
        }
    </style>
@livewire('la-gold')
@endsection

@section('scripts')
<script>
$( "#topla_kontrol" ).click(function() {
    $('#emin_misin').modal('show');
});

$("#topla_kontrol").click(function (){
    $('#modal-yazi').html("");
    // var topla = $(this).val();
});

</script>
@endsection
