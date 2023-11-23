<?php 
   
   function extract_path_elements($request_uri) {
        $elements = explode('/', trim($request_uri, '/'));
    return $elements;
}
