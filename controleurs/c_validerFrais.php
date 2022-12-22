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

 
        // $pdo->majFraisHorsForfait();
         echo $_POST['4'];
         break;

    case 'supprimer_hors_forfait':
        //var_dump($_POST); 
        $levisiteur=filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "202212");
        $nb=count($lesFraisHorsForfait);
        echo "<hr>".$nb."<hr>";
        for ($i=1; $i<=$nb; $i++){
           if (isset($_POST['id'.$i])){
               echo "test";
               $libelle=$pdo->getLibelle($_POST['id'.$i]);
               $new_libelle="REFUSE : ".$libelle;
               $ids=$_POST['id'.$i];
               $pdo->majFraisHorsForfait($new_libelle,$ids);
               
                                                                                                
               echo "<hr>".$new_libelle."<hr>";
               echo "<hr>".$ids."<hr>";

           }
        }
        break;
    
    case 'modifier_statut_en_valider':
         $levisiteur=filter_input(INPUT_GET, 'id_visiteur', FILTER_SANITIZE_STRING);

        //id_visiteur
        $pdo->majEtatFicheFrais($levisiteur, "202212" , "VA" ) ;// changer le status
        include 'vues/v_statut_valider.php';

        break;

    }
        
    



