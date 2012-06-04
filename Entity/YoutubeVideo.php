<?php

namespace Soloist\Bundle\MediaBundle\Entity;

class YoutubeVideo extends Video
{
    /**
     * @var string
     */
    protected $distId;

    /**
     * @param string $distId
     */
    public function setDistId($distId)
    {
        $this->distId = $distId;
    }

    /**
     * @return string
     */
    public function getDistId()
    {
        return $this->distId;
    }

    public function getType()
    {
        return 'youtube';
    }

    public function getData()
    {
        return array(
            'distId' => $this->distId,
            'title'  => $this->name
        );
    }
}
