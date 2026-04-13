<?php 
require 'config.php';
require 'fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club <?= NOM_CLUB ?> | Acceuil</title>
    <style>
        body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 17px;
            background-color: #eee2e2;

        }

        h1{
            color: #c73746;
            text-align: center;

        }

        .info-div{
            background: white;
            padding: 15px;
            border-radius: 7px;
            margin: 15px 5px;
            box-shadow: 0 2px 4px #725891, 
                        -0.9em 0 0.7em #7b75d6;
            text-align: center;

        }

        .liens-acceuil{
            list-style: none;  /* https://developer.mozilla.org/fr/docs/Web/CSS/Reference/Properties/list-style */
            padding: 3px;

        }

        .liens-acceuil li{
            margin: 8px 0;


        }

        .liens-acceuil a{
            display: block;
            text-decoration: none;
            text-align: center;
            padding: 5px;
            background: #3498DB;
            color: white;
            border-radius: 5px;

        }

        .liens-acceuil a:hover{
            background: #6aa5dd;
        }



    </style>
</head>
<body>
<?php

echo "<h1>Bienvenu au club " . NOM_CLUB . ", fondé en " . ANNEE_FONDATION. " !</h1>";
?>

<div class="info-div">
    <h2>Acceuil</h2>
    <ul class="liens-acceuil">
        <li> <a href="formulaire.php">S'inscrire</a></li>
        <li> <a href="affichage_membres.php">Voir les membres</a></li>
    </ul>
</div>

</body>
</html>