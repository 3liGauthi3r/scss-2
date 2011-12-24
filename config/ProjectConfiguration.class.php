<?php

require_once '/home/ner0tic/libraries/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfFacebookConnectPlugin');
    $this->enablePlugins('sfDependentSelectPlugin');
    $this->enablePlugins('sfDoctrineActAsTaggablePlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    //$this->enablePlugins('sfMediaBrowserPlugin');
    //$this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfAssetsManagerPlugin');
    $this->enablePlugins('sfDoctrineOAuthPlugin');
    //$this->enablePlugins('sfMelodyPlugin');
    //$this->enablePlugins('csSecurityTaskExtraPlugin');
    $this->enablePlugins('ddNavMenuPlugin');
    //$this->enablePlugins('stPhpConsolePlugin');
    //$this->enablePlugins('sfToolsPlugin');
  }
}
