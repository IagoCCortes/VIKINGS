<?php
    class Controller {
        /***********************************************************************
        * Classe pai dos controladores responsável por criar o contexto (set) a 
        * ser usado pela view carregada e o layout em render 
        **********************************************************************/
        var $vars = [];
        var $layout = "default";

        function set($d) {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename) {
            extract($this->vars);
            ob_start();
            require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
            $content_for_layout = ob_get_clean();
            
            if ($this->layout == false) {
                $content_for_layout;
            }
            else {
                require(ROOT . "Views/Layouts/" . $this->layout . '.php');
            }
        }
    }
?>