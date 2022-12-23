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
                    <td><a href="index.php?uc=paiementFicheFrais&action=detail_fiche&idFrais=<?php echo $unefiche['idvisiteur'] ?>"> 
                           Détail</a></td>
                </tr>
                <?php
            }
           
            ?>
            </tbody>  
        </table>
    </div>
</div>


