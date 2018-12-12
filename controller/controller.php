<?php

session_start();

include "model/model.php";





// Warenkorbcookie ----------------------------------------------------------------------------------

    if(isset($_POST['korblegen']))
    {
        $neu = $_COOKIE['korb'] + $_POST['artanzahl'];

        setcookie('korb', $neu, time()+3600);
        header("Refresh:0");

        // Artikel in den Warenkorb legen ohne Login ----------------------------------------------------------------------------------

            $stm = $pdo->prepare("INSERT INTO warenkorb (cookie_user, s_id, s_menge) VALUES (:cookie_user, :s_id, :s_menge)");
            $stm->bindParam(":cookie_user", $_COOKIE['user']);
            $stm->bindParam(":s_id", $_POST['sid']);
            $stm->bindParam(":s_menge", $_POST['artanzahl']);
            $stm->execute();

        // ----------------------------------------------------------------------------------------------------------------------------

    }

    if(!isset($_COOKIE['korb']))
    {
        setcookie('korb', 0, time()+31556926);
    }

    if(!isset($_COOKIE['user']))
    {

        // cookie User erstellen, falls noch nicht getan.

        $newuser = md5(openssl_random_pseudo_bytes(32));
        setcookie('user', $newuser, time()+31556926);

        $stm = $pdo->prepare("INSERT INTO cookie (cookie_user, logged_in) VALUES (:cookie_user, 0)");
        $stm->bindParam(":cookie_user", $_COOKIE['user']);

        $stm->execute();

        
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

            //     $stm = $pdo->prepare("UPDATE nutzer SET hashwert = :hashwert WHERE n_email = :email");
            //     $stm->bindParam(":hashwert", $hash);
            //     $stm->bindParam(":email", $email);
                
            //     $stm->execute();
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

    if(isset($_GET['spiel']) && !isset($_GET['Warenkorb']))
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
    elseif(!isset($_GET['Warenkorb']))
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

// Warenkorb -------------------------------------------------------------------------------------------------------

    if(isset($_GET['Warenkorb']))
    {

        include "view/Warenkorb.php";


        // Auflistung der Einträge -------------------------------------------------------------------------

            $stm = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");
            while ($row = $stm->fetch())
            {
                $spielename = $pdo->query("SELECT s_name from spiele WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                include "view/Warenkorbeinzelartikel.php";

                
            }


            // Löschen der Einzeleinträge -----------------------------------------------------------------

                if(isset($_POST['del']))
                {
                    $stm = $pdo->prepare("DELETE FROM warenkorb WHERE w_id = '".$_POST['wid']."'");
                    // $stm->bindParam("w_id", $_POST['wid']);
                    $stm->execute();

                    header("Refresh:0");
                }

            // ---------------------------------------------------------------------------------------------

        // ------------------------------------------------------------------------------------------------------

        

    }

// --------------------------------------------------------------------------------------------------------------------


?>