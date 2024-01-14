<?php require ROOT_PATH . '/view/inc/header.php'; ?>

<div class="row">
    <h3>New Book</h3>
    <?php 
    if ($errors) {
        echo '<h5 class="error">';
        foreach ($errors as $field => $error) {
            echo htmlentities($error);
        }
        echo '</h5>';
    }
    ?>
    <form method="POST">
        <label for="isbn">Isbn: </label>
        <input type="text" name="isbn" >
        <br>
        <label for="title">Title: </label>
        <input type="text" size="50" name="title" >
        <br>
        <label for="author">Author: </label>
        <input type="text" size="50" name="author" >
        <br>
        <label for="publisher">Publisher: </label>
        <input type="text" size="50" name="publisher" >
        <br>
        <label for="pages">Pages: </label>
        <input type="text"  name="pages" >
        <br>
        <hr>

        <input type="submit" class="button-primary" name="save" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
<?php require ROOT_PATH . '/view/inc/footer.php'; ?>