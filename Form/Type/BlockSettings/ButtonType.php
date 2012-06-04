<?php

namespace Soloist\Bundle\MediaBundle\Form\Type\BlockSettings;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface;

class ButtonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uri', 'url')
            ->add('path_bg')
            ->add('path_fg')
            ->add('name')
            ->add('description')
        ;
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'soloist_core_button_block_settings';
    }

}
