<?php

namespace SCSS\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SCSSReportBundle:Report:index.html.twig', array('name' => $name));
    }
}
