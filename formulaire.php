<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            max-width: 600px;
            margin: 40px auto;  
            padding: 20px;
            background-color: #eee2e2;
  
        }

        .div-head{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .div-head h1{
            color: #2c3e50;

        }

        form{
            background-color: white;
            padding: 35px;
            border-radius: 7px;
            box-shadow: 3px 2px #7bbdff,
                        -0.7em 0 1em #5c5a4c;
        }

        label{
            display: block;
            margin-bottom: 3px;
            color: #3a484b;
            font-weight: 600;  /* https://developer.mozilla.org/fr/docs/Web/CSS/Reference/Properties/font-weight */

        }

        input{
            width: 80%;
            padding: 7px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            

        }

        button{
            width: 50%;
            padding: 13px;
            margin-left: 115px;
            font-size: 17px;
            background: #3e98bb;
            color: white;
            border-radius: 7px;
            cursor: pointer;

        }

        button:hover{
            background: #6aa5dd;
        }

        .retour-acceuil{
            display: block;
            text-align: center;
            text-decoration:underline overline;  /* https://developer.mozilla.org/fr/docs/Web/CSS/Reference/Properties/text-decoration */
            margin-top: 17px;
            color: #298deb

        }

        .session-error{
            color: red;
            text-align: center;
        }


    </style>
</head>
<body>
    <div class="div-head">
        <img src="img/icons8-basketball-48.png" class="basketball" alt="basketball image">
        <h1>Formulaire d'inscription</h1>
    </div>
<?php
// Message d'erreur si l'inscription ne se passe pas bien
if (isset($_SESSION['error']))
{
    echo "<div class='session-error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    unset($_SESSION['error']);
}
?>
    <form action="traitement.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required/>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required/>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" id="date_naissance" min="1936-01-01" max="2021-01-01" required>

        <label for="email">Email :</label>
        <input type="email" name="email" maxlength="255" id="email" required>

        <button type="submit">Inscrire le membre</button>
    </form>
    <a href="index.php" class="retour-acceuil"><= Revenir à l'acceuil</a>
</body>
</html>