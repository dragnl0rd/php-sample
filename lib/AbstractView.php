<?php
abstract class AbstractView
{
    protected $_template = 'default.phtml'; 
    protected $_properties = array();
    
    protected $_headScript;
    protected $_headLink;

    // constructor
    public function __construct($template = '', array $data = array())
    {
        $this->_headScript = new HeadScript();
        $this->_headLink = new HeadLink();
        
        if ($template !== '') {
            $this->setTemplate($template);
        }
        if (!empty($data)) {
            foreach ($data as $name => $value) {
                $this->$name = $value;
            }
        } 
    }
    
    // set a new view template
    public function setTemplate($template)
    {
        $template = explode('controller', $template);
        $template = implode('', $template);
        $template = $template . '.phtml';

        try{
            ob_start();
            require $template;
            ob_end_clean();
        }catch(Exception $e){
            throw new ViewException('The specified view template: ' . $template . ' does not exist.');    
        }
        
        
        $this->_template = $template;
    }
      
    // get the view template
    public function getTemplate()
    {
        return $this->_template;
    }
      
    // set a new property for the view
    public function __set($name, $value)
    {
        $this->_properties[$name] = $value;
    }

    // get the specified property from the view
    public function __get($name)
    {
        if (!isset($this->_properties[$name])) {
            throw new ViewException('The requested property is not valid for this view.');      
        }
        return $this->_properties[$name];
    }

    // remove the specified property from the view
    public function __unset($name)
    {
        if (isset($this->_properties[$name])) {
            unset($this->_properties[$name]);
        }
    }
    
    public function addScript($fileName){
        $this->_headScript->add($fileName);
    }
    
    public function addLink($fileName){
        $this->_headLink->add($fileName);
    }
    
    // add a new view (implemented by view subclasses)
    abstract public function addView(AbstractView $view);
    
    // remove a view (implemented by view subclasses)
    abstract public function removeView(AbstractView $view);
    
    // render the view template
    public function render()
    {
        $this->_properties['jsFiles'] = $this->_headScript->__toString();
        $this->_properties['cssFiles'] = $this->_headLink->__toString();
        if ($this->_template !== '') {
           extract($this->_properties);
           ob_start();
           include($this->_template);
           return ob_get_clean(); 
        } 
    }
}// End AbstractView class


class ViewException extends Exception{}



