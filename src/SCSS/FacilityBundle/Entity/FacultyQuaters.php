<?php
namespace SCSS\FacilityBundle\Entity;

class FacultyQuaters extends Quarters
{
    public function __construct()
    {
        $this->setType('faculty');
    }
}
