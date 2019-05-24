<?php

namespace EntityBundle\Controller;

use DateTime;
use EntityBundle\Entity\User;
use EntityBundle\Entity\WorkOut;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WorkoutController extends Controller
{

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $data=array("result"=>"missing params");
        if($request->get("user_id")!=null&&$request->get("name")!=null&&$request->get("DayOfWeek")!=null&&$request->get("time")!=null)
        { $workout = new WorkOut();
        $workout->setDayOfWeek($request->get('DayOfWeek'));
        $workout->setName($request->get('name'));
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($request->get('user_id'));
        $workout->setUser($user);
        $workout->setTime($request->get('time'));
            $em->persist($workout);
            $em->flush();
            $data=array("result"=>"ok");
        }
     return new JsonResponse($data);
    }

    public function getAllAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($request->get('id'));
        $list = $em->getRepository('EntityBundle:Workout')->findBy(array("user"=>$user));
        $data=array();
        forEach( $list as $one){
            $data[] = array("name"=>$one->getName(),"time"=>$one->getTime(),"dateOfWeek"=>$one->getDayOfWeek());
        }
          return new JsonResponse($data);
    }


}
