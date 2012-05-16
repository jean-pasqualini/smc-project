<?php

namespace Smc\Module\PhotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smc\Module\PhotoBundle\Entity\Document;
use Smc\Module\PhotoBundle\Form\DocumentType;

/**
 * Document controller.
 *
 */
class DocumentController extends Controller
{
    /**
     * Lists all Document entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SmcModulePhotoBundle:Document')->findAll();

        return $this->render('SmcModulePhotoBundle:Document:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Document entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModulePhotoBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SmcModulePhotoBundle:Document:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Document entity.
     *
     */
    public function newAction()
    {
        $entity = new Document();
        $form   = $this->createForm(new DocumentType(), $entity);

        return $this->render('SmcModulePhotoBundle:Document:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Document entity.
     *
     */
    public function createAction()
    {
        $entity  = new Document();
        $request = $this->getRequest();
        $form    = $this->createForm(new DocumentType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
			
			$entity->upload();
			
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('document_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SmcModulePhotoBundle:Document:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Document entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModulePhotoBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $editForm = $this->createForm(new DocumentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SmcModulePhotoBundle:Document:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Document entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModulePhotoBundle:Document')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Document entity.');
        }

        $editForm   = $this->createForm(new DocumentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('document_edit', array('id' => $id)));
        }

        return $this->render('SmcModulePhotoBundle:Document:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Document entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SmcModulePhotoBundle:Document')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Document entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('document'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
