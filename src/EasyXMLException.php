<?php namespace EasyXML;

class EasyXMLException extends \Exception
{
    public function __construct ($message) {
        parent::__construct($message);
    }
}