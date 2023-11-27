<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <form action="{{ route('liste_fournisseurs') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="fournisseur">Sélectionnez un fournisseur :</label>
                <select class="form-control" id="fournisseur" name="fournisseur">
                    <!-- Replace the static values with a Blade loop to fetch suppliers from the database -->
                   <option value="" style="background: aqua">Chose one</option>
                    @foreach($four as $fournisseur)

                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                    @endforeach
                </select>
            </div>
        </form>@if (!empty($four1))
        <div class="container">
            <h1 class="mt-4">Liste des Articles du Fournisseur</h1>

            @if (count($four1) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Poids</th>
                            <th>Prix d'achat</th>
                            <th>Couleur</th>
                            <th>ID du Fournisseur</th>
                            <th>Date de création</th>
                            <th>Date de mise à jour</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($four1 as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->description }}</td>
                                <td>{{ $article->poids }}</td>
                                <td>{{ $article->prix_achat }}</td>
                                <td>{{ $article->couleur }}</td>
                                <td>{{ $article->id_Fournissours }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>{{ $article->updated_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('articles.destroy', ['article' => $article->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>

                                    <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun article trouvé pour ce fournisseur.</p>
            @endif
        </div>
    @endif




    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var selectElement = document.getElementById("fournisseur");

            selectElement.addEventListener("change", function() {

                document.querySelector("form").submit();
            });
        });
    </script>



    <!-- Add Bootstrap JS and Popper.js scripts (order matters) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
