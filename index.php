<?php

/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
session_start();
var_dump($_SESSION);
echo "<hr>";
var_dump($_REQUEST);
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
require 'vues/v_entete_commun.php';
if ($estConnecte) {
    // Entete specifique pour les visiteurs ou comptable
    include 'vues/v_entete_connecte.php';
}

// $uc=$_GET['uc']
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
// $_GET
echo "test" . $uc;

// CAS 1 : Je pars dans la page connexion dans un cas :
// si uc existe et que je ne suis pas connecté
if ($uc && !$estConnecte) {
    $uc = 'connexion';


    // CAS 2 : Je SUIS CONNECTE mais UC est vide
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleurs/c_accueil.php';
        break;
    case 'gererFrais':
        include 'controleurs/c_gererFrais.php';
        break;
    case 'etatFrais':
        include 'controleurs/c_etatFrais.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;
    case 'test':
        echo "test";
        include 'controleurs/c_test.php';
        break;
}
require 'vues/v_pied.php';
