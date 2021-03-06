<?php
namespace SCSS\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\CourseBundle\Entity\Course;
use SCSS\CourseBundle\Form\Type\CourseType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class CourseController extends Controller
{
    /**
     * @Route("/", name="scss_course_index")
     * @Template("SCSSCourseBundle:Course:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSCourseBundle:Course')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'courses' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_course_show")
     * @Template("SCSSCourseBundle:Course:show.html.twig")
     */
    public function showAction($slug)
    {
        $course = $this->getDoctrine()
            ->getRepository('SCSSCoursebundle:Course')
            ->findOneBySlug($slug);

        if (!$course) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching course found.'
                );
            $this->redirect($this->generateUrl('scss_course_index'));
        }

        return array('course' => $course);
    }

    /**
     * @Route("/new", name="scss_course_new")
     * @Template("SCSSCoursebundle:Course:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm(new CourseType(), $course);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($course);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'course created.'
                );

                return $this->render(
                    'SCSSCoursebundle:Course:show.html.twig',
                    array(
                        'course' => $course
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
