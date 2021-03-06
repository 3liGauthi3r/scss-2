<?php
namespace SCSS\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\CourseBundle\Entity\SCSSClass;
use SCSS\CourseBundle\Form\Type\SCSSClassType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class SCSSClassController extends Controller
{
    /**
     * @Route("/", name="scss_class_index")
     * @Template("SCSSCourseBundle:SCSSClass:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSCourseBundle:SCSSClass')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'classs' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_class_show")
     * @Template("SCSSCourseBundle:SCSSClass:show.html.twig")
     */
    public function showAction($slug)
    {
        $class = $this->getDoctrine()
            ->getRepository('SCSSCoursebundle:SCSSClass')
            ->findOneBySlug($slug);

        if (!$class) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching class found.'
                );
            $this->redirect($this->generateUrl('scss_class_index'));
        }

        return array('class' => $class);
    }

    /**
     * @Route("/new", name="scss_class_new")
     * @Template("SCSSCoursebundle:SCSSClass:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $class = new SCSSClass();
        $form = $this->createForm(new SCSSClassType(), $class);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($class);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'class created.'
                );

                return $this->render(
                    'SCSSCoursebundle:SCSSClass:show.html.twig',
                    array(
                        'class' => $class
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
