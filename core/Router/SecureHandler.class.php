<?php
/*---------------------------------------------------------------------------
  SecureHandler									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Router
  Class		  : SecureHandler
---------------------------------------------------------------------------*/
namespace Router;

abstract class SecureHandler extends \Router\AuthenticationHandler
{

  public final function Request()
  {
    if($this->isAuthenticated())
    {
      $this->AuthenticatedRequest();
    }
    else
    {
      $this->AnonymousRequest();
    }
  }

  protected abstract function AuthenticatedRequest();
  protected abstract function AnonymousRequest();
}
?>
