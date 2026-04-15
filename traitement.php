<?php
session_start();
require 'config.php';
require 'fonctions.php';

// Formulaire  soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nom = nettoyer_donnee($_POST['nom']);
    $prenom = nettoyer_donnee($_POST['prenom']);
    $date_naissance = nettoyer_donnee($_POST['date_naissance']);
    $email = nettoyer_donnee($_POST['email']);

    // Validation des données et affichage d'erreur(s) s'il y en a
    $donnees = valider_formulaire($nom, $prenom, $date_naissance, $email);
    if (!$donnees['valide'])
    {
        foreach ($donnees['erreurs'] as $erreur)
        {
            echo "$erreur";
        }
        exit;
    }

    // On crée le membre "après" le nettoyage et la validation du formulaire
    $membre = creer_membre($nom, $prenom, $date_naissance, $email);

    $estEnregistrer = enregistrer_membre_au_bdd($membre);
    if ($estEnregistrer)
    {
        $_SESSION['success'] = "Inscription reussi, bienvenu parmis nous !";
        header('Location: index.php');
        exit;

    }
    else
    {
        $_SESSION['error'] = "Erreur, veuillez réessayer";
        header('location: formulaire.php');
        exit;
    }
}

?>