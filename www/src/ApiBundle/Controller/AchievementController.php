<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Achievement;

use ApiBundle\Form\AchievementType as AchievementType;
use ApiBundle\Form\AchievementEditType as AchievementEditType;

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
 * Class AchievementController.
 */
class AchievementController extends Controller
{

    /**
     * Test API options and requirements.
     *
     * @return Response
     *
     * @FOSRest\Options("/achievements/")
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK"
     *     }
     * )
     */
    public function optionsAchievementsAction()
    {
        # HTTP method: OPTIONS
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/achievements/

        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, POST, PUT');

        return $response;
    }

    /**
     * Returns all achievements.
     *
     * @return mixed
     * @FOSRest\Get(
     *     "/achievements/",
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
    public function getAchievementsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Achievement');

        $achievements = $repository->findAll();

        return $achievements;
    }


    /**
     * Returns a specific achievement.
     * @param $achievement_id
     *
     * @return mixed
     *
     * @FOSRest\Get(
     *      "/achievements/{achievement_id}",
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
    public function getAchievementAction($achievement_id)
    {
        $em = $this->getDoctrine()->getManager();
        $achievement = $em
            ->getRepository('AppBundle:Achievement')
            ->find($achievement_id);

        if (!$achievement instanceof Achievement) {
            throw new NotFoundHttpException('Not found');
        }

        return $achievement;
    }

    /**
     * Delete an Achievement.
     *
     * @param $achievement_id
     *
     * @throws NotFoundHttpException
     * @FOSRest\View(statusCode = 204)
     * @FOSRest\Delete(
     *     requirements = {
     *         "achievement_id"   : "\d+",
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
    public function deleteAchievementAction($achievement_id)
    {
        $em = $this->getDoctrine()->getManager();

        $achievement = $em
            ->getRepository('AppBundle:Achievement')
            ->find($achievement_id);

        if (!$achievement instanceof Achievement) {
            throw new NotFoundHttpException();
        }

        $em->remove($achievement);
        $em->flush();
    }

    /**
     * Post a new achievement.
     *
     * @param Request $request
     *
     * @return View|Response
     *
     * @FOSRest\View()
     * @FOSRest\Post(
     *     "/achievements/",
     *     name = "api_achievements_post"
     * )
     * @Nelmio\ApiDoc(
     * input = "ApiBundle\Form\AchievementType",
     *     statusCodes = {
     *         Response::HTTP_CREATED : "Created",
     *         Response::HTTP_BAD_REQUEST: "Please fill in all the necessary data."
     *     }
     * )
     */
    public function postAchievementAction(Request $request)
    {
        # HTTP method: POST
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/achievements/
        $user = new Achievement();
        $logger = $this->get('logger');
        $logger->info($request);
        return $this->processAchievementForm($request, $user);
    }

    /**
     * Update an achievement.
     *
     * @param Request $request
     *
     * @param $achievement_id
     *
     * @return Response
     *
     * @FOSRest\View()
     * @FOSRest\Post(
     *     "/achievements/{achievement_id}",
     *     requirements = {
     *         "achievement_id" : "\d+",
     *         "_format" : "json|xml"
     *     }
     * )
     * @Nelmio\ApiDoc(
     *     input = "ApiBundle\Form\AchievementType",
     *     statusCodes = {
     *         Response::HTTP_NO_CONTENT: "No Content"
     *     }
     * )
     */
    public function putAchievementAction(Request $request, $achievement_id)
    {

        $em = $this->getDoctrine()->getManager();
        $achievement = $em
            ->getRepository('AppBundle:Achievement')
            ->find($achievement_id);

        if (!$achievement instanceof Achievement) {
            throw new NotFoundHttpException();
        }

        return $this->processAchievementForm($request, $achievement);
    }


    /**
     * Process AchievementType Form.
     *
     * @param Request $request
     * @param Achievement $achievement
     *
     * @return View|Response
     */
    private function processAchievementForm(Request $request, Achievement $achievement)
    {
        $form = $this->createForm(new AchievementType(), $achievement, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $statusCode = is_null($achievement->getId()) ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
            $em = $this->getDoctrine()->getManager();
            $em->persist($achievement); // Manage entity Achievement for persistence.
            $em->flush();           // Persist to database.
            $response = new Response();
            $response->setStatusCode($statusCode);
            return $response;
        }
        return View::create($form, Response::HTTP_BAD_REQUEST);


    }
}