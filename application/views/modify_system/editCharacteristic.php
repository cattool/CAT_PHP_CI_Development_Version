<?php

$charTypeId = $this->input->get("charTypeId");
$charId = $this->input->get("char_id");
$command = $this->input->get("command");
//CharacteristicManager manager = CharacteristicManager.instance();

if($command == "up" || $command == "down" || $command == "delete")
{
	$moveChar = $this->characteristics_model->moveCharacteristic(intval($charId), intval($charTypeId),$command);
	if(!$moveChar)
	{
		if($command == "edit")
			echo "ERROR: Unable to edit Characteristic";
		else
			echo "ERROR: Unable to move Characteristic option ".$command;
	}
}

else if($command == "deleteType")
{
	if($this->characteristics_model->deleteCharacteristicsType($charTypeId))
	{
		echo "Deleted";
	}
	else
	{
		echo "Unable to delete Characteristic Type";
	}
}

?>
		
