<?php
    class Request {
        /**************************************************************
         * Carrega o atributo $url com a URI dada para acessar esta
         * página
         *************************************************************/
        public $url;
        
        public function __construct() {
            $this->url = $_SERVER["REQUEST_URI"];
        }
    }
?>