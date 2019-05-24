<?php

namespace EntityBundle\Controller;

use DateTime;
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
        if($request->get("username")!=null&&$request->get("password")!=null&&$request->get("email")!=null&&$request->get("name")!=null)
        { $user = new User();
        $user->setUsername($request->get("username"));
        /*    $var = strtotime($request->get("birthdate"));
            $newValue = date('dd-MM-yyyy', $var);

        */

   //     $date = \DateTime::createFromFormat("dd-MM-yyyy",$request->get("birthdate"));
            $date = new \DateTime();
          //  $date->setTimestamp($request->get('birthdate'));
           $user->setBirthdate($date);
            $user->setEmail($request->get("email"));
            $user->setPassword($request->get("password"));
            $user->setName($request->get("name"));
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
        $one=null;
        if($request->request->has('id'))
            $params["id"]=$request->get("id");
        if($request->request->has('password'))
            $params["password"]=$request->get("password");
        if($request->request->has('email'))
            $params["email"]=$request->get("email");
        if($request->request->has('name'))
            $params["username"]=$request->get("username");
        if(count($params)!=0) {
            $em = $this->getDoctrine()->getManager();
            $one = $em->getRepository('EntityBundle:User')->findOneBy($params);
        }
        $data = array();
        if($one!=null) {
            $data[] = array("id" => $one->getId(), "email" => $one->getEmail(), "password" => $one->getPassword(),"username"=>$one->getUsername());
        }else
         throw new AccessDeniedException("no data found");
        return new JsonResponse($data);
    }
}
