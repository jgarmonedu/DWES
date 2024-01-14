<?php require ROOT_PATH . '/view/inc/header.php'; ?>
    <div class="row center">
        <h3>Confirm remove: <?= htmlentities($book->title); ?></h3>
        <form method="POST" class="u-full-width">
            <div>
                <h5>Are you sure?</h5>
            </div>
            <div>
                <input type="submit" class="button-danger" name="remove" value="Remove">
                <input type="submit" name="cancel" value="Cancel">
            </div>
            <hr>
        </form>

    </div>
<?php require ROOT_PATH . '/view/inc/footer.php'; ?>