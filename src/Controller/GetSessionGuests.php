<?php

namespace App\Controller;

//use App\Entity\Event;
//use App\Entity\Session;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class GetSessionGuests
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request)
    {
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $eventData = $em->getRepository('App:SessionData')->findAll();
        $allEvents = $em->getRepository('App:Event')->findAll();

        $results = [];
        if($request->get('eventId')){
            $eventById = $em->getRepository('App:SessionData')->findBy(['event' => $request->get('eventId')]);
            foreach ($eventById as $s){
                $id = $s->getSessions()->getId();
                $results[$id]['session_time'] = $s->getSessions()->getTime();
                $results[$id]['guests'][] = $s->getGuest();
            }
            return $results;
        }else{
            return $eventData;
        }
    }

}