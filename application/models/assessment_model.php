<?php
class Assessment_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getAssessmentGroups()
	{
		$sql = "SELECT * FROM assessment_group a ORDER BY display_index";
		$query = $this->db->query($sql);
	    return $query;		
	}
	
	function getAssessmentGroupById($id)
	{
		$sql = "SELECT * FROM assessment_group where id = $id order by display_index";
		$query = $this->db->query($sql);
	    return $query;
	}
	
		function getAssessmentsForGroup($assessGroup_id)
	{
		$sql = "SELECT * FROM assessment where assessment_group_id = $assessGroup_id order by display_index";
		$query = $this->db->query($sql);
	    return $query;
	}

	function getAssessments(){
		$sql = "SELECT * FROM assessment order by name";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAssessmentById($id){
		$sql = "SELECT * FROM assessment where id = $id order by name";
		$query = $this->db->query($sql);
	    return $query;
	}	
	
	function updateAssessmentGroupDisplayIndex($id, $displayIndex){
			$assessDisplay = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateAssessmentGroupDisplayIndex = $this->db->update('assessment_group', $assessDisplay);	
	}
	
	function deleteAssessmentGroupDisplayIndex($id){
			$delete = $this->db->delete('assessment_group', array('id' => $id)); 
			return $delete;
	}
	
	function moveAssessmentMethodGroup($id, $direction){
		
		
		//when moving up, find the one to be moved (while keeping track of the previous one) and swap display_index values
		//when moving down, find the one to be moved, swap displayIndex values of it and the next one
		//when deleting, reduce all links following one to be deleted by 1
		$done = false;
			//AssessmentGroup group = (AssessmentGroup)session.get(AssessmentGroup.class, groupId);
			//List<Assessment> existing = this.getAssessmentsForGroup(group,session);

		$existing = $this->assessment_model->getAssessmentGroups();
		$existing_data = $existing->result();
		if($direction == "group_up")
		{
			//Characteristic prev = null;
			$prevId = "";
			$prevDisplayIndex = "";
			//for(Characteristic ch : existing)
			foreach($existing_data as $rsExisting)
			{
				if($rsExisting->id == $id && strlen($prevId) > 0)
				{
					$tempAction = $this->assessment_model->updateAssessmentGroupDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->assessment_model->updateAssessmentGroupDisplayIndex($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				$prevId = $rsExisting->id;
				$prevDisplayIndex = $rsExisting->display_index;
			}
		} 
		else if($direction == "group_down")
		{
			$prevId = "";
			$prevDisplayIndex = "";
			foreach($existing_data as $rsExisting)
			{
				if(strlen($prevId) > 0)
				{
					$tempAction = $this->assessment_model->updateAssessmentGroupDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->assessment_model->updateAssessmentGroupDisplayIndex($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				if($rsExisting->id == $id)
				{
					$prevId = $id;
					$prevDisplayIndex = $rsExisting->display_index;
				}
				
			}
		}
		else if($direction == "group_delete")
		{
			//Characteristic toDelete = null;
			foreach($existing_data as $rsExisting)
			{
			
				if(strval($toDelete) > 0)
				{
					
					$tempAction = $this->assessment_model->updateAssessmentGroupDisplayIndex($rsExisting->id, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->id == $id)
				{
					$toDelete = $rsExisting->id;
				}
				
			}
			if(strlen($toDelete) > 0)
			{
					$tempAction = $this->assessment_model->deleteAssessmentGroupDisplayIndex($toDelete);
					$done = true;
			}
		}
		return $done;
	}
}

