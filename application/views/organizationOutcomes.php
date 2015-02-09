<?php
$organizationId = intval($this->input->get("organization_id"));
if(isset($organization_id)){
	$organizationId = $organization_id;
}



$sessionValue = $this->common->check_if_admin($this->session->userdata('username'));
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));

$access = $sysadmin;



//OrganizationManager om = OrganizationManager.instance();

$organization = $this->organization_model->getOrganizationById($organizationId);
$organization_data = $organization->row();
$links = $this->organization_model->getLinkOrganizationOrganizationOutcomeForOrg($organization_data->id);
$links_data = $links->result();
$links_count = $links->num_rows();


?>
<h5>Organization Outcomes</h5>
<ul>
<?php


$prevGroup = "";
$first = true;

foreach($links_data as $link)
{
	//OrganizationOutcome o = link.getOrganizationOutcome();
	$groupName = $link->oog_name;//o.getGroup().getName();
	if(!($groupName==$prevGroup))
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
		<li><strong><?php echo $groupName;?></strong></li><ul style="padding-left:15px;line-height:1.0em;">
		<?php
	}
	?>
	
	<li><?php echo $link->oo_name;?> <?php $this->common->addBracketsIfNotNull($link->oo_description);?>
	 <?php if($access){?>
     	<a href="javascript:removeOrganizationOutcome(<?php echo $organization_data->id;?>,<?php echo $link->looo_id;?>);">
        	<img src="<?php echo base_url()?>img/deletes.gif" style="height:10pt;" alt="Remove organization outcome" title="Remove organization outcome" >
        </a><?php } ?>
	</li>
	<?php 
	$prevGroup = $groupName;
}


if(strlen($links_count) < 0)
{
	?>
	</ul>
	<?php
}
else
{
	echo "No outcomes added (yet).";
}
if($access)
{
?>
	<li>	<a href="javascript:loadModify('modify_program/organizationOutcome?organization_id=<?php echo $organization_data->id;?>');" class="smaller">
				<img src="<?php echo base_url()?>img/add_24.gif" style="height:10pt;" alt="Add outcome" title="Add outcome"/>
				Add an outcome
			</a>
	</li>
<?php } ?>
</ul>
