<?php
$id = $this->input->get("id");
$fieldName = $this->input->get("field_name");
$object = $this->input->get("object");
$existingValue = "";
$fieldSize = 0;

if(strlen($object) > 0 && strlen($fieldName) > 0)
{
	if($object == "Characteristic")
	{
		//Characteristic characteristic = new Characteristic(); 
		if( strlen($id) > 0 && $id != 'undefined'){
			$characteristic = $this->characteristics_model->getCharacteristicById($id);
			$characteristic_data = $characteristic->row();		
		}
		if($fieldName == "name")
		{
			$existingValue = "";
			if(strlen($characteristic_data->name) > 0){
				$existingValue = $characteristic_data->name;
			}
			//existingValue = characteristic.getName()==null?"":characteristic.getName();
			//fieldSize= (Characteristic.class.getMethod("getName")).getAnnotation(Length.class).max();
			
			$fieldSize = $this->common->getFieldMaxLength('characteristic','name');//strlen($existingValue);
		}
		else if($fieldName == "description")
		{
			//fieldSize= (Characteristic.class.getMethod("getDescription")).getAnnotation(Length.class).max();
			//existingValue = characteristic.getDescription()==null?"":characteristic.getDescription();
			$existingValue = "";
			if(strlen($characteristic_data->description) > 0){
				$existingValue = $characteristic_data->description;
			}
			$fieldSize = $this->common->getFieldMaxLength('characteristic','description');//strlen($existingValue);
		}
	}
	else if($object == "CharacteristicType")
	{
		//CharacteristicType characteristicType =  new CharacteristicType();
		if(strlen($id) > 0 && $id != 'undefined'){
			//characteristicType = CharacteristicManager.instance().getCharacteristicTypeById(id);
			$characteristicType = $this->characteristics_model->getCharacteristicTypeById($id);
			$characteristicType_data = $characteristicType->row();
		}
		if($fieldName == "name")
		{
			//fieldSize= (CharacteristicType.class.getMethod("getName")).getAnnotation(Length.class).max();
			//existingValue = characteristicType.getName()==null?"":characteristicType.getName();
			$existingValue = "";
			if(strlen($characteristicType_data->name) > 0){
				$existingValue = $characteristicType_data->name;
			}
			$fieldSize = $this->common->getFieldMaxLength('characteristic_type','name');//strlen($existingValue);
		}
		else if($fieldName == "question")
		{
			//fieldSize= (CharacteristicType.class.getMethod("getQuestionDisplay")).getAnnotation(Length.class).max();
			//existingValue = characteristicType.getQuestionDisplay()==null?"":characteristicType.getQuestionDisplay();
			$existingValue = "";
			if(strlen($characteristicType_data->question_display) > 0){
				$existingValue = $characteristicType_data->question_display;
			}
			$fieldSize = $this->common->getFieldMaxLength('characteristic_type','question');//strlen($existingValue);
		}
		else if($fieldName == "shortDisplay")
		{
			//fieldSize= (CharacteristicType.class.getMethod("getShortDisplay")).getAnnotation(Length.class).max();
			//existingValue = characteristicType.getShortDisplay()==null?"":characteristicType.getShortDisplay();
			$existingValue = "";
			if(strlen($characteristicType_data->short_display) > 0){
				$existingValue = $characteristicType_data->short_display;
			}
			$fieldSize = $this->common->getFieldMaxLength('characteristic_type','short_display');//strlen($existingValue);
		}
		else if($fieldName == "AnswerType")
		{
			//fieldSize= (CharacteristicType.class.getMethod("getValueType")).getAnnotation(Length.class).max();
			//existingValue = characteristicType.getValueType()==null?"":characteristicType.getValueType();
			$existingValue = "";
			if(strlen($characteristicType_data->value_type) > 0){
				$existingValue = $characteristicType_data->value_type;
			}	
			$fieldSize = $this->common->getFieldMaxLength('characteristic_type','value_type');//strlen($existingValue);
		}
		else 
		{
			echo "Unable to find field[".$fieldName."]";
		}

	}
	else if($object == "Assessment")
	{
		//Assessment assessment = new Assessment(); 
		if( strlen($id) > 0 && $id != 'undefined'){
			
			//assessment = CourseManager.instance().getAssessmentById(Integer.parseInt(id));
			$assessment = $this->assessment_model->getAssessmentById(intval($id));
			$assessment_data = $assessment->row();
		}
		if($fieldName == "name")
		{
			//existingValue = assessment.getName()==null?"":assessment.getName();
			//fieldSize= (Assessment.class.getMethod("getName")).getAnnotation(Length.class).max();
			$existingValue = "";
			if(strlen($assessment_data->name) > 0){
				$existingValue = $assessment_data->name;
			}	
			$fieldSize = $this->common->getFieldMaxLength('assessment','name');//strlen($existingValue);
		}
		else if($fieldName == "description")
		{
			//existingValue = assessment.getDescription()==null?"":assessment.getDescription();
			//fieldSize= (Assessment.class.getMethod("getDescription")).getAnnotation(Length.class).max();
			$existingValue = "";
			if(strlen($assessment_data->description) > 0){
				$existingValue = $assessment_data->description;
			}	
			$fieldSize = $this->common->getFieldMaxLength('assessment','description');//strlen($existingValue);

		}
		else 
		{
			echo "Unable to find field[".$fieldName."]";
		}
	}
	else if($object == "AssessmentGroup")
	{
		//AssessmentGroup assessmentGroup =  new AssessmentGroup();
		if(strlen($id) > 0 && $id != 'undefined'){
			//assessmentGroup = CourseManager.instance().getAssessmentGroupById(Integer.parseInt(id));
			$assessmentGroup = $this->assessment_model->getAssessmentGroupById(intval($id));
			$assessmentGroup_data = $assessmentGroup->row();
		}
		if($fieldName == "name")
		{
			//fieldSize= (AssessmentGroup.class.getMethod("getName")).getAnnotation(Length.class).max();
			//existingValue = assessmentGroup.getName()==null?"":assessmentGroup.getName();
			$existingValue = "";
			if(strlen($assessmentGroup_data->name) > 0){
				$existingValue = $assessmentGroup_data->name;
			}	
			$fieldSize = $this->common->getFieldMaxLength('assessment_group','name');//strlen($existingValue);
		}
		else if($fieldName == "short_name")
		{
			//fieldSize= (AssessmentGroup.class.getMethod("getShortName")).getAnnotation(Length.class).max();
			//existingValue = assessmentGroup.getShortName()==null?"":assessmentGroup.getShortName();
			$existingValue = "";
			if(strlen($assessmentGroup_data->short_name) > 0){
				$existingValue = $assessmentGroup_data->short_name;
			}	
			$fieldSize = $this->common->getFieldMaxLength('assessment_group','short_name');//strlen($existingValue);

		}
		else 
		{
			echo "Unable to find field[".$fieldName."]";
		}

	}
	else 
	{
		echo "Unable to find object[".$object."]";
	}

}
//List<String> fieldsToIgnore = new ArrayList<String>();
//fieldsToIgnore.add("id");
$fieldsToIgnore = array();

