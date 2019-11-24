<?php

namespace EntityBundle\Controller;

use EntityBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PostController extends Controller
{


    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if($request->get("title")!=null&&$request->get("description")!=null&&$request->get("userid")!=null)
        { $user = new Post();
            $user->setTitle($request->get("title"));
            $user->setDescription($request->get("description"));
            $user->setUserid($request->get("userid"));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $data=array("result"=>"ok");
        }
        return new JsonResponse($data);
    }

    /**
     * Lists one user entities as JSONObject.
         * @return Response
         */
        public function indexAction()
        {

            $articles=$this->getDoctrine()->getManager()->getRepository('EntityBundle:Post')->findAll();
            $serializer =  new Serializer([new ObjectNormalizer()]);
            $formatted =$serializer->normalize($articles);
            return new JsonResponse($formatted);

    }

    public function removesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('EntityBundle:Post')->find((int)$request->get('id'));
        $em->remove($p);
        $em->flush();
        $data=array("result"=>"ok");
        return new JsonResponse($data);
    }



}

