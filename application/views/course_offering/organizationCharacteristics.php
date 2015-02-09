<?php
//OrganizationManager dm = OrganizationManager.instance();
//Organization o = new Organization();
$id = $this->input->get("organization_id");

if(!is_null($id) && strlen(trim($id) > 0))
{
	$o = $this->organization_model->getOrganizationById(intval($id));
	$o_data = $o->row();
	
	
}

?>

	<h4>Setting up Characteristics for <?php echo $o_data->name;?></h4>
	<hr/>
	<input type="hidden" name="objectClass" id="objectClass" value="ProgramCharacteristic"/>
	<div id="characteristicsList">
	<?php
	
	$types = $this->organization_model->getOrganizationCharacteristicTypes($o_data->id);
	$types_count  = $types->num_rows();
	$types_data = $types->result();
	
	/*for($i = 0 ; $i < $types_count ; $i++ )
	{
	*/
	$i = 0;
	foreach($types_data as $cType)
	{	
		if($i==0)
		{
			?><h3>Main characteristic:</h3> <?php
		}
		else if($i==1)
		{
			?><h3>Additional characteristics:</h3> <?php
		}
		//CharacteristicType cType = types.get(i);
		?><ul><h5><?php echo $cType->name;?> (Associated question:<?php echo $cType->question_display;?>)
		<?php if($i>0)
		{?>
			<a href="javascript:moveCharacteristicType(<?php echo $o_data->id;?>,<?php echo $cType->id;?>,'up');">
				<img src="<?php echo base_url();?>img/up2.gif"  alt="Move Up"/>
			</a>
		<?php }
		if($i < $types_count-1)
		{?>
			<a href="javascript:moveCharacteristicType(<?php echo $o_data->id;?>,<?php echo $cType->id;?>,'down');">
				<img src="<?php echo base_url();?>img/down2.gif"  alt="Move Down"/>
			</a>
		<?php }
		?>
		<a href="javascript:moveCharacteristicType(<?php echo $o_data->id;?>,<?php echo $cType->id;?>,'delete');">
				<img src="<?php echo base_url();?>/img/del.gif"  alt="Move Up"/>
			</a>
		</h5> 
			<?php
			$charType = $this->characteristics_model->getCharacteristicsForType($cType->id);
			$charType_data = $charType->result();
			foreach($charType_data as $c)
			{
				?>
				<li><?php echo $c->name;?> <?php echo (!is_null($c->description) && strlen($c->description)>0)?"(".$c->description.")":""?></li>
				<?php
			}
			?>
			</ul>
			<hr/>
		<?php
		$i++;
	}
	?>
	<a href="javascript:loadModify('course_offering/addOrganizationCharacteristic?id=<?php echo $o_data->id;?>','addCharacteristicToOrganizationDiv','organizationCharacteristicsDiv');" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add a characteristic" title="Add a characteristic" />
				Add a Characteristic
			</a>
			<div id="addCharacteristicToOrganizationDiv">
			</div>
	</div>

		
