<?php
require_once __DIR__ . '/../models/Book.php';

class BookController {
    private $book;

    public function __construct() {
        $this->book = new Book();
    }

    // Liste tous les livres
    public function index() {
        $books = $this->book->read();
        require __DIR__ . '/../views/list.php';
    }

    // Formulaire de création
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->book->title = htmlspecialchars($_POST['title']);
            $this->book->author = htmlspecialchars($_POST['author']);

            if ($this->book->create()) {
                header("Location: index.php?action=list");
                exit;
            } else {
                $error = "Error creating book.";
                require __DIR__ . '/../views/create.php';
            }
        } else {
            require __DIR__ . '/../views/create.php';
        }
    }

    // Formulaire d'édition
    public function edit($id) {
        $bookData = $this->book->readSingle($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->book->id = $id;
            $this->book->title = htmlspecialchars($_POST['title']);
            $this->book->author = htmlspecialchars($_POST['author']);

            if ($this->book->update()) {
                header("Location: index.php?action=list");
                exit;
            } else {
                $error = "Error updating book.";
            }
        }

        require __DIR__ . '/../views/edit.php';
    }

    // Supprimer un livre
    public function delete($id) {
        $this->book->delete($id);
        header("Location: index.php?action=list");
        exit;
    }
}
