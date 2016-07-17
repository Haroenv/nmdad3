<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * User controller.
 *
 * @Route("/status")
 */
class StatusController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="status")
     * @Method("GET")
     * @Template("Status/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $status = $em->getRepository('AppBundle:Status')->findAll();

        return [
            'status' => $status,
        ];
    }
}
