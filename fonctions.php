<?php

function calculer_age($date_naissance)
{
    $date_naissance = new DateTime($date_naissance);
    $date_actuelle = new DateTime(); 

    return $date_actuelle->diff($date_naissance)->y;  // diff() pour trouver l'âge simplement avec des variable de type DateTime
}

function categorie_age($age)
{
    if ($age >= 6 && $age <= 8)
    {
        return "Poussin (U8)";
    }
    elseif ($age >= 9 && $age <=11)
    {
        return "Benjamin (U11)";
    }
    elseif ($age >= 12 && $age <= 14)
    {
        return "Minime (U14)";
    }
    elseif ($age >= 15 && $age <= 17)
    {
        return "Cadet (U17)";
    }
    elseif ($age >= 18 && $age <= 19)
    {
        return "Junior (U19)";
    }
    elseif ($age >= 20)
    {
        return "Senior";
    }
}

function creer_membre($nom, $prenom, $date_naissance, $email)
{
    $nom = strtoupper($nom);
    $age = calculer_age($date_naissance);
    $categorie = categorie_age($age);

    $date_inscription = date('Y-m-d');

    return [
        "nom" => $nom,
        "prenom" => $prenom,
        "age" => $age,
        "date_naissance" => $date_naissance,
        "date_inscription" => $date_inscription,
        "email" => $email,
        
    ];
}

function connexion_bdd()
{
    try {
        // Connexion à la bdd et utf8mn4 appliquée
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
    // Gestion des erreurs dans try
    catch (PDOException $e)
    {
        die("Erreur de connexion à la base de donnée: " . $e->getMessage());
    }
}

function nettoyer_donnee($donnee)
{
    $trimed_donnee = trim($donnee);

    $resultat = strip_tags($trimed_donnee);

    return ($resultat);
}

function valider_formulaire($nom, $prenom, $date_naissance, $email)
{
    // https://www.w3schools.com/php/php_form_url_email.asp
    
    // Creation d'un tableau pour stocker les erreurs
    $erreurs = [];

    if (empty($nom))
    {
        $erreurs[] = "Le nom est nécessaire !";
    }
    if (!preg_match("/^[a-zA-Z-'. ]*$/", $nom))
    {
        $erreurs[] = "Seulement les lettres et certains characters spéciaux sont autorisés !";
    }
//------------------------------------------------------------------------------------------------
    if (empty($prenom))
    {
        $erreurs[] = "Le prénom est nécessaire !";
    }
    if (!preg_match("/^[a-zA-Z-'. ]*$/", $prenom))
    {
        $erreurs[] = "Seulement les lettres et certains characters spéciaux sont autorisés !";
    }
//-----------------------------------------------------------------------------------------------
    if (empty($date_naissance))
    {
        $erreurs[] = "La date de naissance est nécessaire !";
    }
    if ($date_naissance < 1936 || $date_naissance > 2021)
    {
        $erreurs[] = "La date de naissance doit être entre 1936 et 2021 !";
    }
//------------------------------------------------------------------------------------------------------
    $age = calculer_age($date_naissance);
    if ($age < 6)
    {
        $erreurs[] = "Vous devez être agez de 6 ans minimum pour vous inscrire !";
    }
//--------------------------------------------------------------------------------------------------
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $erreurs[] = "Format d'email invalide !";
    }

    return [
        'valide' => count($erreurs) === 0,
        'erreurs' => $erreurs
    ];
}


function enregistrer_membre_au_bdd($membre)
{
    $pdo = connexion_bdd();

    $stmt = $pdo->prepare("INSERT INTO membres (nom, prenom, date_naissance, date_inscription, email)
                           VALUES (?, ?, ?, ?, ?)");

    // Exécute la requête prepare | execute() + prepare() = requête sécurisée | retourne aussi une bool selon l'état du tableau (vide ou non)
    return $stmt->execute([
        $membre['nom'],
        $membre['prenom'],
        $membre['date_naissance'],
        $membre['date_inscription'],
        $membre['email']
    ]);

}

function afficher_membres()
{
    $pdo = connexion_bdd();
    $stmt = $pdo->query("SELECT * FROM membres ORDER BY id ASC"); 

    // 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function afficher_membre_par_numero($numero_membre){}


?>