<?php 
    // Démarre une session PHP
    session_start();
    
    // Si le formulaire d'ajout de produit a été soumis
    if(isset($_POST['submit'])){
        // Récupère le nom, le prix et la quantité saisis dans le formulaire
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        
        // Vérifie que les données saisies sont valides
        if($name && $price && $qtt){
            
            // Crée un tableau associatif contenant les informations du produit
            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt 
            ];

            // Ajoute le produit à la liste des produits enregistrés en session
            $_SESSION['products'][] = $product;
            // Stocke un message de confirmation dans la session
            $_SESSION['check'] = "<p style='background: rgb(33, 244, 178); padding: 10px 10px 9px 45px; border-radius: 20px; color: white;'>Produit ajouté avec succès.</p>";       
        } else {
            // Stocke un message d'erreur dans la session si les données saisies ne sont pas valides
            $_SESSION['check'] = "<p style='background: rgb(239, 138, 138); padding: 10px 10px 9px 45px; border-radius: 20px; color: white;'>Erreur. Vérifiez votre saisie.</p>";
        }

    }

    // Si le formulaire de suppression de tous les produits a été soumis, détruit la session
    if(isset($_POST['deleteall'])){
        $_SESSION['products'] = array ();
    }
    
    // Redirige l'utilisateur vers la page d'accueil
    header("Location:index.php");
    
        // Si le formulaire de suppression du produit en cours a été soumis, supprime le produit de la session
        if(isset($_POST['deleteOne'])){
            $index = $_POST['index'];
            unset($_SESSION['products'][$index]); 
            // Redirige l'utilisateur vers la page de récapitulatif des produits
            header("Location:recap.php"); 
        }
    

        // Si le formulaire d'ajout de quantité du produit en cours a été soumis, incrémente la quantité et met à jour le total
        elseif (isset($_POST['add'])) { 
            // 
            $index = $_POST['index'];
            // Incrémente la quantité du produit en cours
            $_SESSION['products'][$index]['qtt'] += 1;
            // Met à jour le total du produit en fonction de sa quantité mise à jour
            $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
            // Redirige l'utilisateur vers la page de récapitulatif des produits
            header("Location: Recap.php");
            
        } elseif (isset($_POST['remove'])) {
            //
            $index = $_POST['index'];
            // Si le formulaire de suppression de quantité du produit en cours a été soumis
            if ($_SESSION['products'][$index]['qtt'] > 1) {
                // Décrémente la quantité du produit en cours si elle est supérieure à 1
                $_SESSION['products'][$index]['qtt'] -= 1;
                // Met à jour le total du produit en fonction de sa quantité mise à jour
                $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $_SESSION['products'][$index]['qtt'];
            }
            // Redirige l'utilisateur vers la page de récapitulatif des produits
            header("Location: Recap.php");
        
        }

    
?>