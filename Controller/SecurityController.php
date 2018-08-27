<?php


namespace Italia\SpidSymfonyBundle\Controller;


use Italia\Spid\Sp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    public function metadataAction()
    {
        return new Response($this->getSPClientInstance()->getSPMetadata());
    }

    public function acsAction(Request $request)
    {
        $sp = $this->getSPClientInstance();

        if ($sp->isAuthenticated()) {
            $out = "";
            foreach ($sp->getAttributes() as $key => $attr) {
                $out .= $key . ' - ' . $attr . '<br>';
            }
            return new Response($out);
        }
        throw new \Exception('Unauthenticated');
    }

    public function chooseidpAction(Request $request)
    {
        return new Response('choose one of the configured IDPs <a href="'.$this->container->getParameter('sp_entityid').'/login/local">local</a>');
    }

    public function loginAction(Request $request, $idp)
    {
        $sp = $this->getSPClientInstance();
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

    /**
     * @return Sp
     */
    private function getSPClientInstance(): Sp {
        /**
         * TODO: pass the configuration in a better way
         */
        $base = $this->container->getParameter('sp_entityid');
        $configuration = [
            'sp_entityid' => $this->container->getParameter('sp_entityid'),
            'sp_key_file' => $this->container->getParameter('sp_key_file'),
            'sp_cert_file' => $this->container->getParameter('sp_cert_file'),
            'sp_assertionconsumerservice' => [
                $base . '/acs'
            ],
            'sp_singlelogoutservice' => $base . '/slo',
            'sp_org_name' => $this->container->getParameter('sp_org_name'),
            'sp_org_display_name' => $this->container->getParameter('sp_org_display_name'),
            'idp_metadata_folder' => $this->container->getParameter('idp_metadata_folder').DIRECTORY_SEPARATOR,
            'sp_attributeconsumingservice' => [
                ["name", "familyName", "fiscalNumber", "email"],
                ["name", "familyName", "fiscalNumber", "email", "spidCode"]
            ]
        ];

        return new Sp($configuration);
    }
}