<?php namespace EasyXML;

use ICanBoogie\Inflector as BoogieInflector;

class Inflector
{
    private $inflector = null;

    public function __construct () {
        $this->inflector = BoogieInflector::get(BoogieInflector::DEFAULT_LOCALE);
    }

    public function __call ($name, $arguments) {
        if (method_exists($this->inflector, $name)) {
            return call_user_func_array([ $this->inflector, $name ], $arguments);
        }
        throw new EasyXMLException("Method '{$name}' is not available.");
    }
}