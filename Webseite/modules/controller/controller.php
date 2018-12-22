<?php

include "webseite/modules/model/model.php";

echo "<a href=\"http://localhost/Onlineshop2/locksmith/index.php\">Zur Startseite</a><br><br>";

// Session ID erstellen ------------------------------------------------------------------------------

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


    
// ---------------------------------------------------------------------------------------------------



// Warenkoreinlage -----------------------------------------------------------------------------------

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
    
    
    include "webseite/modules/view/Warenkorbvorschau.php";
    
// ---------------------------------------------------------------------------------------------------



// Loginfunktion -------------------------------------------------------------------------------------

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
            include "webseite/modules/view/Loginfeld.php";
        }
        else
        {
            $n_id = $pdo->query("SELECT n_id from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            $vorname = $pdo->query("SELECT n_vorname from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();
            include "webseite/modules/view/Willkommen.php";
        }

    // -----------------------------------------------

// ---------------------------------------------------------------------------------------------------



// Registrierfunktion --------------------------------------------------------------------------------

    

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
        include "webseite/modules/view/reg.php";
    }

// ---------------------------------------------------------------------------------------------------



// Einzelansicht -------------------------------------------------------------------------------------

    if(isset($_GET['spiel']) && !isset($_GET['Warenkorb']))
    {
        
        $stm = $pdo->query("SELECT * FROM spiele WHERE s_name = '".$_GET['spiel']."'"); // muss noch gebindet werden !!!!

            while ($row = $stm->fetch())
            {
                include "webseite/modules/view/Einzelartikelinfos.php";

                $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                if($restanzahl == 0)
                {
                    $restbestand = "Es sind leider alle Artikel ausverkauft.";
                }
                elseif($restanzahl == 1)
                {
                    $restbestand = "Es ist nur noch 1 Artikel übrig!";
                    include "webseite/modules/view/Warenkorbeinlage.php";
                }
                else
                {
                    $restbestand = "Es sind noch ".$restanzahl." Artikel übrig!";
                    include "webseite/modules/view/Warenkorbeinlage.php";
                }

                include "webseite/modules/view/Restanzahl.php";
            }
    }
    elseif(!isset($_GET['Warenkorb']) && !isset($_GET['admin']))
    {
        // Alle Artikel ausgeben ----------------------------------------------------------------------------------

            if(isset($_GET['seite']))
            {
                $artikelstart = $_GET['seite'] * 6 - 6;
                $stm = $pdo->query("SELECT * FROM spiele limit ".$artikelstart.", 6");

                while ($row = $stm->fetch())
                {
                    include "webseite/modules/view/Artikel.php";
                }
            }
            else
            {
                $stm = $pdo->query("SELECT * FROM spiele limit 6");
                while ($row = $stm->fetch())
                {
                    include "webseite/modules/view/Artikel.php";
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
                include "webseite/modules/view/Seitenanzahl.php";
            }

        // ----------------------------------------------------------------------------------------------------
    }


// ---------------------------------------------------------------------------------------------------



// Warenkorb -----------------------------------------------------------------------------------------

    if(isset($_GET['Warenkorb']))
    {

        include "webseite/modules/view/Warenkorb.php";


        // Auflistung der Einträge -------------------------------------------------------------------------

            $stm = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");
            while ($row = $stm->fetch())
            {
                $spielename = $pdo->query("SELECT s_name from spiele WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                include "webseite/modules/view/Warenkorbeinzelartikel.php";

                
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



// ---------------------------------------------------------------------------------------------------



// Adminbereich --------------------------------------------------------------------------------------

    // Adminbereich einblenden -----------------------------------------------------------    

        $eingeloggt = $pdo->query("SELECT logged_in from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();

        if($eingeloggt == 1)
        {
            $n_id = $pdo->query("SELECT n_id from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            $n_admin = $pdo->query("SELECT n_admin from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();

            if($n_admin == 1 && !isset($_GET['admin']) && !isset($_GET['spiel']) && !isset($_GET['Warenkorb']))
            {
                include "webseite/modules/view/Adminbereichsbutton.php";
            }
            elseif($n_admin == 1 && isset($_GET['admin']))
            {
                include "webseite/modules/view/Adminbereich.php";
            }
        }

    // ----------------------------------------------------------------------------------------------


    // Artikel hinzufügen -------------------------------------------------------------------------

        if(isset($_POST['arthin']))
        {
            $stm = $pdo->prepare("INSERT INTO spiele (s_name, s_hersteller, s_preis, s_text) VALUES (:s_name, :s_hersteller, :s_preis, :s_text)");
            $stm->bindParam(":s_name", $_POST['s_name']);
            $stm->bindParam(":s_hersteller", $_POST['s_hersteller']);
            $stm->bindParam(":s_preis", $_POST['s_preis']);
            $stm->bindParam(":s_text", $_POST['s_text']);
            $stm->execute();
        }

    // --------------------------------------------------------------------------------------------

    // Spiele bearbeiten --------------------------------------------------------------------------

        if(isset($_POST['artaend'])) 
        {
            $stm = $pdo->prepare("UPDATE spiele SET s_name = :s_name, s_hersteller = :s_hersteller, s_preis = :s_preis, s_text = :s_text WHERE s_id = :s_id");
            $stm->bindParam(":s_name", $_POST['s_name']);
            $stm->bindParam(":s_hersteller", $_POST['s_hersteller']);
            $stm->bindParam(":s_preis", $_POST['s_preis']);
            $stm->bindParam(":s_text", $_POST['s_text']);
            $stm->bindParam(":s_id", $_POST['s_id']);
            $stm->execute();
        }   

    // --------------------------------------------------------------------------------------------

    // Spiele löschen -----------------------------------------------------------------------------

        if(isset($_POST['artdel']))
        {
            $stm = $pdo->prepare("DELETE FROM spiele WHERE s_id = :s_id");
            $stm->bindParam(":s_id", $_POST['s_id']);
            $stm->execute();
        }

    // --------------------------------------------------------------------------------------------

    // Spiele auflisten zum Bearbeiten ------------------------------------------------------------

        if($n_admin == 1 && isset($_GET['admin']))
        {
            $stm = $pdo->query("SELECT * FROM spiele");

            while ($row = $stm->fetch())
            {
                include "webseite/modules/view/Artikeladminbereich.php";
            }
        }

    // --------------------------------------------------------------------------------------------


   

// ---------------------------------------------------------------------------------------------------


?>