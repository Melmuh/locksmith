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
                <?php require('webseite/modules/controller/controller.php') ?>
            </main>
        </div>

        <?php require('html/footer.php') ?>
    </div> <!-- end: #page-wrapper -->
    <?php require('html/html_foot.php') ?>
  </body>
</html>