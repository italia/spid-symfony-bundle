<?php


namespace Italia\SpidSymfonyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    public function metadataAction()
    {
        $sp = $this->get("spid.configuredSPClient");
        $response = new Response($sp->getSPMetadata());
        $response->headers->set('Content-Type', 'xml');
        return $response;
    }

    public function chooseidpAction(Request $request)
    {
        return new Response('choose one of the configured IDPs <a href="'.$this->container->getParameter('sp_entityid').'/login/local">local</a>');
    }

    public function loginAction(Request $request, $idp)
    {
        $sp = $this->get("spid.configuredSPClient");
        /**
         * FIXME: waiting for upstream to fix the issue in the library
         */
        if(!@$sp->login($idp, 0, 1)) {
            return new Response('Already logged in');
        }
    }

    public function singleLogoutAction(Request $request)
    {
        throw new \Exception('Uninmplemented');
    }
}