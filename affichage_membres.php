<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des inscrits</title>
    <style>
        body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 17px;
            background-color: #eee2e2;

        }

        h1{
            color: #c73746;
            text-align: center;
        }

        table{
            width: 100%;
            background-color: #b3e4c3;
            border-collapse: collapse;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 5px -10px #387cd4;;
        }

        th{
            background: #dac259;
            padding: 12px;
            text-align: left;
        }

        td{
            padding: 6px 17px;
            border-bottom: 1px solid #ca3e39;
        }

        tr:hover{
            background: #8feeb0;
        }

        .nb-membres{
            padding: 2px;
            font-weight: bold;
            color: #2c3e50;
        }

        .retour-acceuil{
            display: block;
            text-align: center;
            text-decoration: underline;  /* https://developer.mozilla.org/fr/docs/Web/CSS/Reference/Properties/text-decoration */
            margin-top: 17px;
            color: #298deb

        }

        .vide{
            text-align: center;
        }

    </style>
</head>
<body>
<?php
require 'config.php';
require 'fonctions.php';

    echo "<h1>Membres de " . NOM_CLUB . " </h1>";


$membres = afficher_membres();
if (empty($membres)) 
{
    echo "<div class='vide'>Aucun membres, mais vous pourriez être le premier !</div>";
}
else
{
    echo "<table>";

    echo "<thead>";
    echo "<tr>";

    echo "<th> ID </th>";
    echo "<th> Nom </th>";
    echo "<th> Prénom </th>";
    echo "<th> Âge </th>";
    echo "<th> Catégorie </th>";
    echo "<th> Date de naissance </th>";
    echo "<th> Date inscription </th>";
    echo "<th> Email </th>";

    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

    foreach ($membres as $membre)
    {
        $age = calculer_age($membre['date_naissance']);
        $categorie = categorie_age($age);

        echo "<tr>";

        echo "<td>" . $membre['id'] . "</td>";
        echo "<td>" . htmlspecialchars($membre['nom']) . "</td>";  
        echo "<td>" . htmlspecialchars($membre['prenom']) . "</td>";
        echo "<td>" . $age . "</td>";
        echo "<td>" . $categorie . "</td>";
        echo "<td>" . $membre['date_naissance'] . "</td>";
        echo "<td>" . $membre['date_inscription'] . "</td>";
        echo "<td>" . htmlspecialchars($membre['email']) . "</td>";

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
echo "<div class='nb-membres'>Total : " . count($membres) . " membres(s)</div>";

?>
<a href="index.php" class="retour-acceuil"><= Revenir à l'acceuil</a>
</body>
</html>