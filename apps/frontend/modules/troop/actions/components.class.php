<?php // apps/frontend/modules/troop/actions/components.class.php
  class troopComponents extends sfComponents {
    public function executeWidgetCurrentEnrollment(sfWebRequest $request) {
      $this->checks['c'] = (bool)Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->getBySeason(date('y')+1)->getByCamp($this->user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(),$this->user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId())->execute();
      $this->checks['w'] = (bool)Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->getBySeason(date('y')+1)->getByCampWeek($this->user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(),$this->user->getProfile()->getActiveEnrollment()->getWeek()->getSlug())->execute();
      $this->checks['s'] = (bool)Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->getBySeason(date('y')+1)->getByWeek($this->user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(),$this->user->getProfile()->getActiveEnrollment()->getWeek()->getSlug())->getByCampSite($this->user->getProfile()->getActiveEnrollment()->getCampSite()->GetId())->execute();
    }
    public function executeWidgetFeeSvc(sfWebrequest $request) {
      // Widget :: feeSvcWidget
      // reservation counts
      $this->enrollments['incomplete']  = Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->getBySeason(date('Y')+1)->getByRegistrationStatus(false)->execute;
      $this->enrollments['complete']    = Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->getBySeason(date('Y')+1)->getByRegistrationStatus(true)->execute;
    }
    public function executeWidgetLeaderList(sfWebRequest $request) {
      // Widget :: leader list
      // autocomplete form
      
      // add form
      //$this->LeaderForm = new TroopLeaderForm();
      // attendance this season
      $leaders = null;
    }
    public function executeTroopDetails(sfWebRequest $request) {
      // Widget :: troop details
      // build form
      //$this->form = new TroopDetailForm($this->user->getProfile()->getActiveEnrollment()->getTroop()->getId());
    }
  }
?> 