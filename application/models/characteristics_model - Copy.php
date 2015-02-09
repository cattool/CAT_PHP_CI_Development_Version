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
		$sql = "SELECT * FROM characteristic_type c";	
		$sql .= " WHERE c.id = $id";
		$sql .= " ORDER BY c.name";
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
		$existing_data = $existing->row();
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
					$this->characteristics_model->updateCharacteristicsDisplayIndex($id, $prevDisplayIndex);
					$this->characteristics_model->updateCharacteristicsDisplayIndex($prevId, $rsExisting->display_index);
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
			foreach($existing_data as $rsExisting)
			{
				if(strlen($prevId) > 0)
				{
					$this->characteristics_model->updateCharacteristicsDisplayIndex($id, $prevDisplayIndex);
					$this->characteristics_model->updateCharacteristicsDisplayIndex($prevId, $rsExisting->display_index);
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
					
					$this->characteristics_model->updateCharacteristicsDisplayIndex($rsExisting, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->id == $id)
				{
					$toDelete = $rsExisting->id;
				}
				
			}
			if(strlen($toDelete) > 0)
			{
					$this->characteristics_model->deleteCharacteristicsDisplayIndex($toDelete);
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
}

