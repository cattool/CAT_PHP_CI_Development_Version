<?php 

/*Enumeration e = request.getParameterNames();
while(e.hasMoreElements())
{
	String pName = (String)e.nextElement();
	String value = request.getParameter(pName);
	logger.error("("+pName + ") = ("+value+")");
}
*/


$object = $this->input->post("object");
if(strlen($object) < 1)
{
	echo "ERROR: Unable to determine what to do (Object not found)";	
	return;
}



if($object == "Course")
{
	$subject = $this->input->post("subject");
	$courseNumber = $this->input->post("courseNumber");
	$title = $this->input->post("title");
	$description = $this->input->post("description");
	$id = $this->input->post("id");
	
	//CourseManager cm = CourseManager.instance();
	//check first if it already exists:
	$course = $this->course_model->getCourseBySubjectAndNumber(trim($subject), trim($courseNumber));
	$course_data = $course->row();
	if(strlen($course)>0 )
	{
		echo "Course already exists!";
		echo "[".$course_data->id."]";
		$id = "".$course_data->id;
	}
	if(strlen($id) > 0)
	{
		if($this->course_model->updateCourse($id, $subject, $courseNumber, $title, $description))
		{
			echo "Course updated";
		}
		else
		{
			echo "There was a problem updating the course!";
		}
	}
	else if(strlen($created = $this->course_model->saveCourse($subject, $courseNumber, $title, $description) > 0))
	{
		echo "Course created";
		//Course created = cm.getCourseBySubjectAndNumber(subject.trim(), courseNumber.trim());
		echo "[".$created."]";
	}
	else
	{
		echo "There was a problem creating the course!";
	}
	
	
}
else if($object == "CourseOffering")
{
	$sectionNumber = $this->input->post("sectionNumber");
	$term = $this->input->post("term");
	$medium = $this->input->post("medium");
	$courseId = $this->input->post("course_id");
	
	//CourseManager cm = CourseManager.instance();
	$course = $this->course_model->getCourseById(intval($courseId));
	$course_data = $course->row();
	$offering = $this->course_model->getOfferingByCourseAndSectionAndTerm($courseId, $sectionNumber, $term);
	$offering_data = $offering->row();
	$offering_count = $offering->num_rows();
	if(intval($offering_count) > 0)
	{
		if($this->course_model->updateCourseOffering($offering_data->id, $sectionNumber, $term, $medium))
		{
			echo "Course offering updated";
		}
		else
		{
			echo "There was a problem updating the course offering!";
		}
	}
	else if($this->course_model->saveCourseOffering($courseId, $sectionNumber, $term, $medium))
	{
		echo "Course offering created";
		$session_items = array('sessionInitialized' => '');
		$this->session->unset_userdata($session_items);
		//trigger re-init for reloading permissions
		//session.removeAttribute("sessionInitialized");
	}
	else
	{
		echo "There was a problem creating the course offering!";
	}
}

