<?php require ROOT_PATH . '/view/inc/header.php'; ?>
    <div class="row">
        <h3>Editing <?= htmlentities($book->title); ?></h3>
        <?php
        if ($errors) {
            echo '<h5 class="error">';
            foreach ($errors as $field => $error) {
                echo htmlentities($error);
            }
            echo '</h5>';
        }
        ?>
        <form method="post" action="">
            <label for="isbn">ISBN </label>
            <input type="text" name="isbn" value="<?= htmlentities($book->isbn); ?>">
            <br>
            <label for="title">Title</label>
            <input type="text" name="title" size="50" value="<?= htmlentities($book->title); ?>">
            <br>
            <label for="author">Author</label>
            <input type="text" name="author" size="50" value="<?= htmlentities($book->author); ?>">
            <br>
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" size="50" value="<?= htmlentities($book->publisher); ?>">
            <br>
            <label for="pages">Pages</label>
            <input type="text"  name="pages" value="<?= htmlentities($book->pages); ?>">
            <br>
            <hr>
            <input type="submit" class="button-primary" name="save" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
<?php require ROOT_PATH . '/view/inc/footer.php'; ?>