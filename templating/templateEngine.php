<?php
/*
***
TEMPLATING ENGINE FROM:
http://www.broculos.net/2008/03/how-to-make-simple-html-template-engine.html
****
*/

namespace templating;

class templateEngine 
{
    private $templateFile;
    private $values = array();
    private $HTMLelements = array();
    
    public function __construct($templateFile) 
    {
        $this->templateFile = 'templating/templates/' . $templateFile;
    }
    
    public function generateElement($key)
    {
        $this->HTMLelements[$key] = file_get_contents("templating/templates/elements/$key.tpl");
        //echo var_dump($this->HTMLelements);
    }
    
    public function setValue($key, $value) 
    {
        $this->values[$key] = $value;
    }
    

      
    public function output() {
        if (!file_exists($this->templateFile)) 
        {
            return "Error loading template file ($this->templateFile).";
        }
        $output = file_get_contents("http://moris.pw/infobox/$this->templateFile");


        foreach($this->HTMLelements as $key => $HTMLelement) 
        {
            $tagToReplace = "[[$key]]";
            $output = str_replace($tagToReplace, $HTMLelement, $output);
        }
      
        foreach($this->values as $key => $value) 
        {
            $tagToReplace = "[$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }
    
}