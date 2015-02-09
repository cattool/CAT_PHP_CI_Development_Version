<?php
$programId = intval($this->input->get("program_id"));

$program = $this->program_model->getProgramById($programId);
$program_data = $program->row();

$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$access = $sysadmin;
$orgId = 0;


//Organization org = null;
//ProgramManager pm = ProgramManager.instance();
//OutcomeManager om =  OutcomeManager.instance();
//Program program =null;
if($this->common->isValid($programId))
{
	$program =  $this->program_model->getProgramById(intval($programId));
	$program_data = $program->row();
	$orgId = $program_data->organization_id;	
	$org = $this->organization_model->getOrganizationById($orgId);
	$org_data = $org->row();	
	//@SuppressWarnings("unchecked")
	//HashMap<String,Organization>  userHasAccessToOrganizations = (HashMap<String,Organization> )session.getAttribute("userHasAccessToOrganizations");
	$userHasAccessToOrganizations = $this->permission_model->userHasAccessToOrganizations($orgId,$this->session->userdata('username'));
	$userHasAccessToOrganizations_count = $userHasAccessToOrganizations->num_rows();
	//access = sysadmin || userHasAccessToOrganizations!=null && userHasAccessToOrganizations.containsKey(""+org.getId());
	$access = $sysadmin || ($userHasAccessToOrganizations < 0);
}
else
{
	?><h1>No program parameter found!!!</h1><?php
	return;
}
$characteristicTypes = $this->organization_model->getCharacteristicTypes($orgId);
$characteristicTypes_count = $characteristicTypes->num_rows();
if($characteristicTypes_count < 0)//characteristicTypes == null  || characteristicTypes.isEmpty())
{
	?>
	<h1>No Characteristics associated with organization <b><?php echo $org->name;?></b> (yet)!  Add Characteristics first please!</h1>
	<?php
	return;
}

//List<LinkProgramProgramOutcome> outcomeLinks = pm.getLinkProgramOutcomeForProgram(program);
$outcomeLinks = $this->program_model->getLinkProgramOutcomeForProgram($programId);
$outcomeLinks_data = $outcomeLinks->result();
?>
<ul>
<?php
$prevGroup = "";
$first = true;



foreach($outcomeLinks_data as $link)
{
	//ProgramOutcome o = link.getProgramOutcome();
	$groupName = $link->pog_name;
	if(strpos($groupName,"Custom"))
	{
		$groupName = "";
	}
	else 
	{
		$groupName = $groupName . " : ";
	}
	if($groupName != $prevGroup)
	{
		if($first)
		{
			$first = false;
		}
		else
		{
			?>
				</ul>
			<?php
		}
		?>
		<li><?php echo $groupName;?></li><ul style="padding-left:15px;line-height:1.0em;">
		<?php
	}
	
	$outcomeCharacteristics = $this->outcome_model->getCharacteristicsForProgramOutcome($programId,$link->po_id, $orgId);
	$outcomeCharacteristics_data = $outcomeCharacteristics->result();
	
	$charOutput = "";//new StringBuilder();
	$charTypeIndex = 0;
	$colorIndex = 0;
	
	foreach($outcomeCharacteristics_data as $charac)
	{
		
		$cType = $this->characteristics_model->getCharacteristicTypeById($charac->Characteristic_type_id);
		$cType_data = $cType->row();
		if(strlen($cType_data->question_display) > 0)
		{
			if(strlen($cType_data->question_display) > 0)  //this should be remove
			{
				$charOutput .= $cType_data->question_display;	
			}
			$charOutput .= " ";
			$charOutput .= $charac->name;
			$charOutput .= "      ";
		}
		
	}
	$charOutputDisplay = "";
	if(strlen($charOutput > 0))
		$charOutputDisplay = " title=\"" . $charOutput . "\"";
	
	
	
	?>
	
	<li><span <?php echo $charOutputDisplay;?>><?php echo $link->po_name;?> <?php echo $this->common->addBracketsIfNotNull($link->po_description);?></span>
	 <?php if($access){
	 	if($link->pog_program_id > 0 ){?>
	 <a href="javascript:loadModify('modify_program/editProgramOutcome?program_id=<?php echo $program_data->id;?>&organization_id=<?php echo $org_data->id;?>&link_id=<?php echo $link->id;?>');">
     <img src="<?php echo base_url();?>img/edit_16.gif" style="height:10pt;" alt="Edit program outcome" title="Edit program outcome" ></a>
	 	<?php } ?>
	 <a href="javascript:removeProgramOutcome(<?php echo $program_data->id;?>,<?php echo $link->id;?>);">
     <img src="<?php echo base_url()?>img/deletes.gif" style="height:10pt;" alt="Remove program outcome" title="Remove program outcome" ></a>
	 <?php } ?>
	</li>
	<?php 
	
	$prevGroup = $groupName;
	
}

if(empty($outcomeLinks))
{
	echo "No outcomes added (yet).";
}
else
{
	?>
	</ul>
	<?php
}

if($access)
{
?>
	<li>	<a href="javascript:loadModify('<?php echo site_url();?>/modify_program/programOutcome?program_id=<?php echo $program_data->id;?>&organization_id=<?php echo $org_data->id;?>');" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add a program outcome" title="Add a program outcome"/>
				Add a program outcome
			</a>
	</li>
<?php } ?>
</ul>
