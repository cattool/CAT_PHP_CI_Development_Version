<?php
//OrganizationManager dm = OrganizationManager.instance();
//Organization o = new Organization();
$organizationLoaded = false;
$id = $this->input->get("id");
if($this->common->isValid($id))
{
	$o = $this->organization_model->getOrganizationById(intval($id));
	$o_data = $o->row();
	$organizationLoaded = true;
}

$types = $this->organization_model->getOrganizationCharacteristicTypes($id);
$types_data = $types->result();
//List<Integer> alreadyUsed = new ArrayList<Integer>();
$alreadyUsed = array();
$maxDisplayIndex = 0;

foreach($types_data as $type)
{
	//alreadyUsed.add(type.getId());
	array_push($alreadyUsed,$type->id);
}


$types = $this->organization_model->getCandidateCharacteristicTypes($alreadyUsed);
$types_data  = $types->result();

foreach($types_data as $type)
{

		?><ul><h5><?php echo $type->name;?> (Associated question:<?php echo $type->question_display;?>)
        		<a href="javascript:addCharacteristicToOrganization(<?php echo $type->id;?>,<?php echo $o_data->id;?>);" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add to organization" title="Add to organization"/>
				Add to organization
			</a> </h5> 
			<?php 
			$char4Type = $this->characteristics_model->getCharacteristicsForType($type->id);
			$char4Type_data = $char4Type->result();
			foreach($char4Type_data as $c)
			{
				?>
				<li><?php echo $c->name;?>(<?php echo $c->description;?>)</li>
				<?php
			}
			?>
			</ul>
		<?php

	
}
if(empty($types))
{
	echo("No more characteristic types to add");
}
?>
		
