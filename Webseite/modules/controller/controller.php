<?php

include "webseite/modules/model/model.php";

echo "<a class=\"menutop\" href=\"http://localhost/Onlineshop2/locksmith/index.php\">Startseite & Produkte</a>";









// Session ID erstellen ------------------------------------------------------------------------------

    if($_COOKIE['user'] == 0)
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

            $stm = $pdo->prepare("INSERT INTO warenkorb (cookie_user, s_id, s_menge, s_name) VALUES (:cookie_user, :s_id, :s_menge, :s_name)");
            $stm->bindParam(":cookie_user", $_COOKIE['user']);
            $stm->bindParam(":s_id", $_POST['sid']);
            $stm->bindParam(":s_menge", $_POST['artanzahl']);
            $stm->bindParam(":s_name", $_POST['sname']);
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
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

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
            echo "Ungültige Email-Adresse oder Passwort!";
        }
    }

    if(isset($_POST['logout']))
    {
        // User auf ausgeloggt setzen -----------------------------------------------------------

            // $stm = $pdo->prepare("UPDATE cookie SET logged_in = 0 WHERE cookie_user = :cookie_user");
            // $stm->bindParam(":cookie_user", $_COOKIE['user']);

            // $stm->execute();

            $stm = $pdo->prepare("DELETE FROM cookie WHERE cookie_user = :cookie_user");
            $stm->bindParam(":cookie_user", $_COOKIE['user']);
            $stm->execute();
            setcookie('user', 0, time()+31556926);
            $_COOKIE['user'] = 0; // damit der cookie früher geladen wird lol
            header("Refresh:0");

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


// Mein Bereichsbutton -------------------------------------------------------------------------------

    $eingeloggt = $pdo->query("SELECT logged_in from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            
    if($eingeloggt == 1)
    {
        if(!isset($_GET['mein']))
        {
            echo "<a class=\"menutop bereich\" href=\"?mein=bereich\">Mein Bereich</a>";
        }
    }

// -----------------------------------------------------------------------------------------------------


// Registrierfunktion --------------------------------------------------------------------------------

    

    if(isset($_POST['registrieren']))
    {
        
        // Get Parameters
        $n_vorname = htmlspecialchars($_POST['n_vorname']);
        $n_name = htmlspecialchars($_POST['n_name']);
        $n_str = htmlspecialchars($_POST['n_str']);
        $n_nr = htmlspecialchars($_POST['n_nr']);
        $n_ort = htmlspecialchars($_POST['n_ort']);
        $n_bank = htmlspecialchars($_POST['n_bank']);
        $n_iban = htmlspecialchars($_POST['n_iban']);
        $n_bic = htmlspecialchars($_POST['n_bic']);
        $n_email = $_POST['n_email'];
        $n_pass = $_POST['n_pass'];
        $n_pass2 = $_POST['n_pass2'];


        $hash = password_hash($n_pass, PASSWORD_DEFAULT);

        // Prüfen, ob passwörter übereinstimmen --------------------------------------------------------------------------


        if($n_pass != $n_pass2) {
            echo 'Registrierung fehlgeschlagen!<br>
            Die Passwörter stimmen nicht überein! <br>
                    Bitte versuchen Sie es nochmal.';
            $error = true;
        }
        
        // Prüfen, ob email schon vorhanden ----------------------------------------------------------------------

            $emailvergeben = $pdo->query("SELECT count(*) from nutzer WHERE n_email = '".$n_email."'")->fetchColumn();

            if($emailvergeben > 0)
            {
                $_GET['reg'] = "Registrieren";
                echo "Diese E-Mail ist bereits vergeben.";
            }
            else
            {
                //Prepare Statements
                $stm = $pdo->prepare("INSERT INTO nutzer(n_vorname, n_name, n_str, n_nr, n_ort, n_bank, n_iban, n_bic, n_email, hashwert) VALUES (:n_vorname, :n_name, :n_str, :n_nr, :n_ort, :n_bank, :n_iban, :n_bic, :n_email, :hashwert)");
                $stm->bindParam(":n_vorname", $n_vorname);
                $stm->bindParam(":n_name", $n_name);
                $stm->bindParam(":n_str", $n_str);
                $stm->bindParam(":n_nr", $n_nr);
                $stm->bindParam(":n_ort", $n_ort);
                $stm->bindParam(":n_bank", $n_bank);
                $stm->bindParam(":n_iban", $n_iban);
                $stm->bindParam(":n_bic", $n_bic);
                $stm->bindParam(":n_email", $n_email);
                $stm->bindParam(":hashwert", $hash);

                $stm->execute();

                echo 'Registrierung erfolgreich!
                Sie können sich jetzt anmelden.';
            }

        // -------------------------------------------------------------------------------------------------------

    }

    if(isset($_GET['reg']))
    {
        include "webseite/modules/view/reg.php";
    }

// ---------------------------------------------------------------------------------------------------



// Einzelansicht -------------------------------------------------------------------------------------

    if(isset($_GET['spiel']) && !isset($_GET['Warenkorb']) && !isset($_GET['bestellen']) && !isset($_GET['vielen']) && !isset($_GET['mein']))
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
    elseif(!isset($_GET['Warenkorb']) && !isset($_GET['admin']) && !isset($_GET['bestellen']) && !isset($_GET['vielen']) && !isset($_GET['mein']))
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



// Mein Bereich ------------------------------------------------------------------------------------

    // Meine Daten bearbeiten --------------------------------------------------------------------------
            
        if(isset($_POST['dataend'])) 
        {
            $n_id = $pdo->query("SELECT n_id FROM cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();

            $stm = $pdo->prepare("UPDATE nutzer SET n_vorname = :n_vorname, n_name = :n_name, n_email = :n_email, n_str = :n_str, n_nr = :n_nr, n_ort = :n_ort, n_bank= :n_bank, n_iban = :n_iban, n_bic = :n_bic, n_anrede = :n_anrede  WHERE n_id = :n_id");
            $stm->bindParam(":n_vorname", $_POST['n_vorname']);
            $stm->bindParam(":n_name", $_POST['n_name']);
            $stm->bindParam(":n_email", $_POST['n_email']);
            $stm->bindParam(":n_str", $_POST['n_str']);
            $stm->bindParam(":n_nr", $_POST['n_nr']);
            $stm->bindParam(":n_ort", $_POST['n_ort']);
            $stm->bindParam(":n_bank", $_POST['n_bank']);
            $stm->bindParam(":n_iban", $_POST['n_iban']);
            $stm->bindParam(":n_bic", $_POST['n_bic']);
            $stm->bindParam(":n_anrede", $_POST['n_anrede']);
            $stm->bindParam(":n_id", $n_id);
            $stm->execute();
            
        }   

    // -------------------------------------------------------------------------------------------------


    if(isset($_GET['mein']))
    {
        if($eingeloggt == 1)
        {

            

            $n_id = $pdo->query("SELECT n_id from cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            $n_admin = $pdo->query("SELECT n_admin from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();

            if($n_admin == 1)
            {
                echo "<h2>Alle Bestellungen:</h2><hr>";
                $stm = $pdo->prepare("SELECT * FROM kauf, nutzer");
                $stm->execute();
                
                while($row = $stm->fetch())
                {
                    include "webseite/modules/view/Meinbereicheinzelartikeladmin.php";
                }
            }
            else
            {
                echo "<h2>Meine Bestellungen:</h2><hr>";
                $stm = $pdo->prepare("SELECT * FROM kauf WHERE n_id = :n_id");
                $stm->bindParam(":n_id", $n_id);
                $stm->execute();
                
                while($row = $stm->fetch())
                {
                    include "webseite/modules/view/Meinbereicheinzelartikel.php";
                }
            }

            $n_id = $pdo->query("SELECT n_id FROM cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();

            $stm = $pdo->prepare("SELECT * FROM nutzer WHERE n_id = :n_id");
            $stm->bindParam(":n_id", $n_id);
            $stm->execute();

            while($row = $stm->fetch())
            {
                include "webseite/modules/view/Meinbereichdatenaenderung.php";
            }
        }
        else
        {
            echo "Logge dich ein um diesen Bereich zu benutzen!";
        }

    }

    

// --------------------------------------------------------------------------------------------------------


// Warenkorb -----------------------------------------------------------------------------------------

    if(isset($_GET['Warenkorb']))
    {
        include "webseite/modules/view/Warenkorb.php";

        // Update der Anzahl ---------------------------------------------------------------------------------

            if(isset($_POST['update']))
            {
                $stm = $pdo->prepare("UPDATE warenkorb SET s_menge = :s_menge WHERE w_id = :w_id");
                $stm->bindParam(":s_menge", $_POST['neuanzahl']);
                $stm->bindParam(":w_id", $_POST['wid']);
                $stm->execute();
            }

        // ---------------------------------------------------------------------------------------------------

        // Löschen der Einzeleinträge -----------------------------------------------------------------

            if(isset($_POST['del']))
            {
                $stm = $pdo->prepare("DELETE FROM warenkorb WHERE w_id = '".$_POST['wid']."'");
                // $stm->bindParam("w_id", $_POST['wid']);
                $stm->execute();
                header("Refresh:0");
            }

        // ---------------------------------------------------------------------------------------------

        // Auflistung der Einträge -------------------------------------------------------------------------

            $stm = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");
            while ($row = $stm->fetch())
            {
                $spielename = $pdo->query("SELECT s_name from spiele WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                include "webseite/modules/view/Warenkorbeinzelartikel.php";

                
            }
                
        // -------------------------------------------------------------------------------------------------------
    }

// ----------------------------------------------------------------------------------------------------------------



// Checkout -------------------------------------------------------------------------------------------------------

    if(isset($_GET['bestellen']))
    {
        include "webseite/modules/view/Checkout.php";

        // Warenkorb nochmals auflisten ---------------------------------------------------------------------------

            $stm = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");

            while ($row = $stm->fetch())
            {
                $spielename = $pdo->query("SELECT s_name from spiele WHERE s_id = '".$row['s_id']."'")->fetchColumn();
                $preis = $pdo->query("SELECT s_preis from spiele WHERE s_id = '".$row['s_id']."'")->fetchColumn();

                include "webseite/modules/view/Checkouteinzelartikel.php";
            }
            
            if($eingeloggt == 1)
            {
                include "webseite/modules/view/kaufen.php";
            }
            else
            {
                echo "Sie müssen sich erst einloggen, um etwas zu kaufen!";
            }

        // ------------------------------------------------------------------------------------------------------------
    }



    if(isset($_POST['kaufen']))
    {
        
        
        // Bestandskorrektur ---------------------------------------------------------------------------------------------    
        
            $test = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");

            // Testen, ob noch genügen Keys vorhanden sind ---------------------------------------------------------------

                $zahl = 0;

                while($zeile = $test->fetch())
                {
                    $restanzahl = $pdo->query("SELECT count(*) from locks WHERE s_id = '".$zeile['s_id']."'")->fetchColumn();
                    $pdo == NULL;

                    // echo $restanzahl;

                    if($restanzahl == 0)
                    {
                        $zahl + 1;
                    }
                }
            
            // -----------------------------------------------------------------------------------------------------------
            
            if($zahl == 0)
            {
                $test = $pdo->query("SELECT * FROM warenkorb WHERE cookie_user = '".$_COOKIE['user']."'");
            
                // Schlüssel löschen --------------------------------------------------------------------------------------

                    while($zeile = $test->fetch())
                    {
                        $kaufanzahl = "LIMIT ".$zeile['s_menge'];
                        $stm = $pdo->prepare("DELETE FROM locks WHERE s_id = :s_id ".$kaufanzahl."");
                        $stm->bindParam(":s_id", $zeile['s_id']);
                        $stm->execute();
                    }

                // -----------------------------------------------------------------------------------------------------------

                // Warenkorb löschen -----------------------------------------------------------------------------------------

                    $stm = $pdo->prepare("DELETE FROM warenkorb WHERE cookie_user = :cookie_user");
                    $stm->bindParam(":cookie_user", $_COOKIE['user']);
                    $stm->execute();

                // ------------------------------------------------------------------------------------------------------------

            }
            else
            {
                echo "Es sind nicht mehr genügend Keyes da.";
            }

        // -------------------------------------------------------------------------------------------------------------------

        // Bestellung in Tabelle schreiben -------------------------------------------------------------------------------------

            $datum = date('d.m.Y');
            date_default_timezone_set("Europe/Berlin");
            $zeit = date('G:i');

            $n_id = $pdo->query("SELECT n_id FROM cookie WHERE cookie_user = '".$_COOKIE['user']."'")->fetchColumn();
            // $benutzeremail = $pdo->query("SELECT n_email from nutzer WHERE n_id = '".$n_id."'")->fetchColumn();
            // mail($benutzeremail, "Ihr Kauf bei locksmith.com!", "Inhalt der Email, funktioniert natürlich nur auf einem echten Server!", "From: Absender <locksmith@euredomain.de>");

            $stm = $pdo->prepare("INSERT INTO kauf (n_id, k_datum, k_zeit, k_spiele, k_preis) VALUES (:n_id, :k_datum, :k_zeit, :k_spiele, :k_preis)");
            $stm->bindParam(":n_id", $n_id);
            $stm->bindParam(":k_datum", $datum);
            $stm->bindParam(":k_zeit", $zeit);
            $stm->bindParam(":k_spiele", $_POST['bestellung']);
            $stm->bindParam(":k_preis", $_POST['endpreis']);
            $stm->execute();

        // -----------------------------------------------------------------------------------------------------------------------

    }

// ---------------------------------------------------------------------------------------------------


// Danke -------------------------------------------------------------------------------------------------

    if(isset($_GET['vielen']))
    {
        include "webseite/modules/view/danke.php";
    }

// ----------------------------------------------------------------------------------------------------------



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
        

    // ----------------------------------------------------------------------------------------------
    // Bestellungen einblenden -----------------------------------------------------------   
            
        
            


    // Artikel hinzufügen -------------------------------------------------------------------------

        if(isset($_POST['arthin']))
        {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false)
            {
                $image = file_get_contents($_FILES["image"]["tmp_name"]);
                //echo "jo";
            }
            
            $stm = $pdo->prepare("INSERT INTO spiele (s_name, s_hersteller, s_preis, s_text, s_bild) VALUES (:s_name, :s_hersteller, :s_preis, :s_text, :s_bild)");
            $stm->bindParam(":s_name", $_POST['s_name']);
            $stm->bindParam(":s_hersteller", $_POST['s_hersteller']);
            $stm->bindParam(":s_preis", $_POST['s_preis']);
            $stm->bindParam(":s_text", $_POST['s_text']);
            $stm->bindParam(":s_bild", $image);
            $stm->execute();
        }

    // --------------------------------------------------------------------------------------------

    // Spiele bearbeiten --------------------------------------------------------------------------

        if(isset($_POST['artaend'])) 
        {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false)
            {
                $image = file_get_contents($_FILES["image"]["tmp_name"]);
                //echo "jo";
            }

            $stm = $pdo->prepare("UPDATE spiele SET s_name = :s_name, s_hersteller = :s_hersteller, s_preis = :s_preis, s_text = :s_text, s_bild = :s_bild WHERE s_id = :s_id");
            $stm->bindParam(":s_bild", $image);
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


    }

// ---------------------------------------------------------------------------------------------------



// Locks erstellen DEBUGFEAUTURE ----------------------------------------------------------------------------------

    echo "<form action=\"\" method=\"POST\"><input type=\"number\" name=\"spielid\" value=\"1\"><input type=\"submit\" name=\"lockerstellen\" value=\"lock\"></form>";

    if(isset($_POST['lockerstellen']))
    {
        $lockgenerate = md5(openssl_random_pseudo_bytes(32));
        $stm = $pdo->prepare("INSERT INTO locks (locks, s_id) VALUES (:locks, :s_id)");
        $stm->bindParam(":locks", $lockgenerate);
        $stm->bindParam(":s_id", $_POST['spielid']);
        $stm->execute();
    }

// --------------------------------------------------------------------------------------------------------------

?>