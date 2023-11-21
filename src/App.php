<?php
    namespace App;

    //use App\Session;
    use App\Request;

    final class App{
      //  protected Session $session;
        protected Request $request;

        function __construct()
        {
            $this->request=new Request;
            //$request nos ofrece api o controlador y accion
            echo $this->request->getController();
            echo $this->request->getAction();
        }
        
    }