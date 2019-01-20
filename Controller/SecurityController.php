<?php


namespace Italia\SpidSymfonyBundle\Controller;


use Italia\Spid\Sp;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class SecurityController
 * @package Italia\SpidSymfonyBundle\Controller
 * @property Sp $sp
 */
class SecurityController extends Controller
{
    /**
     * @param Sp $sp
     */
    public function __construct(Sp $sp)
    {
        $this->sp = $sp;
    }

    public function metadataAction()
    {
        $response = new Response($this->sp->getSPMetadata());
        $response->headers->set('Content-Type', 'xml');
        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @Template()
     */
    public function chooseidpAction(Request $request)
    {
        return [];
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $idp = $request->query->get('idp');
        if(!$idp) {
            throw new BadRequestHttpException('Missing the idp parameter');
        }
        /**
         * FIXME: waiting for upstream to fix the issue in the library
         */
        if(!@$this->sp->login($idp, 0, 1)) {
            return new Response('Already logged in');
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @Template()
     */
    public function acsAction(Request $request)
    {
        if ($this->sp->isAuthenticated()) {
            return ['attributes' => $this->sp->getAttributes()];
        }
        return new Response("Unauthenticated", 401);
    }

    public function singleLogoutAction(Request $request)
    {
        throw new \Exception('Uninmplemented');
    }
}