else if($object == "LinkCourseProgram")
{
	$courseId = $this->input->post("course_id");
	$programId = $this->input->post("program_id");
	
	$courseClassifcation = $this->input->post("courseClassifcation");
	$time = $this->input->post("time");
	$id = $this->input->post("id");
	
	//ProgramManager manager = ProgramManager.instance();
	if(strlen($id) > 0)
	{
		if($this->program_model->updateLinkCourseProgram(intval($id),intval($courseClassifcation), intval($time)))
		{
			echo "Course info updated";
		}
		else
		{
			echo "There was a problem updating the course info!";
		}
	}
	else if($this->program_model->saveLinkCourseProgram(intval($courseId), intval($programId), intval($courseClassifcation), intval($time)))
	{
		echo "CourseOffering added to program";
		//trigger re-init for reloading permissions
		//session.removeAttribute("sessionInitialized");
		$session_items = array('sessionInitialized' => '');
		$this->session->unset_userdata($session_items);
	}
	else
	{
		echo "There was a problem adding the courseOffering to the program!";
	}
	
}
else if($object == "ProgramOutcome")
{
	$linkId = $this->input->post("id");
	$programId = $this->input->post("program_id");
	$outcomeIds = $this->input->post("outcomeToAdd");
	$outcomeIds = explode(",",$outcomeIds);
	//OutcomeManager manager = OutcomeManager.instance();
	$userid = $this->session->userdata('username');//(String)session.getAttribute("edu.yale.its.tp.cas.client.filter.user");
	$count = 0;
	if(strlen($linkId) < 1 )
	{
		foreach($outcomeIds as $outcomeId)
		{//new outcome link
			if($this->outcome_model->saveProgramOutcomeLink(intval($programId), intval($outcomeId)))
			{
				$count++;
			}
		}
		echo $count." outcome(s) added";
	}
	
}
else if($object == "OrganizationOutcome")
{
	$linkId = $this->input->post("id");
	$organizationId = $this->input->post("organization_id");
	$outcomeIds = $this->input->post("outcomeToAdd");
	$outcomeIds = explode(",",$outcomeIds);
	//OutcomeManager manager = OutcomeManager.instance();
	$userid=$this->session->userdata('username');//(String)session.getAttribute("edu.yale.its.tp.cas.client.filter.user");
	$count = 0;
	if(strlen($linkId) < 1)
	{
		foreach($outcomeIds as $outcomeId)
		{//new outcome link
			if($this->outcome_model->saveOrganizationOutcomeLink(intval($organizationId), intval($outcomeId)))
			{
				$count++;
			}
		}
		echo $count." outcome(s) added";
	}
	
}
else if($object == "CharacteristicType")
{//newOutcomeName','newOutcomeDescription','program_id','newOutcomeProgramSpecific'
	$name = $this->input->post("name");
	$id = $this->input->post("id");
	$questionDisplay = $this->input->post("questionDisplay");
	$valueType = $this->input->post("valueType");
	//CharacteristicManager manager = CharacteristicManager.instance();
/*	if(HTMLTools.isValid(id))
	{
		//update
		/if(manager.updateCharacteristicType(id,name, questionDisplay,valueType))
		{
			out.println("Characteristic Type saved");
		}
		else
		{
			out.println("ERROR: Unable to save new outcome");
		}
	}
	else
	{
		if(manager.saveCharacteristicType(name, questionDisplay,valueType))
		{
			out.println("Characteristic Type saved");
		}
		else
		{
			out.println("ERROR: Unable to save new outcome");
		}
	}*/
}
else if($object == "NewProgramOutcome")
{
	$newOutcomeName = $this->input->post("newOutcomeName");
	$programId = $this->input->post("program_id");
	$newOutcomeDescription = $this->input->post("newOutcomeDescription");
	$newOutcomeProgramSpecific = $this->input->post("newOutcomeProgramSpecific");
	//OutcomeManager manager = OutcomeManager.instance();
	if($this->outcome_model->saveNewProgramOutcome($newOutcomeName, $programId,$newOutcomeDescription,$newOutcomeProgramSpecific))
	{
		echo "Done saving new outcome";
	}
	else
	{
		echo "ERROR: Unable to save new outcome";
	}
	
}

else if($object == "InstructorAttribute")
{
	$name = $this->input->post("name");
	$organizationId = $this->input->post("organization_id");
	//OrganizationManager manager = OrganizationManager.instance();
	//Organization org = manager.getOrganizationById(Integer.parseInt(organizationId));
	$org = $this->organization_model->getOrganizationById(intval($organizationId));
	$org_data = $org->row();
	
	if($this->organization_model->addAttribute($org_data->id,$name))
	{
		echo "Done saving new Instructor Attribute";
	}
	else
	{
		echo "ERROR: Unable to save new Instructor Attribute";
	}
	
}

