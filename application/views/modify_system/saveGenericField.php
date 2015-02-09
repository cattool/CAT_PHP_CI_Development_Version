
<?php
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
$fieldName = $this->input->post("field_name");
$id = $this->input->post("id");
$newValue = $this->input->post("new_value");


if(strlen($object) <= 0)
{
	echo "ERROR: Unable to determine what to do (Object not found)";	
	return;
}

if(strlen($fieldName) <= 0)
{
	echo "ERROR: Unable to determine what to do (field not found)";	
	return;
}


if($object == "Characteristic")
{
	if($fieldName == "name")
	{
		 
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{

			if($this->characteristics_model->saveCharacteristicNameById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{

			//create a new Characteristic
			$charTypeId = $this->input->post("part_of_id");
			
			if($this->characteristics_model->saveNewCharacteristicWithNameAndType($newValue,$charTypeId))
			{
				echo "Created";
			}
			else
			{
				echo "ERROR: Creation failed";
			}
		}
	}
	else if($fieldName == "description")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->characteristics_model->saveCharacteristicDescriptionById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			
			echo "Don't know what to do. No id found";
		}
	}
	else
	{
		echo "Don't know what to do. Field not found!";
	}
}

else if($object == "CharacteristicType")
{
	if($fieldName == "name")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->characteristics_model->saveCharacteristicTypeNameById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			//create a new Characteristic
			
			if($this->characteristics_model->saveNewCharacteristicTypeName($newValue))
			{
				echo "Created";
			}
			else
			{
				echo "ERROR: Creation failed";
			}
		}
		
		
		
	}
	else if($fieldName == "question")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->characteristics_model->saveCharacteristicTypeQuestionById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			echo "ERROR: Don't have the correct values!";
		}

	}
	else if($fieldName == "shortDisplay")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->characteristics_model->saveCharacteristicTypeShortDisplayById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			echo "ERROR: Don't have the correct values!";
		}

	}
	else if($fieldName == "AnswerType")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if(trim($newValue) == "boolean")
			{
				$newValue = "Boolean";
			}
			else
			{
				$newValue = "String";
			}
			
			if($this->characteristics_model->saveCharacteristicTypeValueTypeById($newValue,$id))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
	}
	else
	{
		echo "Don't know what to do. Field not found!";
	}

}
else if($object == "Assessment")
{
	if($fieldName == "name")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined') //save existing one
		{
			if($this->course_model->saveAssessmentMethodName(intval($id), $newValue))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			//create a new Assessment Method (and add it to the group)
			$groupId = intval($this->input->post("part_of_id"));
			
			if($this->course_model->addAssessmentMethodToGroup($groupId, $newValue))
			{
				echo "Created";
			}
			else
			{
				echo "ERROR: Creation failed";
			}
		}
	}
	else if($fieldName == "description")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->course_model->saveAssessmentDescriptionById(intval($id),$newValue))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			
			echo "Don't know what to do. No id found";
		}
	}
	else
	{
		echo "Don't know what to do. Field not found!";
	}
}

else if($object == "AssessmentGroup")
{
	if($fieldName == "name")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined') //save existing one
		{
			if($this->course_model->saveAssessmentGroupName(intval($id), $newValue))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			//create a new Assessment Method Group 
			if($this->course_model->createAssessmentGroup($newValue))
			{
				echo "Created";
			}
			else
			{
				echo "ERROR: Creation failed";
			}
		}
	}
	else if($fieldName == "short_name")
	{
		if(strlen(intval($id)) > 0 && $id != 'undefined')
		{
			if($this->course_model->saveAssessmentGroupShortName(intval($id),$newValue))
			{
				echo "Value Saved";
			}
			else
			{
				echo "ERROR: Unable to save value";
			}
		}
		else
		{
			
			echo "Don't know what to do. No id found";
		}
	}
	else
	{
		echo "Don't know what to do. Field not found!";
	}
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
