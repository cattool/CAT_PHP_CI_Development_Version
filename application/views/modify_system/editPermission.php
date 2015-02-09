<?php
$programId = intval($this->input->get("program_id"));
$organizationId = intval($this->input->get("organization_id"));

$name = $this->input->get("name");
$first = $this->input->get("first");
$last = $this->input->get("last");

$type = $this->input->get("type");
$command = $this->input->get("command");
$permissionId = $this->input->get("permission_id");
$userid = $this->session->userdata('username');

//PermissionsManager manager = PermissionsManager.instance();
if($programId <= 0 && $organizationId <= 0) // must be a system-permission
{
	if($command == "add")
	{
		$checkExist = $this->permission_model->getSystemAdminByNameAndType($name,$type);
		$checkExist_data = $checkExist->row();
		$checkExist_count = intval($checkExist->num_rows());
		$systemId = 0;
		if($checkExist_count > 0){
			$systemId = $checkExist_data->id;
		}
		
		if($this->permission_model->saveSystemPermission($type,$name,$userid,$first,$last,$systemId))
		{
			echo "Permission added";
		}
		else
		{
			echo "ERROR: could not add permission";
		}
	}
	else if ($command == "delete")
	{
		if($this->permission_model->removeSystemPermission($permissionId))
		{
			echo "Permission removed";
		}
		else
		{
			echo "ERROR: could not remove permission";
		}
	}
}


else if($organizationId > -1)
{
	if($command == "add")
	{
		$orgCheck = $this->permission_model->getOrganizationAdminByNameAndType($name,$type,$organizationId);
		$orgCheck_data = $orgCheck->row();
		$orgCheck_count = intval($orgCheck->num_rows());
		
		$orgAdminId = 0;
		if($orgCheck_count > 0){
			$orgAdminId = $orgCheck_data->id;
		}
			
		if($this->permission_model->saveOrganizationPermission($organizationId,$type,$name,$first,$last,$orgAdminId))
		{
			echo "Permission added";
		}
		else
		{
			echo "ERROR: could not add permission";
		}
	}
	else if ($command == "delete")
	{
		if($this->permission_model->removeOrganizationPermission($permissionId))
		{
			echo "Permission removed";
		}
		else
		{
			echo "ERROR: could not remove permission";
		}
	}
}

?>
