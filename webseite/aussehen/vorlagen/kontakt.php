<?php ?>

<!doctype html>
<html lang="de">
  <head>
    <?php require('html/html_head.php') ?>
  </head>
  <body>
    <div id="page-wrapper" class="container" style="background-color: white">
        <?php require('html/header.php') ?>
        <div class="row content">
            <main class="container-fluid col-12 col-md-8">
                <h3 class="row"> Du hast Fragen oder Anmerkungen?<br> Dann kontaktiere uns gerne per Mail!
                </h3>
                <form id="contact-form" method="post" action="contact.php" role="form">

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Vorname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Dein Vorname *" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Nachname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Dein Nachname *" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Deine Email Adresse *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_need">Wähle dein Anliegen *</label>
                                    <select id="form_need" name="need" class="form-control" required="required" data-error="Please specify your need.">
                                        <option value=""></option>
                                        <option value="Request quotation">Probleme mit dem KEY oder dem Spiel</option>
                                        <option value="Request order status">Email Versand</option>
                                        <option value="Request copy of an invoice">Rechnungen</option>
                                        <option value="Other">Sonstiges</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Deine Nachricht *</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Deine Nachricht an uns *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <acceptance>Mit dem Versenden des Kontaktformulares erklären Sie sich mit der Verarbeitung Ihrer Daten einverstanden. Siehe Datenschutzerklärung.</acceptance><br>
                                <input type="submit" class="btn btn-success btn-send" value="Nachricht senden">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted">
                                    <strong>*</strong> Pflichtfelder
                            </div>
                        </div>
                    </div>

                </form>

            </main>
        </div>

        <?php require('html/footer.php') ?>
    </div> <!-- end: #page-wrapper -->
    <?php require('html/html_foot.php') ?>
  </body>
</html>