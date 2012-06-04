<?php

namespace Soloist\Bundle\MediaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function buttonAction($uri, $path_bg, $path_fg, $name, $description)
    {
        return array(
            'uri'         => $uri,
            'path_bg'     => $path_bg,
            'path_fg'     => $path_fg,
            'name'        => $name,
            'description' => $description,
        );
    }
}
