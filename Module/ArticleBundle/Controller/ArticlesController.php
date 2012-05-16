<?php

namespace Smc\Module\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smc\Module\ArticleBundle\Entity\Articles;
use Smc\Module\ArticleBundle\Form\ArticlesType;

/**
 * Articles controller.
 *
 */
class ArticlesController extends Controller
{
    /**
     * Lists all Articles entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SmcModuleArticleBundle:Articles')->findAll();

        return $this->render('SmcModuleArticleBundle:Articles:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Articles entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModuleArticleBundle:Articles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SmcModuleArticleBundle:Articles:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Articles entity.
     *
     */
    public function newAction()
    {
        $entity = new Articles();
        $form   = $this->createForm(new ArticlesType(), $entity);

        return $this->render('SmcModuleArticleBundle:Articles:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Articles entity.
     *
     */
    public function createAction()
    {
        $entity  = new Articles();
        $request = $this->getRequest();
        $form    = $this->createForm(new ArticlesType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articles_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SmcModuleArticleBundle:Articles:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Articles entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModuleArticleBundle:Articles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $editForm = $this->createForm(new ArticlesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SmcModuleArticleBundle:Articles:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Articles entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SmcModuleArticleBundle:Articles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $editForm   = $this->createForm(new ArticlesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articles_edit', array('id' => $id)));
        }

        return $this->render('SmcModuleArticleBundle:Articles:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Articles entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SmcModuleArticleBundle:Articles')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Articles entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('articles'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
