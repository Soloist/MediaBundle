<?php

namespace Soloist\Bundle\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Soloist\Bundle\MediaBundle\Entity\Folder,
    Soloist\Bundle\MediaBundle\Entity\Media;

class AdminController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        $this->addBaseBreadcrumb(false);

        return array('folders' => $this->getFolderRepository()->findAllOrderedByName());
    }

    /**
     * @Template
     */
    public function newAction($type)
    {
        $this->addBaseBreadcrumb()->add('Nouveau média');

        return array('form' => $this->getFormHandler()->getCreateForm($type)->createView(), 'type' => $type);
    }

    /**
     * @Template("SoloistMediaBundle:Admin:new.html.twig")
     */
    public function createAction($type, Request $request)
    {
        $this->addBaseBreadcrumb()->add('Nouveau média');
        $handler = $this->getFormHandler();
        $form    = $handler->getCreateForm($type);

        if ($handler->create($form, $request)) {
            $this->get('session')->setFlash('success', 'Le média a bien été créé');

            return $this->redirectIndex();
        }

        return array('form' => $form->createView(), 'type' => $type);
    }

    public function deleteAction(Media $media)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($media);
        $em->flush();
        $this->get('session')->setFlash('success', 'Le média a été supprimé avec succès');

        return $this->redirectIndex();
    }

    /**
     * @Template
     */
    public function newFolderAction()
    {
        $this->addBaseBreadcrumb()->add('Nouveau dossier');

        return array('form' => $this->getFolderFormHandler()->getCreateForm()->createView());
    }

    /**
     * @Template("SoloistMediaBundle:Admin:newFolder.html.twig")
     */
    public function createFolderAction(Request $request)
    {
        $this->addBaseBreadcrumb()->add('Nouveau dossier');
        $handler = $this->getFolderFormHandler();
        $form    = $handler->getCreateForm();

        if ($handler->create($form, $request)) {
            $this->get('session')->setFlash('success', 'Le dossier a bien été créé');

            return $this->redirectIndex();
        }

        return array('form' => $form->createView());
    }

    /**
     * @Template
     */
    public function editFolderAction(Folder $folder)
    {
        $this->addBaseBreadcrumb()->add('Editer le dossier '.$folder->getName());

        return array('form' => $this->getFolderFormHandler()->getUpdateForm($folder)->createView(), 'folder' => $folder);
    }

    /**
     * @Template("SoloistMediaBundle:Admin:editFolder.html.twig")
     */
    public function updateFolderAction(Folder $folder, Request $request)
    {
        $this->addBaseBreadcrumb()->add('Editer le dossier '.$folder->getName());
        $handler = $this->getFolderFormHandler();
        $form    = $handler->getUpdateForm($folder);

        if ($handler->update($form, $request)) {
            $this->get('session')->setFlash('success', 'Le dossier a bien été modifié');

            return $this->redirectIndex();
        }

        return array('form' => $form->createView(), 'folder' => $folder);
    }

    public function deleteFolderAction(Folder $folder)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($folder);
        $em->flush();
        $this->get('session')->setFlash('success', 'Le dossier a été supprimé avec succès');

        return $this->redirectIndex();
    }

    /**
     * @param bool $linkList
     * @return \FrequenceWeb\Bundle\DashboardBundle\Breadcrumbs\Manager
     */
    protected function addBaseBreadcrumb($linkList = true)
    {
        $params = array();
        if (true === $linkList) {
            $params  = array('route' => 'soloist_admin_media_index');
        }

        return $this->get('fw_breadcrumbs')
            ->add('Tableau de bord', array('route' => 'fw_dashboard_index'))
            ->add('Gestion des medias', $params);
    }

    protected function getMediaRepository()
    {
        return $this->getDoctrine()->getEntityManager()->getRepository('SoloistMediaBundle:Media');
    }

    /**
     * @return \Soloist\Bundle\MediaBundle\Entity\Repository\Folder
     */
    protected function getFolderRepository()
    {
        return $this->getDoctrine()->getEntityManager()->getRepository('SoloistMediaBundle:Folder');
    }

    /**
     * @return \Soloist\Bundle\MediaBundle\Form\Handler\Media
     */
    protected function getFormHandler()
    {
        return $this->get('soloist.media.form.handler');
    }

    /**
     * @return \Soloist\Bundle\MediaBundle\Form\Handler\Folder
     */
    protected function getFolderFormHandler()
    {
        return $this->get('soloist.media.folder.form.handler');
    }

    protected function redirectIndex()
    {
        if ($this->getRequest()->query->has('nolayout')) {
            return $this->redirect($this->generateUrl('soloist_admin_media_index').'?nolayout');
        }

        return $this->redirect($this->generateUrl('soloist_admin_media_index'));
    }
}
