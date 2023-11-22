<?php
    namespace App\Controllers;

    class UserController{
        function __construct()
        {
            echo "UserController";
        }
        function index(){
            echo "INDEX";
        }
        function error(){
            echo "ERROR";
        }
    }