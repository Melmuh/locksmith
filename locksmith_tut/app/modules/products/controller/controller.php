<?php
include_once('../app/modules/products/model/model.php');

class Products {
    
    public $model;
    public $html;

    public function __construct()
    {   
        $this->model = new Model();
    }

    public function invoke()
    {
        if(!isset($_GET['book']))
        {  
             // no special book is requested, we'll show a list of all available books  
             $booklist = $this->model->getBookList();
             ob_start();
             include '../app/modules/products/view/booklist.php';
             $this->html = ob_get_contents();
             ob_end_clean();

        } 
        else 
        { 
            // show the requested book 
            $book = $this->model->getBook($_GET['book']); 
            ob_start();
            include '../app/modules/products/view/viewbook.php';
            $this->html = ob_get_contents();
            ob_end_clean();
        }  
    }
};
