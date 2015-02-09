<?php
$charId = $this->input->get("charId");
$orgId = $this->input->get("organization_id");

if(!$this->organization_model->addCharacteristicToOrganization(intval($charId), intval($orgId)))
{
	echo("ERROR: Unable to add Characteristic");
}

?>
		
