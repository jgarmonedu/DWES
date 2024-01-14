<?php require ROOT_PATH . '/view/inc/header.php'; ?>
    <div class="row">
        <h3>Showing book</h3>

        <section id="info">
            <p><b>ISBN:</b>  <?= $book->isbn; ?></p>
            <p><b>Title:</b>  <?=  $book->title; ?></p>
            <p><b>Author:</b> <?=  $book->author; ?> </p>
            <p><b>Publisher:</b> <?=  $book->publisher; ?> </p>
            <p><b>Pages:</b> <?=  $book->pages; ?> </p>
        </section>
        <form method="POST">
            <input class="button-primary" type="submit" name="cancel" value="Back">
        </form>

    </div>
<?php require ROOT_PATH . '/view/inc/footer.php'; ?>
