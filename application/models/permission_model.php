<?php
class Permission_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getOrganizationsForUser($userid, $sysadmin, $activeOnly)
	{
		if($sysadmin){
				$sql = "SELECT org.* FROM organization org WHERE 1=1";
			
		}else{
				$sql = "SELECT org.* 
						FROM organization org, organization_admin org_admin 
						WHERE org_admin.organization_id = org.id
						AND org_admin.name = '$userid' and org_admin.type= 'Userid'";
		}
		
		if($activeOnly){
				$sql .= " AND active='Y'";
			}
				$sql .= " ORDER BY lower(org.name)";
	
		$query = $this->db->query($sql);
	    return $query;		
	}
	
	function getAllInstructors(){
		$sql = "SELECT *,concat(first_name,' ',last_name,'( ',userid,' )') as DisplayName 
				FROM instructor ORDER by lower(last_name), lower(first_name),lower(userid)";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function saveInstructor($id,$userid,$first,$last,$action){
			$instructor = array(
				'userid' => $userid,
				'first_name' => $first,
				'last_name' => $last
			);
			
			
			if($action == "update"){
				$this->db->where('id', $id);
				$saveInstructor = $this->db->update('instructor', $instructor);
			}else{
				$saveInstructor = $this->db->insert('instructor', $instructor);
			}
			return $saveInstructor;
	}
	
	function getInstructorById($id)
	{
		$sql = "SELECT *,concat(first_name,' ',last_name,'( ',userid,' )') as DisplayName 
				FROM instructor WHERE id = $id ORDER by lower(last_name), lower(first_name),lower(userid)
				";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAdminsForOrganization($orgId)
	{
		$orgId = intval($orgId);
		$sql = "SELECT * FROM organization_admin 
				WHERE organization_id = $orgId 
				ORDER BY type,name";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getSystemAdminByNameAndType($name,$type)
	{
		$sql = "SELECT * FROM system_admin WHERE type='$type' AND lower(name)='$name'";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function saveSystemPermission($type,$name,$createdUserid,$first,$last,$systemId){
		$Systemdate = date('Y-m-d H:i:s');
		$systemPermission = array(
				'name' => $name,
				'type' => $type,
				'created_userid' => $createdUserid,
				'created_on' => $Systemdate,
				'first_name' => $first,
				'last_name' => $last
		);
		
		if($type == "Userid"){
			$TypeDisplay = "Persons";
		}else{
			$TypeDisplay = "Organizations";
		}
		
		$systemPermission['type_display'] = $TypeDisplay;
		
		$existed = false;
		if(intval($systemId) > 0){
			$existed = true;
		}
		
		if($existed){
			$this->db->where('id', $systemId);
			$saveSystemPermission = $this->db->update('system_admin', $systemPermission);
		}else{
			$saveSystemPermission = $this->db->insert('system_admin', $systemPermission);
		}
		
		return $saveSystemPermission;
	}
	
	function removeSystemPermission($id){
		$delete = $this->db->delete('system_admin', array('id' => $id)); 
		return $delete;
	}
	
	function saveOrganizationPermission($organizationId,$type,$name,$first,$last,$orgAdminId){
		$Systemdate = date('Y-m-d H:i:s');
		$systemOrgPermission = array(
				'organization_id' => $organizationId,
				'name' => $name,
				'type' => $type,
				'first_name' => $first,
				'last_name' => $last
		);
		
		if($type == "Userid"){
			$TypeDisplay = "Persons";
		}else{
			$TypeDisplay = "Organizations";
		}
		
		$systemOrgPermission['type_display'] = $TypeDisplay;
		
		$existed = false;
		if(intval($systemId) > 0){
			$existed = true;
		}
		
		if($existed){
			$this->db->where('id', $orgAdminId);
			$saveOrganizationPermission = $this->db->update('organization_admin', $systemOrgPermission);
		}else{
			$saveOrganizationPermission = $this->db->insert('organization_admin', $systemOrgPermission);
		}
		
		return $saveOrganizationPermission;
		
		
	}
	
	function getOrganizationAdminByNameAndType($name,$type,$organizationId){
		
		$sql = "SELECT * FROM organization_admin WHERE organization_id=$organizationId AND type='$type' AND lower(name)='$name'";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function removeOrganizationPermission($id){
		$delete = $this->db->delete('organization_admin', array('id' => $id)); 
		return $delete;
	}
	
	function getSystemAdmins(){
		$sql = "SELECT * FROM system_admin  ORDER BY type,name";
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function userHasAccessToOrganizations($orgId,$userId){
		$sql = "SELECT co.*
			   FROM program p 
				  ,link_course_program lcp 
				  ,course_offering co
			   WHERE lcp.program_id = p.id
			   AND lcp.course_id = co.course_id
			   AND p.organization_id in ($orgId)
			UNION
			   SELECT co.* 
			   FROM course_offering co
				  , link_course_offering_instructor coi
				  , instructor instruc
			   WHERE instruc.userid = '$userId' 
			   AND coi.instructor_id = instruc.id
			   AND coi.course_offering_id
			   AND coi.course_offering_id = co.id";
		$query = $this->db->query($sql);
	    return $query;
	   
	}
}