else if($object == "InstructorAttributeValue")
{
	$value = $this->input->post("value");
	$programId = $this->input->post("program_id");
	$userid = $this->input->post("userid");
	$instructorAttributeValueId = intval($this->input->post("attribute_value_id"));
	$instructorAttributeId = intval($this->input->post("attribute_id"));
	
	//CourseManager manager = CourseManager.instance();
	if($instructorAttributeValueId > -1)
	{
		//editing
		if($this->course_model->editInstructorAttributeValue($instructorAttributeValueId, $value))
		{
			echo "Done saving new Instructor Attribute";
		}
		else
		{
			echo "ERROR: Unable to save new Instructor Attribute";
		}
		
	}
	else
	{
		//create new one
		$instructor = $this->getInstructorByUserid(userid, session);
		$instructor_data = $instructor->row();
		$instructorId = $instructor_data->id;
		if($this->course_model->saveInstructorAttributeValue($instructorAttributeId, $value,$instructorId))
		{
			echo "Done saving new Instructor Attribute";
		}
		else
		{
			echo "ERROR: Unable to save new Instructor Attribute";
		}

	}	
}
else if($object == ("CourseAttribute"))
{
	$name = $this->input->post("name");
	$organizationId = $this->input->post("organization_id");
	//OrganizationManager manager = OrganizationManager.instance();
	$org = $this->organization_model->getOrganizationById(intval($organizationId));
	$org_data = $org->row();
	
	if($this->organization_model->addCourseAttribute($org_data->id,$name))
	{
		echo "Done saving new Course Attribute";
	}
	else
	{
		echo "ERROR: Unable to save new Course Attribute";
	}
	
}
else if($object == "CourseAttributeValue")
{
	$value = $this->input->post("value");
	$programId = $this->input->post("program_id");
	$courseId = intval($this->input->post("course_id"));
	$courseAttributeValueId = intval($this->input->post("attribute_value_id"));
	$courseAttributeId = intval($this->input->post("attribute_id"));
	
	//CourseManager manager = CourseManager.instance();
	if($courseAttributeValueId > -1)
	{
		//editing
		if($this->course_model->editCourseAttributeValue($courseAttributeValueId, $value))
		{
			echo "Done saving new Course Attribute";
		}
		else
		{
			echo "ERROR: Unable to save new Course Attribute";
		}
		
	}
	else
	{
		//create new one
		if($this->course_model->saveCourseAttributeValue(courseAttributeId, value,courseId))
		{
			echo "Done saving new Course Attribute";
		}
		else
		{
			echo "ERROR: Unable to save new Course Attribute";
		}

	}	
}
else if($object == "Program")
{
	$name = $this->input->post("name");
	$description = $this->input->post("description");
	$organizationId = $this->input->post("organization_id");
	$id = $this->input->post("id");
	
	//ProgramManager manager = ProgramManager.instance();
	if(strlen($id) > 0 )
	{
		if($this->program_model->updateProgram($id,$name,$description))
		{
			echo "Program updated";
			//trigger re-init for reloading permissions
			session.removeAttribute("sessionInitialized");
		}
		else
		{
			echo "There was a problem updating the program!";
		}
	}
	else if($this->program_model->addProgram($name,$description,$organizationId))
	{
		echo "Program created";
		//trigger re-init for reloading permissions
		//session.removeAttribute("sessionInitialized");
		$session_items = array('sessionInitialized' => '');
		$this->session->unset_userdata($session_items);
	}
	else
	{
		echo "There was a problem creating the program!";
	}
	
	
}
else if ($object == "ProgramOutcomeOrganizationOutcome")
{
	$outcomeId = intval($this->input->post("outcome_selected"));
	$organizationOutcomeId = intval($this->input->post("organization_outcome_id"));
	$programId = intval($this->input->post("program_id"));
	
	
	//OrganizationManager manager = OrganizationManager.instance();
	if($this->organization_model->saveProgramOutcomeOrganizationOutcome($outcomeId, $organizationOutcomeId,$programId))
	{
		echo "Contribution added";
	}
	else
	{
		echo "ERROR: Unable to save contribution";
	}
}
else if ($object == "LinkCourseOrganization")
{
	$courseId = intval($this->input->post("id"));
	$organizationId = intval($this->input->post("organization"));
	
	//CourseManager manager = CourseManager.instance();
	if($this->orgzanization_model->addCourseToOrganization($courseId,$organizationId))
	{
		echo "Organization added";
	}
	else
	{
		echo "ERROR: Unable to add Organization";
	}
}
else if ($object == "MoveQuestionItem")
{
	$programId = intval($this->input->post("program_id"));
	$toMoveId = intval($this->input->post("option_id"));
	$setId = intval($this->input->post("set_id"));
	$action = $this->input->post("action");
	$type = $this->input->post("type");

	//QuestionManager manager = QuestionManager.instance();
	
	
	if($type == ("answerOption"))
	{
		$tempAction = $this->question_model->moveAnswerOption($toMoveId, $action);
		if($tempAction)
		{
			echo "";
		}
		else
		{
			echo "ERROR: Unable to perform answer option action";
		}
	}
	else if ($type == "question")
	{
		$tempAction = $this->question_model->moveQuestion($programId,$toMoveId, $action);
		if($tempAction)
		{
			echo "";
		}
		else
		{
			echo "ERROR: Unable to perform question action".$tempAction;
		}
	}
	
}
else if ($object == "LinkProgramQuestion")
{
	
	$programId = intval($this->input->post("program_id"));
	$questionId = intval($this->input->post("question_id"));
	$action = $this->input->post("action");
	
	//QuestionManager manager = QuestionManager.instance();
	if($action === "add")
	{
		
		$process = $this->question_model->addQuestionToProgram($questionId, $programId); 
		if($process)
		{
			echo "Question added";
		}
		else
		{
			echo "ERROR: Unable to add Question";
		}
	}
	else if($action === "remove")
	{
			if($this->question_model->addQuestionToProgram($questionId, $programId))
			{
				echo "Question added";
			}
			else
			{
				echo "ERROR: Unable to add Question";
			}

		}
		
}

