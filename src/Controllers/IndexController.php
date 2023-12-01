<?php
    namespace App\Controllers;
    use App\Request;
    use App\Controller;
    class IndexController extends Controller {
        function __construct($session,$request)
        {
            parent::__construct($session,$request);
            echo "IndexController";
           
        }
        function index(){
            echo "INDEX";
            
        }
        
    }