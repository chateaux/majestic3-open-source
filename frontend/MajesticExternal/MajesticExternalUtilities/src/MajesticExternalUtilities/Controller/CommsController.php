<?php
namespace MajesticExternalUtilities\Controller;

use FrontCore\Adapters\AbstractCoreActionController;

class CommsController extends AbstractCoreActionController
{
	/**
	 * Container for the External Utilities Model
	 * @var \MajesticExternalUtilities\Models\MajesticExternalUtilitiesModel
	 */
	private $model_external_utilities;

    public function viewOnlineAction()
    {
    	//set layout
    	$this->layout('layout/body-pane');

		$comm_history_id = $this->params()->fromRoute("comm_history_id", "");
		$comm_id = $this->params()->fromQuery("cid", "");

		//make sure ids are encoded
		if (is_numeric($comm_history_id) || is_numeric($comm_id))
		{
			echo "<h3>Data could not be loaded. Required data is not available</h3>";
			exit;
		}//end if

		try {
			$objCommContent = $this->getExternalUtilitiesModel()->viewCommOnline($comm_history_id, $comm_id);
		} catch (\Exception $e) {
			echo '<p>A problem has occured and the page could not be loaded. Please try again later or consult the profile admin for further assistance</p>';
			echo '<!--';
			echo $e->getMessage();
			echo '-->';
			exit;
		}//end catch

		return array(
			"objCommContent" => $objCommContent,
		);
    }//end function

    /**
     * Create an instance of the External Utilities Model using the Service Manager
     * @return \MajesticExternalUtilities\Models\MajesticExternalUtilitiesModel
     */
    private function getExternalUtilitiesModel()
    {
    	if (!$this->model_external_utilities)
    	{
    		$this->model_external_utilities = $this->getServiceLocator()->get("MajesticExternalUtilities\Models\MajesticExternalUtilitiesModel");
    	}//end if

    	return $this->model_external_utilities;
    }//end function
}//end class
