<?php

class Route {

    private $view;
    private $arrUrl;
    private $method;

    /**
     * Constructs a new instance.
     *
     * @param      <type>  $url    The url
     */
    public function __construct($url){

        if(Controller::validaGet($url)){

            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->arrUrl = explode('/', $url);
            
        }
    }

    /**
     * Sets the view.
     *
     * @param      <type>  $view   The view
     */
    public function setView($view){
        $this->view = $view;
    }

    /**
     * Gets the arr url.
     *
     * @param      <type>  $pos    The position
     *
     * @return     bool    The arr url.
     */
    public function getArrUrl($pos){
        if(isset($this->arrUrl[$pos])){
            return $this->arrUrl[$pos];
        }
        return false;
    }

    /**
     * Gets the view.
     *
     * @return     <type>  The view.
     */
    public function getView(){
        return $this->view;
    }
}