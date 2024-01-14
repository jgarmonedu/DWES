<?php
require_once 'Database.php';

class BooksGateway extends Database
{

    public function selectAll($order, $type,$startpage)
    {
        $pdo = Database::connect();
        $query = "SELECT * FROM Books ORDER BY $order $type limit $startpage , ". ITEMS_BY_PAGE;
        $sql = $pdo->prepare($query);
        $sql->execute();
        // $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        $Books = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $Books[] = $obj;
        }
        return $Books;
    }

    public function selectById($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM Books WHERE id = ?");
        $sql->bindValue(1, $id);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function insert($isbn, $title, $author, $publisher, $pages)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("INSERT INTO Books (isbn, title, author, publisher, pages) VALUES (?, ?, ?, ?, ?)");
        $result = $sql->execute(array($isbn, $title, $author, $publisher, $pages));
    }

    public function edit($isbn, $title, $author, $publisher, $pages, $id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("UPDATE Books set isbn = ?, title = ?, author = ?, publisher = ?, pages = ? WHERE id = ? LIMIT 1");
        $result = $sql->execute(array($isbn, $title, $author, $publisher, $pages, $id));
    }

    public function delete($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("DELETE FROM Books WHERE id = ?");
        $sql->execute(array($id));
    }

    public function selectFields(){
        $pdo = Database::connect();
        $sql = $pdo->prepare("SHOW COLUMNS FROM books");
        $sql->execute();
        $fields = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $fields[] = $obj->Field;
        }
        return $fields;
    }

    public function countBooks(){
        $pdo = Database::connect();
        $res = $pdo->query("SELECT COUNT(*) FROM Books")->fetchColumn();
        return $res;
    }

}

?>
