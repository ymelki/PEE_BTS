<?php
$fiches=$pdo->getFichesfrais();
?>

<h2>Mes fiches de frais à valider</h2>
<div class="row">
    <div class="col-md-4">
        <h3>Sélectionner une fiche : </h3>
    </div>
    <div class="col-md-4">

    </div>

</div>




<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Liste des fiches de frais</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">id visiteur</th>
                    <th class="mois">mois</th> 
                    <th class="action">Detail</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($fiches as $unefiche) { ?>          
                <tr>
                    <td> <?php echo $unefiche['idvisiteur'] ?></td>
                    <td> <?php echo $unefiche['mois'] ?></td>
                    <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>"> 
                           Détail</a></td>
                </tr>
                <?php
            }
           
            ?>
            </tbody>  
        </table>
    </div>
</div>



<form role="form" method="POST" action="index.php?uc=ValiderFrais&action=detail_fiche">



    <select name="fiche" id="fiche">

        <?php foreach ($fiches as $unefiche) { ?>
            <option value="<?php echo $unefiche['idvisiteur'].$unefiche['mois'] ?>">
                <?php echo $unefiche['idvisiteur']." - ".$unefiche['mois']  ?> </option>
        <?php
        }
        ?>
    </select>




    <input id="ok" type="submit" value="Valider" class="btn btn-success" role="button">
    <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" role="button">

</form>