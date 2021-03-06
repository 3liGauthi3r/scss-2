<?php
namespace SCSS\EnrollmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\EnrollmentBundle\Entity\ActiveEnrollment;
use SCSS\EnrollmentBundle\Form\Type\ActiveEnrollmentType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class ActiveEnrollmentController extends Controller
{
    /**
     * @Route("/", name="scss_active_enrollment_index")
     * @Template("SCSSEnrollmentBundle:ActiveEnrollment:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSEnrollmentBundle:ActiveEnrollment')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'active_enrollments' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_active_enrollment_show")
     * @Template("SCSSEnrollmentBundle:ActiveEnrollment:show.html.twig")
     */
    public function showAction($slug)
    {
        $active_enrollment = $this->getDoctrine()
            ->getRepository('SCSSEnrollmentBundle:ActiveEnrollment')
            ->findOneBySlug($slug);

        if (!$active_enrollment) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching active_enrollment found.'
                );
            $this->redirect($this->generateUrl('scss_active_enrollment_index'));
        }

        return array('active_enrollment' => $active_enrollment);
    }

    /**
     * @Route("/new", name="scss_active_enrollment_new")
     * @Template("SCSSEnrollmentBundle:ActiveEnrollment:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $active_enrollment = new ActiveEnrollment();
        $form = $this->createForm(new ActiveEnrollmentType(), $active_enrollment);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($active_enrollment);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'active_enrollment created.'
                );

                return $this->render(
                    'SCSSEnrollmentBundle:ActiveEnrollment:show.html.twig',
                    array(
                        'active_enrollment' => $active_enrollment
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
