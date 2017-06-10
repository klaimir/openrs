<?php

if (!defined('APPPATH'))
    exit('No direct script access allowed');

class MY_Security extends CI_Security
{

    function __construct()
    {
        parent::__construct();
    }

    /**
    * CSRF Verify
    *
     * Necesitamos especificar manualmente este exclude URI porque no lo coge la función nativa
     * 
    * @return	CI_Security
    */
   public function csrf_verify()
   {
       $uri = load_class('URI', 'core');
       
       $uri_string_explode=explode("/", $uri->uri_string());
       
       if($uri_string_explode[0]=="inmuebles_imagenes" && $uri_string_explode[1]=="upload")
       {
           return $this;
       }
       else
       {
           return parent::csrf_verify();
       }
   }
}
