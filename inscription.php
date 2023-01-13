<?php
require_once('include/init_inc.php');


require_once('include/init_inc.php');
/*
if(isConnect())
{
    header("location: profil.php");
}

// 2. Contrôler en PHP que l'on receptionne bien toute les données saisies dans le formulaire 

// echo "<pre>"; print_r($_POST); echo "</pre>";

extract($_POST);

*/

$border="border border-danger";


if(!empty($_POST)){
    
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
   $civilite= trim($_POST['civilite']);

   $border="border border-danger";


$errors =array();



//  Contrôler la validité du pseudo ,doublon , 
 $verifPseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
$verifPseudo->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
$verifPseudo->execute();



if(empty($_POST['pseudo'])){

    $errors['pseudo'] = "vous n'avez pas entré votre pseudo";

 

}

if ($verifPseudo->rowCount())
    {
        $errors['doublon']= "le pseudo $pseudo est déjà pris";
       
    } 

if(empty($_POST['mdp'])){

    $errors['mdp'] = "vous n'avez pas entré votre mot de passe";
    
}

if(empty($_POST['nom'])){

    $errors['nom'] = "vous n'avez pas entré votre nom";

}
if(empty($_POST['prenom'])){

    $errors['prenom'] = "vous n'avez pas entré votre prénom";

}


if(empty($_POST['telephone'])){

$errors['telephone'] = "vous n'avez pas entré votre numéro de téléphone";

}

 // validité email doublon

$verifEmail = $pdo->prepare("SELECT * FROM membre WHERE email = :email");
    $verifEmail->bindValue(':email', $email, PDO::PARAM_STR);
    $verifEmail->execute();

    if($verifEmail->rowCount())
    {
        $errors['email']= "Un compte existe déjà avec cet email";
       
    } 
    

if(empty($_POST['email']) ){

    $errors['email'] = "vous n'avez pas entré votre adresse email";

}
if(empty($_POST['civilite'])){

    $errors['civilite'] = "vous n'avez pas entré votre pseudo";

}

//var_dump($errors);
//var_dump($_POST);


 // CRYPTAGE DU MDP EN BDD
$mdp = password_hash($mdp, PASSWORD_BCRYPT);

//var_dump($mdp);

if(empty($errors)){


   



$inscription = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :prenom, :nom, :telephone, :email, :civilite, 0, NOW())");

$inscription->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
$inscription->bindParam(':mdp', $mdp, PDO::PARAM_STR);
$inscription->bindParam(':nom', $nom, PDO::PARAM_STR);
$inscription->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$inscription->bindParam(':telephone', $telephone, PDO::PARAM_INT);
$inscription->bindParam(':email', $email, PDO::PARAM_STR);
$inscription->bindParam(':civilite', $civilite, PDO::PARAM_STR);
$inscription->execute();

header("location: valid_inscription.php");

}


}


require_once('include/header_inc.php');
require_once('include/nav_inc.php');

?>




<form class="col-md-6 mx-auto my-5" method="POST" >


    <h3 class="text-center text-white my-4 bg-dark rounded mx-auto col-md-8 "> S'inscrire</h3>
    
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control <?php if(isset($errors)) echo $border; ?>">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control <?php if(isset($errors)) echo $border; ?>  ">
            
        </div>
        
    </div>  

    <div class="form-row mt-2">
        <div class="form-group col-md-6">
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" class="form-control <?php if(isset($errors)) echo $border; ?> ">
        </div>
        <div class="form-group col-md-6">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control  <?php if(isset($errors)) echo $border; ?> ">
        </div>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control<?php if(isset($errors)) echo $border; ?>">
       
    </div>
    
   

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="telephone">Votre téléphone</label>
            <input type="tel" id="telephone" name="telephone" class="form-control<?php if(isset($errors)) echo $border; ?> ">
        </div>
        
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label for="civilité" class="input-group-text">Civilité</label>
        </div>
        <select name="civilite" id="civilité" class="custom-select">
            <option value="m" selected>Homme</option>
            <option value="f">Femme</option>
        </select>
    </div>
        
    <div class="mt-15">
        <button type="submit" class="col-md-15 offset-md-15 btn btn-success "> Inscription </button>
    </div>

    
</form>


















<?php require_once('include/footer_inc.php');?>

