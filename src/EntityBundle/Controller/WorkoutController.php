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


}
