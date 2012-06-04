<?php

namespace Soloist\Bundle\MediaBundle\EventListener;

use Soloist\Bundle\MediaBundle\Form\Type\BlockSettings\ButtonType,
    Soloist\Bundle\BlockBundle\EventListener\Event\RequestTypes;

class BlockListener
{
    /**
     * Listen to the RequestTypes event from block bundle
     *
     * @param \Solist\Bundle\BlockBundle\EventListener\Event\RequestTypes $event
     */
    public function onRequestTypes(RequestTypes $event)
    {
        $event->getManager()
            // Add last_news block
            ->addBlockType('button', array(
                'name'     => 'Bouton',
                'action'   => 'SoloistMediaBundle:Default:button',
                'settings' => array('uri' => null, 'path' => null, 'label' => null),
                'form'     => new ButtonType()
            ))
        ;
    }
}
