<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Status;
use ApiBundle\Form\StatusType as StatusType;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController as Controller;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation as Nelmio;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * Class StatusController.
 */
class StatusController extends Controller
{
    /**
     * Test API options and requirements.
     *
     * @return Response
     *
     * @FOSRest\Options("/status/")
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK"
     *     }
     * )
     */
    public function optionsStatusAction()
    {
        # HTTP method: OPTIONS
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/status/

        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, POST, PUT');

        return $response;
    }

    /**
     * Returns a specific Status.
     *
     * @param $status_id
     *
     * @return mixed
     *
     * @FOSRest\Get(
     *      "/status/{status_id}",
     *      requirements = {
     *          "_format": "json|jsonp|xml"
     *      }
     * )
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK",
     *         Response::HTTP_NOT_FOUND: "Not Found"
     *     }
     * )
     */
    public function getStatusAction($status_id)
    {
        $em = $this->getDoctrine()->getManager();
        $status = $em
            ->getRepository('AppBundle:Status')
            ->find($status_id);

        if (!$status instanceof Status) {
            throw new NotFoundHttpException('Not found');
        }

        return $status;
    }

    /**
     * Returns all status.
     *
     * @return mixed
     * @FOSRest\Get(
     *     "/status/",
     *     requirements = {
     *          "_format": "json|jsonp|xml"
     *     }
     * )
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK"
     *     }
     * )
     */
    public function getAllStatusAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Status');

        $status = $repository->findAll();

        return $status;
    }

    /**
     * Delete a Status.
     *
     * @param $status_id
     *
     * @throws NotFoundHttpException
     * @FOSRest\View(statusCode = 204)
     * @FOSRest\Delete(
     *     "/status/{status_id}",
     *     requirements = {
     *         "status_id"   : "\d+",
     *         "_format"   : "json|xml"
     *     },
     *     defaults = {"_format": "json"}
     * )
     * @Nelmio\ApiDoc(
     *     statusCodes = {
     *         Response::HTTP_NO_CONTENT: "No Content",
     *         Response::HTTP_NOT_FOUND : "Not Found"
     *     }
     * )
     */
    public function deleteStatusAction($status_id)
    {
        $em = $this->getDoctrine()->getManager();

        $status = $em
            ->getRepository('AppBundle:Status')
            ->find($status_id);

        if (!$status instanceof Status) {
            throw new NotFoundHttpException();
        }

        $em->remove($status);
        $em->flush();
    }

    /**
     * Post a new status.
     *
     * @param Request $request
     *
     * @return View|Response
     *
     * @FOSRest\View()
     * @FOSRest\Post(
     *     "/status/{status_id}",
     *     name = "api_status_post"
     * )
     * @Nelmio\ApiDoc(
     * input = "ApiBundle\Form\StatusType",
     *     statusCodes = {
     *         Response::HTTP_CREATED : "Created",
     *         Response::HTTP_BAD_REQUEST: "Please fill in all the necessary data."
     *     }
     * )
     */
    public function postStatusAction(Request $request)
    {
        # HTTP method: POST
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/status/
        $status = new Status();
        $logger = $this->get('logger');
        $logger->info($request);
        return $this->processStatusForm($request, $status);
    }

    /**
     * Update a status.
     *
     * @param Request $request
     *
     * @param $status_id
     *
     * @return Response
     *
     * @FOSRest\View()
     * @FOSRest\Put(
     *     "/status/{status_id}",
     *     requirements = {
     *         "status_id" : "\d+",
     *         "_format" : "json|xml"
     *     }
     * )
     * @Nelmio\ApiDoc(
     *     input = "ApiBundle\Form\StatusType",
     *     statusCodes = {
     *         Response::HTTP_NO_CONTENT: "No Content"
     *     }
     * )
     */
    public function putStatusAction(Request $request, $status_id)
    {

        $em = $this->getDoctrine()->getManager();
        $status = $em
            ->getRepository('AppBundle:Status')
            ->find($status_id);

        if (!$status instanceof Status) {
            throw new NotFoundHttpException();
        }

        return $this->processStatusForm($request, $status);
    }


    /**
     * Process StatusType Form.
     *
     * @param Request $request
     * @param Status $status
     *
     * @return View|Response
     */
    private function processStatusForm(Request $request, Status $status)
    {
        $form = $this->createForm(new StatusType(), $status, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $statusCode = is_null($status->getId()) ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
            $em = $this->getDoctrine()->getManager();
            $em->persist($status); // Manage entity Article for persistence.
            $em->flush();           // Persist to database.
            $response = new Response();
            $response->setStatusCode($statusCode);
            return $response;
        }
        return View::create($form, Response::HTTP_BAD_REQUEST);


    }
}