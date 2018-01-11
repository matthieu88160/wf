<?php

spl_autoload_register(
    function($className){
        $filename = sprintf('%s/%s.php', __DIR__, str_replace('\\', '/', $className));
        
        if (is_file($filename)) {
            require_once $filename;
        }
    }
);
