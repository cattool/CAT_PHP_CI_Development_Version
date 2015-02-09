<?php
if(!isset($charTypeId)){
	$charTypeId = $this->input->get("charTypeId");	
}
if(!isset($index)){
	$index = $this->input->get("index");
}

if(!isset($selectedId)){
	$selectedId = intval($this->input->get("selectedId"));
}
//Characteristic charac = new Characteristic();
//OutcomeManager om = OutcomeManager.instance();

if($selectedId > 0)
{
	$charac = $this->outcome_model->getCharacteristicById($selectedId);
	$charac_data = $charac->row();
}

$ct = $this->characteristics_model->getCharacteristicTypeById($charTypeId);
$ct_data = $ct->row();


?>
	<div class="formElement">
		<div class="label"><?php echo $ct_data->question_display;?></div>
		<div class="field">
		<?php
		$valueType = $ct_data->value_type;
		$options =  $this->characteristics_model->getCharacteristicsForType($ct_data->id);
		$options_data = $options->result();
		$options = array();
		foreach($options_data as $tempoption){
				$bogus = array();
				$bogus['id'] = $tempoption->id;
				$bogus['name'] = $tempoption->name;
				array_push($options,$bogus);
		}
		
		if($valueType == "String")
		{
			echo ($this->common->createSelect("characteristic_".$index,$options,"id","name", $selectedId > -1?"".$selectedId: null, null));
		}
		if($valueType == "Boolean")
		{
			$checked = $selectedId > -1 && $charac_data->name == "true"?"checked=\"checked\"":"";
			//Make it a checkbox
			?><input type="checkbox" name="characteristic_<?php echo $index ?>" id="characteristic_<?php echo $index ?>" <?php echo $checked?>/>
			<?php 
		}
		?>
			<input type="hidden" id="characteristic_type_<?php echo $index?>" name="characteristic_type_<?php echo $index?>" value="<?php echo $ct_data->id?>"/>
		</div>
		<div class="error" id="characteristic_<?php echo $index ?>Message"></div>
		<div class="spacer"> </div>
	</div>
	<hr/>

