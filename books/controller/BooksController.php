<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/books/model/Autoloader.php';

require_once ROOT_PATH . '/model/BooksService.php';
require_once ROOT_PATH . '/model/PDF.php';

session_start();

class BooksController
{
    private $booksService = null;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : null;

        try {

            if (!$op || $op == 'list') {
                $this->listBooks();
            } elseif ($op == 'new') {
                $this->saveBook();
            } elseif ($op == 'edit') {
                $this->editBook();
            } elseif ($op == 'delete') {
                $this->deleteBook();
            } elseif ($op == 'show') {
                $this->showBook();
            } else {
                $this->showError("Page not found", "Page for operation " . $op . " was not found!");
            }
        } catch (Exception $e) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function listBooks()
    {
        $fields = $this->booksService->getAllFields();
        $orderby = isset($_GET['orderBy']) ? htmlentities($_GET['orderBy']) : $fields[1];
        $orderoption = isset($_GET['orderOption']) ? htmlentities($_GET['orderOption']) : ORDERTYPE[0];
        $totalbooks = $this->booksService->getCountBooks();
        $totalpages = ceil($totalbooks/ITEMS_BY_PAGE);

        if (!in_array($orderby,$fields) || empty($orderby) ||       // Check orderby && orderoption value
            !in_array($orderoption,ORDERTYPE) || empty($orderoption)) {
            $this->redirect("index.php");
        }

        if ($page = isset($_GET['page'])) {         // Check page value
            $page = htmlentities($_GET['page']);
            if (!is_numeric($page) || empty($page)) {
                $this->redirect("index.php");
            } else {
                $startpage = ($page - 1) * ITEMS_BY_PAGE;
            }
         } else {
            $page = 1;
            $startpage = 0;
         }
        
         if (isset($_GET['generatePDF'])) {     //Check generatePDF
            $records = isset($_GET['records']) ? htmlentities($_GET['records']) : 10;
            $pdf = new PDF();
            $pdf->AddPage();
            // Output all columns
            $pdf->ShowTable($orderby,$orderoption,$records);
            $pdf->AddPage();
            // http://www.fpdf.org/en/doc/output.htm
            $pdf->Output();
        } else {
            $books = $this->booksService->getAllBooks($orderby,$orderoption,$startpage);
            include ROOT_PATH . '/view/books.php';
        }
    }

    public function saveBook()
    {
        $title = 'New book';

        $isbn = '';
        $title = '';
        $author = ''; 
        $publisher = '';
        $pages = '';

        $errors = array();  

        if (isset($_POST['cancel'])) {
            $this->redirect("index.php");
        }

        if (isset($_POST['save'])) {

            $isbn = isset($_POST['isbn']) ? htmlentities(trim($_POST['isbn'])) : null;
            $title = isset($_POST['title']) ? htmlentities(trim($_POST['title'])) : null;
            $author = isset($_POST['author']) ? htmlentities(trim($_POST['author'])) : null;
            $publisher = isset($_POST['publisher']) ? htmlentities(trim($_POST['publisher'])) : null;
            try {
                $this->booksService->createNewBook($isbn, $title, $author, $publisher, $pages);
                $_SESSION['success']="Book Created";
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // include 'view/Book-form.php';
        include ROOT_PATH . '/view/book-new.php';
    }

    public function editBook()
    {
        $title = "Edit book";

        if (isset($_POST['cancel'])) {
            $this->redirect("index.php");
        }
        
        $isbn = '';
        $title = '';
        $author = ''; 
        $publisher = '';
        $pages = '';
    
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $errors = array();

        $book = $this->booksService->getBook($id);

        if (isset($_POST['save'])) {
            $isbn = isset($_POST['isbn']) ? htmlentities(trim($_POST['isbn'])) : null;
            $title = isset($_POST['title']) ? htmlentities(trim($_POST['title'])) : null;
            $author = isset($_POST['author']) ? htmlentities(trim($_POST['author'])) : null;
            $publisher = isset($_POST['publisher']) ? htmlentities(trim($_POST['publisher'])) : null;
            $pages = isset($_POST['pages']) ? htmlentities(trim($_POST['pages'])) : null;

            try {
                $this->booksService->editBook($isbn, $title, $author, $publisher, $pages, $id);
                $_SESSION['success'] = "Book Modified";
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        // Include in the view of the edit form
        include ROOT_PATH . 'view/book-edit.php';
    }

    public function deleteBook()
    {
        if (isset($_POST['cancel'])) {
            $this->redirect("index.php");
        }

        $id = isset($_GET['id']) ? htmlentities($_GET['id']) : null;
        if (!$id) {
            throw new Exception('Internal error');
        } else {
            $book = $this->booksService->getBook($id);       
            if (isset($_POST['remove'])) {
                try {
                    $this->booksService->deleteBook($id);
                    $_SESSION['success'] = "Book Deleted";
                    $this->redirect('index.php');
                    return;
                } catch (ValidationException $e) {
                    $errors =$e->getErrors();
                }
            }
            include ROOT_PATH . 'view/book-delete.php';
        }
    }

    public function showBook()
    {

        $title = "Show book";

        if (isset($_POST['cancel'])) {
            $this->redirect("index.php");
        }
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $errors = array();

        if (!$id) {
            throw new Exception('Internal error');
        }
        $book = $this->booksService->getBook($id);

        include ROOT_PATH . 'view/book-show.php';
    }

    public function showError($title, $message)
    {
        include ROOT_PATH . 'view/error.php';
    }
}