<?php
namespace FrontPowerTools\Events;

use FrontCore\Adapters\AbstractCoreAdapter;

class FrontPowerToolsWebhooksEvents extends AbstractCoreAdapter
{
	
	public function registerEvents()
	{
		$eventManager = $this->getEventManager()->getSharedManager();
		$serviceManager = $this->getServiceLocator();
	

	}//end function
	
}//end class
