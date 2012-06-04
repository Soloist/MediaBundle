<?php

namespace Soloist\Bundle\MediaBundle\Media;

class Factory
{
    /**
     * @var array
     */
    protected $medias = array();

    /**
     * @var array
     */
    protected $formTypes = array();

    public function __construct(array $config)
    {
        foreach ($config['media_types'] as $key => $values) {
            $this->medias[$key]    = $values['class'];
            $this->formTypes[$key] = $values['form_type'];
        }
    }

    /**
     * @param $type
     * @return \Soloist\Bundle\MediaBundle\Entity\Media
     */
    public function getMedia($type)
    {
        return new $this->medias[$type];
    }

    /**
     * @param $type
     * @param \Soloist\Bundle\MediaBundle\Form\Type\MediaType
     */
    public function getForm($type)
    {
        return new $this->formTypes[$type];
    }
}
