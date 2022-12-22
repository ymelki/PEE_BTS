<?php

 $visiteur=$pdo->getVisiteur();
 var_dump($visiteur);
?>


<h2>Mes fiches de frais à valider</h2>
<div class="row">
    <div class="col-md-4">
    <h3>Sélectionner un visiteur : </h3>
    </div>
    <div class="col-md-4">

    </div>

</div>   

<form role="form" method="POST" 
 action="index.php?uc=ValiderFrais&action=detail_fiche">


 <select name="visiteur" id="visiteur">

 <?php foreach ( $visiteur as $unvisiteur) { ?>
    <option value="<?php echo $unvisiteur['id'] ?>">
        <?php echo $unvisiteur['prenom']." ".$unvisiteur['nom'] ?> </option>
    <?php 
}
 ?>
</select>


  

    <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
                   role="button">

</form> 