<?php


namespace Application\engine;


class Url
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function link($route = '')
    {
        return $this->url . $route;
    }
}