<?php
class Router {
    /**************************************************************
    * Faz o parser da url solicitada 
    **************************************************************/
    static public function parse($url, $request) {

        $url = trim($url);
        if ($url == "/VIKINGS-master/") {
            $request->controller = "cartorios";
            $request->action = "index";
            $request->params = [];
        }else {
            if (strpos($url, "?") !== false) {
                $explode_url = substr($url, 0, strpos($url, "?"));
            }else{
                $explode_url = $url;
            }
            $explode_url = explode('/', $explode_url);
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}
?>