<?php
include_once('../app/modules/products/model/Book.php');

class Model {
    /**
    * BESCHREIBUNG DER METHODE
    *
    * @param int Optional The number of rows to return (default=6)
    * @param int Optional The offset number of rows to start query (default=0)
    * @param string Optional column by which to order the articles (default="name DESC")
    * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of books
    */
    public function getBookList($numRows=6, $start=0, $order="name DESC")
    { 
        $conn = new PDO(DB_DSN , DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM books ORDER BY ". mysql_escape_string($order) . " LIMIT :numRows";
        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $result = $st->fetch();

        $list = array();

        while( $row = $st->fetch()){
            $book = new Book($row);
            $list[] = $book;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;

        return array(
            "books" => $list,
            "totalRows" => $totalRows[0]
        );
    }

    public function getBook($title)
    {
        $conn = new PDO(DB_DSN , DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM books WHERE name = :title";
        $st = $conn->prepare($sql);
        $st->bindValue(":title", $title, PDO::PARAM_STR);
        $st->execute();
        $result = $st->fetch();
        $conn = null;
        return $result;
    }
}
?>