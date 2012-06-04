<?php

namespace Soloist\Bundle\MediaBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class ImageType extends MediaType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('path', 'file')
        ;
    }

    public function getName()
    {
        return 'soloist_image';
    }
}
