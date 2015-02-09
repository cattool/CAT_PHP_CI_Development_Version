<?php
class Common {
	
	  private $CI;
	
	 function check_if_admin($username)
		{
			$CI =& get_instance();
			$query = $CI->login_model->check_if_admin($username);
			$sessionValue = $query->num_rows();
			
			$sysadmin = false;
			if($sessionValue != 0){
				$sysadmin = true;	
			}
			return $sysadmin;
		}	

	 function os_info($uagent)
		{
			if(strpos($uagent,"Windows") > 0){
				$os = "windows";
			}elseif(strpos($uagent,"Linux") > 0){
				$os = "linux";
			}else{
				$os = "mac";
			}
			
			return $os;
		}
		
	function getFieldMaxLength($tablename, $fieldName){
		$CI =& get_instance();
		$fields = $CI->db->field_data($tablename);
		$fieldMax = "";
		foreach ($fields as $field)
		{
			if($field->name == $fieldName){
				$fieldMax = $field->max_length;
			}
		} 	
		return $fieldMax;
	}
	
	function isValid($id)
	{
		if(empty($id)){
			return false;
		}
		$id = trim($id);
		if(strlen($id) < 1){
			return false;
		}
		if(is_null($id) || $id == "undefined"){
			return false;
		}
		return true;
	}
	
	function removeSession($array){
		
	}	
	
	function addBracketsIfNotNull($string){
		if(strlen($string) < 1)
		{
			return "";
		}
		return "(".s.")";	
	}
	
	function createSelect($name, $List, $valueList, $textList, $selectedValue, $onchange)
	{
		$s = '';
		$s .= "<select name=\"";
		$s .= $name;
		$s .= "\" id=\"";
		$s .= $name;
		$s .= "\" ";
		if(!is_null($onchange))
		{
			$s .= " onchange=\"";
			$s .= $onchange;
			$s .= "\" ";
		}
		$s .= " >";
		
		
		
		for($i = 0; $i< count($List); $i++)
		{
			$value = $List[$i][$valueList];
			$text = $List[$i][$textList];
		
			$s .= "<option value=\"";
			$s .= $value;
			$s .= "\" ";
			
			if((!is_null($selectedValue) && $selectedValue == $value) || (is_null($selectedValue)  && $i==0))
			{
				$s .= "selected=\"selected\"";
			}
			$s .= ">";
			$s .= $text;
			$s .= "</option>\n";
		}
		$s .= "</select>";
		return $s;
	}
	
	function createSelectOrganizationOutcomes($name, $list, $selectedValue)
	{
		
		$s = '';
		$s .= "<select multiple=\"multiple\" size=\"10\" name=\"";
		$s .= $name;
		$s .= "\" id=\"";
		$s .= $name;
		$s .= "\">";
		
		$prevGroup = 0;
		foreach($list as $o)
		{
			if($o->oog_id != $prevGroup)
			{
				if($prevGroup > 0) //not the first one
				{
					$s .= "</optgroup>\n";
				}
				
				$s .= "<optgroup label=\"";
				$s .= $o->oog_name;
				$s .= "\">\n";
			}
				$s .= "\t<option value=\"";
				$s .= $o->oo_id;
			$s .= "\" ";
			if(!is_null($selectedValue) && ($selectedValue === $o->oo_id) || (is_null($selectedValue)  && $prevGroup == 0))
			{
				$s .= "selected=\"SELECTED\"";
			}
			$s .= ">";
			$s .= $o->oo_name;
			$s .= "</option>\n";
			$prevGroup = $o->oog_id;
		}
		$s .= "</optgroup>\n";
		
		$s .= "</select>";
		return $s;
	}
	
	function createSelectProgramOutcomes($name, $list, $selectedValue)
	{
		
		//StringBuilder s = new StringBuilder();
		$s = '';
		$s .= "<select multiple=\"multiple\" size=\"10\" name=\"";
		$s .= $name;
		$s .= "\" id=\"";
		$s .= $name;
		$s .= "\">";
		
		$prevGroup = 0;
		foreach($list as $o)
		{
			if($o->program_outcome_group_id != $prevGroup)
			{
				if($prevGroup > 0) //not the first one
				{
					$s .= "</optgroup>\n";
				}
				
				$s .= "<optgroup label=\"";
				$s .= $o->outcome_group_name;
				$s .= "\">\n";
			}
				$s .= "\t<option value=\"";
				$s .= $o->id;
			$s .= "\" ";
			if((!is_null($selectedValue) && $selectedValue == $o->id) || (is_null($selectedValue)  && $prevGroup == 0))
			{
				$s .= "selected=\"SELECTED\"";
			}
			$s .= ">";
			$s .= $o->name;
			$s .= "</option>\n";
			$prevGroup = $o->program_outcome_group_id;
		}
		$s .= "</optgroup>\n";
		
		$s .= "</select>";
		return $s;
	}
}
?>