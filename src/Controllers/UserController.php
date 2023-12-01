<?php
    namespace App\Controllers;
    use App\Request;
    use App\Controller;
    class UserController extends Controller {
      
        function __construct($session,$request)
        {
            parent::__construct($session,$request);
            echo "UserController";
         
        }
        function index(){
            echo "INDEX";
        }
       
    }