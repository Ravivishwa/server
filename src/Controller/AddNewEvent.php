<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Session;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddNewEvent
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request)
    {
//        $em = $this->container->get('doctrine.orm.default_entity_manager');
//        $event = $em->getRepository('App:Event')->find($request->get('id'));
        return $request;die;
        $session = $em->getRepository('App:Session')->findBy(['event' => $event->getId()]);
        if($event){
            $new = new Session();
            $new->setTime(new \DateTime());
            $event->addSessions($new);
            $em->persist($event);
            $em->flush();
        }
        return $event;

    }

}