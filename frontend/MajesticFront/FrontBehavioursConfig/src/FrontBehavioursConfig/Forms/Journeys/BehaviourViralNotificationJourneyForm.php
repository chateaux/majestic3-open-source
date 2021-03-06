<?php
namespace FrontBehavioursConfig\Forms\Journeys;

use FrontCore\Forms\FrontCoreSystemFormBase;

/**
 * Form is used to restructure the form received from the API for the Journey no start behaviour since it is so invloved.
 * The default behaviour engine cannot render the received form correctly
 * @author ettiene
 *
 */
class BehaviourViralNotificationJourneyForm extends FrontCoreSystemFormBase
{
	/**
	 * Container for javascript set below for the form
	 * @var string
	 */
	public $additional_javascript;

	public function __construct($objForm)
	{
		parent::__construct('behaviour-journey-viral-notification-journey');
		$this->setAttribute("method", "post");

		//set field elements in correct order
		$arr_fields = array(
				'description',
				'fk_form_id',
				'active',

				//hidden fields
				'event_runtime_trigger',
				'behaviour',
				'beh_action',
				'setup_complete',
		);

		foreach ($arr_fields as $field)
		{
			$objElement = $objForm->get($field);
			$objForm->remove($field);
			$this->add(array(
					'name' => $objElement->getAttribute('name'),
					'type' => $objElement->getAttribute('type'),
					'attributes' => $objElement->getAttributes(),
					'options' => $objElement->getOptions(),
			));
		}//end foreach

		$this->add(array(
				'type' => 'submit',
				'name' => 'submit',
				'attributes' => array(
						'value' => 'Submit',
				),
				'options' => array(
						'value' => 'Submit',
				),
		));

		$this->setJavascript();
	}//end function

	private function setJavascript()
	{
		$s = '<script type="text/javascript">';
		$s .=	'jQuery(document).ready(function () {
					//finally, intercept the form submit to assign values to field_value and field_operator hidden fields
					jQuery("#behaviour-journey-viral-notification-journey").submit(function () {
						//set some more values
						jQuery("#behaviour").val("journey");
						jQuery("#beh_action").val("__viral_notification_journey");
						jQuery("#setup_complete").val(1);
					});
				});';
		$s .= '</script>';
		$this->additional_javascript = $s;
	}//end function
}//end class