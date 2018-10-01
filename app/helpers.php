<?php

if (!function_exists('getContrastColor')) {
    // Taken from https://stackoverflow.com/a/42921358
    function getContrastColor($hexcolor)
    {
        $r = hexdec(substr($hexcolor, 1, 2));
        $g = hexdec(substr($hexcolor, 3, 2));
        $b = hexdec(substr($hexcolor, 5, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? '#000000' : '#ffffff';
    }
}

if (!function_exists('getRequestIpAddress')) {
    /**
     * Returns the real IP address of the request even if the website is using Cloudflare
     *
     * @return string
     */
    function getRequestIpAddress()
    {
        return $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
}

if (!function_exists('getRequestUserAgent')) {
    /**
     * Returns the user_agent of the request even if the website is using Cloudflare
     *
     * @return string
     */
    function getRequestUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    }
}

if (!function_exists('getRequestCountry')) {
    /**
     * Returns the country that the request has been sent from even if the website is using Cloudflare
     *
     * @return string
     */
    function getRequestCountry()
    {
        return $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'unknown';
    }
}

if (! function_exists('userAgentData')) {
    /**
     * Get browser information throug user agent information
     *
     * @return null|\WhichBrowser\Parser
     */
    function userAgentData()
    {
        if (!isset($_SERVER['HTTP_USER_AGENT'])) {
            return null;
        }

        $parser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);

        return $parser;
    }
}
