<?php
class Characteristics_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getAllCharacteristicTypes()
	{
		$sql = "SELECT * FROM characteristic_type c";	
		$sql .= " ORDER BY c.name";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCharacteristicTypeById($id){
		$sql = "SELECT * FROM characteristic_type c
				WHERE c.id = $id
				ORDER BY c.name";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getCharacteristicById($id){
		$sql = "SELECT * FROM characteristic c";	
		$sql .= " WHERE c.id = $id";
		$sql .= " ORDER BY c.name";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	
	function getCharacteristicsForType($typeID){
		$sql = "SELECT * FROM characteristic c";	
		$sql .= " WHERE c.characteristic_type_id = $typeID";
		$sql .= " ORDER BY c.display_index";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function updateCharacteristicsDisplayIndex($id, $displayIndex){
			$charDisplay = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateCharacteristicsDisplayIndex = $this->db->update('characteristic', $charDisplay);	
	}
	
	function deleteCharacteristicsDisplayIndex($id){
			$delete = $this->db->delete('characteristic', array('id' => $id)); 
			return $delete;
	}
	
	function moveCharacteristic($id, $charTypeId,$direction)
	{
		//CharacteristicType ct = (CharacteristicType)session.get(CharacteristicType.class, charTypeId);
		//List<Characteristic> existing = this.getCharacteristicsForType(ct,session);
		$existing = $this->characteristics_model->getCharacteristicsForType(intval($charTypeId));
		$existing_data = $existing->result();
		if($direction == "up")
		{
			//Characteristic prev = null;
			$prevId = "";
			$prevDisplayIndex = "";
			//for(Characteristic ch : existing)
			foreach($existing_data as $rsExisting)
			{
				if($rsExisting->id == $id && strlen($prevId) > 0)
				{
					$tempAction = $this->characteristics_model->updateCharacteristicsDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->characteristics_model->updateCharacteristicsDisplayIndex($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				$prevId = $rsExisting->id;
				$prevDisplayIndex = $rsExisting->display_index;
			}
		} 
		else if($direction == "down")
		{
			$prevId = "";
			$prevDisplayIndex = "";
			foreach($existing_data as $rsExisting)
			{
				if(strlen($prevId) > 0)
				{
					$tempAction = $this->characteristics_model->updateCharacteristicsDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->characteristics_model->updateCharacteristicsDisplayIndex($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				if($rsExisting->id == $id)
				{
					$prevId = $rsExisting->id;
					$prevDisplayIndex = $rsExisting->display_index;
				}
				
			}
		}
		else if($direction == "delete")
		{
			//Characteristic toDelete = null;
			foreach($existing_data as $rsExisting)
			{
			
				if(strval($toDelete) > 0)
				{
					
					$tempAction = $this->characteristics_model->updateCharacteristicsDisplayIndex($rsExisting->id, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->id == $id)
				{
					$toDelete = $rsExisting->id;
				}
				
			}
			if(strlen($toDelete) > 0)
			{
					$tempAction = $this->characteristics_model->deleteCharacteristicsDisplayIndex($toDelete);
					$done = true;
			}
		}
		return $done;
	}
	
		 	
	function deleteCharacteristicsType($charTypeId)
	{
		$charType = $this->characteristics_model->getCharacteristicsForType(intval($charTypeId));
		$charType_data = $charType->result();
		foreach($charType_data as $rsCharType){
			$this->characteristics_model->deleteCharacteristic($rsCharType->id);
		} 	
		
			$array = array('characteristic_type_id' => $charTypeId);
			$this->db->where($array); 
			$delete = $this->db->delete('link_organization_characteristic_type', $array); 

			$array = array('id' => $charTypeId);
			$this->db->where($array); 
			$delete = $this->db->delete('characteristic_type', $array); 
		
	}
	
	function deleteCharacteristic($charId){
			$array = array('Chracteristic_id' => $charId);
			$this->db->where($array); 
			$delete = $this->db->delete('link_course_offering_outcome_characteristic', $array); 
			
			$array = array('id' => $charId);
			$this->db->where($array); 
			$delete = $this->db->delete('characteristic', $array); 
			
			
			return $delete;
		
	}
	
	function saveCharacteristicNameById($newName, $id){
			$charType = array(
				'name' => $newName,
				'description' => ""
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicNameById = $this->db->update('characteristic', $charType);
	}
	
	function saveNewCharacteristicWithNameAndType($newName, $charTypeId){
			$cType = $this->characteristics_model->getCharacteristicTypeById(intval($charTypeId));
			$cType_data = $cType->row();
			$existing = $this->characteristics_model->getCharacteristicsForType($cType_data>id);
			$existing_data = $existing->row();
			$existing_count = intval($existing->num_rows()) + 1;

			$char = array(
				'name' => $newName,
				'description'	=> "",
				'display_index' => $existing_count,
				'Characteristic_type_id' => $cType_data->id
			);
			return $saveNewCharacteristicWithNameAndType = $this->db->insert('characteristic', $char);
	}
	
	function saveCharacteristicDescriptionById($newDescription, $id){
			$char = array(
				'description' => mysql_real_escape_string($newDescription)
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicDescriptionById = $this->db->update('characteristic', $char);
	}
	
	function saveCharacteristicTypeNameById($newName, $id){
			$charType = array(
				'description' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicDescriptionById = $this->db->update('characteristic_type', $charType);
	}
	
	function saveNewCharacteristicTypeName($newName){
			
			$charType = array(
				'name' => $newName,
				'short_display'	=> 'default short value',
				'question_display' => 'No Question set yet',
				'value_type' => 'NOT SET'
			);
			return $saveNewCharacteristicTypeName = $this->db->insert('characteristic_type', $charType);

		
	}
	
	function saveCharacteristicTypeQuestionById($newName, $id){
			$charType = array(
				'question_display' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicTypeQuestionById = $this->db->update('characteristic_type', $charType);
	}
	
	function saveCharacteristicTypeShortDisplayById($newName, $id){
			$charType = array(
				'short_display' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicTypeShortDisplayById = $this->db->update('characteristic_type', $charType);
	}
	
	function saveCharacteristicTypeValueTypeById($newValue, $id){
			$charType = array(
				'value_type' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveCharacteristicTypeValueTypeById = $this->db->update('characteristic_type', $charType);
	}
}

