<?php

namespace EntityBundle\Controller;

use EntityBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommentsController extends Controller
{


    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if($request->get("comments")!=null&&$request->get("postid")!=null)
        { $user = new Comments();
            $user->setComment($request->get("comments"));
            $user->setPost($request->get('postid'));
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

            $articles=$this->getDoctrine()->getManager()
                ->getRepository('EntityBundle:Comments')->findAll();
            $serializer =  new Serializer([new ObjectNormalizer()]);
            $formatted =$serializer->normalize($articles);
            return new JsonResponse($formatted);

    }



}

