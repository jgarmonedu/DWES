<?php

require_once 'BooksGateway.php';
require_once 'ValidationException.php';
require_once 'Database.php';

class BooksService extends BooksGateway
{

    private $BooksGateway = null;

    public function __construct()
    {
        $this->BooksGateway = new BooksGateway();
    }

    public function getAllBooks($order,$typeorder,$startpage)
    {
        try {
            self::connect();
            $res = $this->BooksGateway->selectAll($order,$typeorder,$startpage);
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getBook($id)
    {
        try {
            self::connect();
            $result = $this->BooksGateway->selectById($id);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
        return $this->BooksGateway->selectById($id);
    }

    private function validateBookParams($isbn, $title, $author, $publisher, $pages)
    {
        $errors = array();
        if (!isset($isbn) || empty($isbn)) {
            $errors[] = 'ISBN is required';
        }
        if (!isset($title) || empty($title)) {
            $errors[] = 'Title is required';
        }
        if (!isset($author) || empty($author)) {
            $errors[] = 'Author is required';
        }
        if (!isset($publisher) || empty($publisher)) {
            $errors[] = 'Publisher is required';
        }
        if (!isset($pages) || empty($pages)) {
            $errors[] = 'Pages is required';
        }
        if (empty($errors)) {
            return;
        }
        throw new ValidationException($errors);
    }

    public function createNewBook($isbn, $title, $author, $publisher, $pages)
    {
        try {
            self::connect();
            $this->validateBookParams($isbn, $title, $author, $publisher, $pages);
            $result = $this->BooksGateway->insert($isbn, $title, $author, $publisher, $pages);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function editBook($isbn, $title, $author, $publisher, $pages, $id)
    {
        try {
            self::connect();
            $this->validateBookParams($isbn, $title, $author, $publisher, $pages);
            $result = $this->BooksGateway->edit($isbn, $title, $author, $publisher, $pages, $id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function deleteBook($id)
    {
        try {
            self::connect();
            $result = $this->BooksGateway->delete($id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getAllFields()
    {
        try {
            self::connect();
            $res = $this->BooksGateway->selectFields();
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getCountBooks()
    {
        try {
            self::connect();
            $res = $this->BooksGateway->countBooks();
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
}

?>
