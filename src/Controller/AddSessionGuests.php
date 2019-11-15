<?php

namespace App\Controller;

//use App\Entity\Event;
//use App\Entity\Session;
use App\Entity\SessionGuest;
use App\Entity\User;
use App\Helper\ModuleContentHelper;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


class AddSessionGuests
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager();
        $data = json_decode($this->container->get('request_stack')->getCurrentRequest()->getContent());

        $sessionId = $request->get('session_id');
        $session = $em->getRepository('App:Session')->find($sessionId);
        $allSessionGuests = $em->getRepository('App:SessionGuest')->findBy(['session' => $sessionId]);

        foreach ($allSessionGuests as $s){
            if(!in_array($s->getGuest()->getId(),$data)){
                $em->remove($s);
            }
        }
        $em->flush();

        foreach ($data as $d) {
            $guest = $em->getRepository('App:Guest')->find($d);

            $sessionGuests = $em->getRepository('App:SessionGuest')->findBy([
                'session' => $sessionId,
                'guest' => $d
            ]);

            if(!count($sessionGuests)){
                $new = new SessionGuest();
                $new->setSession($session);
                $new->setGuest($guest);
                $em->persist($new);
                $em->flush();
            }
        }


        return $allSessionGuests;
    }
}