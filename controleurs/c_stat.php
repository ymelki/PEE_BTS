<?php
 

// 
$nb_fiche=$pdo->getnbfiche();
$nb_visiteur=$pdo->getnbvisiteur();
$nb_ficheparvisiteur=$pdo->getnbfichebyvisiteur(); 
var_dump( $nb_fiche );
var_dump( $nb_visiteur );
var_dump( $nb_ficheparvisiteur);

// afficher la vue
require 'vues/v_stat.php';
