<?php
$charTypeId = $this->input->get("charTypeId");
$organizationId = $this->input->get("organization_id");
$direction = $this->input->get("direction");
$temp = $this->organization_model->moveCharacteristicType(intval($organizationId), intval($charTypeId),$direction);
echo $temp;
if(!$temp)
{
	echo("ERROR: Unable to move Characteristic Type ".$direction);
}

?>
		
