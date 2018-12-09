<?php
class Book {
    public $title;
    public $author;
    public $description;

    public function __construct($row)
    {
        $this->title = $row['name'];
        $this->author = $row['author'];
        $this->description = $row['desc'];
    }
}