


<?php //!private static Logger logger = Logger.getLogger("/auth/modify_system/saveSystem.jsp");?>
<?php 

$formValues = $this->input->post(NULL, TRUE);

$formParam = array();

foreach($formValues as $key => $value) 
{
    $formParam[$key] = $this->input->post($key);
}

/*
Enumeration e = request.getParameterNames();
while(e.hasMoreElements())
{
	String pName = (String)e.nextElement();
	String value = request.getParameter(pName);
	logger.error("("+pName + ") = ("+value+")");
}

*/
$object = $this->input->post("object");
if($object == "")
{
	 echo "ERROR: Unable to determine what to do (Object not found)";	
	 return;
}
else if($object == "Organization")
{
	$name = $this->input->post("name");
	$id = $this->input->post("id");
	$organizationId = $this->input->post("organization");
	$parentId = intval($this->input->post("parent_organization_id"));
	$oldParentId = intval($this->input->post("old_parent_id"));
	$systemName = $this->input->post("system_name");
	$active = $this->input->post("active");
	$action = $this->input->post("action");
	//OrganizationManager manager = OrganizationManager.instance();
	if(intval($id) > 0)
	{
		if(strlen($action) > 0 && $action == "delete")
		{
			//Organization org = manager.getOrganizationById(Integer.parseInt(id));
			$org = $this->organization_model->getOrganizationById(intval($id));
			$org_data = $org->row();
			$orgId = $org_data->id;
			//List<OrganizationOutcomeGroup> groups = manager.getOrganizationOutcomeGroupsForOrgForDelete(org);
			$groups = $this->organization_model->getOrganizationOutcomeGroupsForOrgForDelete($orgId);
			$groups_count = $groups->num_rows();
			if(intval($groups_count) > 0)
			{
				echo "ERROR: Organization still has outcome groups associated with it";
				return;
			}
			//List<OrganizationAdmin> admins = PermissionsManager.instance().getAdminsForOrganization(id);
			$admins = $this->organization_model->getAdminsForOrganization($id);
			$admins_count = $admins->num_rows();
			if(intval($admins_count) > 0)
			{
				echo "ERROR: Organization still has admins associated with it";
				return;
			}
			//List<Organization> children = manager.getChildOrganizationsOrderedByName(org,false);
			$children = $this->organization_model->getChildOrganizationsOrderedByName($orgId,false);
			$children_count = $children->num_rows();
			if(intval($children_count) > 0)
			{
				echo "ERROR: Organization still has child-organizations";
				return;
			}
			//List<LinkOrganizationOrganizationOutcome> linkedOutcomes = manager.getLinkOrganizationOrganizationOutcomeForOrg(org);
			$linkedOutcomes = $this->organization_model->getLinkOrganizationOrganizationOutcomeForOrg($orgId);
			$linkedOutcomes_count = $linkedOutcomes->num_rows();
			if(intval($linkedOutcomes_count) > 0)
			{
				echo "ERROR: Organization still has outcomes linked to it";
				return;
			}
			//List<CharacteristicType> types = manager.getOrganizationCharacteristicTypes(org);
			$types = $this->organization_model->getOrganizationCharacteristicTypes($orgId);
			$types_count = $types->num_rows();
			if(intval($types_count) > 0)
			{
				echo "ERROR: Organization still characteristic(s) linked to it";
				return;
			}
			
			$delOrg = $this->organization_model->deleteOrganization($orgId);		
			if($delOrg)
			{
				 echo "Organization deleted";
			}
			else
			{
				echo "ERROR: Unable to delete Organization";
			}
		}
		else
		{
			$updateOrg = $this->organization_model->updateOrganization($id,$name,$systemName,$active,$parentId,$oldParentId);	
			if($updateOrg)
			{
				echo "Organization updated";
			}
			else
			{
				echo "There was a problem updating the organization!";
			}
		}
	}
	//else if(manager.save(name,parentId,systemName))
	else if($this->organization_model->addOrganization($name,$parentId,$systemName))
	{
		echo "Organization created";
		//trigger re-init for reloading permissions
		//session.removeAttribute("sessionInitialized");
		$this->session->unset_userdata('sessionInitialized');
	}
	else
	{
		echo "There was a problem creating the organization!";
	}
	
	
}
else if($object == "Program")
{
	$name = $this->input->post("name");
	$description = $this->input->post("description");
	$organizationId = $this->input->post("parentObjectId");
	$id = $this->input->post("id");
	
	//ProgramManager manager = ProgramManager.instance();
	if(strlen($id) > 0)
	{
		//if(manager.update(id,name,description))
		if($this->program_model->updateProgram($id,$name,$description))
		{
			echo "Program updated";
		}
		else
		{
			echo "There was a problem updating the program!";
		}
	}
	else if($this->program_model->addProgram($name,$description,$organizationId))
	{
		 echo "Program created";
	}
	else
	{
		echo "There was a problem creating the program!";
	}
	
	
}
else if($object == "CharacteristicType")
{
	$name = $this->input->post("name");
	$id = $this->input->post("id");
	$questionDisplay = $this->input->post("questionDisplay");
	$valueType = $this->input->post("valueType");
	//CharacteristicManager manager = CharacteristicManager.instance();
}
else if($object == "OrganizationCourses")
{
	
	$organizationId = intval($this->input->post("organization_id"));
	$subject = $this->input->post("courseSubject");
	
	//List<String> courseNumbers = CourseManager.instance().getCourseNumbersForSubject(subject);
	$courseNumbers = $this->course_model->getCourseNumbersForSubject($subject);
	$courseNumbers_data = $courseNumbers->result();
	//logger.error("CourseNumbers found"+courseNumbers.size());
	
	//List<String> alreadyHasAsHomeorganization = CourseManager.instance().getCourseNumbersForSubjectAndOrganization(subject,organizationId);
	//$alreadyHasAsHomeorganization = $this->course_model->getCourseNumbersForSubjectAndOrganization($subject, $organizationId, $courseNumbers_data->course_number);
	//$alreadyHasAsHomeorganization_count = $alreadyHasAsHomeorganization->num_rows();
	$deleted = 0;
	$failed = 0;
	$added = 0;
	$stayed = 0;
	//logger.error("already has "+alreadyHasAsHomeorganization.size());
	//for(String courseNumber : courseNumbers)
	foreach($courseNumbers_data as $rsCourseNumber)
	{
		$param = $this->input->post("course_number_checkbox_".$rsCourseNumber->course_number);
		$alreadyHasAsHomeorganization = $this->course_model->getCourseNumbersForSubjectAndOrganization($subject, $organizationId, $rsCourseNumber->course_number);
		$alreadyHasAsHomeorganization_count = $alreadyHasAsHomeorganization->num_rows();
		if(strlen($param) <= 0) // param==null //course not included
		{
			if(intval($alreadyHasAsHomeorganization_count) > 0) // it was before
			{
				$course = $this->course_model->getCourseBySubjectAndNumber($subject,$rsCourseNumber->course_number);
				$course_data = $course->row();
				$courseId = $course_data->id;	
				if($this->organization_model->removeCourseFromOrganization($courseId, $organizationId))
				{
					$deleted++;
				}
				else
				{
					$failed++;
				}
			}
			else
				$stayed++;
		}
		else 
		{
			if(intval($alreadyHasAsHomeorganization_count) <= 0) // it was before ans still is
			{
				$course = $this->course_model->getCourseBySubjectAndNumber($subject,$rsCourseNumber->course_number);
				$course_data = $course->row();
				$courseId = $course_data->id;
				if($this->organization_model->addCourseToOrganization($courseId, $organizationId))
				{
					$added++;
				}
				else
				{
					$failed++;
				}
			}
			else
				$stayed++;
	
		}
	}
	if($failed > 0)
	{
		echo "ERROR: ".$failed." changes failed. You could try it again.  If it keeps failing, please contact an administrator";
	}
	else
	{
		echo "Changes saved (deleted:".$deleted." added:".$added." the same:".$stayed.")";
	}
}

else if($object == "Instructor")
{
	$userid = $this->input->post("userid");
	$first = $this->input->post("first_name");
	$last = $this->input->post("last_name");
	$id = intval($this->input->post("id"));
	
	//PermissionsManager manager = PermissionsManager.instance();
	$instructor = $this->permission_model->getInstructorById($id);
	$instructor_count = $instructor->num_rows();
	//check if action is add record of update
	$action = "update";
	if(intval($instructor_count) <= 0){
		$action = "add";
	}
	if($this->permission_model->saveInstructor($id,$userid,$first,$last,$action)){
		echo "Instructor saved";
	}else{
		echo "There was a problem saving the Instructor!";
	}
}
else
{
	echo "ERROR: Unable to determine what to do (object [".$object."] not recognized)";	
	return;
}

?>

<?php
/*
public boolean isInt(String s)
{
	try
	{
		Integer.parseInt(s);
		return true;
	}
	catch(Exception e)
	{
	}
	return false;
}
*/
?>
