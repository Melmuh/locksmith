<?php

session_start();

include "model/model.php";


// Warenkorb -------------------------------------------------------------------------------------------------------

    if(isset($_POST['korblegen']))
    {
        $neu = $_COOKIE['korb'] + $_POST['artanzahl'];

        setcookie('korb', $neu, time()+3600);
        header("Refresh:0");
    }

// --------------------------------------------------------------------------------------------------------------------


// Warenkorbcookie ----------------------------------------------------------------------------------

    if(!isset($_COOKIE['korb']))
    {
        setcookie('korb', 0, time()+3600);
    }
    
    include "view/Warenkorbvorschau.php";
    
// ---------------------------------------------------------------------------------------------------



// Loginfunktion -------------------------------------------------------------------------------

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
            echo $password. "<br>";
            echo password_hash($password, PASSWORD_DEFAULT)."<br>";
        }
    }

// ---------------------------------------------------------------------------------------------------



// Registrierfunktion -------------------------------------------------------------------------------

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

        
        //Prepare Statements
        $stm = $pdo->prepare("INSERT INTO nutzer(n_name, n_vorname, n_email, hashwert) VALUES (:n_name, :n_vorname, :n_email, :hashwert)");
        $stm->bindParam(":n_name", $n_name);
        $stm->bindParam(":n_vorname", $n_vorname);
        $stm->bindParam(":n_email", $n_email);
        $stm->bindParam(":hashwert", $hash);

        $stm->execute();
    
    }

// ---------------------------------------------------------------------------------------------------------


// Einzelansicht -----------------------------------------------------------------------------------------

    if(isset($_GET['spiel']))
    {
        
        $stm = $pdo->query("SELECT * FROM spiele WHERE s_name = '".$_GET['spiel']."'"); // muss noch gebindet werden !!!!

            while ($row = $stm->fetch())
            {
                include "view/Einzelartikelinfos.php";

                $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                if($restanzahl == 0)
                {
                    $restbestand = "Es sind leider alle Artikel ausverkauft.";
                }
                elseif($restanzahl == 1)
                {
                    $restbestand = "Es ist nur noch 1 Artikel übrig!";
                    include "view/Warenkorbeinlage.php";
                }
                else
                {
                    $restbestand = "Es sind noch ".$restanzahl." Artikel übrig!";
                    include "view/Warenkorbeinlage.php";
                }

                include "view/Restanzahl.php";
            }
    }
    else
    {
        // Alle Artikel ausgeben ----------------------------------------------------------------------------------

            if(isset($_GET['seite']))
            {
                $artikelstart = $_GET['seite'] * 6 - 6;
                $stm = $pdo->query("SELECT * FROM spiele limit ".$artikelstart.", 6");

                while ($row = $stm->fetch())
                {
                    include "view/Artikel.php";
                }
            }
            else
            {
                $stm = $pdo->query("SELECT * FROM spiele limit 6");
                while ($row = $stm->fetch())
                {
                    include "view/Artikel.php";
                }
            }

        // -----------------------------------------------------------------------------------------------------


        // Seitenanzahl berechnen & ausgeben ------------------------------------------------------------------

            $Artikelanzahl = $pdo->query("SELECT count(*) from spiele")->fetchColumn(); 

            if($Artikelanzahl <= 6)
            {
                $seitenzahl = 1;
            }
            else
            {
                $rest = $Artikelanzahl % 6;
                $anzahlohnerest = $Artikelanzahl - $rest;
                $seitenzahl = $anzahlohnerest / 6 + 1;
            }



            for($i = 1; $i <= $seitenzahl; $i++)
            {
                include "view/Seitenanzahl.php";
            }

        // ----------------------------------------------------------------------------------------------------
    }


// ---------------------------------------------------------------------------------------------------------------




?>