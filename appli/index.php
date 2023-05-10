<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First App</title>
</head>
<body>

        <h1>Ajouter un Produit</h1>
        <form action="traitement.php" method="post">
            <p>
                <label>
                    Nom du produit : 
                    <input type="text" name="name">
                </label>
            </p>

            <p>
                <label>
                    Prix du produit : 
                    <input type="number" step="any" name="prix">
                </label>
            </p>

            <p>
                <label>
                    Quantitée : 
                    <input type="number" name="qtt" value="1">
                </label>
            </p>

            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>     
</body>
</html>