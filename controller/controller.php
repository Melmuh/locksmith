<?php

include "model/model.php";

include "view/Loginfeld.php";


if(isset($_POST['Login']))
{
    


    // Get Parameters
    $email = $_POST['email'];
    $password = $_POST['password'];


    

    // Prepare Statements
    $statement = $pdo->prepare("SELECT hashwert FROM nutzer WHERE n_email = :email");
    $statement->bindParam(":email", $email);
    $statement->execute();
    $stored_hash = $statement->fetchColumn();




    if(password_verify($password, $stored_hash))
    {
        // if(password_needs_rehash($stored_hash, PASSWORD_DEFAULT))
        // {
        //     $hash = password_hash($password, PASSWORD_DEFAULT),

        //     // store in database
        // }

        // Session ID erstellen --------------------------------------------------------

        $_SESSION['sid'] = md5(openssl_random_pseudo_bytes(32));

        // -----------------------------------------------------------------------------
        
        echo "Bruder, du bist drin.";
    }
    else
    {
        echo "Bruder, du hasts verkackt.";
    }
}

if(isset($_GET['reg']))
{
    include "view/reg.php";
}

if(isset($_POST['registrieren']))
{
    
    // Get Parameters
    $n_name = $_POST['n_name'];
    $n_vorname = $_POST['n_vorname'];
    $n_email = $_POST['n_email'];
    $n_pass = $_POST['n_pass'];

    $hash = password_hash($n_pass, PASSWORD_DEFAULT);

    echo $hash;

    //Prepare Statements
    $stm = $pdo->prepare("INSERT INTO nutzer(n_name, n_vorname, n_email, hashwert) VALUES (:n_name, :n_vorname, :n_email, :hashwert)");
    $stm->bindParam(":n_name", $n_name);
    $stm->bindParam(":n_vorname", $n_vorname);
    $stm->bindParam(":n_email", $n_email);
    $stm->bindParam(":hashwert", $hash);

    $stm->execute();

    
}











?>