<?php
    class View
    {
        protected $template_view = 'template_view.php';

        function generate($content_view, $data = null){
            include 'application/views/'.$this->template_view;
        }
    }