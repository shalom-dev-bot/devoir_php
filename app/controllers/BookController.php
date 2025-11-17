<?php
use App\Models\Book;

$books = Book::all();
require '../views/books.php';