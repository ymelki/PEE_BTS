<?php

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
echo $action;

switch ($action) {
    case 'selectionnerMois_User': 
        $visiteur = $pdo->getVisiteur();
        $moisVisiteur= $pdo->getLesMoisVisiteur();
        include 'vues/v_valider_frais.php';
        break;

    case 'detail_fiche':
        var_dump($_POST);
      $mois=filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);

      var_dump("test-----------TEST----".$mois);
      
      $levisiteur=filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
       var_dump("-----".$levisiteur);

       // creer une session user et mois qui va stocker les données en session
       $_SESSION['user']=$levisiteur;
       $_SESSION['mois']=$mois;
 
       // la fonction estPremierFraisMois renvoie faux lo
        if (!$pdo->estPremierFraisMois($levisiteur, $mois)) {
            $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "$mois");
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "$mois");
 
        //  include 'vues/v_valider_frais.php';
            include 'vues/v_valider_detail.php';
        }
        else {     
            $erreur="aucune fiche pour cette date !";
            $visiteur = $pdo->getVisiteur();
            $moisVisiteur= $pdo->getLesMoisVisiteur();
    

            include 'vues/v_valider_frais.php';


        }
  


      break;

      case 'modifier_forfait':
        $levisiteur=$_SESSION['user']; 
        $mois=$_SESSION['mois'];

        var_dump("test-----------TEST----".$mois);
      
        // $levisiteur=filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        var_dump($_POST);
        $pdo->majFraisForfait( 
            $levisiteur , 
            $mois,
            $_POST
        );
        // $pdo->majFraisHorsForfait();


        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "$mois");
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "$mois");

    //  include 'vues/v_valider_frais.php';
        include 'vues/v_valider_detail.php';
          
         break;



 
    case 'reporter':
        //var_dump($_POST); 
        $levisiteur=$_SESSION['user'];
        $mois=$_SESSION['mois'];

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $mois);
        
        // compte le nombre de ligne hors forfait pour l'utilisateur
        $nb=count($lesFraisHorsForfait);
        echo "<hr>".$nb."<hr>";
        for ($i=1; $i<=$nb; $i++){
            // cas genéral ou l'on souhaite refusé un remboursement
           if (isset($_POST['id'.$i])){ 

                // verifier si on à une date correcte < au 10 du mois en cours 
                // la date du jour a verifier
                $id=$_POST['id'.$i];
                $date_jour_initial=$pdo->getDateHorsforfait($id);
                $date_jour = new DateTimeImmutable($date_jour_initial);

                // la date du mois de référence au 10 du mois au max
                $annee_max=substr($_SESSION['mois'],0,4);
                $mois_max=substr($_SESSION['mois'],4,2);
                $jour_max=10;
                $date_max = new DateTimeImmutable($annee_max."-".$mois_max."-".$jour_max);
                // on verifie le nombre jour la date à verifier et le 10 du mois en cours
                $interval = $date_max->diff($date_jour);
                echo $interval->format('%R%a days INFOS');
                // si on est >=  0 alors on est dans le systeme de report

                // 1 Modifier le mois pour le mois dans hors forfait 
                // on passe de 202304 à 202305
            
                if (   $interval > 0  ) {
        
                
                  $dates = new DateTime($annee_max."-".$mois_max."-".$jour_max);
                  $dates->modify('+1 month');
                
                  $date_format= $dates->format('Ym');
                

                // avant la modification car il y a une contrainte d'intégrité
                // 2 creer si elle n existe pas nouvelle ligne fiche forfait
                // 3 nouvelle ligne frais forfait
                 $pdo->creeNouvellesLignesFrais($_SESSION['user'], $date_format);

                // 1 Modification de la date
                  $pdo->setMoisencoursFraisHF($date_format,$id);
                }  

           }
        }

        
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "$mois");
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "$mois");

    //  include 'vues/v_valider_frais.php';
        include 'vues/v_valider_detail.php';
      





        break;

    case 'supprimer_hors_forfait': 

        //var_dump($_POST); 
        $levisiteur=$_SESSION['user'];
        $mois=$_SESSION['mois'];

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $mois);
        
        // compte le nombre de ligne hors forfait pour l'utilisateur
        $nb=count($lesFraisHorsForfait);
        echo "<hr>".$nb."<hr>";
        for ($i=1; $i<=$nb; $i++){
            // cas genéral ou l'on souhaite refusé un remboursement
           if (isset($_POST['id'.$i])){
               echo "test";
               // recupéré la date du jour
               // selection du 10 et 12
               // appel de la fonction 
               $cequevousvoulez=$_POST['id'.$i];
               //  $datejour=  $pdo->getDateHorsforfait( $_POST['id'.$i] );


                    // Verfie si > 10 : le cas ou c'est trop tard les dates sont supérieur > 10 du mois
                
                        // MAJ de l'état de la fiche

                    // fin du if

                    // si non 


               // le cas ou on refuse
               $libelle=$pdo->getLibelle($_POST['id'.$i]);
               $new_libelle="REFUSE : ".$libelle;
               $ids=$_POST['id'.$i];
               $pdo->majFraisHorsForfait($new_libelle,$ids);
               
                                                                                                
               echo "<hr>".$new_libelle."<hr>";
               echo "<hr>".$ids."<hr>";

                // fin du if

           }
        }

        
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "$mois");
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "$mois");

    //  include 'vues/v_valider_frais.php';
        include 'vues/v_valider_detail.php';
        break;
    
    case 'modifier_statut_en_valider':
         $mois=$_SESSION['mois'];
         $levisiteur=$_SESSION['user'];

        //id_visiteur
        $pdo->majEtatFicheFrais($levisiteur, $mois , "VA" ) ;// changer le status
        include 'vues/v_statut_valider.php';

        break;

    }
        
    



