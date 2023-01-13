<?php 
require_once('include/init_inc.php');





if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    unset($_SESSION['membre']);
}

extract($_POST);

if(isConnect())
{
   // header("location: profil.php");
}

if($_POST)
{
    $data= $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo OR email = :email");
    $data->bindValue(':pseudo', $email_pseudo, PDO::PARAM_STR);
    $data->bindValue(':email', $email_pseudo, PDO::PARAM_STR);
    $data->execute();

    if($data->rowCount())
    {
        // echo "Ce pseudo  existant en BDD";
        $user = $data->fetch(PDO::FETCH_ASSOC);

         
        if (password_verify($password, $user['mdp']))
        {
           
           foreach($user as $key => $value)
           {
               if($key != 'mdp') 
               {
                  
                    $_SESSION['membre'][$key] = $value;
               }

               header("location: profil.php");
           }

            // echo "<pre>"; print_r($_SESSION); echo "</pre>";

        }
        else
        {
            // echo "erreur MDP";
            $error = "<p class='text-center text-white bg-danger p-3 col-md-4 mx-auto'>Le mot de passe est invalide</p>";
        }
    } 
    else
    {
        // echo "erreur pseudo ";
        $error = "<p class='text-center text-white bg-danger p-3 col-md-4 mx-auto'>Le pseusdo ou le mot de passe est invalide</p>";
    }
}




require_once('include/header_inc.php');
require_once("include/nav_inc.php");
?>

<h1 class="display-4 text-center my-4">Identifiez-vous</h1>

<?php if(isset($error)) echo $error; ?>

<form class="col-md-4 mx-auto my-5" method="POST">

    <div class="form-group">
        <label for="email_pseudo"> Pseudo</label>
        <input type="text" id="email_pseudo" name="email_pseudo" class="form-control" value="<?php if(isset($email_pseudo)) echo $email_pseudo; ?>">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <button type="submit" class="col-md-4 offset-md-4 btn btn-success">Connexion</button>
</form>

<?php 
require_once('include/footer_inc.php');
?>