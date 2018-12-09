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
                <div class="titel row">
                    <h1>Title</h1>
                </div>
                <?php echo $content ?>
            </main>
            <aside id="sidebar" class="col-4">Sidebar</aside>
        </div>

        <?php require('html/footer.php') ?>
    </div> <!-- end: #page-wrapper -->
    <?php require('html/html_foot.php') ?>
  </body>
</html>