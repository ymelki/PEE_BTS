<?php
/**
 * Gestion des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
// on a besoin de l'id du visiter pour générer une fiche de frais
// on la stock dans la variable idVisiteur issue de la variable
// du tableau session créé lors de l'authentification
$idVisiteur = $_SESSION['idVisiteur'];

// la fonction date('d/m/Y') => renvoie la date du jour : 12/12/2022

// mois <= 202212
// mois <= 202202
$mois = getMois(date('d/m/Y'));

// fonction substr => qui va prendre en parametre "202212"
// elle va extraire une partie du 0 au 4 : Les 2 parametre d'apres.
// $numAnnee <= 2022
// $numMois <= 12
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);

// $action <= lit dans l'URL le parametre "action" et le stock
// dans une variable $action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);



switch ($action) {
case 'saisirFrais':
    if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
        $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
    }
    break;
case 'validerMajFraisForfait':
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_SANITIZE_STRING);
    echo "je test";
    var_dump($lesFrais);
    echo "je test2";
    if (lesQteFraisValides($lesFrais)) {
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
    } else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/v_erreurs.php';
    }
    break;
case 'validerCreationFrais':
    //$dateFrais<= Recuperer du formulaire 
    // en POST grace à la l'attribut de l'INPUT pareil pour les 3 
    $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);

    var_dump($montant);
    valideInfosFrais($dateFrais, $libelle, $montant);
    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->creeNouveauFraisHorsForfait(
            $idVisiteur,
            $mois,
            $libelle,
            $dateFrais,
            $montant
        );
    }
    break;
case 'supprimerFrais':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    $pdo->supprimerFraisHorsForfait($idFrais);
    break;
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);

// 1. au click sur la page renseigner la fiche de frais
// il y a une insertion dans la table lignefraisforfait
// contenant l'IDvisiteur et le mois en cours avec une quantité à 0
// 2. chez nous on voit que on recupere les données inséré
// par défaut à 0 et on construit le formulaire 
// grace à fraisforfait pour construire le formulaire

// cette fonction va renvoyer un tableau
// contenant les elements remboursable pour le visiteur en question
// qui est inséré dans la table lignefraisforfait lors de l'affichage 
// de la page plus haut
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
require 'vues/v_listeFraisForfait.php';

require 'vues/v_listeFraisHorsForfait.php';
