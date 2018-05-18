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
  
    public function __construct($templateFile) 
    {
        $this->file = 'templating/templates/' . $templateFile;
    }
    
    public function set($key, $value) 
    {
        $this->values[$key] = $value;
    }
      
    public function output() {
        if (!file_exists($this->file)) 
        {
            return "Error loading template file ($this->file).";
        }
        $output = file_get_contents($this->file);
      
        foreach ($this->values as $key => $value) 
        {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }
      
        return $output;
    }
    
}