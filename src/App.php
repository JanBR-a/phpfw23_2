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
            $controller=$this->request->getController();
            $action=$this->request->getAction();
            $this->dispatch($controller,$action);
        }
        
        private function dispatch($controller,$action){
          try{
              $nameController='\\App\Controllers\\'.ucfirst($controller).'Controller';
              $objContr=new $nameController();
              if(is_callable([$objContr,$action])){
                  call_user_func([$objContr,$action]);
              }else{
                call_user_func([$objContr,'error']);
              }
          }catch(\Exception $e){
            die($e->getMessage());
          }
        }
        private function getRoutes():array{
          $routes=[];
          $dir=__DIR__.'/Controllers';
          $handle=opendir($dir);
          while(($entry=readdir($handle))!=false){
            if($entry!='.' && $entry!='..'){
              $routes[]=strtolower(substr($entry,0,-14));
            }
          }
          return $routes;
        }
    }