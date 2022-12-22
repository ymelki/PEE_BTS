<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
echo $action;

switch ($action) {
    case 'selectionnerMois_User': 
        $visiteur = $pdo->getVisiteur();
       include 'vues/v_valider_frais.php';
        break;

    case 'detail_fiche':
        var_dump($_POST);
      //   $mois=filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
      
      $levisiteur=filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
       
      $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "202212");
      
      $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "202212");
      
      include 'vues/v_valider_frais.php';
      include 'vues/v_valider_detail.php';


      break;

      case 'modifier_forfait':
         var_dump($_POST); 
         break;

    case 'modifier_hors_forfait':
        var_dump($_POST); 
        break;

    }
        
    



