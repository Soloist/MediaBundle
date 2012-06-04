<?php

namespace Soloist\Bundle\MediaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Folder
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array|\Soloist\Bundle\MediaBundle\Entity\Media
     */
    protected $medias;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->medias = new ArrayCollection;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Soloist\Bundle\MediaBundle\Entity\Media $medias
     */
    public function addMedia(Media $media)
    {
        $this->medias->add($media);
    }

    /**
     * @return array|\Soloist\Bundle\MediaBundle\Entity\Media
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getRouteParams()
    {
        return array(
            'id' => $this->id
        );
    }

    public function __toString()
    {
        return $this->name;
    }

}

