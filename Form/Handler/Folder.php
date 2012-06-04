<?php

namespace Soloist\Bundle\MediaBundle\Form\Handler;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\FormFactory,
    Symfony\Component\Form\Form;

use Soloist\Bundle\MediaBundle\Entity\Folder as FolderEntity,
    Soloist\Bundle\MediaBundle\Form\Type\FolderType;

class Folder
{
    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $factory;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;


    public function __construct(EntityManager $em, FormFactory $factory)
    {
        $this->em      = $em;
        $this->factory = $factory;
    }

    public function create(Form $form, Request $request)
    {
        $form->bindRequest($request);
        if ($form->isValid()) {
            $this->em->persist($form->getData());
            $this->em->flush();

            return true;
        }

        return false;
    }

    public function update(Form $form, Request $request)
    {
        $form->bindRequest($request);
        if ($form->isValid()) {
            $this->em->flush();

            return true;
        }

        return false;
    }

    public function getCreateForm()
    {
        return $this->factory->create(new FolderType, new FolderEntity);
    }

    public function getUpdateForm(FolderEntity $folder)
    {
        return $this->factory->create(new FolderType, $folder);
    }
}
