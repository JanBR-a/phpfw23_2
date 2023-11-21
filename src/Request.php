<?php
    namespace App;

    final class Request{
        private $controller;
        private $action;
        private $method;
        private $param;
        private $type;

        protected $arrURI;

        function __construct()
        {
            $url=$_SERVER['REQUEST_URI'];
            $uri_parts=explode('/',$url);
            
            array_shift($uri_parts);

           
            
           
            if($uri_parts[0]==""){
                $this->setController('index');
                $this->setAction('index');
              
            }elseif($uri_parts[0]=="api"){
                $this->setType("api");
                $uri_parts=array_slice($uri_parts,1);
                $this->arrURI=$uri_parts;
                $this->extractURI();
            }else{
                   
                $uri_parts=array_slice($uri_parts,0); 
                $this->arrURI=$uri_parts;
                $this->extractURI(); 
            }
                       
        }
        /**
         * extractURI
         * extract controllers and more
         */
        private function extractURI(){
            //estudi de casos possibles?
            if($this->arrURI[count($this->arrURI)-1]==""){
                array_pop($this->arrURI);
            }
            $length=count($this->arrURI);
            switch($length){
                case 1://only controller
                    if($this->arrURI[0]==""){
                        $this->setController('index');
                    }else{
                        $this->setController($this->arrURI[1]);
                    }
                    $this->setAction('index');
                   
                    break;
                case 2://controller  & action
                    $this->setController($this->arrURI[0]);
                    $this->setAction($this->arrURI[1]);
                    break;
                default: //controller & action & params
                    $this->setController($this->arrURI[0]);
                    $this->setAction($this->arrURI[1]);
                    $this->setParam($this->arrURI[2]);
            }
        }

        /**
         * Get the value of controller
         */ 
        public function getController()
        {
                return $this->controller;
        }

        /**
         * Set the value of controller
         *
         * @return  self
         */ 
        public function setController($controller)
        {
                $this->controller = $controller;

                return $this;
        }

        /**
         * Get the value of action
         */ 
        public function getAction()
        {
                return $this->action;
        }

        /**
         * Set the value of action
         *
         * @return  self
         */ 
        public function setAction($action)
        {
                $this->action = $action;

                return $this;
        }

        /**
         * Get the value of method
         */ 
        public function getMethod()
        {
                return $this->method;
        }

        /**
         * Set the value of method
         *
         * @return  self
         */ 
        public function setMethod($method)
        {
                $this->method = $method;

                return $this;
        }

        /**
         * Get the value of params
         */ 
        public function getParam()
        {
                return $this->param;
        }

        /**
         * Set the value of params
         *
         * @return  self
         */ 
        public function setParam($param)
        {
                $this->param = $param;

                return $this;
        }

        /**
         * Set the value of type
         *
         * @return  self
         */ 
        public function setType($type)
        {
                $this->type = $type;

                return $this;
        }

        
    }