<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Report;
use ApiBundle\Form\ReportType as ReportType;

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
 * Class ReportController.
 */
class ReportController extends Controller
{
    /**
     * Test API options and requirements.
     *
     * @return Response
     *
     * @FOSRest\Options("/reports/")
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK"
     *     }
     * )
     */
    public function optionsReportsAction()
    {
        # HTTP method: OPTIONS
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/reports/

        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, POST, PUT');

        return $response;
    }

    /**
     * Returns a specific Report.
     *
     * @param $report_id
     *
     * @return mixed
     *
     * @FOSRest\Get(
     *      "/reports/{report_id}",
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
    public function getReportAction($report_id)
    {
        $em = $this->getDoctrine()->getManager();
        $report = $em
            ->getRepository('AppBundle:Report')
            ->find($report_id);

        if (!$report instanceof Report) {
            throw new NotFoundHttpException('Not found');
        }

        return $report;
    }
    
    /**
     * Returns all reports.
     *
     * @return mixed
     * @FOSRest\Get(
     *     "/reports/",
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
    public function getReportsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Report');

        $report = $repository->findAll();

        return $report;
    }

    /**
     * Delete a Report.
     *
     * @param $report_id
     *
     * @throws NotFoundHttpException
     * @FOSRest\View(statusCode = 204)
     * @FOSRest\Delete(
     *     requirements = {
     *         "report_id"   : "\d+",
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
    public function deleteReportAction($report_id)
    {
        $em = $this->getDoctrine()->getManager();

        $report = $em
            ->getRepository('AppBundle:Report')
            ->find($report_id);

        if (!$report instanceof Report) {
            throw new NotFoundHttpException();
        }

        $em->remove($report);
        $em->flush();
    }

    /**
     * Post a new report.
     *
     * @param Request $request
     *
     * @return View|Response
     *
     * @FOSRest\View()
     * @FOSRest\Post(
     *     "/reports/{report_id}",
     *     name = "api_reports_post"
     * )
     * @Nelmio\ApiDoc(
     * input = "ApiBundle\Form\ReportType",
     *     statusCodes = {
     *         Response::HTTP_CREATED : "Created",
     *         Response::HTTP_BAD_REQUEST: "Please fill in all the necessary data."
     *     }
     * )
     */
    public function postReportAction(Request $request)
    {
        # HTTP method: POST
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/reports/
        $report = new Report();
        $logger = $this->get('logger');
        $logger->info($request);
        return $this->processReportForm($request, $report);
    }

    /**
     * Update a report.
     *
     * @param Request $request
     *
     * @param $report_id
     *
     * @return Response
     *
     * @FOSRest\View()
     * @FOSRest\Put(
     *     requirements = {
     *         "report_id" : "\d+",
     *         "_format" : "json|xml"
     *     }
     * )
     * @Nelmio\ApiDoc(
     *     input = "ApiBundle\Form\ReportType",
     *     statusCodes = {
     *         Response::HTTP_NO_CONTENT: "No Content"
     *     }
     * )
     */
    public function putReportAction(Request $request, $report_id)
    {

        $em = $this->getDoctrine()->getManager();
        $report = $em
            ->getRepository('AppBundle:Report')
            ->find($report_id);

        if (!$report instanceof Report) {
            throw new NotFoundHttpException();
        }

        return $this->processReportForm($request, $report);
    }


    /**
     * Process ReportType Form.
     *
     * @param Request $request
     * @param Report $report
     *
     * @return View|Response
     */
    private function processReportForm(Request $request, Report $report)
    {
        $form = $this->createForm(new ReportType(), $report, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $statusCode = is_null($report->getId()) ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
            $em = $this->getDoctrine()->getManager();
            $em->persist($report); // Manage entity Article for persistence.
            $em->flush();           // Persist to database.
            $response = new Response();
            $response->setStatusCode($statusCode);
            return $response;
        }
        return View::create($form, Response::HTTP_BAD_REQUEST);


    }
}