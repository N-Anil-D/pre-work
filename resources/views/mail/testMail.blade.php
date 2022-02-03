<!DOCTYPE html>

<html>

<head>

    <title>INVAMED</title>

</head>

<body>
    <img src="{{url('/') . '/invamed_rdglobal.png'}}">
    @isset($details['title'])
    <h1>Mesaj başlığınız: {{ $details['title'] }}</h1>
    @endif

    @isset($details['body'])
    <p>{{ $details['body'] }}</p>
    @endif

    @isset($details['cevap'])
    <p>{{ $details['cevap'] }}</p>
    @endif

</body>

</html>