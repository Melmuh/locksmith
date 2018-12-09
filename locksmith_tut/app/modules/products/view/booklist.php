<div class="row">

    <?php foreach ($booklist['books'] as $title => $book): ?>
        
        <div class="card col-4">
            <img class="card-img-top" src="https://source.unsplash.com/100x100/" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $book->title ?></h5>
                <p class="card-text"><?php echo $book->description ?></p>

                <a href="/products/index.php?book=<?php echo $book->title ?>" class="btn btn-block btn-outline-success">Go somewhere</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
