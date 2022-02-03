@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/')}}" style="text-decoration:none; color:#737373">Home</a></li>
    </ol>
</nav>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('show.ticket')}}" style="text-decoration:none; color:#737373">Talep Gönder</a></li>
    </ol>
</nav>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('list.tickets')}}" style="text-decoration:none; color:#737373">Müşteri Talepleri</a></li>
    </ol>
</nav>

@endsection