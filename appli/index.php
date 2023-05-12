<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/index.css" rel="stylesheet">
    
    <title>Ajouter un produit</title>
</head>
<body>
    
    <main class="main-container">
        
        <!-- Définit la section pour ajouter un produit -->
        <section class="box-add-product">
            
            
            <h1>Ajouter un Produit</h1>
            
            <!-- Définit le formulaire pour ajouter un produit -->
            <form action="./traitement.php" method="post">
                
                <!-- Champ pour entrer le nom du produit -->
                <p>
                    <label>
                        Nom du produit : 
                        <input class="input-text-int" type="text" name="name">
                    </label>
                </p>

                <!-- Champ pour entrer le prix du produit -->
                <p>
                    <label>
                        Prix du produit : 
                        <input class="input-text-int" type="number" step="any" name="price">
                    </label>
                </p>

                <!-- Champ pour entrer la quantité du produit -->
                <p>
                    <label>
                        Quantitée : 
                        <input class="input-text-int" type="number" name="qtt" value="1">
                    </label>
                </p>

                <!-- Bouton pour ajouter le produit -->
                <p>
                    <input class="input-button" type="submit" name="submit" value="AJOUTER LE PRODUIT">
                </p>
                
                <!-- Affiche un message si un produit a été ajouté avec succès ou si il y une erreur-->

                <?php
                    // Démarrage d'une session pour stocker des variables de session
                    session_start();
                    // Comptage du nombre de produits dans le tableau de produits stocké dans les variables de session
                    $productCount = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;
                    // Vérification de l'existence d'un message de succès ou d'erreur stocké dans les variables de session
                    if(isset($_SESSION['check'])){
                        // Affichage du message de succès ou d'erreur dans une balise de span avec une classe d'animation
                        echo "<span class='animation'>".$_SESSION['check']."</span>";
                        // Suppression du message de succès ou d'erreur des variables de session pour éviter qu'il ne soit affiché à nouveau
                        unset($_SESSION['check']);
                    }
                ?>
                
            </form>

            <!-- Lien pour accéder au récapitulatif de tous les produits ajoutés -->
            <a href="./recap.php">Accéder au récapitulatif (<?php echo $productCount; ?> produits) -></a>

        </section>
    </main> 
<body>
</html>