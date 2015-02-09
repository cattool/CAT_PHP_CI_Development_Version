<?php
class Outcome_model extends  CI_Model{
     function __construct()
    {
		  error_reporting("E_ALL");
        // Call the Model constructor
        parent::__construct();
    }
	
	function getLinkProgramProgramOutcomeById($id){
		$sql = "SELECT l.*,po.*
				FROM link_program_program_outcome l 
				INNER JOIN program_outcome po ON po.id = l.program_outcome_id
				INNER JOIN program_outcome_group pog ON pog.id = po.program_outcome_group_id
			    WHERE l.id = $id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getProgramOutcomesForProgram($programId)
	{
		$sql = "SELECT  o.*,og.name as outcome_group_name,og.description as outcome_group_description,og.program_specific,og.program_id
				FROM program_outcome o 
			         ,program_outcome_group og
			    WHERE o.program_outcome_group_id = og.id
				AND (og.program_specific = 'N'
			 	OR (og.program_specific = 'Y' AND og.program_id=$programId))
			    ORDER BY og.name, o.name";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getProgramOutcomeByName($name)
	{
		$sql = "SELECT * 
				FROM program_outcome WHERE name = $name
				GROUP BY name";	
		$query = $this->db->query($sql);
	    return $query;
	}
		
	function saveProgramOutcomeLink($programId, $outcomeId){
			$ProgramOutcomeLink = array(
				'program_id'	=> $programId,
				'program_outcome_id'	=> $classification
			);
			return $saveProgramOutcomeLink = $this->db->insert('link_program_program_outcome', $ProgramOutcomeLink);	
	}
	
	function saveOrganizationOutcomeLink($organizationId, $outcomeId){
			$OrganizationOutcomeLink = array(
				'organization_id'	=> $organizationId,
				'organization_outcome_id'	=> $outcomeId
			);
			return $saveOrganizationOutcomeLink = $this->db->insert('link_organization_organization_outcome', $OrganizationOutcomeLink);	
	}
	
	
	
	function saveNewProgramOutcome($name, $programId, $description, $programSpecific){
			if($programSpecific)
			{
				$sql = "SELECT * FROM program_outcome_group og WHERE og.programId = $programId AND og.name like '%$Custom'";
				$query = $this->db->query($sql);	
				$group = $query->row();
				$group_count = $query->num_rows();
				
				if($intval($group_count) < 1){
					$ProgramOutcomeGroup = array(
					'name'	=> $group->name. ' Custom',
					'program_id'	=> $group->id,
					'program_specific'	=> 'Y'
					);
					$this->db->insert('program_outcome_group', $ProgramOutcomeGroup);			
					$outcomegroupid = $this->db->insert_id();
				}
				
				
			}else{
				$sql = "SELECT * FROM program_outcome_group og WHERE og.programId = -1 AND og.name = 'Custom'";
				$query = $this->db->query($sql);	
				$group = $query->row();
				
				if($intval($group_count) < 1){
					$ProgramOutcomeGroup = array(
					'name'	=> 'Custom',
					'program_id'	=> -1,
					'program_specific'	=> 'N'
					);
					$this->db->insert('program_outcome_group', $ProgramOutcomeGroup);			
					$outcomegroupid = $this->db->insert_id();
				}
			}	
				
					$ProgramOutcome = array(
					'name'	=> mysql_real_escape_string($name),
					'description'	=> mysql_real_escape_string($description),
					'program_outcome_group_id'	=> $outcomegroupid
					);
					$this->db->insert('program_outcome', $ProgramOutcome);			
			
	}
	
	function getCharacteristicsForProgramOutcome($ProgramId, $ProgramOutcomeId , $OrganizationId){
		$sql = "SELECT c.* 
				FROM characteristic c, 
					 link_program_program_outcome_characteristic lcoc, 
					 link_program_program_outcome lco, 
					 link_organization_characteristic_type ldct 
				WHERE lcoc.characteristic_id = c.id 
				 AND lco.id = lcoc.link_program_program_outcome_id 
				 AND lco.program_id = $ProgramId
				 AND lco.program_outcome_id = $ProgramOutcomeId
				 AND ldct.characteristic_type_id = c.characteristic_type_id 
				 AND ldct.organization_id = $OrganizationId
				ORDER BY ldct.display_index";	
		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	function getLinkCourseOfferingOutcomeCharacteristics($Id){
		$sql = "SELECT * FROM link_course_offering_outcome_characteristic WHERE link_course_offering_outcome_id = $Id";
		$query = $this->db->query($sql);
		return $query;	
	}
	
	function getCharacteristicsForCourseOfferingOutcome($courseOfferingId, $CourseOutcomeId, $organizationId){
		$sql = "SELECT *
		     	FROM characteristic c, 
		          link_course_offering_outcome_characteristic lcoc, 
		          link_course_offering_outcome lco, 
		          link_organization_characteristic_type ldct 
				WHERE lcoc.characteristic_id = c.id 
				  AND lco.id = lcoc.link_course_offering_outcome_id 
				  AND lco.course_offering_id = $courseOfferingId
				  AND lco.course_outcome_id = $CourseOutcomeId
				  AND ldct.characteristic_type_id = c.characteristic_type_id 
				  AND ldct.organization_id = $organizationId
				ORDER BY ldct.display_index ";	
				
		$query = $this->db->query($sql);
	    return $query;	
	
	
	}
	
	
	function getOutcomeById($id){
		$sql = "SELECT * 
				FROM course_outcome 
				WHERE id = $id";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getCourseOutcomeByName($name){
		$sql = "SELECT * FROM course_outcome WHERE lower(name) =$name";	
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function getLinkCourseOfferingOutcomeById($id){
		$sql = "SELECT * FROM link_course_offering_outcome 
				WHERE id = $id";
		$query = $this->db->query($sql);
		return $query;			
	}
	
	
	function getOutcomesForCourseOffering($courseOfferingId){
		$sql = "SELECT l.*,co.name as name, co.description as description, co.course_outcome_group_id as course_outcome_group_id 
				FROM link_course_offering_outcome l 
				INNER JOIN course_outcome co ON co.id = l.course_outcome_id 
				WHERE l.course_offering_id = $courseOfferingId
				ORDER BY l.display_index";	
		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	
	function getCourseOutcomeIndex($list, $outcomeId)
	{
		$index = 1;
		foreach($list as $o)
		{
			if($o->course_outcome_id == $outcomeId)
				return $index;
			$index++;
		}
		return -1;
	
	}
	
	function getLinkAssessmentCourseOutcomes($courseOfferingId){
		$sql = "SELECT  l.*,lcoa.course_offering_id,lcoa.assessment_id,lcoa.weight,
					lcoa.assessment_time_option_id,
					lcoa.additional_info,lcoa.criterion_exists,lcoa.criterion_level,lcoa.criterion_completion_required,
					lcoa.criterion_submit_required,ato.name as ato_name,ato.display_index as ato_display_index, 
					ato.time_period as ato_time_period, assessment.name as assessment_name, 
					assessment.description as assessment_description,
					assessment.assessment_group_id,assessment.display_index as assessment_display_index, 
					assessment_group.name as assessment_group_name,assessment_group.display_index as assessment_group_display_index,
					assessment_group.short_name, 
					co.name as co_name, co.description as co_description, co.course_outcome_group_id as co_course_outcome_group_id 
				FROM link_assessment_course_outcome l
				INNER JOIN link_course_offering_assessment lcoa ON lcoa.id = l.link_assessment_course_offering_id
				INNER JOIN assessment_time_option ato ON ato.id = lcoa.assessment_time_option_id 
				INNER JOIN assessment ON assessment.id = lcoa.assessment_id
				INNER JOIN assessment_group ON assessment_group.id = assessment.assessment_group_id
				INNER JOIN course_outcome co ON co.id = l.course_outcome_id
				WHERE l.course_offering_id = $courseOfferingId ORDER BY ato.display_index
				";	
		$query = $this->db->query($sql);
	    return $query;
	
	}
	
	function getLinkCourseOfferingOutcome($courseOffering, $outcome)
	{
		$sql = "SELECT  *
				FROM link_course_offering_outcome lco 
				WHERE lco.course_offering_id=$courseOffering
				AND lco.course_outcome_id=$outcome
				";	
		
		$query = $this->db->query($sql);
	    return $query;
	}
	
	function updateCharacteristic($courseOfferingId, $outcomeId, $characteristicValue, $characteristicType)
	{
			$characteristic = null;
			$lco = $this->outcome_model->getLinkCourseOfferingOutcome($courseOfferingId, $outcomeId);
			$lco_data = $lco->row();
			
			$cType =  $this->characteristics_model->getCharacteristicTypeById(intval($characteristicType));
			$cType_data = $cType->row();
			
			
			if($cType_data->value_type == "String")
			{
				$characteristic = $this->characteristics_model->getCharacteristicById(intval($characteristicValue));
				$characteristic_data = $characteristic->row();
			}
			else if($cType_data->value_type == "Boolean")
			{
				$characteristic = $this->outcome_model->getCharacteristicByNameAndTypeId($characteristicValue,intval($characteristicType));
				$characteristic_data = $characteristic->row();
			}
			
			//LinkCourseOfferingOutcomeCharacteristic characteristicLink = this.getCharacteristicLinkWithType(cType, lco,session);
			
			$characteristicLink = $this->outcome_model->getCharacteristicLinkWithType($cType_data->id, $lco_data->id);
			$characteristicLink_data = $characteristicLink->row();
			$characteristicLink_count = $characteristicLink->num_rows();
			
			
			
			$createNew = false;
			
			if ($characteristicLink_count < 1)
			{
				//$characteristicLink = new LinkCourseOfferingOutcomeCharacteristic();
				//characteristicLink.setLinkCourseOfferingOutcome(lco);
				$createNew = true;
				
				$LinkCourseOfferingOutcomeCharacteristic = array(
					'link_course_offering_outcome_id'	=> $lco_data->id,
					'Characteristic_id'	=> $characteristic_data->id,
					'created_by_userid'	=> "website",
					'created_on'	=> round(microtime(true) * 1000)
				);
				$this->db->insert('link_course_offering_outcome_characteristic', $LinkCourseOfferingOutcomeCharacteristic);			
				
			}else{
				$LinkCourseOfferingOutcomeCharacteristic = array(
					'Characteristic_id'	=> $characteristic_data->id,
					'created_by_userid'	=> "website",
					'created_on'	=> round(microtime(true) * 1000)
				);
				$this->db->where('id', $characteristicLink_data->id);
				$this->db->update('link_course_offering_outcome_characteristic', $LinkCourseOfferingOutcomeCharacteristic);	
			
			}
			return true;
		
	}
	
	function getCharacteristicLinkWithType($cType, $lcoId)
	{
			$sql = "SELECT * FROM link_course_offering_outcome_characteristic  lcooc
					INNER JOIN characteristic charac ON lcooc.characteristic_id = charac.id
					WHERE link_course_offering_outcome_id = $lcoId
					AND charac.characteristic_type_id = $cType
					";	
			$query = $this->db->query($sql);
			return $query;		
	}
	
	function saveCourseOfferingOutcomeLink($courseOfferingId, $outcomeName, $outcomeId)
	{
		
					
			if(intval($outcomeId) > 0)
			{
				$CourseOutcome = array(
				'name' => $outcomeName
				);
				$this->db->where('id', $outcomeId);
				$this->db->update('course_outcome', $CourseOutcome);	
			}
			else
			{
				$CourseOutcome = array(
				'name'	=> $outcomeName,
				'description'	=> ""
				);
				$this->db->insert('course_outcome', $CourseOutcome);	
				$outcomeId = $this->db->insert_id();
			}
			
			
			$lco = $this->outcome_model->getLinkCourseOfferingOutcome($courseOfferingId, $outcomeId);
			$lco_data = $lco->row();
			$lco_count = $lco->num_rows();
			
			if($lco_count < 1)
			{
				$sql = "SELECT  *
						FROM link_course_offering_outcome 
						WHERE course_offering_id=$courseOfferingId
						";	
				$query = $this->db->query($sql);
				$existingCount = $query->num_rows();	
				
				$LinkCourseOfferingOutcome = array(
				'course_offering_id'	=> $courseOfferingId,
				'course_outcome_id'	=> $outcomeId,
				'display_index'	=> $existingCount+1
				);
				$this->db->insert('link_course_offering_outcome', $LinkCourseOfferingOutcome);			
				
			}
			return $this->db->insert_id();
	}
		
	function saveCharacteristic($id, $outcomeId, $characteristicValue, $characteristicType, $creatorUserid, $isProgram)
	{


		/*
		Session session = HibernateUtil.getSessionFactory().getCurrentSession();
		session.beginTransaction();
		try
		{
		*/	
			//LinkCourseOfferingOutcome lco = null;
			//LinkProgramProgramOutcome lpo = null;
			$lco = '';
			$lpo = '';

			if($isProgram)
			{
				//ProgramOutcome outcome = (ProgramOutcome) session.get(ProgramOutcome.class, outcomeId);
				//Program program = (Program)session.get(Program.class,id);
				$lpo = $this->outcome_model->getLinkProgramProgramOutcome($id, $outcomeId);
				$lpo_data = $lpo->row();
					
			}
			else
			{
				//CourseOutcome outcome = (CourseOutcome) session.get(CourseOutcome.class, outcomeId);
				//CourseOffering courseOffering = (CourseOffering)session.get(CourseOffering.class,id);
				$courseOutcomeId = $this->outcome_model->getLinkCourseOfferingOutcomeById($outcomeId);
				$courseOutcomeId_data = $courseOutcomeId->row();
				$lco = $this->outcome_model->getLinkCourseOfferingOutcome($id, $courseOutcomeId_data->course_outcome_id);
				$lco_data = $lco->row();
			}
			
			
			$cType =  $this->characteristics_model->getCharacteristicTypeById(intval($characteristicType));
			$cType_data = $cType->row();
			$characteristic = null;
			
			
			if($cType_data->value_type == "String")
			{
				$characteristic = $this->characteristics_model->getCharacteristicById(intval($characteristicValue));
				$characteristic_data = $characteristic->row();
			}
			else if($cType_data->value_type == "Boolean")
			{
				$characteristic = $this->outcome_model->getCharacteristicByNameAndTypeId($characteristicValue,intval($characteristicType));
			}

			if($isProgram)
			{
				$LinkProgramProgramOutcomeCharacteristic = array(
				'characteristic_id'	=> $characteristic_data->id,
				'created_by_userid'	=> $creatorUserid,
				'created_on'	=> round(microtime(true) * 1000),
				'link_program_program_outcome_id'	=> $lpo_data->id,
				);
				$this->db->insert('link_program_program_outcome_characteristic', $LinkProgramProgramOutcomeCharacteristic);			
				/*
				LinkProgramProgramOutcomeCharacteristic characteristicLink = new LinkProgramProgramOutcomeCharacteristic();
				characteristicLink.setCharacteristic(characteristic);
				characteristicLink.setCreatedByUserid(creatorUserid);
				characteristicLink.setCreatedOn(new Date(System.currentTimeMillis()));
				characteristicLink.setLinkProgramProgramOutcome(lpo);
				session.save(characteristicLink);
				*/
			}
			else
			{
				//echo $outcomeId;
				$LinkCourseOfferingOutcomeCharacteristic = array(
				'characteristic_id'	=> $characteristic_data->id,
				'created_by_userid'	=> $creatorUserid,
				'created_on'	=> round(microtime(true) * 1000),
				'link_course_offering_outcome_id'	=> $lco_data->id,
				);
				$this->db->insert('link_course_offering_outcome_characteristic', $LinkCourseOfferingOutcomeCharacteristic);			
				/*
				LinkCourseOfferingOutcomeCharacteristic characteristicLink = new LinkCourseOfferingOutcomeCharacteristic();
				characteristicLink.setCharacteristic(characteristic);
				characteristicLink.setCreatedByUserid(creatorUserid);
				characteristicLink.setCreatedOn(new Date(System.currentTimeMillis()));
				characteristicLink.setLinkCourseOfferingOutcome(lco);
				session.save(characteristicLink);
				*/
			}
			//session.getTransaction().commit();
			return true;
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
	
	function getProgramOutcomeLinksForCourseOutcome($offeringId, $courseOutcomeId)
	{
		$sql = "SELECT * FROM link_course_outcome_program_outcome l 
				INNER JOIN course_outcome co 
					ON l.course_outcome_id = co.id 
				WHERE l.course_outcome_id = $courseOutcomeId 
					AND l.course_offering_id = $offeringId 
				ORDER BY co.name";
		$query = $this->db->query($sql);
		return $query;		
	}
	
	function deleteCourseOfferingOutcome($outcomeId, $courseOfferingId)
	{
			
			//@SuppressWarnings("unchecked")
			//List<LinkCourseOfferingOutcome> existing = (List<LinkCourseOfferingOutcome>)session.createQuery("select l from LinkCourseOfferingOutcome l where l.courseOffering.id = :offeringId order by l.displayIndex").setParameter("offeringId",courseOfferingId).list();
			
			$sql = "SELECT l.* FROM link_course_offering_outcome l 
					WHERE l.course_offering_id = $courseOfferingId 
					ORDER BY l.display_index
					";	
			$query = $this->db->query($sql);		
			$existing = $query->result();
				
			$toDelete = null;
			foreach($existing as $link)
			{
				if(!is_null($toDelete))
				{
					//$link.setDisplayIndex(link.getDisplayIndex()-1);
					//session.merge(link);
					$tempDI = $link->display_index - 1;
					$CourseOffering = array(
						'display_index' => $tempDI
						);
						$this->db->where('id', $link->id);
						$this->db->update('link_course_offering_outcome', $CourseOffering);	
				}
				if($link->course_outcome_id == $outcomeId)
				{
					$toDelete = $link->id;
				}
				
			}

			

			if(!is_null($toDelete))
			{
				
				
				//Set<LinkCourseOfferingOutcomeCharacteristic> existingCharacteristics = toDelete.getLinkCourseOfferingOutcomeCharacteristics();
				$existingCharacteristics = $this->outcome_model->getLinkCourseOfferingOutcomeCharacteristics($toDelete);
				$existingCharacteristics_data = $existingCharacteristics->result();
				
				foreach($existingCharacteristics_data as $linkToDelete)
				{
					//session.delete(linkToDelete);
					$this->db->delete('link_course_offering_outcome_characteristic', array('id' => $linkToDelete->id)); 
				}
				//List<LinkCourseOutcomeProgramOutcome> existingLinks = ProgramManager.instance().getProgramOutcomeLinksForCourseOutcome(courseOfferingId, outcomeId,session);
				$existingLinks = $this->outcome_model->getProgramOutcomeLinksForCourseOutcome($courseOfferingId, $outcomeId);
				$existingLinks_data = $existingLinks->result();
				foreach($existingLinks_data as $programLinktoDelete)
				{
					//session.delete(programLinktoDelete);
					$this->db->delete('link_course_outcome_program_outcome', array('id' => $programLinktoDelete->id)); 
				}
				//@SuppressWarnings("unchecked")
				/*
				List<LinkAssessmentCourseOutcome> existingAssessmentLinks =  (List<LinkAssessmentCourseOutcome>)session.createQuery("from LinkAssessmentCourseOutcome l where l.courseOffering.id=:courseOfferingId AND l.outcome.id=:outcomeId")
				          .setParameter("courseOfferingId",courseOfferingId)
				          .setParameter("outcomeId",outcomeId)
				          .list();
				*/
				
				$sql = "SELECT * FROM link_assessment_course_outcome l 
						WHERE l.course_offering_id=$courseOfferingId 
						AND l.course_outcome_id=$outcomeId";
						
				$query = $this->db->query($sql);		
				$existingAssessmentLinks = $query->result();		
				
				foreach($existingAssessmentLinks as $assessmentLinktoDelete)
				{
					//session.delete(assessmentLinktoDelete);
					$this->db->delete('link_assessment_course_outcome', array('id' => $assessmentLinktoDelete->id)); 
				}
			
			
				//session.refresh(toDelete);
				//session.delete(toDelete);
				$this->db->delete('link_course_offering_outcome', array('id' => $toDelete));	
				
			}

		
		$this->db->delete('course_outcome', array('id' => $outcomeId));	
			
		//	CourseOutcome toDelete = (CourseOutcome)session.get(CourseOutcome.class, outcomeId);
		//	session.delete(toDelete);
		//	session.getTransaction().commit();
			
			
			
			return true;
		
		
	}
	
	function getLinkProgramProgramOutcome($programId, $outcomeId)
	{
		$sql = "SELECT  *
				FROM link_program_program_outcome lpo WHERE lpo.program_id=$programId and lpo.program_outcome_id=$outcomeId";	
		return	$this->db->query($sql);
	}
	
	function getCharacteristicByNameAndTypeId($value, $typeId)
	{
		$sql = "SELECT c.* FROM characteristic c WHERE c.Characteristic_type_id = $typeId AND c.name = $value";	
		return	$this->db->query($sql);
	}	
	
	function getOrganizationOutcomeByName($name)
	{
		$sql = "SELECT * FROM organization_outcome WHERE name = $name";	
		return	$this->db->query($sql);
	}
	
	function updateLinkCourseOfferingOutcomeIndex($id, $displayIndex){
			$LinkCourseOfferingOutcomeDisplay = array(
				'display_index' => $displayIndex
			);
			
			$this->db->where('id', $id);
			return $updateLinkCourseOfferingOutcomeIndex = $this->db->update('link_course_offering_outcome', $LinkCourseOfferingOutcomeDisplay);	
	}
	
	function deleteLinkCourseOfferingOutcome($id){
			$delete = $this->db->delete('link_course_offering_outcome', array('id' => $id)); 
			return $delete;
	}
	
	function moveLinkCourseOfferingOutcome($id, $courseOfferingId, $direction){
		//when moving up, find the one to be moved (while keeping track of the previous one) and swap display_index values
		//when moving down, find the one to be moved, swap displayIndex values of it and the next one
		//when deleting, reduce all links following one to be deleted by 1
		$done = false;
			//AssessmentGroup group = (AssessmentGroup)session.get(AssessmentGroup.class, groupId);
			//List<Assessment> existing = this.getAssessmentsForGroup(group,session);

		$existing = $this->outcome_model->getOutcomesForCourseOffering($courseOfferingId);
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
				if($rsExisting->course_outcome_id == $id && strlen($prevId) > 0)
				{
					$tempAction = $this->outcome_model->updateLinkCourseOfferingOutcomeIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->outcome_model->updateLinkCourseOfferingOutcomeIndex($prevId, $rsExisting->display_index);
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
					$tempAction = $this->outcome_model->updateLinkCourseOfferingOutcomeIndex($rsExisting->id, $prevDisplayIndex);
					$tempAction = $this->outcome_model->updateLinkCourseOfferingOutcomeIndex($prevId, $rsExisting->display_index);
					$done = true;
					break;
				}
				if($rsExisting->course_outcome_id == $id)
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
					
					$tempAction = $this->outcome_model->updateLinkCourseOfferingOutcomeIndex($rsExisting->course_outcome_id, intval($rsExisting->display_index)-1);
				}
				
				if($rsExisting->course_outcome_id == $id)
				{
					$toDelete = $rsExisting->course_outcome_id;
				}
				
			}
			if(strlen($toDelete) > 0)
			{
					$tempAction = $this->outcome_model->deleteLinkCourseOfferingOutcome($toDelete);
					$done = true;
			}
		}
		return $done;
	}
}

