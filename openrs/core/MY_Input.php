<?php

if (!defined('APPPATH'))
    exit('No direct script access allowed');

class MY_Input extends CI_Input
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Clean Keys
     *
     * This is a helper function. To prevent malicious users
     * from trying to exploit keys we make sure that keys are
     * only named with alpha-numeric text and a few other items.
     * 
     * Extended to allow: 
     *      - '.' (dot), 
     *      - '[' (open bracket),
     *      - ']' (close bracket)
     * 
     * @access  private
     * @param   string
     * @return  string
     */
    function _clean_input_keys($str, $fatal=true)
    {
        if (!preg_match("/^[a-z0-9:_\/\.\[\]-]+$/i", $str))
        {
            exit('Disallowed Key Characters.' . $str);
        }

        // Clean UTF-8 if supported
        if (UTF8_ENABLED === TRUE)
        {
            $str = $this->uni->clean_string($str);
        }

        return $str;
    }

    private function get_ip()
    {
        //Just get the headers if we can or else use the SERVER global
        if (function_exists('apache_request_headers'))
        {
            $headers = apache_request_headers();
        }
        else
        {
            $headers = $_SERVER;
        }
        //Get the forwarded IP if it exists
        if (array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        {
            $the_ip = $headers['X-Forwarded-For'];
        }
        elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
        )
        {
            $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
        }
        else
        {

            $the_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        }
        return $the_ip;
    }

    /**
     * Fetch the IP Address
     *
     * @return	string
     */
    public function ip_address()
    {
        if ($this->ip_address !== FALSE)
        {
            return $this->ip_address;
        }

        $proxy_ips = config_item('proxy_ips');
        if (!empty($proxy_ips))
        {
            $proxy_ips = explode(',', str_replace(' ', '', $proxy_ips));
            foreach (array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'HTTP_X_CLIENT_IP', 'HTTP_X_CLUSTER_CLIENT_IP') as $header)
            {
                if (($spoof = $this->server($header)) !== FALSE)
                {
                    // Some proxies typically list the whole chain of IP
                    // addresses through which the client has reached us.
                    // e.g. client_ip, proxy_ip1, proxy_ip2, etc.
                    if (strpos($spoof, ',') !== FALSE)
                    {
                        $spoof = explode(',', $spoof, 2);
                        $spoof = $spoof[0];
                    }

                    if (!$this->valid_ip($spoof))
                    {
                        $spoof = FALSE;
                    }
                    else
                    {
                        break;
                    }
                }
            }

            $this->ip_address = ($spoof !== FALSE && in_array($_SERVER['REMOTE_ADDR'], $proxy_ips, TRUE)) ? $spoof : $_SERVER['REMOTE_ADDR'];
        }
        else
        {
            $this->ip_address = $this->get_ip();
        }

        if (!$this->valid_ip($this->ip_address))
        {
            $this->ip_address = '0.0.0.0';
        }

        return $this->ip_address;
    }

}
