<?php

namespace EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntityBundle\Entity\User;
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
        if($request->get("password")!=null&&$request->get("email")!=null&&$request->get("name")!=null)
        { $user = new User();
            $user->setEmail($request->get("email"));
            $user->setPassword($request->get("password"));
            $user->setName($request->get("name"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $data=array("result"=>"ok");
        }
        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
