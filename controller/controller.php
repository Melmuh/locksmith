<?php


include "model/model.php";

// Session ID erstellen --------------------------------------------------------------------------

    if(!isset($_COOKIE['user']))
    {

        // cookie User erstellen, falls noch nicht getan.

        $newuser = md5(openssl_random_pseudo_bytes(32));
        setcookie('user', $newuser, time()+31556926);
        $_COOKIE['user'] = $newuser; // damit der cookie früher geladen wird lol

        

        $stm = $pdo->prepare("INSERT INTO cookie (cookie_user, logged_in) VALUES (:cookie_user, 0)");
        $stm->bindParam(":cookie_user", $_COOKIE['user']);

        $stm->execute();

    }


    
// ------------------------------------------------------------------------------------------------



// Warenkoreinlage ----------------------------------------------------------------------------------

    if(isset($_POST['korblegen']))
    {

        // Artikel in den Warenkorb legen ohne Login ----------------------------------------------------------------------------------

            $stm = $pdo->prepare("INSERT INTO warenkorb (cookie_user, s_id, s_menge) VALUES (:cookie_user, :s_id, :s_menge)");
            $stm->bindParam(":cookie_user", $_COOKIE['user']);
            $stm->bindParam(":s_id", $_POST['sid']);
            $stm->bindParam(":s_menge", $_POST['artanzahl']);
            $stm->execute();

        // ----------------------------------------------------------------------------------------------------------------------------

    }

    
    // Warenkorbartikel zählen -------------------------------------------------------------------------------------------

        $korbanzahl = $pdo->query("SELECT count(*) from warenkorb WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();

    // -------------------------------------------------------------------------------------------------------------------
    
    
    include "view/Warenkorbvorschau.php";
    
// ---------------------------------------------------------------------------------------------------



// Loginfunktion -------------------------------------------------------------------------------

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
            


            
            // User auf eingeloggt setzen -----------------------------------------------------------

                $stm = $pdo->prepare("UPDATE cookie SET logged_in = 1 WHERE cookie_user = :cookie_user");
                $stm->bindParam(":cookie_user", $_COOKIE['user']);

                $stm->execute();

            // ---------------------------------------------------------------------------------------


            // User ID in cookie Tabelle speichern -------------------------------------------------------

                $stm = $pdo->prepare("SELECT n_id from nutzer WHERE n_email = :email");
                $stm->bindParam(":email", $email);
                $stm->execute();
                $nid = $stm->fetchColumn(); // User ID raussuchen


                $stm = $pdo->prepare("UPDATE cookie SET n_id = '".$nid."' WHERE cookie_user = :cookie_user");
                $stm->bindParam(":cookie_user", $_COOKIE['user']);

                $stm->execute(); // User ID in cookie Tabelle setzen

            // -------------------------------------------------------------------------------------------

            
        }
        else
        {
            echo "Bruder, du hasts verkackt.";
        }
    }

    if(isset($_POST['logout']))
    {
        // User auf ausgeloggt setzen -----------------------------------------------------------

            $stm = $pdo->prepare("UPDATE cookie SET logged_in = 0 WHERE cookie_user = :cookie_user");
            $stm->bindParam(":cookie_user", $_COOKIE['user']);

            $stm->execute();

        // ---------------------------------------------------------------------------------------
    }



    // Ist ein User eingeloggt? -----------------------

        $eingeloggt = $pdo->query("SELECT logged_in from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();

        if($eingeloggt == 0)
        {
            include "view/Loginfeld.php";
        }
        else
        {
            $n_id = $pdo->query("SELECT n_id from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            $vorname = $pdo->query("SELECT n_vorname from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();
            include "view/Willkommen.php";
        }

    // -----------------------------------------------

// ---------------------------------------------------------------------------------------------------



// Registrierfunktion -------------------------------------------------------------------------------

    

    if(isset($_POST['registrieren']))
    {
        
        // Get Parameters
        $n_name = $_POST['n_name'];
        $n_vorname = $_POST['n_vorname'];
        $n_email = $_POST['n_email'];
        $n_pass = $_POST['n_pass'];

        $hash = password_hash($n_pass, PASSWORD_DEFAULT);

        // Prüfen, ob email schon vorhanden ----------------------------------------------------------------------

            $emailvergeben = $pdo->query("SELECT count(*) from nutzer WHERE n_email = '".$n_email."'")->fetchColumn();

            if($emailvergeben > 0)
            {
                $_GET['reg'] = "Registrieren";
                echo "loool die gibts schon!!!";
            }
            else
            {
                //Prepare Statements
                $stm = $pdo->prepare("INSERT INTO nutzer(n_name, n_vorname, n_email, hashwert) VALUES (:n_name, :n_vorname, :n_email, :hashwert)");
                $stm->bindParam(":n_name", $n_name);
                $stm->bindParam(":n_vorname", $n_vorname);
                $stm->bindParam(":n_email", $n_email);
                $stm->bindParam(":hashwert", $hash);

                $stm->execute();
            }

        // -------------------------------------------------------------------------------------------------------

    }

    if(isset($_GET['reg']))
    {
        include "view/reg.php";
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



// Adminbereich --------------------------------------------------------------------------------------------------

    $n_id = $pdo->query("SELECT n_id from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
    $n_admin = $pdo->query("SELECT n_admin from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();

// ---------------------------------------------------------------------------------------------------------------


?>