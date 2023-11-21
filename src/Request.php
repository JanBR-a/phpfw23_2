<?php
    namespace App;

    final class Request{
        private $controller;
        private $action;
        private $method;
        private $params;
        private $type;

        protected $arrURI;

        function __construct()
        {
            $url=$_SERVER['REQUEST_URI'];
            $uri_parts=explode('/',$url);
            array_shift($uri_parts);
            $first=$uri_parts[0];
            var_dump($uri_parts);
            die;
            if($first=""){
                $this->setController('index');
                $this->setAction('index');
            }
            elseif($first=="api"){
                $this->setType("api");
                $this->arrURI=array_slice($uri_parts,1);
            }else{
                $this->arrURI=array_slice($uri_parts,0); 
                $this->extractURI(); 
            }
                       
        }
        /**
         * extractURI
         * extract controllers and more
         */
        private function extractURI(){
            //estudi de casos possibles?
            $length=count($this->arrURI);
            var_dump($length);
            switch($length){
                case 1://only controller
                    if($this->arrURI[0]==""){
                        $this->setController('index');
                    }else{
                        $this->setController($this->arrURI[1]);
                    }
                    $this->setAction('index');
                    var_dump($this);
                    break;
                case 2://controller  & action
                    

                case 3: //controller & action & params
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
        public function getParams()
        {
                return $this->params;
        }

        /**
         * Set the value of params
         *
         * @return  self
         */ 
        public function setParams($params)
        {
                $this->params = $params;

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