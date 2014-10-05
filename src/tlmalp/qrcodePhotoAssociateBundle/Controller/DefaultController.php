<?php

namespace tlmalp\qrcodePhotoAssociateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('tlmalpqrcodePhotoAssociateBundle:Default:index.html.twig');
    }

    /**
     * @Route("/hello/admin/{name}", name="_demo_secured_hello_admin")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Template()
     */
    public function associateAction($action, $qrcode, $photo)
    {
        return $this->render('tlmalpqrcodePhotoAssociateBundle:Default:associate.html.twig', array('action' => $action, 'qrcode' => $qrcode, 'photo' => $photo));
    }
}
