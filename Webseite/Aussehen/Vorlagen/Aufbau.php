<?php ?>

<!doctype html>
<html lang="de">
  <head>
    <?php require('html/html_head.php') ?>
  </head>
  <body>
    <div id="page-wrapper">
        <?php require('html/header.php') ?>
        <div class="row content">
            <main class="container-fluid col-12 col-md-8">
                <div class="background-inner">
                <?php require('webseite/modules/controller/controller.php') ?>
                </div>
            </main>
        </div>
        <?php require('html/footer.php') ?>
      </div>
    <?php require('html/html_foot.php') ?>
      <!-- end: #page-wrapper -->
  </body>
</html>