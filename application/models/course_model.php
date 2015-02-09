<?php
class Course_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getTeachingMethodPortionOptions(){
		
		$sql = "SELECT * 
				FROM teaching_method_portion_option order by display_index";
		$query = $this->db->query($sql);
	    return $query;		
	}
	
	
	function getTeachingCourseOfferings($userid)
	{
		
				$sql = "SELECT * 
						FROM link_course_offering_instructor LCOI
						INNER JOIN course_offering CO ON LCOI.course_offering_id = CO.id
						INNER JOIN instructor INS ON INS.id = LCOI.instructor_id
						INNER JOIN course ON course.id = CO.course_id
						WHERE 1=1";

				$sql .= " AND INS.userid = '$userid'";
		
		$query = $this->db->query($sql);
	    return $query;		
	}
	
	function updateCourse($courseId, $subject, $courseNumber, $title, $description){
		$course = array(
				'subject' => mysql_real_escape_string($subject),
				'course_number'	=> $courseNumber,
				'title' => mysql_real_escape_string($title),
				'description' => mysql_real_escape_string($description),
			);
			$this->db->where('id', $courseId);
			return $updateCourse = $this->db->update('course', $course);
	}
	
	function saveCourse($subject, $courseNumber, $title, $description){
		$course = array(
				'subject' => mysql_real_escape_string($subject),
				'course_number'	=> $courseNumber,
				'title' => mysql_real_escape_string($title),
				'description' => mysql_real_escape_string($description),
			);
			$updateCourse = $this->db->insert('course', $course);
			return $this->db->insert_id();
	}
	
	function updateCourseOffering($offeringId, $sectionNumber, $term, $medium){
		$courseOffering = array(
				'section_number' => mysql_real_escape_string($sectionNumber),
				'term'	=> mysql_real_escape_string($term),
				'medium' => mysql_real_escape_string($medium)
			);
			$this->db->where('id', $offeringId);
			return $updateCourseOffering = $this->db->update('course_offering', $courseOffering);
	}
	
	function getInstructorByUserid($userid){
				$sql = "SELECT * FROM instructor
						WHERE userid=$userid";

		$query = $this->db->query($sql);
	    return $query;		
	}
	
	function editInstructorAttributeValue($id, $value){
		$InstructorAttributeValue = array(
				'value' => mysql_real_escape_string($value)
			);
			$this->db->where('id', $id);
			return $editInstructorAttributeValue = $this->db->update('instructor_attribute_value', $InstructorAttributeValue);
	}
	
	function saveInstructorAttributeValue($instructorAttributeId, $value,$instructorid){
				
			$InstructorAttributeValue = array(
				'value' => mysql_real_escape_string($value),
				'instructor_id' => $instructorid,
				'instructor_attribute_id' => $instructorAttributeId
			);
			return $editInstructorAttributeValue = $this->db->insert('instructor_attribute_value', $InstructorAttributeValue);
	}
	
	function editCourseAttributeValue($id, $value){
			$CourseAttributeValue = array(
				'value' => mysql_real_escape_string($value)
			);
			$this->db->where('id', $id);
			return $editCourseAttributeValue = $this->db->update('course_attribute_value', $CourseAttributeValue);
			
	}
	
	function saveCourseAttributeValue($attributeTypeId, $value,$courseId){
			$CourseAttributeValue = array(
				'course_id' => $courseId,
				'course_attribute_id' => $attributeTypeId,
				'value' => mysql_real_escape_string($value)
				
			);

			return $editCourseAttributeValue = $this->db->insert('course_attribute_value', $CourseAttributeValue);
	
	}
	
	
	function saveCourseOffering($courseId, $sectionNumber, $term, $medium){
		$courseOffering = array(
				'course_id' => $courseId,
				'section_number' => mysql_real_escape_string($sectionNumber),
				'term'	=> mysql_real_escape_string($term),
				'medium' => mysql_real_escape_string($medium)
			);
			
			return $updateCourseOffering = $this->db->insert('course_offering', $courseOffering);
	}
	
	
	function getCourseSubjects() {
		$sql = "SELECT DISTINCT subject FROM course ORDER BY subject";
		
		$query = $this->db->query($sql);
	    return $query;			
			
	}
	
	function getCourseById($id){
		$sql = "SELECT * 
				FROM course 
				WHERE id = $id";
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getOrganizationForCourseOffering($courseId){
		return $this->course_model->getOrganizationForCourse($courseId);	
	}
	
	function getCourseNumbersForSubject($subject) {
		$sql = "SELECT DISTINCT course_number FROM course WHERE subject='$subject' order by course_number";
		
		$query = $this->db->query($sql);
	    return $query;			
			
	}	
	
	function getOfferingByCourseAndSectionAndTerm($courseId, $sectionNumber, $term){
		$sql = "SELECT * FROM course_offering WHERE id=$courseId AND section_number=$sectionNumber AND term=$term";
		
		$query = $this->db->query($sql);
	    return $query;			
	}
	
	function getCourseNumbersForSubjectAndOrganization($subjectParameter,$organizationId, $course_number){
	
		$sql = "SELECT DISTINCT lco.course_id
				FROM link_course_organization lco
				INNER JOIN course on course.id = lco.course_id
				INNER JOIN organization org on org.id = lco.organization_id 
				WHERE course.subject='$subjectParameter' 
				AND lco.organization_id=$organizationId 
				AND course.course_number = $course_number
				ORDER BY lco.course_id
				";
		
		$query = $this->db->query($sql);
	    return $query;			
	}
	
	function isAlreadyPartOfProgram($programId, $courseId)
	{
		$testRS = $this->course_model->getLinkCourseProgramByCourseAndProgram($programId,$courseId);
		$test = $testRS->num_rows();
		
		$isAlreadyPartOfProgram = false;
		
		if(intval($test) > 0)
			$isAlreadyPartOfProgram = true;
	
		return $isAlreadyPartOfProgram;	
	}
	
	function getCourseBySubjectAndNumber($subject,$number){
			
		$sql = "SELECT * 
				FROM course 
				WHERE upper(subject)='$subject' 
				AND course_number=$number";
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAssessmentByName($name)
	{
		$sql = "SELECT * 
				FROM assessment 
				WHERE lower(name)=$name";
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	
	function saveAssessmentMethodName($id, $newName){
		$assessment = array(
				'name' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveAssessmentMethodName = $this->db->update('assessment', $assessment);	
	}
	
	function addAssessmentMethodToGroup($groupId, $newName){
			 $group =  $this->assessment_model->getAssessmentGroupById($groupId);
			 $group_data = $group->row();
			 $existing = $this->assessment_model->getAssessmentsForGroup($group_data->id);
			 $existing_data = $existing->row();	
			 $existing_count = intval($existing->num_rows()) + 1;
		
		$assessment = array(
				'assessment_group_id' => $group_data->id,
				'name'	=> mysql_real_escape_string($newName),
				'description' => "",
				'display_index' => $existing_count
			);
			return $addAssessmentMethodToGroup = $this->db->insert('assessment', $assessment);

	}
	
	function saveTeachingMethod($name, $description)
	{

			$saveTeachingMethod = array(
				'description' => mysql_real_escape_string($description),
				'name'	=> mysql_real_escape_string($name)
			);
			return $saveTeachingMethod = $this->db->insert('teaching_method', $saveTeachingMethod);
	}

	function saveAssessment($name, $description)
	{
		
		if(!$existing) //if it already exists, don't bother adding it
		{
			return true;
		}
		
		$saveAssessment = array(
			'description' => mysql_real_escape_string($description),
			'name'	=> mysql_real_escape_string($name)
		);
		return $saveAssessment = $this->db->insert('assessment', $saveTeachingMethod);
		
		$existing = $this->course_model->getAssessmentByName($name);
	}

	
	function saveAssessmentDescriptionById($id, $newValue){
		$assessment = array(
				'description' => mysql_real_escape_string($newValue)
			);
			
			$this->db->where('id', $id);
			return $saveAssessmentDescriptionById = $this->db->update('assessment', $assessment);
	}
	
	function  getAssessmentFeedbackQuestions(){
		$sql = "SELECT * 
				FROM assessment_feedback_option_type 
				ORDER BY display_index";
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function  getAssessmentFeedbackOption($id){
		$sql = "SELECT * 
				FROM assessment_feedback_option 
				WHERE id = $id";
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function createAssessmentGroup($newName){
			$existing = $this->assessment_model->getAssessmentGroups();
			$existing_data  = $existing->row();
			$existing_count = intval($existing->num_rows()) + 1;
		
			$assessmentGroup = array(
				'short_name' => 'Not created yet',
				'name'	=> mysql_real_escape_string($newName),
				'display_index' => $existing_count
			);
			return $createAssessmentGroup = $this->db->insert('assessment_group', $assessmentGroup);
	}
	
	function saveAssessmentGroupName($id, $newName){
			$assessmentGroup = array(
				'name' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveAssessmentGroupName = $this->db->update('assessment_group', $assessmentGroup);		
	
	}
	
	
	
	function saveAssessmentGroupShortName($id, $newName){
			$assessmentGroup = array(
				'short_name' => mysql_real_escape_string($newName)
			);
			
			$this->db->where('id', $id);
			return $saveAssessmentGroupShortName = $this->db->update('assessment_group', $assessmentGroup);	
	}
	
	function getAssessmentsUsed($assessmentId){
		
		$sql = "SELECT * 
		FROM link_course_offering_assessment l WHERE l.assessment_id=$assessmentId";

		$query = $this->db->query($sql);
	    return $query;

	}
	
	function getCourseAttributes($orgId){
		
		$sql = "SELECT * 
		FROM course_attribute WHERE organization_id = $orgId ORDER BY name	";

		$query = $this->db->query($sql);
	    return $query;

	}
	
	function updateAssessmentDisplayIndex($id, $displayIndex){
			$assessDisplay = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateAssessmentDisplayIndex = $this->db->update('assessment', $assessDisplay);	
	}
	
	function deleteExistingAdditionalAssessmentOptions($linkId)
	{
		
		$delete = $this->db->delete('link_course_assessment_feedback_option_value', array('link_course_offering_assessment_id' => $linkId)); 
			return $delete;
	}
	
	function createNewAdditionalAssessmentOptions($link, $additionQuestionResponses)
	{
		foreach($additionQuestionResponses as $answer)
		{
			
			$questionOption = $this->course_model->getAssessmentFeedbackOption(intval(answer));
			$questionOption_data = $questionOption->row();
			$LinkCourseAssessmentFeedbackOption = array(
				'link_course_offering_assessment_id' => $link,
				'assessment_feedback_option_id'	=> $answer
			);
			return $createNewAdditionalAssessmentOptions = $this->db->insert('link_course_assessment_feedback_option_value', $LinkCourseAssessmentFeedbackOption);

		}
		
	}
	
	function updateLinkCourseOfferingAssessment($id, $assessmentId, $weight, $whenId, $criterionExists, $criterionLevel, $criterionSubmitted, $criterionCompleted,$additionQuestionResponses, $additionalInfo)
	{
		$LinkCourseOfferingAssessment = array(
				'assessment_time_option_id' => $whenId,
				'weight'	=> $weight,
				'additional_info' => $additionalInfo,
				'criterion_exists' => $criterionExists,
				'criterion_level'	=> $criterionLevel,
				'criterion_completion_required' => $criterionCompleted,
				'criterion_submit_required'	=> $criterionSubmitted,
				'assessment_id' => $assessmentId
			);
			$this->db->where('id', $id);
			return $updateCourseOffering = $this->db->update('link_course_offering_assessment', $LinkCourseOfferingAssessment);
		
		
		
	}
	
	function deleteAssessmentDisplayIndex($id){
			$delete = $this->db->delete('assessment', array('id' => $id)); 
			return $delete;
	}
	
	function setCommentsForCourseOffering($id, $comments, $type)
	{
		
			if($type == "teaching_comment")
				$CourseOffering = array(
				'teaching_comment' => mysql_real_escape_string($comments)
				);

			else if($type == "contribution_comment")
				$CourseOffering = array(
				'contribution_comment' => mysql_real_escape_string($comments)
				);
			else if($type == "outcome_comment")
				$CourseOffering = array(
				'outcome_comment' => mysql_real_escape_string($comments)
				);
			else
				$CourseOffering = array(
				'comments' => mysql_real_escape_string($comments)
				);
			
			$this->db->where('id', $id);
			return $setCommentsForCourseOffering = $this->db->update('course_offering', $CourseOffering);	
	}
	
	
	function moveAssessmentMethod($id, $groupId, $direction){
		//when moving up, find the one to be moved (while keeping track of the previous one) and swap display_index values
		//when moving down, find the one to be moved, swap displayIndex values of it and the next one
		//when deleting, reduce all links following one to be deleted by 1
		$done = false;
			//AssessmentGroup group = (AssessmentGroup)session.get(AssessmentGroup.class, groupId);
			//List<Assessment> existing = this.getAssessmentsForGroup(group,session);

		$existing = $this->assessment_model->getAssessmentsForGroup($groupId);
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
					$tempAction = $this->course_model->updateAssessmentDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->course_model->updateAssessmentDisplayIndex($prevId, $rsExisting->display_index);
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
					$tempAction = $this->course_model->updateAssessmentDisplayIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->course_model->updateAssessmentDisplayIndex($prevId, $rsExisting->display_index);
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
					
					$tempAction = $this->course_model->updateAssessmentDisplayIndex($rsExisting->id, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->id == $id)
				{
					$toDelete = $rsExisting->id;
				}
				
			}
			if(strlen($toDelete) > 0)
			{
					$tempAction = $this->course_model->deleteAssessmentDisplayIndex($toDelete);
					$done = true;
			}
		}
		return $done;
	}
	
	function getCourseForLinkProgram($id){
		
		$sql = "SELECT  l.*, c.id as c_id, c.subject as c_subject, 
						c.course_number as c_course_number, 
						c.title as c_title, c.description as c_desccription 
				FROM link_course_program l
				INNER JOIN course c on c.id = l.course_id
				WHERE l.id = $id";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseClassification($id){
		$sql = "SELECT * 
				FROM course_classification
				WHERE id = $id";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseClassifications(){
		$sql = "SELECT * 
				FROM course_classification ORDER BY display_index";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseTimes(){
		$sql = "SELECT * 
				FROM time 
				ORDER BY option_display_index";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	
	function getAssessmentTimeOptions(){
		$sql = "SELECT * 
				FROM assessment_time_option 
				ORDER BY display_index";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	
	
	function getCourseAttributeValues($courseId, $programId){
		
		$org = $this->program_model->getOrganizationByProgramId($programId);
		$org_data = $org->row();
		$orgId = $org_data->organization_id; 
		
		$sql = "SELECT cav.*, ca.id as ca_id, ca.name as ca_name, 
					   ca.organization_id as ca_organization_id  
				FROM course_attribute_value cav
				INNER JOIN course_attribute ca ON ca.id = cav.course_attribute_id
				WHERE cav.course_id = $courseId
				AND ca.organization_id = $programId 
				ORDER BY ca.name, cav.value	";

		$query = $this->db->query($sql);
	    return $query;	
		
	}

	
	function getFeatures(){
		$sql = "SELECT *
				FROM feature 
				ORDER BY display_index";

		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getAllTeachingMethods(){
		$sql = "SELECT * FROM teaching_method order by display_index";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getLinkTeachingMethodByData($CourseOfferingId, $TeachingMethodId){
		$sql = "SELECT * 
				FROM link_course_offering_teaching_method l
				INNER JOIN course_offering co ON co.id = l.course_offering_id
				INNER JOIN teaching_method tm ON tm.id = l.teaching_method_id
				WHERE course_offering_id = $CourseOfferingId AND teaching_method_id = $TeachingMethodId ";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getAssessmentsForCourseOffering($courseOfferingId){
		$sql = "SELECT l.*
					,ato.id as ato_id,ato.name as ato_name,ato.display_index as ato_display_index
					,ato.time_period, a.id as assessment_id,a.name as assessment_name
					,a.description as assessment_description,a.display_index as assessment_display_index
					,ag.id as assessment_group_id, ag.name as assessment_group_name, ag.display_index as assessment_group_display_index
					,ag.short_name 
				FROM link_course_offering_assessment l 
				INNER JOIN assessment_time_option ato ON ato.id = l.assessment_time_option_id
				INNER JOIN assessment a ON a.id = l.assessment_id
				LEFT JOIN assessment_group ag ON ag.id = a.assessment_group_id
				WHERE l.course_offering_id = $courseOfferingId ORDER BY ato.display_index,a.name
				";
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getOrganizationForCourse($courseId){
		$sql = "SELECT lco.*, org.id as org_id, org.name as org_name, 
					org.parent_organization_id as org_parent_organization_id,
					org.system_name as org_system_name, org.active as org_active 
				FROM link_course_organization lco
				INNER JOIN organization org ON org.id = lco.organization_id
				WHERE lco.course_id = $courseId ";

		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getCourseOfferingById($id){
		$sql = "SELECT co.*,course.subject,course.course_number,course.title,course.description
				FROM course_offering co 
				INNER JOIN course ON course.id = co.course_id
				WHERE co.id = $id";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getTeachingMethods($courseOfferingId){
		$sql = "SELECT *
				FROM link_course_offering_teaching_method l 
				INNER JOIN teaching_method tm ON tm.id = l.teaching_method_id
				WHERE l.course_offering_id = $courseOfferingId
				ORDER BY tm.name
				";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseOfferingsWithoutDataForCourse($courseId){
		$sql = "SELECT * FROM course_offering 
				WHERE course_id = $courseId
				AND id NOT IN 
					(SELECT l.course_offering_id 
					 FROM link_course_offering_teaching_method l 
					 INNER JOIN course_offering co ON co.id = l.course_offering_id
					 WHERE co.course_id = $courseId) 
					 ORDER BY term, section_number
				";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getLinkCourseProgramByCourseAndProgram($programId, $courseId){
		$sql = "SELECT l.*,cc.id as cc_id,cc.name as cc_name,cc.description as cc_description, cc.display_index as cc_display_index
					,time.id as time_id
					,time.name as time_name
					,time.display_index as time_display_index
					,time.option_display_index as time_option_display_index  
				FROM link_course_program l 
				INNER JOIN course_classification cc ON cc.id = l.course_classification_id
				INNER JOIN time ON time.id = l.time_id
				WHERE l.course_id = $courseId
				AND l.program_id = $programId";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseAttributesString($courseId, $programId, $admin)
	{
		
		$org = $this->program_model->getOrganizationByProgramId($programId);
		$org_data = $org->row();
		$orgId = $org_data->organization_id; 
		$attrTypes = $this->course_model->getCourseAttributes($orgId);
		$attrTypes_count = $attrTypes->num_rows();
		$attrTypes_data = $attrTypes->result();
		if($attrTypes_count < 1){
			return "";
		}
		$output = "";
		$attrValues = $this->course_model->getCourseAttributeValues($courseId, $programId);
		$attrValues_data = $attrValues->result();
		$attrValues_count = $attrValues->num_rows();
		$prevAttr = "";
	
		if($attrValues_count > 0)
		{
			$output .= " [";
			$first = true;
			foreach($attrValues_data as $av)
			{
				if($av->ca_name == $prevAttr)
				{
					$output .= ",";
					$output .= $av->value;
				}
				else
				{
					if(!$first)
						$output .= " | ";
					else
						$first = false;
					$output .= $av->ca_name;
					$output .= ":";
					$output .= $av->value;	
				}
				$prevAttr = $av->ca_name;
			}
			$output .= "] ";
		}
		if($admin)
		{
			$output .= "<a href=\"javascript:loadModify('modify_program/modifyCourseAttributes?program_id=";
			output.append(programId);
			output.append("&course_id=");
			output.append(c.getId());
			output.append("');\"><img src=\"/cat/images/edit_16.gif\" alt=\"Edit Course Attributes\" title=\"Edit Course Attributes\"></a>");
		}
		return output.toString();
	}
	
	function getCourseOfferingsForCourse($courseId){
		$sql = "SELECT * FROM course_offering 
				WHERE course_id = $courseId 
				ORDER BY term, section_number";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAvailableTermsForCourse($courseId){
		$sql = "SELECT distinct term FROM course_offering 
				WHERE course_id = $courseId 
				ORDER BY term DESC";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseOfferingInstructors($courseOfferingId){
		$sql = "SELECT l.*,co.*,instruc.id as instruc_id, instruc.userid as instruc_userid
					, instruc.first_name as instruc_first_name
					, instruc.last_name as instruc_last_name 
				FROM link_course_offering_instructor l
				INNER JOIN course_offering co ON co.id = l.course_offering_id
				INNER JOIN instructor instruc ON instruc.id = l.instructor_id
				WHERE co.id = $courseOfferingId";

		$query = $this->db->query($sql);
	    return $query;
	}
	
	
	function getInstructorAttributeValues ($userId, $orgId){
		$sql = "SELECT * FROM 
				instructor_attribute_value iav 
				INNER JOIN instructor_attribute ia ON ia.id = iav.instructor_attribute_id
				INNER JOIN instructor instruc ON instruc.id = iav.instructor_id
				WHERE iav.instructor_userid = $userId
				AND iav.attribute_organization.id = $orgId
				ORDER BY ia.name, iav.value";

		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	function getCourseOfferingsForCourseWithProgramOutcomeData($courseId){
		$sql = "SELECT *
				FROM link_course_outcome_program_outcome l 
				INNER JOIN course_offering co ON co.id = l.course_offering_id
				WHERE co.course_id = $courseId
				GROUP BY l.course_offering_id";

		$query = $this->db->query($sql);
	    return $query;
	
	}

	function getCourseOfferingsContributionsForCourse($courseId){
		$sql = "SELECT  l.*,co.*,lppo.*,cov.id as cov_id,cov.name as cov_name
					,cov.display_index as cov_display_index,cov.calculation_value as cov_calculation_value
					,mov.id as mov_id,mov.name as mov_name,mov.display_index as mov_display_index
					,mov.calculation_value as mov_calculation_value
				FROM link_course_offering_contribution_program_outcome l 
				INNER JOIN course_offering co ON co.id = l.course_offering_id
				INNER JOIN link_program_program_outcome lppo ON lppo.id = l.link_program_program_outcome_id
				INNER JOIN contribution_option_value cov ON cov.id = l.contribution_option_id
				INNER JOIN mastery_option_value mov ON mov.id = l.mastery_option_id
				WHERE 1=1
				AND co.course_id = $courseId 
				AND (cov.calculation_value + mov.calculation_value) > 0
				ORDER BY lppo.id,co.term, co.section_number;
				";

		$query = $this->db->query($sql);
	    return $query;
	
	}


	
	function getInstructorsString($offeringId, $admin, $programId, $hasInstructorAttributes)
	{
		$output = '';
		
		//Course course = offering.getCourse();
		
		$dbInstructors = $this->course_model->getCourseOfferingInstructors($offeringId);
		$dbInstructors_count = $dbInstructors->num_rows();
		$dbInstructors_data = $dbInstructors->result();
		if($dbInstructors_count > 0 )
		{
			$output .= "Instructors : ";
		}
		$firstInstructor = true;
		foreach($dbInstructors_data as $instr)
		{
			if(!$firstInstructor)
				$output .= " , ";
			$firstInstructor = false;
			$output .= $instr->instruc_first_name.' '.$instr->instruc_last_name.' ( '.$instr->instruc_userid.' )';
			
			$programIdInt = intval($programId);
			if($programIdInt > -1 && $hasInstructorAttributes)
			{
				$org = $this->program_model->getOrganizationByProgram($programIdInt);
				$org_data = $org->row();
				$attrValues = getInstructorAttributeValues($instr->instructor_id, $org_data->organization_id);
				$attrValues_count = $attrValues->num_rows();
				$attrValues_data = $attrValues->result();
				$prevAttr = "";
				if($attrValues_count > 0)
				{
					$output .= " [";
					$first = true;
					foreach($attrValues_data as $av)
					{
						if($av->name == $prevAttr)
						{
							$output .= ",";
							$output .= $av->value;
						}
						else
						{
							if(!$first)
								$output .= " | ";
							else
								$first = false;
							$output .= $av->name;
							$output .= ":";
							$output .= $av->value;	
						}
						$prevAttr = $av->name;
					}
					$output .= "] ";
				}
			}
			if($admin && $hasInstructorAttributes)
			{
				$output .= "<a href=\"javascript:loadModify('modify_program/modifyInstructorAttributes.?program_id=";
				$output .= $programId;
				$output .= "&userid=";
				$output .= $instr->userid;
				$output .= "&course_id=";
				$output .= $instr->course_id;
				$output .= "');\"><img src=\"".base_url()."img/edit_16.gif\" alt=\"Edit Instructor Attributes\" title=\"Edit Instructor Attributes\"></a>";
			}
		}

		return $output;
		
	}	
	
	function saveTimeItTook($courseOfferingId, $timeItTookId)
	{
		/*
		Session session = HibernateUtil.getSessionFactory().getCurrentSession();
		session.beginTransaction();
		try
		{
		*/
			/*
			CourseOffering c = (CourseOffering)session.get(CourseOffering.class, courseOfferingId);
			TimeItTook time = (TimeItTook)session.get(TimeItTook.class, timeItTookId);
			c.setTimeItTook(time);
			session.merge(c);
			session.getTransaction().commit();
			return true;
			*/
			$CourseOffering = array(
				'time_it_took_id' => $timeItTookId
			);
			
			$this->db->where('id', $courseOfferingId);
			return $saveTimeItTook = $this->db->update('course_offering', $CourseOffering);	
		/*
		}
		catch(Exception e)
		{
			HibernateUtil.logException(logger, e);
			try{session.getTransaction().rollback();}catch(Exception e2){logger.error("Unable to roll back!",e2);}
			return false;
		}
		*/
	}

}

