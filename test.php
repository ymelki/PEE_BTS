<?php
session_start();
var_dump($GLOBALS);
/*

$_GET : Afficher les données de l'URL
$_POST : VIA LE FORMULAIRE
$_SESSION : on stock de la données dans le serveur
*/

var_dump($_GET);
$_SESSION['monnom']='Melki';
session_destroy();
?>






















<?php  if ($_SESSION['id2']==1) { ?>
                            <li <?php if ($uc == 'gererFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererFrais&action=saisirFrais">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Renseigner la fiche de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Afficher mes fiches de frais
                                </a>
                            </li>
                            <? } 
                            
                            if ($_SESSION['id2']==2) { ?> 
                                 <?php   echo $_SESSION['id2'];
                             }
                             var_dump($_SESSION);
                             ?>
                            