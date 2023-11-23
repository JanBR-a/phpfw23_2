<?php
    namespace App\Controllers;

    class IndexController{
        function __construct()
        {
            echo "IndexController";
        }
        function index(){
            echo "INDEX";
        }
        function error(){
            echo "ERROR";
        }
    }