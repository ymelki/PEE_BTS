<?php


?>

<form method="post" action="index.php?uc=ValiderFrais&action=modifier_forfait">

    <div class="panel panel-info">
        <div class="panel-heading">Eléments forfaitisés</div>
        <table class="table table-bordered table-responsive">
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {


                    $libelle = $unFraisForfait['libelle']; ?>
                    <th> <?php echo htmlspecialchars($libelle) ?></th>
                <?php
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {

                    $quantite = $unFraisForfait['quantite']; ?>
                    <td class="qteForfait"><?php echo $quantite ?> </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {
                    $idFrais = $unFraisForfait['idfrais'];

                    $quantite = $unFraisForfait['quantite']; ?>
                   <?php
                        }
                            ?>
            </tr>
        </table>

</form>
</div>

<form method="POST" action="index.php?uc=ValiderFrais&action=modifier_hors_forfait">


    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait -
        </div>
        <table class="table table-bordered table-responsive">
            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
            </tr>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $date = $unFraisHorsForfait['date'];
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $montant = $unFraisHorsForfait['montant']; ?>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

     <?php 

     ?>

<?php
var_dump($etatencours);
if ($etatencours=="MP") {

    ?>
        <a href="/index.php?uc=paiementFicheFrais&action=modifier_statut_rembourse&mois=<?=$_GET['mois']?>&idFrais=<?=$_GET['idFrais']  ?>">
    <button type="button" class="btn btn-success">Signaler que le paiement a été effectué  </button>
    </a>
    <?php
    }
else {
    ?>
<a href="/index.php?uc=paiementFicheFrais&action=modifier_statut&mois=<?=$_GET['mois']?>&idFrais=<?=$_GET['idFrais']  ?>">
<button type="button" class="btn btn-success">Mettre au statut paiement</button>
</a>
<?php } ?>
</div>
