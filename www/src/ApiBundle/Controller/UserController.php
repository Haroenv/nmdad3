<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\User;
use ApiBundle\Form\UserType as UserType;

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
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * Test API options and requirements.
     *
     * @return Response
     *
     * @FOSRest\Options("/users/")
     *
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK"
     *     }
     * )
     */
    public function optionsUsersAction()
    {
        # HTTP method: OPTIONS
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/users/

        $response = new Response();
        $response->headers->set('Allow', 'OPTIONS, GET, POST, PUT');

        return $response;
    }

    /**
     * Returns a specific User.
     *
     * @param $user_id
     *
     * @return mixed
     *
     * @FOSRest\Get(
     *      "/users/{user_id}",
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
    public function getUserAction($user_id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em
            ->getRepository('AppBundle:User')
            ->find($user_id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException('Not found');
        }

        return $user;
    }

    /**
     * Returns logged in user.
     *
     *
     * @return mixed
     * @FOSRest\Get(
     *      "/user/",
     *      requirements = {
     *          "_format": "json|jsonp|xml"
     *      }
     * )
     * @Nelmio\ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         Response::HTTP_OK: "OK",
     *     }
     * )
     */
    public function getLoggedInUserAction()
    {
        $user = $this->getUser();
        return $user;
    }

    /**
     * Returns all users.
     *
     * @return mixed
     * @FOSRest\Get(
     *     "/users/",
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
    public function getUsersAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = $repository->findAll();

        return $user;
    }

    /**
     * Delete a User.
     *
     * @param $user_id
     *
     * @throws NotFoundHttpException
     * @FOSRest\View(statusCode = 204)
     * @FOSRest\Delete(
     *     requirements = {
     *         "user_id"   : "\d+",
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
    public function deleteUserAction($user_id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em
            ->getRepository('AppBundle:User')
            ->find($user_id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException();
        }

        $em->remove($user);
        $em->flush();
    }

    /**
     * Post a new user.
     *
     * @param Request $request
     *
     * @return View|Response
     *
     * @FOSRest\View()
     * @FOSRest\Post(
     *     "/users/{user_id}",
     *     name = "api_users_post"
     * )
     * @Nelmio\ApiDoc(
     * input = "ApiBundle\Form\UserType",
     *     statusCodes = {
     *         Response::HTTP_CREATED : "Created",
     *         Response::HTTP_BAD_REQUEST: "Please fill in all the necessary data."
     *     }
     * )
     */
    public function postUserAction(Request $request)
    {
        # HTTP method: POST
        # Host/port  : http://www.trashcam.local
        #
        # Path       : /api/v1/users/
        $user = new User();
        $logger = $this->get('logger');
        $logger->info($request);
        return $this->processUserForm($request, $user);
    }

    /**
     * Update a user.
     *
     * @param Request $request
     *
     * @param $user_id
     *
     * @return Response
     *
     * @FOSRest\View()
     * @FOSRest\Put(
     *     requirements = {
     *         "user_id" : "\d+",
     *         "_format" : "json|xml"
     *     }
     * )
     * @Nelmio\ApiDoc(
     *     input = "ApiBundle\Form\UserType",
     *     statusCodes = {
     *         Response::HTTP_NO_CONTENT: "No Content"
     *     }
     * )
     */
    public function putUserAction(Request $request, $user_id)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em
            ->getRepository('AppBundle:User')
            ->find($user_id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException();
        }

        return $this->processUserForm($request, $user);
    }


    /**
     * Process UserType Form.
     *
     * @param Request $request
     * @param User $user
     *
     * @return View|Response
     */
    private function processUserForm(Request $request, User $user)
    {
        $form = $this->createForm(new UserType(), $user, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $statusCode = is_null($user->getId()) ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
            $em = $this->getDoctrine()->getManager();
            $em->persist($user); // Manage entity Article for persistence.
            $em->flush();           // Persist to database.
            $response = new Response();
            $response->setStatusCode($statusCode);
            return $response;
        }
        return View::create($form, Response::HTTP_BAD_REQUEST);


    }
}