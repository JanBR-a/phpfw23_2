<?php
    namespace App;

    //use App\Session;
    use App\Request;
use Exception;

    final class App{
      //  protected Session $session;
        protected Request $request;

        function __construct()
        {
            $this->request=new Request;
            //$request nos ofrece api o controlador y accion
            $controller=$this->request->getController();
            $action=$this->request->getAction();
          
            $this->dispatch($this->request->getApi(),$controller,$action);
        }
        
        private function dispatch($api,$controller,$action){
          try{
              if(in_array($controller,$this->getRoutes($api))){
                $nameController='\\App\Controllers\\'.ucfirst($controller).'Controller';
                $objContr=new $nameController();
                if(is_callable([$objContr,$action])){
                    call_user_func([$objContr,$action]);
                }else{
                  call_user_func([$objContr,'error']);
                }
              }else{
                throw new Exception("Route not found");
              }    
          }catch(\Exception $e){
            die($e->getMessage());
          }
        }
        private function getRoutes($api):array{
          $routes=[];
          if($api){
            $dir=__DIR__.'/api/Controllers';}
            else{
              $dir=__DIR__.'/Controllers';}
          $handle=opendir($dir);
          while(($entry=readdir($handle))!=false){
            if($entry!='.' && $entry!='..'){
              $routes[]=strtolower(substr($entry,0,-14));
            }
          }
          return $routes;
        }
    }