/*
StringBuffer additionalFields = new StringBuffer();
StringBuffer additionalFieldsToSubmit = new StringBuffer();

@SuppressWarnings("unchecked")
Enumeration<String> e = (Enumeration<String>)request.getParameterNames();
while(e.hasMoreElements())
{
	String pName = (String)e.nextElement();
	if(!fieldsToIgnore.contains(pName))
	{
		String value = request.getParameter(pName);
		additionalFields.append("<input type=\"hidden\" name=\"");
		additionalFields.append(pName);
		additionalFields.append("\" id=\"");
		additionalFields.append(pName);
		additionalFields.append("\" value=\"");
		additionalFields.append(value);
		additionalFields.append("\"/>\n");
		additionalFieldsToSubmit.append(",'");
		additionalFieldsToSubmit.append(pName);
		additionalFieldsToSubmit.append("'");
	}
}

$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url['query'], $params);
*/

?>

<form name="genericFieldForm" id="genericFieldForm" method="post" action="" >
	
	<!--<%=additionalFields.toString()%>-->
	<?php 
	$url = parse_url($_SERVER['REQUEST_URI']);
	parse_str($url['query'], $params);
	$stringFields = '';
	foreach($params as $urlParamsKey => $urlParamsValue){
		//echo $urlParamsKey . '-' . $urlParamsValue.'<hr/>';		
		if($urlParamsKey != 'id'){
			$stringFields .= "'".$urlParamsKey."',";	
	?>	
        <input id="<?php echo $urlParamsKey;?>" type="hidden" value="<?php echo $urlParamsValue;?>" name="<?php echo $urlParamsKey;?>">
    <?php    
		}
	}
	$stringFields = substr($stringFields,0,strlen($stringFields)-1);
	?>
    
	<?php if(strlen($id) > 0 && $id != 'undefined')
		{
			?><input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
			<?php 
		}
		?>
	<div class="formElement">
		<div class="label"><?php echo $fieldName;?>:</div>
		<div class="field">
		<?php if($fieldSize > 100)
		{
			?>
			<textarea name="new_value" id="new_value" cols="40" rows="10"><?php echo $existingValue; ?></textarea>
			<?php
		}
		else
		{?>
			 <input type="text" size="60" maxlength="<?php echo $fieldSize; ?>" name="new_value" id="new_value" value="<?php echo $existingValue; ?>"/>
		<?php } ?>
		</div>
		<div class="error" id="new_valueMessage" style="padding-left:10px;"></div>
		<div class="spacer"> </div>
	</div>
	<br/>
	<div class="formElement">
		<div class="label"><input type="button" name="saveGenericFieldButton" id="saveGenericFieldButton" value="Save" onclick="saveSystemGenericField(new Array('new_value'),new Array('new_value','id'<?php echo ','.$stringFields; ?>));" /></div>
		<div class="field"><div id="messageDiv" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>
</form>

		