else if ($object == "ProgramQuestion")
{
	
	$programId = intval($this->input->post("program_id"));
	$questionId = intval($this->input->post("question_id"));
	$display = $this->input->post("display");
	$questionType = $this->input->post("question_type");
	$answerSetId = intval($this->input->post("answer_set_id"));
	//QuestionManager manager = QuestionManager.instance();
	
	//AnswerSet set= null;
	$set = NULL;
	if ($answerSetId < 0 && $questionType != "textarea")
	{
		 $set_data = $this->question_model->getAnswerSetById($this->input->post("answer_set_id"));
		 $set= $set_data->row();
		 $answerSetId = $set->id;
	}	 

	if($this->question_model->saveQuestion($questionId, $display, $questionType, $answerSetId))
	{
		echo "Question saved";
	}
	else
	{
		echo "ERROR: Unable to save Question";
	}
	
}
else if ($object == "AnswerOption")
{
	$programId = intval($this->input->post("as_program_id"));
	$answerSetId = intval($this->input->post("as_answer_set_id"));
	$display = $this->input->post("as_display");
	$calcValue = $this->input->post("calc_value");
	$optionId = intval($this->input->post("as_option_id"));
	//QuestionManager manager = QuestionManager.instance();

	if($optionId == -1 && $answerSetId == -1)
	{
		$answerSetName = $this->input->post("answer_set_name");
		if($this->question_model->saveAnswerSet($answerSetName))
		{
			echo "Unable to create new Answerset! Please make sure that the values you entered are not too long.";
			return;
		}
		//AnswerSet newSet = manager.getAnswerSetByName(answerSetName);
		$newSet_data = $this->question_model->getAnswerSetByName($answerSetName);
		$newSet = $newSet_data->row();
		$answerSetId = $newSet->id;
	}
	if($this->question_model->saveAnswerOption($optionId,$calcValue, $display, $answerSetId))
	{
		echo "Option saved";
	}
	else
	{
		echo "ERROR: Unable to save Option";
	}
	
}
else if ($object == "ProgramOutcomeWithCharacteristics")
{
	/* --roel
	int existingOutcomeId = intval($this->input->post("outcome_id"));
	int linkId = intval($this->input->post("link_id"));
	int programId = intval($this->input->post("program_id"));
	int programOutcomeGroupId = intval($this->input->post("program_outcome_group_id"));
	
	$characteristicCount = $this->input->post("char_count");
	int charCount = Integer.parseInt(characteristicCount);
	$outcomeName = $this->input->post("new_value");
	OutcomeManager manager = OutcomeManager.instance();
	$userid=(String)session.getAttribute("edu.yale.its.tp.cas.client.filter.user");
	int maxFieldSize= (ProgramOutcome.class.getMethod("getName")).getAnnotation(Length.class).max();
	if(outcomeName.length() > maxFieldSize)
	{
		echo "Maximum length of the outcome is "+maxFieldSize+" characters. The one you entered is "+outcomeName.length()+" characters.";
		return;
	}
	
	if(linkId < 0 )
	{
		boolean allOkay = true;
		//new outcome link
		existingOutcomeId = manager.saveProgramOutcomeLink(programId, outcomeName,programOutcomeGroupId);
		for(int i=0; i < charCount ; i++ )
		{
			$charString = $this->input->post("characteristic_"+i);
			$charType = $this->input->post("characteristic_type_"+i);
			logger.error("charString = ["+charString+"] charType ("+"characteristic_type_"+i+") = ["+charType+"]");
			
			allOkay = allOkay && manager.saveCharacteristic(programId, existingOutcomeId, charString,charType,userid,true);
			
		}
		if(allOkay)
		{
			echo "Outcome added";
		}
		else
		{
			echo "ERROR: saving new outcome";
		}
	}
	else
	{
		LinkProgramProgramOutcome existing = manager.getLinkProgramProgramOutcomeById(linkId);
		ProgramOutcome outcome =  existing.getProgramOutcome();
		if (manager.saveProgramOutcome(outcomeName, outcome.getId()))
		{
			boolean allOkay = true;
			//saving existing
			for(int i=0; i < charCount ; i++ )
			{
				$charString = $this->input->post("characteristic_"+i);
				$charType = $this->input->post("characteristic_type_"+i);
				logger.error("charString = ["+charString+"] charType ("+"characteristic_type_"+i+") = ["+charType+"]");
				
				allOkay = allOkay && manager.updateProgramOutcomeCharacteristic(linkId, charString,charType,userid);
				
			}
			if(allOkay)
			{
				echo "Outcome updated";
			}
			else
			{
				echo "ERROR: saving outcome changes";
			}
		}
		else
		{
			echo "ERROR: Unable to save new Program Outcome text";
		}
	}
	*/
}
else if($object == "DeleteLibraryQuestion")
{
	/* --roel
	int programId = intval($this->input->post("program_id"));
	int questionId = intval($this->input->post("question_id"));
	
	QuestionManager manager = QuestionManager.instance();
	if(manager.deleteQuestion(questionId))
	{
		echo "Question deleted";
	}
	else
	{
		echo "ERROR: Unable to delete question";
	}
	*/
}
else
{
	echo "ERROR: Unable to determine what to do (object [".$object."] not recognized)";	
	return;
}

?>

<?php 
/*
!
public boolean isInt($s)
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
