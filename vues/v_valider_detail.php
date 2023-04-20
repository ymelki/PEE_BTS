<?php


?>
Information concernant le visiteur : <?=$_SESSION['user'] ?>
Pour le mois : <?=$_SESSION['mois'] ?>
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
                    <td>
                        <input type="text" 
                        name="<?php echo $idFrais?>" id="idFrais" value=<?= $quantite ?> name=<?= $idFrais ?> size="10" maxlength="5" class="form-control">
                    </td> <?php
                        }
                            ?>
            </tr>
        </table>

        <input id="ok" type="submit" value="Modifier" class="btn btn-success" role="button">
</form>
</div>

<form method="POST" action="index.php?uc=ValiderFrais&action=supprimer_hors_forfait&visiteur=<?=$levisiteur ?>">


    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait -
        </div>
        <table class="table table-bordered table-responsive">
            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
                <th>Supprimer</th>
            </tr>
            <?php
            $i=1;
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                
                $date = $unFraisHorsForfait['date'];
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $montant = $unFraisHorsForfait['montant']; 
                $supprimer=$unFraisHorsForfait['id'];
               
                ?>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td>
                        <input name=<?php echo "id".$i; ?> class="form-check-input" type="checkbox" value=<?php echo $supprimer ?> id="flexCheckDefault">
                    </td>
                </tr>
            <?php
            $i++;
            }
            ?>
        </table>
        <input id="ok" type="submit" value="Supprimer" class="btn btn-success" role="button">
        <input id="ok2" type="submit" value="Reporter" class="btn btn-success" role="button">
    </form>

</div>
</form>
<a href="index.php?uc=ValiderFrais&action=modifier_statut_en_valider&id_visiteur=<?=$levisiteur?>&mois=">
<button type="button" class="btn btn-primary">Valider la fiche</button>
</a>