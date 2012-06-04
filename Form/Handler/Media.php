<?php

namespace Soloist\Bundle\MediaBundle\Form\Handler;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\File\UploadedFile,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\FormFactory,
    Symfony\Component\Form\Form;

use Soloist\Bundle\MediaBundle\Entity\Media as MediaEntity,
    Soloist\Bundle\MediaBundle\Media\Factory;

class Media
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $factory;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var \Soloist\Bundle\MediaBundle\Media\Factory
     */
    protected $mediaFactory;

    public function __construct(EntityManager $em, FormFactory $factory, Factory $mediaFactory, $rootDir)
    {
        $this->em           = $em;
        $this->factory      = $factory;
        $this->rootDir      = $rootDir;
        $this->mediaFactory = $mediaFactory;
    }

    public function create(Form $form, Request $request)
    {
        $form->bindRequest($request);
        if ($form->isValid()) {
            $this->checkFiles($form, $form->getData());
            $this->em->persist($form->getData());
            $this->em->flush();

            return true;
        }

        return false;
    }

    public function getCreateForm($type)
    {
        $media    = $this->mediaFactory->getMedia($type);
        $formType = $this->mediaFactory->getForm($type);

        return $this->factory->create($formType, $media);
    }

    protected function checkFiles(Form $form, MediaEntity $media)
    {
        foreach ($form as $key => $field) {
            if (($file = $field->getData()) instanceof UploadedFile) {
                // Compute dir
                $dir      = $this->rootDir.'/../web'.$media->getBasePath();

                // Remove extension, add an uniqid, replace extension
                $ext      = $file->guessExtension();
                $filename = $file->getClientOriginalName();
                $filename = substr($filename, 0, strrpos($filename, '.'));
                $filename = $media->sanitize($filename).'-'.uniqid().'.'.$ext;

                // Move the file, and stores the filename
                $file->move($dir, $filename);
                $method = 'set'.ucfirst($key);
                $media->$method($filename);
            }
        }
    }
}
