<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
echo $action;

switch ($action) {
    case 'selectionnerFiche': 
        include 'vues/v_selectionnerFiche.php';
        break;

        
    case 'detail_fiche':
        $levisiteur=filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
       
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "202212");
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "202212");
        
        include 'vues/v_detail_fiche.php';
        break;

    
}
