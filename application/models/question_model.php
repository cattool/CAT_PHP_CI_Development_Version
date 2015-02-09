<?php
class Question_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getAllQuestionsForProgram($progid){
		$sql = "SELECT l.*,q.id as q_id,q.display as q_display, 
					q.question_type_id as q_question_type_id,q.answer_set_id as q_answer_set_id,
					qt.id as qt_id,qt.name as qt_name,qt.description as qt_description
				FROM link_program_question l 
				INNER JOIN question q ON q.id = l.question_id
				INNER JOIN question_type qt ON qt.id = q.question_type_id
				WHERE l.program_id = $progid
				GROUP BY l.question_id
				ORDER BY l.display_index";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAllQuestionsWithResponsesForProgram($programId){
		$sql = "SELECT distinct l.question_id FROM question_response l WHERE l.program_id=$programId";	
		$query = $this->db->query($sql);
	    return $query;	
	
	}
	
	function getQuestionTypes(){
		$sql = "SELECT * FROM question_type";	
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getQuestionById($questionId){
		$sql = "SELECT q.*,qt.id as qt_id, qt.name as qt_name, qt.description as qt_description, a.id as a_id, a.name as a_name 
				FROM question q 
				INNER JOIN question_type qt ON qt.id = q.question_type_id
				LEFT JOIN answer_set a ON a.id = q.answer_set_id
				WHERE q.id = $questionId";	
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getLinkProgramQuestion($programId, $questionId){
		$sql = "SELECT l.*,p.id as p_id, p.name as p_name,p.description as p_description, p.organization_id as p_organization_id,
				q.id as q_id,q.display as q_display,q.question_type_id as q_question_type_id, q.answer_set_id as q_answer_set_id
				FROM link_program_question l
				INNER JOIN program p ON p.id = l.program_id
				INNER JOIN question q ON q.id = l.question_id  
				WHERE l.program_id = $programId 
				AND l.question_id = $questionId";	
		$query = $this->db->query($sql);
	    return $query;	
	}
	
	function getAllAnswerSetIdsWithResponses(){
		$sql = "SELECT q.answer_set_id 
				FROM question_response qr
				INNER JOIN question q ON q.id = qr.question_id 
				WHERE q.answer_set_id <> ''
				GROUP BY q.answer_set_id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAnswerSetById($SetId){
		$sql = "SELECT ansSet.*, ansOpt.id as ansOpt_id, ansOpt.answer_set_id as ansOpt_answer_set_id,
				ansOpt.display as ansOpt_display, ansOpt.value as ansOpt_value, 
				ansOpt.display_index as ansOpt_display_index
				FROM answer_set ansSet
				INNER JOIN answer_option ansOpt ON ansOpt.answer_set_id = ansSet.id
				WHERE ansSet.id=$SetId";	
		$query = $this->db->query($sql);
	    return $query;
	}
	/*
	function getAnswerSetById($SetId){
		$sql = "SELECT ansSet.*, ansOpt.id as ansOpt_id, ansOpt.answer_set_id as ansOpt_answer_set_id,
				ansOpt.display as ansOpt_display, ansOpt.value as ansOpt_value, 
				ansOpt.display_index as ansOpt_display_index
				FROM answer_set ansSet
				INNER JOIN answer_option ansOpt ON ansOpt.answer_set_id = ansSet.id
				WHERE ansSet.id=$SetId";	
		$query = $this->db->query($sql);
	    return $query;
	}*/
	
	function getAllQuestionIdsUsedInProgramsOtherThan($programId){
		$sql = "SELECT distinct question_id FROM link_program_question WHERE program_id <> $programId ";	
		$query = $this->db->query($sql);
	    return $query;
	
	
	}
	
	function addQuestionToProgram($questionId, $programId)
	{
		
		$sql = "SELECT max(display_index) as counter FROM link_program_question WHERE program_id = $programId";	
		$query = $this->db->query($sql);
		$result_data = $query->row();
		$count  = $result_data->counter;
		
		if(is_null($count)){
			$max = 1;	
		}else{
			$max = intval($max) + 1;
		}
		
		$LinkProgramQuestion = array(
			'program_id' => $programId,
			'question_id'	=> $questionId,
			'display_index'	=> $max
			);
			return $addQuestionToProgram = $this->db->insert('link_program_question', $LinkProgramQuestion);
		
	}
	
	function getAllQuestionsNotUsedByProgram($programId){
		$sql = "SELECT * FROM question WHERE id NOT IN 
					(SELECT l.question_id 
					 FROM link_program_question l 
					 WHERE l.program_id=$programId) 
					 ORDER BY lower(display)
			   ";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAllQuestionsWithResponsesForProgramAndOffering($programId,$courseOfferingId){
		$sql = "SELECT *
				FROM question_response l 
				WHERE l.program_id=$programId AND l.course_offering_id=$courseOfferingId
				GROUP BY l.question_id ";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getAllQuestionResponsesForProgramAndOffering($programId, $courseofferingId){
		$sql = "SELECT * 
				FROM question_response 
				WHERE program_id=$programId 
				AND course_offering_id=$courseofferingId";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function clearResponsesForOfferingInProgram($programId, $courseOfferingId)
	{
			/*
			List<QuestionResponse> questionResponses = (List<QuestionResponse>)session
						.createQuery("FROM QuestionResponse WHERE program.id=:programId AND courseOffering.id=:courseOfferingId")
						.setParameter("programId", p.getId())
						.setParameter("courseOfferingId", courseOfferingId)
					    .list();
			*/
			$sql = "SELECT * 
				    FROM question_response WHERE program_id=$programId AND course_offering_id=$courseOfferingId";	
			$query = $this->db->query($sql);
			$questionResponses = $query->result();	
			$delete = false;
			foreach($questionResponses as $responseToDelete)
			{
				//session.delete(responseToDelete);
				$delete = $this->db->delete('question_response', array('id' => $responseToDelete->id)); 
				
			}	
			return $delete;
			//session.getTransaction().commit();
			//return true;
	}

	function saveResponses($programId, $courseOffering, $responses)
	{
		
			//CourseOffering offering = (CourseOffering)session.get(CourseOffering.class, courseOffering);
		
			foreach($responses as $key=>$value)
			{
				$questionIdString = explode("_",$key); //key.split("_")[2];
				$questionIdString = $questionIdString[1];
				//Question q = (Question)session.get(Question.class,Integer.parseInt(questionIdString));
				//String[] responseValues = responses.get(key);
				$responseValues = $key;
				foreach($responseValues as $responseString)
				{
					/*
					QuestionResponse response = new QuestionResponse();
					response.setProgram(p);
					response.setCourseOffering(offering);
					response.setQuestion(q);
					response.setResponse(responseString);
					session.save(response);
					*/
				$QuestionResponse = array(
				'program_id' => $programId,
				'course_offering_id'	=> $courseOffering,
				'question_id'	=> $questionIdString,
				'response'	=> $responseString,
				);
				return $saveResponses = $this->db->insert('question_response', $QuestionResponse);
				}

			}
			
		
	}
	
	function saveAnswerSet($name)
	{
		//AnswerSet o = new AnswerSet();
		$answerSet = array(
				'name' => mysql_real_escape_string($name)
			);
		return $saveAnswerSet = $this->db->insert('answer_set', $answerSet);	
		
	}
	
	function updateQuestionDisplayIndex($id, $displayIndex){
			$charDisplay = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateQuestionDisplayIndex = $this->db->update('link_program_question', $charDisplay);	
	}
	
	function deleteQuestionDisplayIndex($id){
			$delete = $this->db->delete('link_program_question', array('id' => $id)); 
			return $delete;
	}
	
	 function getAnswerSetByName($name){
		 $sql = "SELECT * 
				FROM answer_set 
				WHERE name=$name";	
		$query = $this->db->query($sql);
	    return $query;
	}
	 
	function saveQuestion($id, $display, $questionType, $answerSetId){
		//Question o = new Question();
			$Question2Save = array(
				'display' => $display,
				
			);
			
			if($answerSetId > -1){
				$Question2Save['answer_set_id'] = $answerSetId;	
			}
			
			if(!is_null($questionType)){
				$sql = "SELECT * FROM question_type WHERE name='". mysql_real_escape_string($questionType)."'";	
				$query = $this->db->query($sql);
				$tempRS = $query->row();
				$question_type_id = $tempRS->id;
				$Question2Save['question_type_id'] = $question_type_id;		
			}
			
			
			if($id > -1){
				$this->db->where('id', $id);
				$saveQuestion = $this->db->update('question', $Question2Save);	
			}else{
				$saveQuestion = $this->db->insert('question', $Question2Save);	
				//session.save(o);
			}
			
			return $saveQuestion;
				
	}
	
	function saveAnswerOption($id,$value, $display, $answerSetId)
	{
			//AnswerOption o = new AnswerOption();
			$answerOption = array();
			if( $id > -1)
			{
				//o = (AnswerOption) session.get(AnswerOption.class,id);
				
				$sql = "SELECT * FROM ansert_option WHERE id=$id";	
				$query = $this->db->query($sql);
				$o = $query->row();
				
				
				if($value != ($o->value)) // if the value was already used in question responses, it needs to be updated.
				{
					//@SuppressWarnings("unchecked")
					
					$sql = "SELECT * FROM question_response WHERE question_id IN (SELECT id FROM question WHERE answer_set_id = $answerSetId) AND response = '".$o->value."'";	
					$query = $this->db->query($sql);
					$responsesUsingAnswer = $query->result();
					/*
					List<QuestionResponse> responsesUsingAnswer = (List<QuestionResponse>)session
							.createQuery("FROM QuestionResponse WHERE question in (FROM Question WHERE answerSet.id=:answerSetId) AND response=:responseValue")
							.setParameter("answerSetId",o.getAnswerSet().getId()).setParameter("responseValue",o.getValue()).list();
					*/
					foreach($responsesUsingAnswer as $response)
					{
						$question_response = array(
							'response' => $value,
							
						);
							$this->db->where('id', $response->id);
							$this->db->update('question_response', $question_response);	
						
						//response.setResponse(value);
						//session.merge(response);
					}
					
				}
			}
			else
			{
				//AnswerSet set = (AnswerSet)session.get(AnswerSet.class,  answerSetId);
				//o.setAnswerSet(set);
				$answerOption = array(
							'answer_set_id' => $answerSetId,
							
						);
			}
			$answerOption['value'] = $value;
			$answerOption['display'] = $display;
			//o.setValue(value);
			//o.setDisplay(display);
			
			if($id < 0)
			{
				$sql = "SELECT * FROM answer_option WHERE answer_set_id = $answerSetId";	
				$query = $this->db->query($sql);
				$existingCount = $query->num_rows();
				//$existingCount = session.createQuery("FROM AnswerOption WHERE answerSet.id=:answerSetId").setParameter("answerSetId", answerSetId).list().size();		
				//o.setDisplayIndex(existingCount+1);
				$answerOption['display_index'] = intval($existingCount) + 1;
			}
			/*
			session.merge(o);
			session.getTransaction().commit();
			return true;
			*/
			$this->db->where('id', $id);
			return $this->db->update('answer_option', $answerOption);	
		
	}
	
	function moveQuestion($programId, $questionId, $direction)
	{
		//Session session = HibernateUtil.getSessionFactory().getCurrentSession();
		//session.beginTransaction();
		//try
		//{
			
			
			$sql = "SELECT distinct id 
				    FROM link_program_question WHERE program_id=$programId AND question_id = $questionId";	
			$query = $this->db->query($sql);
			$toMove = $query->row();	
		
			$toMoveId = $toMove->id;
			
			$sql = "SELECT *
				    FROM link_program_question WHERE program_id=$programId ORDER BY display_index";	
			$query = $this->db->query($sql);
			$existing = $query->result();	
			
			//List<LinkProgramQuestion> existing = (List<LinkProgramQuestion>)session.createQuery("FROM LinkProgramQuestion WHERE program.id=:programId ORDER BY displayIndex").setParameter("programId", toMove.getProgram().getId()).list();		
			
			$id= $toMoveId;
			if($direction == "up")
			{
				//LinkProgramQuestion prev = null;
				//$prevIndex = null;
				$prevId = "";
				$prevDisplayIndex = "";
				foreach($existing as $link)
				{
					if($link->id == $id && strlen($prevId) > 0)
					{
						$tempAction = $this->question_model->updateQuestionDisplayIndex($link->id, $prevDisplayIndex);
						$tempAction = $this->question_model->updateQuestionDisplayIndex($prevId, $link->display_index);
						$done = true;
						break;
					}
					$prevId = $link->id;
					$prevDisplayIndex = $link->display_index;
				}
			}
			else if($direction == "down")
			{
				
				$prevId = "";
				$prevDisplayIndex = "";
				foreach($existing as $rsExisting)
				{
						
					if(strlen($prevId) > 0)
					{
						$tempAction = $this->question_model->updateQuestionDisplayIndex($rsExisting->id, $prevDisplayIndex);
						$tempAction = $this->question_model->updateQuestionDisplayIndex($prevId, $rsExisting->display_index);
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
				foreach($existing as $rsExisting)
				{
				
					if(strval($toDelete) > 0)
					{
						
						$tempAction = $this->question_model->updateQuestionDisplayIndex($rsExisting->id, intval($rsExisting->display_index)-1);
					}
					
					if($rsExisting->id == $id)
					{
						$toDelete = $rsExisting->id;
					}
					
				}
				if(strlen($toDelete) > 0)
				{
						$tempAction = $this->question_model->deleteQuestionDisplayIndex($toDelete);
						$done = true;
				}
				
				
				
			}
			return $done;
	}
	
}

