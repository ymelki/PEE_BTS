<?php
/**
 * Gestion de l'accueil
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

if ($estConnecte) {
    // 1 CAS JE SUIS UN VISITEUR
     if ($_SESSION['id2']==1) {
        include 'vues/v_accueil.php';
    }
    // 2 CAS JE SUIS UN COMPTABLE
    if ($_SESSION['id2']==2) {

        include 'vues/v_accueil_compta.php'; // a creer !!    
    }
} else {
    include 'vues/v_connexion.php';
}
