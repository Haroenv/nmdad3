<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Achievement;
use AppBundle\Form\AchievementType;

/**
 * Achievement controller.
 *
 * @Route("/achievements")
 */
class AchievementController extends Controller
{
    /**
     * Lists all Achievement entities.
     *
     * @Route("/", name="achievement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $achievements = $em->getRepository('AppBundle:Achievement')->findAll();

        return $this->render('achievement/index.html.twig', array(
            'achievements' => $achievements,
        ));
    }

    /**
     * Creates a new Achievement entity.
     *
     * @Route("/new", name="achievement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $achievement = new Achievement();
        $form = $this->createForm('AppBundle\Form\AchievementType', $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($achievement);
            $em->flush();

            return $this->redirectToRoute('achievement_show', array('id' => $achievement->getId()));
        }

        return $this->render('achievement/new.html.twig', array(
            'achievement' => $achievement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Achievement entity.
     *
     * @Route("/{id}", name="achievement_show")
     * @Method("GET")
     */
    public function showAction(Achievement $achievement)
    {
        $deleteForm = $this->createDeleteForm($achievement);

        return $this->render('achievement/show.html.twig', array(
            'achievement' => $achievement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Achievement entity.
     *
     * @Route("/{id}/edit", name="achievement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Achievement $achievement)
    {
        $deleteForm = $this->createDeleteForm($achievement);
        $editForm = $this->createForm('AppBundle\Form\AchievementType', $achievement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($achievement);
            $em->flush();

            return $this->redirectToRoute('achievement_edit', array('id' => $achievement->getId()));
        }

        return $this->render('achievement/edit.html.twig', array(
            'achievement' => $achievement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Achievement entity.
     *
     * @Route("/{id}", name="achievement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Achievement $achievement)
    {
        $form = $this->createDeleteForm($achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($achievement);
            $em->flush();
        }

        return $this->redirectToRoute('achievement_index');
    }

    /**
     * Creates a form to delete a Achievement entity.
     *
     * @param Achievement $achievement The Achievement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Achievement $achievement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achievement_delete', array('id' => $achievement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
