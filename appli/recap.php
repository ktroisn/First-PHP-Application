<?php 
    // Démarrage de la session
    session_start();
    // Récupération du nombre de produits en session
    $productCount = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/recap.css" rel="stylesheet">
        <title>Récapitulatif des produits</title>
    </head>
    <body>
        <main class="main-container">
            <section class="box-recap-products">
            <h1>Récapitulatif des produits en session</h1>
            <?php
                // Vérifie si le nombre de produits est égal à 1
                if($productCount == 1){
                    // Affiche un message avec le nombre de produits dans la session
                    echo "<p class='counter-products'>Vous avez ".$productCount." produit dans cette session</p>";
                }
                // Vérifie si le nombre de produits est supérieur à 1
                if($productCount > 1) {
                    // Affiche un message avec le nombre de produits dans la session
                    // Ajoute un formulaire pour supprimer tous les produits de la session
                    echo "<p class='counter-products'>Vous avez ".$productCount." produits dans cette session</p>",
                        "<form action='./traitement.php' method='post'>",
                            "<input class='delete-all' type='submit' name='deleteall' value='SUPPRIMER TOUTS LES PRODUITS'/>",
                        "</form>";
                }
                // Si le nombre de produits est inférieur ou égal à 0, n'affiche rien
                else {
                    echo "";
                }
            ?>


            <?php 

                // Vérifie si la session des produits existe et n'est pas vide
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                    // Si la session est vide, affiche un message indiquant qu'il n'y a aucun produit en session
                    echo "<p>Aucun produit en session...</p>";
                } else {
                    // Si la session contient des produits, affiche un tableau HTML contenant les informations de chaque produit
                    echo "<table>",
                        "<thead>",
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Nom</th>",
                                    "<th>Prix</th>",
                                    "<th class='col-qtt' colspan='3'>Quantité</th>",
                                    "<th>Total</th>",
                                    "<th></th>",
                                "</tr>",
                            "</thead>",
                            "<tbody>";

                    // Initialise une variable pour le total général
                    $totalGeneral = 0;

                    // Parcourt chaque produit dans la session
                    foreach($_SESSION['products'] as $index => $product){

                        // Affiche une ligne du tableau avec les informations du produit
                        echo "<tr>",
                                "<td>".$index."</td>",
                                "<td>".$product['name']."</td>",
                                "<td>".number_format($product['price'], 2, ",", "&nbsp;"). "&nbsp;€</td>",
                                "<td class='position-button-add'><form action='./traitement.php' method='post'>",
                                "<input class='add-qtt' type='submit' name='add' value='+'>",
                                "<input type='hidden' name='index' value='$index'></form></td>",
                                "<td class='value-qtt'>".$product['qtt']."</td>", 
                                "<td class='position-button-remove'><form action='./traitement.php' method='post'>",
                                "<input class='delete-qtt' type='submit' name='remove' value='-'>",
                                "<input type='hidden' name='index' value='$index'></form></td>",
                                "<td>".number_format($product['total'], 2, ",", "&nbsp;"). "&nbsp;€</td>",
                                "<td><form action='./traitement.php' method='post'>",
                                "<input class='delete-one' type='submit' name='deleteOne' value='X'/>",
                                "<input type='hidden' name='index' value='$index'></form></td>",
                            "</tr>";

                        // Ajoute le total du produit au total général
                        $totalGeneral += $product['total'];
                    }

                    // Affiche une dernière ligne du tableau avec le total général
                    echo "<tr>",
                        "<td colspan=4>Total générale :</td>",
                        "<td><span class='total-gen'>" .number_format($totalGeneral, 2, ",", "&nbsp;"). "&nbsp;€</span></td>",
                        "</tr>",
                            "</tbody>",
                                "</table>";
                }
            ?>


                <a href="./index.php"><- Ajouter un produit</a>
            </section>
        </main>
    </body>
    </html>