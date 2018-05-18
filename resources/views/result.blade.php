<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container text-center">
    <h1>Votre t-shirt !</h1>

    <img src="{{route('result',[$tshirt, $logo])}}" style="height: 400px; width: 400px"></br>

    <form action="{{route('save',[$tshirt, $logo])}}" method="post">
        {{ csrf_field() }}
        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{route('home')}}">Annuler</a>
</div>