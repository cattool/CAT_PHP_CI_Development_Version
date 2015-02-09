<?php
class Program_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getProgramByOrgId($id){
		$sql = "SELECT * FROM program WHERE organization_id = $id ORDER BY lower(name)";	
		$query = $this->db->query($sql);
	    return $query;
	}


	function getOrganizationByProgram($name){
		$sql = "SELECT * FROM program WHERE name = '".mysql_real_escape_string($name)."' ORDER BY lower(name)";	
		$query = $this->db->query($sql);
	    return $query;
	}


	function getOrganizationByProgramId($id){
		$sql = "SELECT p.organization_id FROM program p WHERE p.id =  $id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function removeLinkProgramProgramOutcomeByProgramId($programId){
		$delete = $this->db->delete('link_program_program_outcome', array('program_id' => $programId)); 
		return $delete;		
	}
	
	function removeQuestionResponseByProgramId($programId){
		$delete = $this->db->delete('question_response', array('program_id' => $programId)); 
		return $delete;		
	}
	
	function removeLinkProgramQuestionByProgramId($programId){
		$delete = $this->db->delete('link_program_question', array('program_id' => $programId)); 
		return $delete;		
	}
	
	function removeLinkCourseProgramByProgramId($programId){
		$delete = $this->db->delete('link_course_program', array('program_id' => $programId)); 
		return $delete;		
	}
	
	function removeProgramAdminByProgramId($programId){
		$delete = $this->db->delete('program_admin', array('program_id' => $programId)); 
		return $delete;		
	}
	
	function removeProgramById($programId){
		$delete = $this->db->delete('program', array('id' => $programId)); 
		return $delete;		
	}
	
	function removeProgram($programId){
			$deleteTry = $this->removeLinkProgramProgramOutcomeByProgramId($programId);
			
			if($deleteTry){
				$deleteTry = $this->removeQuestionResponseByProgramId($programId);
				
			}
			if($deleteTry){
				$deleteTry = $this->removeLinkProgramQuestionByProgramId($programId);
				
			}
			if($deleteTry){
				$deleteTry = $this->removeLinkCourseProgramByProgramId($programId);			
				
			}
			if($deleteTry){
				$deleteTry = $this->removeProgramAdminByProgramId($programId);						
				
			}
			if($deleteTry){
				$deleteTry = $this->removeProgramById($programId);						
				
			}
			
			return $deleteTry;
			
	}
	
	function saveCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $linkProgramOutcomeId, $contributionId, $masteryId)
	{
		//Session session = HibernateUtil.getSessionFactory().getCurrentSession();
		//session.beginTransaction();
		//try
		//{
			//MasteryOptionValue mastery = (MasteryOptionValue) session.get(MasteryOptionValue.class, masteryId);
			//ContributionOptionValue contribution = (ContributionOptionValue) session.get(ContributionOptionValue.class, contributionId);
			//CourseOffering courseOffering = (CourseOffering) session.get(CourseOffering.class, courseOfferingId);
			//LinkProgramProgramOutcome lpo = (LinkProgramProgramOutcome)session.get(LinkProgramProgramOutcome.class, linkProgramOutcomeId);
			$lpo = $this->program_model->getLinkProgramProgramOutcomeId($linkProgramOutcomeId);
			$lpo_data = $lpo->row();
			//LinkCourseOfferingContributionProgramOutcome o =  $this->program_model->getCourseOfferingContributionLinksForProgramOutcome($courseOffering, lpo,session);
			$o =  $this->program_model->getCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $lpo->program_outcome_id);
			$o_data = $o->row();
			$o_count = $o->num_rows();
			if($o_count < 1)
			{	
				/*
				o = new LinkCourseOfferingContributionProgramOutcome();
				o.setCourseOffering(courseOffering);
				o.setLinkProgramOutcome(lpo);
				o.setContribution(contribution);
				o.setMastery(mastery);
				session.save(o);
				*/
				$LinkCourseOfferingContributionProgramOutcome = array(
				'course_offering_id'	=> $courseOfferingId,
				'link_program_program_outcome_id'	=> $linkProgramOutcomeId,
				'contribution_option_id'	=> $contributionId,
				'mastery_option_id'	=> $masteryId
				);
				$this->db->insert('link_course_offering_contribution_program_outcome', $LinkProgramProgramOutcomeCharacteristic);			
				
			}
			else
			{
				/*	
				o.setContribution(contribution);
				o.setMastery(mastery);
				session.merge(o);
				*/
				$LinkCourseOfferingContributionProgramOutcome = array(
				'contribution_option_id'	=> $contributionId,
				'mastery_option_id'	=> $masteryId
				);
			
				$this->db->where(array('course_offering_id' => $courseOfferingId, 'link_program_program_outcome_id' => $linkProgramOutcomeId));
				$this->db->update('link_course_offering_contribution_program_outcome', $LinkProgramProgramOutcomeCharacteristic);			
			}
			//session.getTransaction().commit();
			return true;
		//}
	}
	
	function getCourseOfferingContributionLinksForProgramOutcome($courseOfferingId, $programOutcomeId){
		$sql = "SELECT * 
				FROM link_course_offering_contribution_program_outcome l 
				INNER JOIN link_program_program_outcome lppo ON lppo.id = l.link_program_program_outcome_id
				WHERE lppo.program_outcome_id = $programOutcomeId AND l.course_offering_id= $courseOfferingId";	
		$query = $this->db->query($sql);
	    return $query;
	}

	function getProgramById($id){
		$sql = "SELECT * FROM program WHERE id = $id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function updateProgram($id,$name,$description){
		
			
			$program = array(
				'name' => mysql_real_escape_string($name),
				'description'	=> mysql_real_escape_string($systemName)
			);
			$this->db->where('id', $id);
			return $updateprogram = $this->db->update('program', $program);
	}
	
	function addProgram($name,$description,$organizationId){
		
			$program = array(
				'name' => mysql_real_escape_string($name),
				'organization_id' => $organizationId,
				'description'	=> mysql_real_escape_string($description)
				
			);
			return $addprogram = $this->db->insert('program', $program);
	}

	function getAllAvailableTerms($id){
			$sql = "SELECT DISTINCT co.term 
					FROM course_offering co 
					WHERE co.course_id 
					IN (SELECT lcp.course_id FROM link_course_program lcp WHERE lcp.program_id=$id) 
					ORDER BY  co.term";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function updateLinkCourseProgram($id, $classification, $time){
		$LinkCourseProgram = array(
				'course_classification_id' => $classification,
				'time_id'	=> $time
			);
			$this->db->where('id', $id);
			return $updateLinkCourseProgram = $this->db->update('link_course_program', $LinkCourseProgram);
	}
	
	function saveLinkCourseProgram($courseId, $programId, $classification, $time){
		$LinkCourseProgram = array(
				'course_id' => $courseId,
				'program_id'	=> $programId,
				'course_classification_id'	=> $classification,
				'time_id'	=> $time
			);
			return $updateLinkCourseProgram = $this->db->insert('link_course_program', $LinkCourseProgram);
	}
	function getLinkProgramOutcomeForProgram($progId){
		$sql = "SELECT 	l.*, po.id as po_id, po.name as po_name, po.description as po_description, 
						po.program_outcome_group_id as po_program_outcome_group_id,
						pog.id as pog_id, pog.name as pog_name,
						pog.description as pog_description, 
						pog.program_specific as pog_program_specific, 
						pog.program_id as pog_program_id  
				FROM link_program_program_outcome l 
				INNER JOIN program_outcome po ON po.id = l.program_outcome_id
				INNER JOIN program_outcome_group pog ON pog.id = po.program_outcome_group_id
				WHERE l.program_id = $progId
				ORDER BY pog.name, po.name";	
			$query = $this->db->query($sql);
			return $query;
	}
	function getLinkCourseProgramForProgram($programId){
		$sql = "SELECT 	l.*, t.id as t_id,t.name as t_name, 
						t.display_index as t_display_index, 
						t.option_display_index as t_option_display_index,
						c.id as c_id, c.subject as c_subject, 
						c.course_number as c_course_number, 
						c.title as c_title, c.description as c_description,
						cc.id as cc_id,cc.name as cc_name, cc.description as cc_description, cc.display_index as cc_display_index
				FROM link_course_program l 
				INNER JOIN time t ON t.id = l.time_id
				INNER JOIN course c ON c.id = l.course_id
				INNER JOIN course_classification cc ON cc.id = l.course_classification_id
				WHERE l.program_id = $programId 
				ORDER BY t.display_index, c.subject, c.course_number";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function getCourseOfferingsContributingToProgram($programId, $list){
		
		$courseOfferingId = '0';
		$ictr = 1;
		foreach($list as $row){
			$courseOfferingId .= $row->term.',';
			$ictr++;
		}
		
		$courseOfferingId = substr($courseOfferingId,0,strlen($courseOfferingId)-1);

		$sql = "SELECT  l.course_offering_id
				FROM link_course_offering_contribution_program_outcome l 
				INNER JOIN course_offering co ON co.id = l.course_offering_id
				INNER JOIN link_program_program_outcome lppo ON lppo.id = l.link_program_program_outcome_id
				INNER JOIN contribution_option_value cov ON cov.id = l.contribution_option_id
				INNER JOIN mastery_option_value mov ON mov.id = l.mastery_option_id
				WHERE 1=1";
		if(strlen($courseOfferingId) < 1)
				$courseOfferingId = 0;	
		$sql .=	" AND co.term IN ($courseOfferingId)";
		$sql .=	" AND lppo.program_id = $programId AND (cov.calculation_value + mov.calculation_value) > 0;";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function getProgramOutcomeGroupsProgram($programId){
		$sql = "SELECT pog.id,pog.name
				FROM link_program_program_outcome l 
				INNER JOIN program_outcome po ON po.id = l.program_outcome_id
				INNER JOIN program_outcome_group pog ON pog.id = po.program_outcome_group_id
				WHERE l.program_id = $programId 
				GROUP BY pog.id
				ORDER BY pog.name;";	
			$query = $this->db->query($sql);
			return $query;
	
	}
	
	function getContributionOptions(){
		$sql = "SELECT * FROM contribution_option_value ORDER BY lower(display_index)";	
			$query = $this->db->query($sql);
			return $query;
	}

	function getLinkProgramProgramOutcomeId($id){
		$sql = "SELECT * FROM link_program_program_outcome WHERE id = $id";	
			$query = $this->db->query($sql);
			return $query;
	}

	function getMasteryOptions(){
		$sql = "SELECT * FROM mastery_option_value ORDER BY lower(display_index)";	
			$query = $this->db->query($sql);
			return $query;
	}	
	
	function getCourseContributionLinksForProgramOutcome($courseId, $LinkProgramProgramOutcomeId){
		$sql = "SELECT l.*,cov.name as cov_name,cov.display_index as cov_display_index, cov.calculation_value as cov_calculation_value,
					 mov.name as mov_name, mov.display_index as mov_display_index, mov.calculation_value as mov_calculation_value  
				FROM link_course_contribution_program_outcome l 
				INNER JOIN contribution_option_value cov ON l.contribution_option_id = cov.id
				INNER JOIN mastery_option_value mov ON l.mastery_option_id = mov.id
				WHERE 	l.link_program_program_outcome_id = $LinkProgramProgramOutcomeId 
					AND l.course_id=$courseId";	
			$query = $this->db->query($sql);
			return $query;	
	}
	
	function getProgramOutcomeForGroupAndProgram($programId,$programOutcomeGroupId ){
		$sql = "SELECT  l.*, po.id as po_id,po.name as po_name,po.description as po_description, 
						po.program_outcome_group_id as po_program_outcome_group_id,
						pog.id as pog_id, pog.name as pog_name,pog.description as pog_description, 
						pog.program_specific as pog_program_specific, pog.program_id as pog_program_id  
				FROM link_program_program_outcome l 
				INNER JOIN program_outcome po ON po.id = l.program_outcome_id
				INNER JOIN program_outcome_group pog on pog.id = po.program_outcome_group_id
				WHERE l.program_id = $programId 
				AND pog.id = $programOutcomeGroupId 
				ORDER BY po.name";	
			$query = $this->db->query($sql);
			return $query;
		
	}
	
	function getContributionForProgramOutcome($programOutcomeId, $programId,$terms){
		$courseOfferingId = '';
		foreach($terms as $row){
			$courseOfferingId .= $row->term.',';
		}
		
		$courseOfferingId = substr($courseOfferingId,0,strlen($courseOfferingId)-1);

		$sql = "SELECT co.id AS courseOfferingId, cov.calculation_value AS contributionObject, 
				mov.calculation_value as masteryObject, lcp.program_id,lppo.program_outcome_id,
				co.course_id,c.subject,c.course_number,cov.id as cov_id
				FROM course_offering co
					,link_course_program lcp
					,link_program_program_outcome lppo
					,link_course_offering_contribution_program_outcome lcopo
					,contribution_option_value cov 
					,mastery_option_value mov 
					,course c
				WHERE co.term IN ($courseOfferingId)
				 AND  co.course_id = lcp.course_id
				 AND co.id = lcopo.course_offering_id
				 AND c.id = co.course_id
				 AND lcopo.link_program_program_outcome_id = lppo.id
				 AND lppo.program_id = lcp.program_id
				 AND lcopo.contribution_option_id = cov.id
				 AND lcopo.mastery_option_id = mov.id
				 AND lcp.program_id = $programId
				 AND lppo.program_outcome_id = $programOutcomeId
				 AND (cov.calculation_value + mov.calculation_value) > 0";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function getServiceCourseContributionForProgramOutomce($programOutcomeId, $programId){
		$sql = "SELECT  lccpo.course_id AS courseOfferingId, cov.calculation_value AS contributionObject, 
						mov.calculation_value AS masteryObject,lppo.program_id,lppo.program_outcome_id 
				FROM link_course_contribution_program_outcome lccpo
				, link_program_program_outcome lppo 
				, contribution_option_value cov 
				, mastery_option_value mov 
				WHERE lccpo.link_program_program_outcome_id = lppo.id 
				AND lccpo.contribution_option_id = cov.id
				AND lccpo.mastery_option_id = mov.id
				AND lppo.program_id = $programId
				AND lppo.program_outcome_id = $programOutcomeId
				AND (cov.calculation_value + mov.calculation_value)  > 0 ";	
			$query = $this->db->query($sql);
			return $query;
	} 
	
	function getProgramCourseAssessmentOptions($programId, $terms){
		$courseOfferingId = '';
		foreach($terms as $row){
			$courseOfferingId .= $row->term.',';
		}
		
		$sql = "SELECT  select sum(lcoa.weight) as weight, ato.display_index as optionId, co.course_id as courseId  
				FROM course_offering co 
					,link_course_offering_assessment lcoa 
					,link_course_program lcp 
					,assessment_time_option ato
				WHERE co.term IN ($courseOfferingId)
				AND lcp.program_id = $programId 
				AND lcp.course_id = co.course_id 
				AND co.id = lcoa.course_offering_id 
				AND ato.id =  lcoa.assessment_time_option_id 
				GROUP BY co.course_id, ato.display_index  
				ORDER BY co.course_id, ato.display_index";	
			$query = $this->db->query($sql);
			return $query;
		
	}
	
	function getCourseOfferingCounts($ProgramId, $terms){
		$courseOfferingId = '';
		foreach($terms as $row){
			$courseOfferingId .= $row->term.',';
		}
		
		$sql = "SELECT co.course_id as a, count( distinct co.id) as b
			 	FROM course_offering co 
			    , link_course_program lcp 
				WHERE co.term IN ($courseOfferingId) 
				AND lcp.program_id = $ProgramId 
				AND lcp.course_id = co.course_id 
				AND co.id in (select course_offering_id FROM link_course_offering_assessment) 
				GROUP BY co.course_id;";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function getCourseOutcomeLinksForProgramOutcome($courseOfferingId, $programOutcomeId){
		/*$courseOfferingId = '';
		foreach($terms as $row){
			$courseOfferingId .= $row->term.',';
		}*/
		
		$sql = "SELECT l.*,l2.id as link_course_outcome_program_outcome_id, 
					   l2.course_offering_id,l2.display_index,co.name,
					   co.description,co.course_outcome_group_id 
				FROM link_course_outcome_program_outcome l , 
					link_course_offering_outcome l2,
					course_outcome co
				WHERE 1=1
					AND l.program_outcome_id = $programOutcomeId
					AND l.course_offering_id= $courseOfferingId
					AND co.id = l.course_outcome_id
					AND l2.course_offering_id = l.course_offering_id  
					AND (l.course_outcome_id = l2.course_outcome_id OR co.name = 'No match to a course outcome') 
				GROUP BY l.course_outcome_id	
				ORDER BY COALESCE(l2.display_index,'aaaaaaa');";	
			$query = $this->db->query($sql);
			return $query;
	}
	
	function saveCourseContributionLinksForProgramOutcome($courseId, $linkProgramOutcomeId, $contributionId, $masteryId)
	{
			
			
			$CheckIfExists = $this->program_model->getCourseContributionLinksForProgramOutcome($courseId, $linkProgramOutcomeId);
			$CheckIfExists_count = $CheckIfExists->num_rows();
			$CheckIfExists_data = $CheckIfExists->row();
			
			
			$LinkCourseContributionProgramOutcome = array(
				'contribution_option_id' => $courseOfferingId,
				'mastery_option_id'	=> $programOutcomeId
				);
				
			
			if(intval($CheckIfExists_count) < 1){
				$LinkCourseContributionProgramOutcome['course_id'] = $courseId;
				$LinkCourseContributionProgramOutcome['link_program_program_outcome_id'] = $linkProgramOutcomeId;
				$saveCourseOutcomeProgramOutcome = $this->db->insert('link_course_contribution_program_outcome', $LinkCourseContributionProgramOutcome);
			}else{
				$this->db->where('id', $CheckIfExists_data->id);
				$saveCourseOutcomeProgramOutcome = $this->db->update('link_course_contribution_program_outcome', $LinkCourseContributionProgramOutcome);
			}	
				
			return $saveCourseOutcomeProgramOutcome;
			
			
	}
	
	function saveCourseOutcomeProgramOutcome($outcomeId, $programOutcomeId, $courseOfferingId, $existingLinkId)
	{
		/*
		Session session = HibernateUtil.getSessionFactory().getCurrentSession();
		session.beginTransaction();
		try
		{
			
			ProgramOutcome pOutcome  = (ProgramOutcome)session.get(ProgramOutcome.class,programOutcomeId);
			CourseOffering courseOffering  = (CourseOffering)session.get(CourseOffering.class,courseOfferingId);
			CourseOutcome outcome = (CourseOutcome) session.get(CourseOutcome.class,outcomeId);
			logger.debug(outcomeId + " "+(outcome==null));
			LinkCourseOutcomeProgramOutcome o = null;
		*/	
			if($existingLinkId > -1) // need to update or delete
			{
				//o = (LinkCourseOutcomeProgramOutcome) session.get(LinkCourseOutcomeProgramOutcome.class,existingLinkId);
				if($outcomeId > -1)
				{
					
					$LinkCourseOutcomeProgramOutcome = array(
					'course_outcome_id' => $outcomeId
					);

					$this->db->where('id', $existingLinkId);
					$LinkCourseOutcomeProgramOutcome = $this->db->update('link_course_outcome_program_outcome', $LinkCourseOutcomeProgramOutcome);

					//o.setCourseOutcome(outcome);
					//session.merge(o);
					
				}
				else
					//session.delete(o); // contribution is invalid (or 0)  Delete it 
					$delete = $this->db->delete('link_course_outcome_program_outcome', array('id' => $existingLinkId)); 
				
			}
			else
			{
				//need to create a new one
				/*
				o = new LinkCourseOutcomeProgramOutcome();
				o.setCourseOffering(courseOffering);
				o.setCourseOutcome(outcome);
				o.setProgramOutcome(pOutcome);
				session.save(o);
				*/
				$LinkCourseOutcomeProgramOutcome = array(
				'course_offering_id' => $courseOfferingId,
				'program_outcome_id'	=> $programOutcomeId,
				'course_outcome_id'	=> $outcomeId
				);
				return $saveCourseOutcomeProgramOutcome = $this->db->insert('link_course_outcome_program_outcome', $LinkCourseOutcomeProgramOutcome);
			}
			//session.getTransaction().commit();
			//return true;
		/*
		}
		
		catch(Exception e)
		{
			HibernateUtil.logException(logger, e);
			logger.error("Oops "+outcomeId+ " "+programOutcomeId+" "+courseOfferingId,e);
			try{session.getTransaction().rollback();}catch(Exception e2){logger.error("Unable to roll back!",e2);}
			return false;
		}
		*/
	}
	
}

