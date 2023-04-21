<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
echo $action;

switch ($action) {
    case 'selectionnerFiche': 
        include 'vues/v_selectionnerFiche.php';
        break;

        
    case 'detail_fiche':
        $levisiteur=$_GET['idFrais'];
        $mois=$_GET['mois'];


        // appel
        // var_dump($pdo->getEtat( $mois ,  $levisiteur));
       $etatencours=$pdo->getEtat( $mois ,  $levisiteur);


        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $mois);
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $mois);
        
        // $pdo->majEtatFicheFrais($levisiteur, $mois , "MP" ) ;// changer le status

        include 'vues/v_detail_fiche.php';
        break;


    case 'modifier_statut':
        $levisiteur=$_GET['idFrais'];
        $mois=$_GET['mois'];
    
        $pdo->majEtatFicheFrais($levisiteur, $mois , "MP" ) ;// changer le status

        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $mois);
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $mois);
        
        // $pdo->majEtatFicheFrais($levisiteur, $mois , "MP" ) ;// changer le status

        include 'vues/v_detail_fiche.php';
       

            
        break;
        

    case 'modifier_statut_rembourse':

        $levisiteur=$_GET['idFrais'];
        $mois=$_GET['mois'];

        $pdo->majEtatFicheFrais($levisiteur, $mois , "RB" ) ;// changer le status
     
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $mois);
        
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $mois);
        
        // $pdo->majEtatFicheFrais($levisiteur, $mois , "MP" ) ;// changer le status

        include 'vues/v_detail_fiche.php';
       
    
        break;
    
}
