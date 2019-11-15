<?php


namespace App\Controller;

//use App\Entity\Event;
//use App\Entity\Session;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class EventDataController
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request)
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $eventGuests = $em->getRepository('App:EventGuest')->findBy(['event' => $request->get('id')]);
        $eventSessions = $em->getRepository('App:EventSession')->findBy(['event' => $request->get('id')]);
        $data['event_guests'] = $eventGuests;
        $x=[];
        foreach ($eventSessions as $key=>$a){
            $sessionGuests = $em->getRepository('App:SessionGuest')->findBy(['session' => $a->getSession()->getId()]);
            $data['event_sessions'][$key]['id']= $a->getSession()->getId();
            $data['event_sessions'][$key]['time']= $a->getSession()->getTime();

            foreach ($sessionGuests as $k=>$s){
                $x[$k]['id']= $s->getGuest()->getID();
                $x[$k]['first_name']= $s->getGuest()->getFirstName();
                $x[$k]['last_name']= $s->getGuest()->getLastName();
                $x[$k]['head_shot_url']= $s->getGuest()->getHeadShotUrl();
            }
            $data['event_sessions'][$key]['session_guests'] = $x;
        }
        return $data;

    }

}