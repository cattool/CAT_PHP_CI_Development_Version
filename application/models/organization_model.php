<?php
class Organization_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getParentOrganizationsOrderedByName($activeOnly)
	{
				$sql = "SELECT * FROM organization WHERE parent_organization_id is null";
		if($activeOnly){
				$sql .= " AND active='Y'";
		}
				$sql .= " ORDER BY name";
		$query = $this->db->query($sql);
	    return $query;		
	}
	
	function getAllOrganizations($activeOnly)
	{
		$sql = "SELECT * FROM organization WHERE 1=1";	
		if($activeOnly){
				$sql .= " AND active='Y'";
		}
				$sql .= " ORDER BY lower(name)";
		$query = $this->db->query($sql);
	    return $query;
	}
	function getOrganizationById($id){
		$sql = "SELECT * FROM organization WHERE id = $id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	
	function getChildOrganizationsOrderedByName($orgID, $activeOnly){
		$sql = "SELECT * FROM organization WHERE parent_organization_id= $orgID";
		if($activeOnly){
			$sql .= " AND active='Y' order by name";	
		}
		
		$query = $this->db->query($sql);
	    return $query;
		
	}
	
	function getOrganizationsForUser($userid, $id){
		$sql = "SELECT o.* FROM organization o, organization_admin oa
				WHERE oa.organization_id = $id
				AND oa.name = '$userid'
				AND type = 'Userid'";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getOrganizationOutcomeGroupsForOrgForDelete($orgId){
		$sql = "SELECT * FROM organization_outcome_group oog 
				WHERE oog.organization_specific = 'Y' AND oog.organization_id = $orgId";	
		$query = $this->db->query($sql);
	    return $query;
	}
		
		
		
	
	function getAdminsForOrganization($organizationId){
		$sql = "SELECT * FROM organization_admin 
				WHERE organization_id = $organizationId 
				ORDER BY type,name";	
		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	function getLinkOrganizationOrganizationOutcomeForOrg($orgId){
		$sql = "SELECT looo.id as looo_id,looo.organization_id as looo_organization_id, looo.organization_outcome_id as looo_organization_outcome_id,
					org.id as org_id, org.name as org_name, org.parent_organization_id as org_parent_organization_id, org.system_name as org_system_name, org.active as org_active,
					oo.id as oo_id, oo.name as oo_name, oo.description as oo_description, oo.organization_outcome_group_id as oo_organization_outcome_group_id,
					oog.id as oog_id, oog.name as oog_name, oog.description as oog_description, oog.organization_specific as oog_organization_specific, oog.organization_id as oog_organization_id
				FROM link_organization_organization_outcome looo
				INNER JOIN organization org ON org.id = looo.organization_id
				INNER JOIN organization_outcome oo ON oo.id = looo.organization_outcome_id
				INNER JOIN organization_outcome_group oog ON oo.organization_outcome_group_id = oog.id
				WHERE looo.organization_id = $orgId 
				ORDER BY oog.name, oo.name";
		$query = $this->db->query($sql);
	    return $query;	
	
	}
	
	function getOrganizationCharacteristicTypes($orgId){
		$sql = "SELECT ct.*
				FROM characteristic_type ct, link_organization_characteristic_type ldct 
				WHERE ldct.organization_id=$orgId
				AND ldct.characteristic_type_id = ct.id 
				ORDER BY ldct.display_index";
		$query = $this->db->query($sql);
	    return $query;	
	
	}
	
	function getCandidateCharacteristicTypes($alreadyUseds)
	{
			$prefix = '';
			foreach ($alreadyUseds as $alreadyUsed)
			{
				$Id .= $prefix . '"' . $alreadyUsed . '"';
				$prefix = ', ';
			}
		
			$sql = "SELECT ct.* FROM characteristic_type ct 
					WHERE ct.id NOT IN ($Id) ORDER BY ct.name";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function deleteOrganization($id) 
	{
		$delete = $this->db->delete('organization', array('id' => $id)); 
		return $delete;
	}
	
	function updateOrganization($id,$name,$systemName,$active,$parentId,$oldParentId){
		
		
			$organization = array(
				'name' => mysql_real_escape_string($name),
				'system_name'	=> mysql_real_escape_string($systemName),
				'active'	=> mysql_real_escape_string($active)
			);
			
			if(intval($oldParentId) != intval($parentId)){
				if($parentId == -1){
					$parentId = NULL;	
				}
				$organization['parent_organization_id'] = $parentId;
			}
			
			$this->db->where('id', $id);
			return $updateOrganization = $this->db->update('organization', $organization);
	}
	
	function addOrganization($name,$parentId,$systemName){
		
			$organization = array(
				'name' => mysql_real_escape_string($name),
				'system_name'	=> mysql_real_escape_string($systemName),
				'parent_organization_id' => intval($active)
			);
			return $addOrganization = $this->db->insert('organization', $organization);
	}
	
	function removeCourseFromOrganization($courseId, $organizationId){
			$array = array('organization_id' => $organizationId, 'course_id' => $courseId);
			$this->db->where($array); 
			$delete = $this->db->delete('link_course_organization', $array); 
			return $delete;
	}

	function addCourseToOrganization($courseId, $organizationId){
			$organization = array(
				'organization_id' => $organizationId,
				'course_id'	=> $courseId
			);
			return $addCourseToOrganization = $this->db->insert('link_course_organization', $organization);
	}	
	
	function addAttribute($org_id, $name){
			$Attribute = array(
				'name' => $name,
				'organization_id' => $org_id
			);
			return $addAttribute = $this->db->insert('instructor_attribute', $Attribute);
	
	}
	
	function addCourseAttribute($org_id, $name){
			$CourseAttribute = array(
				'name' => $name,
				'organization_id' => $org_id
			);
			return $addCourseAttribute = $this->db->insert('course_attribute', $CourseAttribute);
	}
		
	function saveProgramOutcomeOrganizationOutcome($outcomeId, $organizationOutcomeId, $programId){
			$ProgramOutcomeOrganizationOutcome = array(
				'organization_outcome_id' => $organizationOutcomeId,
				'program_outcome_id' => $outcomeId,
				'program_id' => $programId				
			);
			return $saveProgramOutcomeOrganizationOutcome = $this->db->insert('link_program_outcome_organization_outcome', $ProgramOutcomeOrganizationOutcome);
	}	
	
	function getInstructorAttributes($orgId){
			$sql = "SELECT *
					FROM instructor_attribute 
					WHERE organization_id=$orgId ORDER BY name	";
			$query = $this->db->query($sql);
			return $query;	

	
	}
	
	function getOrganizationOutcomeGroupsOrganization($orgId){
			$sql = "SELECT oo.organization_outcome_group_id, oog.name
					FROM link_organization_organization_outcome l
					INNER JOIN organization_outcome oo ON oo.id = l.organization_outcome_id  
					INNER JOIN organization_outcome_group oog ON oog.id = oo.organization_outcome_group_id
					WHERE l.organization_id = $orgId
					GROUP BY oo.organization_outcome_group_id
					order by oog.name";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getOrganizationOutcomeForGroupAndOrganization($orgId, $org_outcome_group_id){
			$sql = "SELECT l.id as looo_id, l.organization_id as looo_organization_id, l.organization_outcome_id as looo_organization_outcome_id, oo.*
					FROM link_organization_organization_outcome l 
					INNER JOIN organization_outcome oo ON oo.id = l.organization_outcome_id  
					where l.organization_id = $orgId 
					AND oo.organization_outcome_group_id = $org_outcome_group_id 
					ORDER BY oo.name";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getProgramOutcomeLinksForOrganizationOutcome($progId, $org_outcome_id){
			$sql = "SELECT 	l.*, po.id as po_id,po.name as po_name, 
							po.description as po_description,
							po.program_outcome_group_id as po_program_outcome_group_id,
							pog.id as pog_id, pog.name as pog_name, 
							pog.description as pog_description, 
							pog.program_specific as pog_program_specific, 
							pog.program_id as pog_program_id   
					FROM link_program_outcome_organization_outcome l 
					INNER JOIN program_outcome po ON po.id = l.program_outcome_id
					INNER JOIN program_outcome_group pog ON pog.id = po.program_outcome_group_id
					WHERE l.organization_outcome_id = $org_outcome_id 
					AND l.program_id = $progId 
					ORDER BY pog.name, po.name";
			$query = $this->db->query($sql);
			return $query;	
	}	
	
	function getCharacteristicTypes($orgId){
			$sql = "SELECT * FROM link_organization_characteristic_type WHERE organization_id = $orgId";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getCharacteristicTypesAll(){
			$sql = "SELECT * FROM link_organization_characteristic_type";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getProgramOrderedByNameForOrganizationLinkedToCourse($orgId, $courseId){
			$sql = "SELECT * FROM program p 
					WHERE p.organization_id = $orgId
					AND p.id IN (SELECT l.program_id FROM link_course_program l 
					WHERE l.course_id = $courseId) ORDER BY lower(name)";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function saveCourseOutcomeValue($Id , $name)
    {
			$course_outcome = array(
			'name' => mysql_real_escape_string($name));
							
			$this->db->where('id', $Id);
			return $saveCourseOutcomeValue = $this->db->update('course_outcome', $course_outcome);
    }
	
	function getOrganizationOutcomesForOrg($orgId)
	{

			$sql = "SELECT  oo.id as oo_id,oo.name as oo_name, oo.description as oo_description, oog.id as oog_id,
							oog.name as oog_name, oog.description as oog_description, oog.organization_specific as oog_organization_specific,
							oog.organization_id as oog_organization_id
					FROM organization_outcome oo 
					INNER JOIN organization_outcome_group oog ON oo.organization_outcome_group_id = oog.id
					WHERE (oog.organization_specific = 'Y' AND oog.organization_id = $orgId) OR (oog.organization_specific = 'N') 
					ORDER BY oog.name, oo.name";
			$query = $this->db->query($sql);
			return $query;	

	}
	
	function getOrganizationOutcomeGroupsForOrg($orgId)
	{
			$sql = "SELECT * FROM 
					organization_outcome_group oog 
					WHERE (oog.organization_specific = 'Y' AND oog.organization_id = $orgId) OR (oog.organization_specific = 'N') 
					ORDER BY oog.organization_specific DESC, oog.name";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getOrganizationOutcomeForGroup($groupId)
	{
		    $sql = "SELECT oo.id as oo_id,oo.name as oo_name, oo.description as oo_description, oog.id as oog_id,
							oog.name as oog_name, oog.description as oog_description, oog.organization_specific as oog_organization_specific,
							oog.organization_id as oog_organization_id
					FROM organization_outcome oo 
					INNER JOIN organization_outcome_group oog ON oo.organization_outcome_group_id = oog.id
					WHERE oog.id = $groupId 
					ORDER BY oog.name, oo.name";
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getProgramOrderedByNameForOrganization($orgId)
	{
		$sql = "SELECT * FROM 
				program p
				WHERE p.organization_id = $orgId 
				ORDER BY lower(name)";
		$query = $this->db->query($sql);
		return $query;		
	}
	
	function addCharacteristicToOrganization($charId, $orgId)
	{
		$createSuccessful = false;
		
		$displayIndextemp = 0;
		$sql = "SELECT MAX(display_index) AS DisplayIndex FROM link_organization_characteristic_type l where l.organization_id = $orgId";
		$query = $this->db->query($sql);
		$displayIndex_data = $query->row();
		$displayIndextemp = $displayIndex_data->DisplayIndex;
		$displayIndex = $displayIndextemp+1;
		

		$LinkOrganizationCharacteristicType = array(
				'display_index' => $displayIndex,
				'organization_id' => $orgId,
				'characteristic_type_id' => $charId				
			);
		return $addCharacteristicToOrganization = $this->db->insert('link_organization_characteristic_type', $LinkOrganizationCharacteristicType);
		
	}
	
	function removeAttribute($toRemoveId)
	{
		
		$sql = "SELECT * FROM instructor_attribute_value WHERE instructor_attribute_id = $toRemoveId";
		$query = $this->db->query($sql);
		$existing = $query->result();
		foreach($existing as $toDel)
		{
			$delete = $this->db->delete('instructor_attribute_value', array('id' => $toDel->id)); 
		}
		$delete = $this->db->delete('instructor_attribute', array('id' => $toRemoveId)); 
		return $delete;
		
	}
	
	function removeAttributeValue($toRemoveId)
	{
		$delete = $this->db->delete('instructor_attribute_value', array('id' => $toRemoveId)); 
		return $todelete;	
	}
	
	function removeCourseAttribute($toRemoveId)
	{
		
		$sql = "SELECT * FROM course_attribute_value WHERE course_attribute_id = $toRemoveId";
		$query = $this->db->query($sql);
		$existing = $query->result();
		foreach($existing as $toDel)
		{
			$delete = $this->db->delete('course_attribute_value', array('id' => $toDel->id)); 
		}
		$delete = $this->db->delete('course_attribute', array('id' => $toRemoveId)); 
		return $delete;
	}
	
	function removeCourseAttributeValue($toRemoveId)
	{
		$delete = $this->db->delete('course_attribute_value', array('id' => $toDel->id)); 
		return $delete;
	}
	
	function getLinkOrganizationCharacteristicType($charTypeId){
		$sql = "SELECT l.* 
				FROM link_organization_characteristic_type l 
				WHERE l.organization_id = $charTypeId ORDER BY l.display_index";	
		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	function updateLinkOrganizationCharacteristicType($id, $displayIndex){
			$LinkOrganizationCharacteristicType = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateLinkOrganizationCharacteristicType = $this->db->update('link_organization_characteristic_type', $LinkOrganizationCharacteristicType);	
	}
	
	function deleteLinkOrganizationCharacteristicType($charTypeId){
			$delete = $this->db->delete('link_organization_characteristic_type', array('characteristic_type_id' => $charTypeId)); 
			return $delete;
	}

	function moveCharacteristicType($id, $charTypeId, $direction){
		//when moving up, find the one to be moved (while keeping track of the previous one) and swap display_index values
		//when moving down, find the one to be moved, swap displayIndex values of it and the next one
		//when deleting, reduce all links following one to be deleted by 1
		$done = false;
			//AssessmentGroup group = (AssessmentGroup)session.get(AssessmentGroup.class, groupId);
			//List<Assessment> existing = this.getAssessmentsForGroup(group,session);

		$existing = $this->organization_model->getLinkOrganizationCharacteristicType($id);
		$existing_data = $existing->result();
		
		if($direction == "up")
		{
			//Characteristic prev = null;
			$prevId = "";
			$prevDisplayIndex = "";
			//for(Characteristic ch : existing)
			$ictr = 0;
			foreach($existing_data as $rsExisting)
			{
				if($rsExisting->characteristic_type_id == $charTypeId && strlen($prevId) > 0)
				{
					$tempAction = $this->organization_model->updateLinkOrganizationCharacteristicType($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->organization_model->updateLinkOrganizationCharacteristicType($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				$prevId = $rsExisting->id;
				$prevDisplayIndex = $rsExisting->display_index;
				$ictr++;
				
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
					$tempAction = $this->organization_model->updateLinkOrganizationCharacteristicType($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->organization_model->updateLinkOrganizationCharacteristicType($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				if($rsExisting->characteristic_type_id == $charTypeId)
				{
					$prevId = $rsExisting->id;
					$prevDisplayIndex = $rsExisting->display_index;
				}
				
			}
		}
		else if($direction == "delete")
		{
			//Characteristic toDelete = null;
			$toDelete = '';
			foreach($existing_data as $rsExisting)
			{
			
				if(strlen($toDelete) > 0)
				{
					$tempAction = $this->organization_model->updateLinkOrganizationCharacteristicType($rsExisting->id, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->characteristic_type_id == $charTypeId)
				{
					$toDelete = $rsExisting->characteristic_type_id;
				}
				
			}
			
			if(strlen($toDelete) > 0)
			{
					$tempAction = $this->organization_model->deleteLinkOrganizationCharacteristicType($toDelete);
					$done = true;
			}
		}
		return $done;
	}
}


