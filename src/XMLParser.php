<?php namespace EasyXML;

class XMLParser
{
    public $guessType = false;
    public $omitEmpty = false;
    public $keepRoot = true;
    public $keepAttributes = true;
    public $attributesToElement = true;

    private $path = null;
    private $xmlParser = null;
    private $originalContent = '';
    private $rootName = '';

    public function __construct ($pathToXml = null) {
        $this->feedXml($pathToXml);
    }

    public function feedXml ($pathToXml) {
        $this->path = trim($pathToXml);

        return $this;
    }

    public function parse () {
        // check if path is empty
        if (empty($this->path)) {
            throw new EasyXMLException("Empty XML Path");
        }
        // set the parser to SimpleXML
        if (file_exists($this->path)) {
            $content = file_get_contents($this->path);
            $xmlParser = simplexml_load_file($this->path);
        } else {
            if (filter_var($this->path, FILTER_VALIDATE_URL)) {
                $content = load_from_url($this->path);
            } else {
                $content = $this->path;
            }
            $xmlParser = simplexml_load_string($content);
        }

        if (false === $xmlParser) {
            throw new EasyXMLException("Failed to load XML.");
        }

        // set the contents and parser
        $this->originalContent = $content;
        $this->xmlParser = $xmlParser;

        // should keep the root name?
        if ($this->keepRoot == true) {
            $this->rootName = $xmlParser->getName();
        }
        // xml parser to json
        return json_decode(json_encode($this->rootName ? [ $this->rootName => $this->xmlParser ] : $this->xmlParser), true);
    }
}