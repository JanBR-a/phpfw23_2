<?php
    namespace App\Controllers;
    use App\Request;
    use App\Controller;
    use App\View;
    class IndexController extends Controller {
        function __construct($session,$request)
        {
            parent::__construct($session,$request); 
        }
        function index(){
            $data=[
                'title'=>'PHP2324',
                'user'=>'Linus'
            ];

            echo View::render('home',$data);
            
        }
        
    }