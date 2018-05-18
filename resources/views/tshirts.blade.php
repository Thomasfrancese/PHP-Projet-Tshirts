<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="text-center" style="background-color: #7da8c3">

    <h1>Choissisez votre tee-shirts</h1>

</div>

<div>
    <form action="{{route('display')}}" method="post">
        {{ csrf_field() }}

        <div class="container text-center choixTshirts">

            <h2>T-shirt </h2>

            @foreach($listTshirts as $tshirt)
                <label><img src="/images/tshirts/{{$tshirt->id}}.png" width="200px" height="200px"></br><input
                            value="{{$tshirt->id}}" name="shirt" type="radio" id="radioButton"></label>

            @endforeach


        </div>


        <div class="container text-center logo">

            <h2>Galery Logos</h2>

            @foreach($listlogo as $logo)
                <label><img class="logo" src="{{ asset("/images/logo/{$logo->id}.png")}}" style="width: 150px"></br>
                    <input value="{{$logo->id}}" name="logo" type="radio"></label>
            @endforeach

            <br><br><br><br><br><br>

            <input class="btn btn-lg btn-primary" type="submit"></br></br></br></br>


        </div>
    </form>


    {{--<form enctype="multipart/form-data" method="post" action="#">--}}
    {{--{{ csrf_field() }}--}}

    {{--<div class="container text-center">--}}
    {{--<h2>Import de votre logo !</h2>--}}
    {{--<input data-preview="#preview" name="input_img" type="file" id="imageInput">--}}

    {{--<div class="text-center">--}}
    {{--<input class="btn btn-lg btn-primary" type="submit">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}

</div>