<?php

namespace App\Controller;

//use App\Entity\Event;
//use App\Entity\Session;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class EventController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request)
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $allEvents = $em->getRepository('App:Event')->findAll();
        $results = [];
        foreach ($allEvents as $key=>$a){
            $session = $em->getRepository('App:EventSession')->findBy(['event' =>$a->getId()]);
            $guest = $em->getRepository('App:EventGuest')->findBy(['event' =>$a->getId()]);
            $results[$key]['id'] = $a->getId();
            $results[$key]['event_location'] = $a->getLocation();
            $results[$key]['event_date'] = $a->getDate();
            $results[$key]['session_count'] = count($session);
            $results[$key]['guest_count'] = count($guest);

         }
        return $results;

    }

}