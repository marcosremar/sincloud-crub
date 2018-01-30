<?php
class View{
    function __construct($page, $variables = []){
        extract($variables);
        include($page);
        return $this;
    }
}
