@extends('layouts.app')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Add Location</h3>
                    <div class="card-body">
                        @foreach($my_locations as $my_location)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Adresim</h5>
                                    <p class="card-text">{{$my_location->country.'/'.$my_location->city.'/'.$my_location->location}}</p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <hr />
                        <form method="POST" action="{{ route('add.location') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Country" id="country" class="form-control" name="country" required autofocus>
                                @if ($errors->has('country'))
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="City" id="city" class="form-control" name="city" required>
                                @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Location details" id="location" class="form-control" name="location" required>
                                @if ($errors->has('location'))
                                <span class="text-danger">{{ $errors->first('location') }}</span>
                                @endif
                            </div>


                            <div>
                                <button type="submit" class="btn btn-outline-dark btn-block">Ekle</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection