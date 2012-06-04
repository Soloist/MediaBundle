<?php

namespace Soloist\Bundle\MediaBundle\Entity;

abstract class Media
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
     * @var \Soloist\Bundle\MediaBundle\Entity\Folder
     */
    protected $folder;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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
     * @param \Soloist\Bundle\MediaBundle\Entity\Folder $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return \Soloist\Bundle\MediaBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getBasePath()
    {
        return '/uploads/'.$this->sanitize($this->folder->getName());
    }

    public function sanitize($name)
    {
        return strtolower(preg_replace('([^_a-zA-Z0-9])', '_', $name));
    }

    public function getRouteParams()
    {
        return array(
            'id'   => $this->id,
            'type' => $this->getType()
        );
    }

    abstract public function getType();

    abstract public function getData();
}
