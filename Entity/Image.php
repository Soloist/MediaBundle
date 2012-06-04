<?php

namespace Soloist\Bundle\MediaBundle\Entity;

class Image extends Media
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getComputedPath()
    {
        return $this->getBasePath().'/'.$this->path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getData()
    {
        return array(
            'path'  => $this->getComputedPath(),
            'title' => $this->name
        );
    }

    public function getType()
    {
        return 'image';
    }
}
