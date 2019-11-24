<?php

namespace EntityBundle\Controller;


use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntityBundle\Entity\User;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if($request->get("firstname")!=null&&$request->get("lastname")!=null&&$request->get("password")!=null&&$request->get("email")!=null)
        { $user = new User();
        $user->setFirstName($request->get("firstname"));
            $date = new \DateTime();
           $user->setCreationDate($date);
            $user->setEmail($request->get("email"));
            $user->setPassword($request->get("password"));
            $user->setLastName($request->get("lastname"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $data=array("result"=>"ok");
        }
     return new JsonResponse($data);
    }

    /**
     * Lists one user entities as JSONObject.
     * @param Request $request
         * @return Response
         */
        public function indexAction(Request $request)
        {
            $params=array();
                $params["password"]=$request->get("password");
                $params["email"]=$request->get("email");
                $em = $this->getDoctrine()->getManager();
                $one = $em->getRepository('EntityBundle:User')->findOneBy(array('email' => $request->get("email"),'password' => $request->get('password')));
        $data = array();

        if($one!=null) {
            $serializer =  new Serializer([new ObjectNormalizer()]);
            $formatted =$serializer->normalize($one);
        }else
         throw new AccessDeniedException("no data found");
        return new JsonResponse($formatted);
    }

}

