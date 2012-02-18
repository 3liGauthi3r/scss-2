<?php

/**
 * ScssCamp
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    scss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ScssCamp extends BaseScssCamp
{
	public function getCourse($mb) {
		$q = Doctrine::getTable('ScssCourse')
                   ->createQuery('c')
		   ->where('c.meritbadge_id = ?',$mb)
                   ->andWhere('c.camp_id = ?',$this->getId());
		$ret = $q->execute();
		return $ret;
  }
  public function getCourses() {
    $q = Doctrine_Core::getTable('ScssCourse')->createQuery('c')->where('c.camp_id = ?',$this->getId());
    $r = $q->execute();
    return $r;
  }
	public function hasCourse($mb) {
	  return ($this->getCourse($mb)->count() >=1);
	}
    
    public function getCampSlug() { return $this->getSlug(); }
    public function getDistrictSlug() { return $this->getDistrict()->getSlug(); }
}
