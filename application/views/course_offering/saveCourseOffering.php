<?php
/*
Enumeration e = request.getParameterNames();
while(e.hasMoreElements())
{
	$pName = (String)e.nextElement();
	String[] values = request.getParameterValues(pName);
	for($value:values)
		logger.error("("+pName + ") = ("+value+")");
}
*/

$object = $this->input->get("object");

if(strlen($object) < 1){
	$object = $this->input->post("object");
}


if($object == null)
{
	echo("ERROR: Unable to determine what to do (Object not found)");	
	return;
}

if($object == "TeachingMethod")
{
	$teachingMethodName = $this->input->get("newTeachingMethodName");
	$newTeachingMethodDescription = $this->input->get("newTeachingMethodDescription");
	//CourseManager manager = CourseManager.instance();
	if($this->course_model->saveTeachingMethod($teachingMethodName,$newTeachingMethodDescription))
	{
		echo("Teaching Method added");
	}
	else
	{
		echo("There was a problem adding the Teaching Method!");
	}
	
}
else if($object == ("AssessmentMethod"))
{
	$teachingMethodName = $this->input->get("newAssessmentMethodName");
	$newTeachingMethodDescription = $this->input->get("newAssessmentMethodDescription");
	//CourseManager manager = CourseManager.instance();
	if($this->course_model->saveAssessment($teachingMethodName,$newTeachingMethodDescription) )
	{
		echo("Assessment type added");
	}
	else
	{
		echo("There was a problem adding the Assessment type!");
	}
	
}
else if($object == "LinkCourseOfferingAssessmentMethod")
{
	$courseOfferingId = $this->input->get("course_offering_id");
	$assessmentId = $this->input->get("assessmentMethod");
	
	$weight = $this->input->get("assessmentWeight");
	$additionalInfo = $this->input->get("additional_info");
	
	$criterionExists = $this->input->get("criterion_exists");
	$criterionLevel = $this->input->get("criterion_level");
	$criterionSubmitted = $this->input->get("criterion_submitted");
	$criterionCompleted = $this->input->get("criterion_completed");
	
	
	$id = intval($this->input->get("assessment_link_id"));
	$when = $this->input->get("when");
	//CourseManager manager = CourseManager.instance();
	$questions = $this->course_model->getAssessmentFeedbackQuestions();
	//String[] additionalQuestionAnswers = request.getParameterValues("additionalQuestionAnswer");
	$additionalQuestionAnswers = $this->input->get("additionalQuestionAnswer");
	if($id > -1)
	{
		if($this->course_model->updateLinkCourseOfferingAssessment($id,intval($assessmentId),$weight,$when,$criterionExists,$criterionLevel,$criterionSubmitted,$criterionCompleted,$additionalQuestionAnswers,$additionalInfo))
		{
			echo("Assessment info updated");
		}
		else
		{
			echo("There was a problem updating the assessment info!");
		}
	}
	else if($this->course_model->saveLinkCourseOfferingAssessment(intval($courseOfferingId), intval($assessmentId), $weight, intval($when),$criterionExists,$criterionLevel,$criterionSubmitted,$criterionCompleted,$additionalQuestionAnswers,$additionalInfo))
	{
		echo("Assessment info added");
	}
	else
	{
		echo("There was a problem adding the assessment info!");
	}
	
}
else if($object == ("CourseOfferingOutcome"))
{
	
	if(strlen($this->input->get("outcome_id")) <= 0){
		$existingOutcomeId = intval($this->input->post("outcome_id"));
		$courseOfferingId = intval($this->input->post("course_offering_id"));
		$charCount = intval( $this->input->post("char_count"));
		$outcomeName = $this->input->post("outcomeToAdd");
	}else{
		$existingOutcomeId = intval($this->input->get("outcome_id"));
		$courseOfferingId = intval($this->input->get("course_offering_id"));
		$charCount = intval( $this->input->get("char_count"));
		$outcomeName = $this->input->get("outcomeToAdd");
	}
	
	//OutcomeManager manager = OutcomeManager.instance();
	$userid=$this->session->userdata('username');//(String)session.getAttribute("edu.yale.its.tp.cas.client.filter.user");
	$maxFieldSize=400; // (CourseOutcome.class.getMethod("getName")).getAnnotation(Length.class).max();
	if(strlen($outcomeName) > $maxFieldSize)
	{
		echo("Maximum length of the outcome is ".$maxFieldSize." characters. The one you entered is ".strlen($outcomeName)." characters.");
		return;
	}
	
	if($existingOutcomeId <= 0 )
	{
			
		//new outcome link
		$existingOutcomeId = $this->outcome_model->saveCourseOfferingOutcomeLink($courseOfferingId, $outcomeName, $existingOutcomeId);
		if($existingOutcomeId <= 0 )
		{
			echo("ERROR: Unable to create a new Outcome");
			return;
		}
		$allOkay = true;
		
		
		for($i=0; $i < $charCount ; $i++ )
		{
			if(strlen($this->input->get("characteristic_".$i))<1){
				$charString = $this->input->post("characteristic_".$i);
				$charType = $this->input->post("characteristic_type_".$i);
			}else{
				$charString = $this->input->get("characteristic_".$i);
				$charType = $this->input->get("characteristic_type_".$i);
			}
			
			//logger.error("charString = ["+charString+"] charType ("+"characteristic_type_"+i+") = ["+charType+"]");
				
			$allOkay = $allOkay && $this->outcome_model->saveCharacteristic($courseOfferingId, $existingOutcomeId, $charString, $charType, $userid, false);
				
		}
		
		if($allOkay)
		{
			echo("Outcome added");
		}
		else
		{
			echo("ERROR: saving characteristcs for new outcome");
		}
	}
	else
	{
		$temp = $this->outcome_model->saveCourseOfferingOutcomeLink($courseOfferingId, $outcomeName, $existingOutcomeId); 
		
		if( $temp < 0)
		{
			echo("ERROR: saving outcome text");
			return;
		}
		
		$allOkay = true;
		//saving existing
		
		for($i=0; $i < $charCount ; $i++ )
		{
			if(strlen($this->input->get("characteristic_".$i)) < 1){
				$charString = $this->input->post("characteristic_".$i);
				$charType = $this->input->post("characteristic_type_".$i);
			}else{
				$charString = $this->input->get("characteristic_".$i);
				$charType = $this->input->get("characteristic_type_".$i);
			}
			
			//logger.error("charString = ["+charString+"] charType ("+"characteristic_type_"+i+") = ["+charType+"]");
			
			$temp = $this->outcome_model->updateCharacteristic($courseOfferingId, $existingOutcomeId, $charString,$charType);
			$allOkay = $allOkay && $temp;
			
		}
		
		if($allOkay)
		{
			echo("Outcome updated");
		}
		else
		{
			echo("ERROR: saving outcome changes");
		}
		
	}
}
else if($object == ("CharacteristicType"))
{//newOutcomeName','newOutcomeDescription','program_id','newOutcomeProgramSpecific'
	$name = $this->input->get("name");
	$id = $this->input->get("id");
	$questionDisplay = $this->input->get("questionDisplay");
	$valueType = $this->input->get("valueType");
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
else if($object == ("CourseOfferingComments"))
{
	$type = $this->input->get("commentType");
	$comments = $this->input->get("comments");
	$id = $this->input->get("course_offering_id");
	
	//CourseManager manager = CourseManager.instance();
	if(!is_null($id))
	{
		if($this->course_model->setCommentsForCourseOffering(intval($id),$comments,$type))
		{
			echo("comments updated");
		}
		else
		{
			echo("ERROR: unable to update comments!");
		}
	}
}
else if($object == ("ExportOfferingData"))
{
	$to = intval($this->input->get("to"));
	$from = intval($this->input->get("course_offering_id"));
	$programId = intval($this->input->get("program_id"));
	
	//CourseManager manager = CourseManager.instance();
	if($to >= 0 && $from >= 0 && $programId >=0)
	{
		if(manager.copyDataFromOfferingToOffering(from, to, programId))
		{
			echo("Data copied");
		}
		else
		{
			echo("ERROR: unable to copy data!");
		}
	}
	else
	{
		echo("ERROR: invalid data");
	}
}
else if ($object == ("EditCourseOutcome"))
{
	$outcomeId = intval($this->input->get("id"));
	//CourseOutcome co = OrganizationManager.instance().getCourseOutcomeById(outcomeId);
	$value = $this->input->get("value");
	if($this->organization_model->saveCourseOutcomeValue($outcomeId,$value))
	{
		echo("Value saved");
	}
	else
	{
		echo("ERROR: Unable to save value");
	}
}
else if ($object == ("CourseOutcomeProgramOutcomeLink"))
{
	$courseOfferingId = intval($this->input->get("course_offering_id"));
	
	$courseOutcomeId = intval($this->input->get("course_outcome_id"));
	$programOutcomeId = intval($this->input->get("program_outcome_id"));
	$existingLinkId = intval($this->input->get("existing_link_id"));

	//ProgramManager manager = ProgramManager.instance();
	$allOkay = true; 
	
    if( $this->program_model->saveCourseOutcomeProgramOutcome($courseOutcomeId, $programOutcomeId , $courseOfferingId, $existingLinkId))
    {
    	echo("Change saved");
	}
	else
	{
		echo("ERROR: Unable to save changes");
	}
}

else if ($object == ("TimeItTook"))
{
	$courseOfferingId = intval($this->input->get("course_offering_id"));
	
	$timeItTookId = intval($this->input->get("timeItTookOptionId"));

	//CourseManager manager = CourseManager.instance();
	$allOkay = true; 
	
    if( $this->course_model->saveTimeItTook($courseOfferingId, $timeItTookId))
    {
    	echo("Change saved");
	}
	else
	{
		echo("ERROR: Unable to save changes");
	}
}
else if ($object == ("Questions"))
{
	$courseOfferingId = intval($this->input->get("course_offering_id"));
	$programId = intval($this->input->get("program_id"));
	$parameterStart = $programId."_".$courseOfferingId."_";
	//TreeMap<String,String[]> responses = new TreeMap<String,String[]>();
	$enums = request.getParameterNames();
	$responses = array();
	/*while(enums.hasMoreElements())
	{
		$pName = (String)enums.nextElement();
		if(pName.startsWith(parameterStart))
		{
			String[] values = request.getParameterValues(pName);
			responses.put(pName,values);
		}
	}*/
	
	foreach($_SERVER['QUERY_STRING'] as $key => $value){
		$pName = $key;
	  	if(startsWith($pName,$parameterStart)){
			$responses[$pName] = $value;
		}	
	  
	}
	//QuestionManager qm = QuestionManager.instance();
	//Program p = ProgramManager.instance().getProgramById(programId);
	
	//List<Question> questions = qm.getAllQuestionsForProgram(p);
	$questions = $this->question_model->getAllQuestionsForProgram($programId);
	$questions_count = $questions->num_rows();
	if(!$this->question_model->clearResponsesForOfferingInProgram($programId,$courseOfferingId))
	{
		echo("ERROR: something went wrong while clearing your previous answers!");
		return;
	}
	
	$result = "";
	
	
	if(!$this->question_model->saveResponses($programId,$courseOfferingId,$responses))
	{
		$result="ERROR: The was a problem saving your responses!".$result;
	}
	else
	{
		if($questions_count != count($responses))
		{
			$result="<script type=\"text/javascript\">\n".changeClass($responses ,$parameterStart, $questions)."\n</script>\nNot all responses have been saved. Not all questions have a response. Please review your responses.";
		}
		else
		{
			$result = "Responses saved.";
		}
	}
	echo($result);
	
}
else
{
	echo("ERROR: Unable to determine what to do (object [".$object."] not recognized)");	
	return;
}

?>

<?php 
function isInt($s)
{
	
	if (is_numeric($s))
		return true;
	else
		return false;
}

function changeClass($responses ,$responseStart, $questions)
{
	//StringBuilder r = new StringBuilder();
	$r = '';
	foreach($questions as $q)
	{
		$id = $responseStart.$q->id;
		if(!responses.containsKey(id))
		{
			$r .= "$(\"#area_";
			$r .= $id;
			$r .= '"\").addClass(\"completeMessage\");"';
			$r .=  "$(\"#area_";
			$r .= $id;
			$r .= '"\").show();"';
			
		}
	}
	return $r;
	
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
}
?>
