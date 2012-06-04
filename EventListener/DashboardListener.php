<?php

namespace Soloist\Bundle\MediaBundle\EventListener;

use FrequenceWeb\Bundle\DashboardBundle\Menu\Event\Configure;


class DashboardListener
{
    public function onConfigureTopMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Medias', array('route' => 'soloist_admin_media_index'));
    }
}
