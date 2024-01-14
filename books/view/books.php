<?php 
require ROOT_PATH . '/view/inc/header.php'; 
?>
    <div class="row">
        <h1>Books list</h1>
    </div>
    <div class="row">
        <p class="new"><a href="index.php?op=new"><i class="fas fa-plus-circle"></i> Add a new book</a></p>
    </div>
    <div class="row" id="order">
        <h4>Order type</h4>
        <form method="GET">
             <select name="orderBy">
                <?php foreach ($fields as $field) {?>             
                    <option value='<?= $field ?>'><?= $field ?></option>
                <?php } ?>
            </select>
            <select name="orderOption" id="orderOption">
                <?php foreach (ORDERTYPE as $order) {?>             
                    <option value='<?= $order ?>'><?= $order ?></option>
                <?php } ?>
            </select>

            <input type="submit" value="Order">
        </form>
    </div>
    <div class="row">
        <h5 class="success">
        <?php  
        if (isset($_SESSION['success']) ) {
            echo (htmlentities($_SESSION['success']));
            unset($_SESSION['success']);
        }?>
        </h5>
        <table class="u-full-width">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Pages</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= htmlentities($book->isbn); ?></td>
                    <td><?= htmlentities($book->title); ?></td>
                    <td><?= htmlentities($book->author); ?></td>
                    <td><?= htmlentities($book->publisher); ?></td>
                    <td><?= htmlentities($book->pages); ?></td>
                    <td>
                        <a href="index.php?op=edit&id=<?= $book->id; ?>"><i class='fas fa-edit'></i></a>
                        <a href="index.php?op=delete&id=<?= $book->id; ?>"><i class='fas fa-trash'></i></a>
                        <a href="index.php?op=show&id=<?= $book->id; ?>"><i class='fas fa-eye'></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <section class="page">
            <p>   
                <?php if ($page != 1) {
                    $pageminus = $page-1;
                    echo "<a href='index.php?orderOption=$orderoption&orderBy=$orderby&page=1'>First</a> ";
                    echo "<a href='index.php?orderOption=$orderoption&orderBy=$orderby&page=$pageminus'>Previous</a>";
                } ?>
                | Page <?= $page ?> of <?= $totalpages ?> |
                <?php if ($page != $totalpages) {
                    $pageplus = $page+1;
                    echo "<a href='index.php?orderOption=$orderoption&orderBy=$orderby&page=$pageplus'>Next</a> ";
                    echo "<a href='index.php?orderOption=$orderoption&orderBy=$orderby&page=$totalpages'>Last</a>";
                } ?>
                
            </p>
        </section>
    </div>
    <div class="row center">
        <form method="GET">
            <input type="number" name="records" placeholder="Number of records">
            <input type="hidden" name="orderOption" value="<?= $orderoption ?? '' ?>">
            <input type="hidden" name="orderBy" value="<?= $orderby ?? '' ?>">
            <input type="submit" name="generatePDF" value="Generate PDF">
        </form>
    </div>

<?php require ROOT_PATH . '/view/inc/footer.php'; ?>