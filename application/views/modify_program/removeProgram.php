<?php

$programId = $this->input->get("program_id");
if($this->program_model->removeProgram(intval($programId)))
{
	echo "Progam removed";
}
else
{
	echo "ERROR: removing program";
}
?>
		
