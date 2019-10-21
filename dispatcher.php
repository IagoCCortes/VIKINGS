<?php
class Dispatcher {
    /*******************************************************************
    * Classe responsável por controlar a lógica de roteamento do site 
    ******************************************************************/
    private $request;

    public function dispatch() {
        /**************************************************************
         * Chama o método do controlador solicitado passando os devidos
         * parâmetros
         *************************************************************/
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController() {
        /**************************************************************
         * Realiza o require na classe controladora solicitada pela url
         *************************************************************/
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }
}
?>