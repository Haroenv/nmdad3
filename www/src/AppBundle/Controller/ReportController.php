<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Report;
use AppBundle\Form\ReportType;

/**
 * Report controller.
 *
 * @Route("/reports")
 */
class ReportController extends Controller
{
    /**
     * Lists all Report entities.
     *
     * @Route("/", name="report_index")
     * @Method("GET")
     * @Template("Report/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $reports = $em->getRepository('AppBundle:Report')->findAll();

        return [
            'reports' => $reports,
        ];
    }

    /**
     * Creates a new Report entity.
     *
     * @Route("/new", name="report_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $report = new Report();
        $form = $this->createForm('AppBundle\Form\ReportType', $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('report_show', array('id' => $report->getId()));
        }

        return $this->render('report/new.html.twig', array(
            'report' => $report,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Report entity.
     *
     * @Route("/{id}", name="report_show")
     * @Method("GET")
     */
    public function showAction(Report $report)
    {
        $deleteForm = $this->createDeleteForm($report);

        return $this->render('report/show.html.twig', array(
            'report' => $report,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Report entity.
     *
     * @Route("/{id}/edit", name="report_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Report $report)
    {
        $deleteForm = $this->createDeleteForm($report);
        $editForm = $this->createForm('AppBundle\Form\ReportType', $report);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('report_edit', array('id' => $report->getId()));
        }

        return $this->render('report/edit.html.twig', array(
            'report' => $report,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Report entity.
     *
     * @Route("/{id}", name="report_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Report $report)
    {
        $form = $this->createDeleteForm($report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($report);
            $em->flush();
        }

        return $this->redirectToRoute('report_index');
    }

    /**
     * Creates a form to delete a Report entity.
     *
     * @param Report $report The Report entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Report $report)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('report_delete', array('id' => $report->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
