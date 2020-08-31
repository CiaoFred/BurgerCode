<?php
    require 'database.php';
    session_start();

    $email = $password = $error = "";
    
    if(!empty($_POST))
    {
        $email                          = checkInput($_POST['email']);
        $password                          = checkInput($_POST['password']);
        
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $statement->execute(array($email,$password));
        Database::disconnect();
        
        if($statement->fetch())
        {
            $_SESSION['email'] = $email;
            header ("Location: index.php");           
        }
        else
        {
            $error = "Votre email ou votre mot de passe sont incorrects";
        }
   

 
    }




    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-logo"><span class="fas fa-utensils"></span>  Burger Code  <span class="fas fa-utensils"></span></h1>
        <div class="container admin">
            <div class="row">
                
                <h1><strong>Login </strong></h1>
                <br>
                <form class="form" role="form" action="login.php" method="post" >
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                      
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de Passe" value="<?php echo $password; ?>">
                       
                    </div>
                <span class="help-inline"><?php echo $error; ?></span>
                           
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <a class="btn btn-primary" href="index.php"><span class="fas fa-arrow-left"></span> Retour</a>
                </div>
                    </form>

                
             
               
            </div>
        </div>
    
    </body>
</html>