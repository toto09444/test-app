<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <form action="{{ route('articles.editL') }}" method="POST">
            @csrf
            <h2>Modifier l 'article </h2>
            @foreach($edis as $edi)
            <div class="form-group">
                <label for="nom">ID:</label>
                <input type="text" readonly value="{{ $edi->id }}" class="form-control" id="ida" name="ida" required>
                <label for="nom">description:</label>
                <input type="text"  value="{{ $edi->description }}" class="form-control" id="description" name="description" required>
                <label for="nom">poids:</label>
                <input type="text"  value="{{ $edi->poids }}" class="form-control" id="poids" name="poids" required>
                <label for="nom">couleur:</label>
                <input type="text"  value="{{ $edi->couleur }}" class="form-control" id="couleur" name="couleur" required>
                <label for="nom">prix_achat:</label>
                <input type="text"  value="{{ $edi->prix_achat }}" class="form-control" id="prix_achat" name="prix_achat" required>
                <label for="nom">id_Fournissours:</label>
                <input type="text" readonly  value="{{ $edi->id_Fournissours }}" class="form-control" id="nom" name="nom" required>


            </div>
        @endforeach



            <button type="submit" class="btn btn-primary">Submit</button>




        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
