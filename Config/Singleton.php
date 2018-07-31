<?php
trait Singleton
{
    public static $instances = [];

    public function getInstance() {
        $caller = get_called_class();

        if (!isset(self::$instances[$caller]))
            self::$instances[$caller] = new static;
        
        return self::$instances[$caller];
    }
}