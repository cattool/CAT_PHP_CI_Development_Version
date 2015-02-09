<?php 

/*
<%
CharacteristicManager cm = CharacteristicManager.instance();
String typeId = request.getParameter("type_id");
CharacteristicType type = cm.getCharacteristicTypeById(typeId); 
%>

*/

$tempTypeId = $this->input->get("type_id");

if(strlen($tempTypeId) > 0){
	$type_id = 	$tempTypeId;
}
?>
<?php

$characteristicType = $this->characteristics_model->getCharacteristicTypeById($type_id);
$characteristicType_data = $characteristicType->row();

?>




	<?php echo $characteristicType_data->name; ?>  
			<a href="javascript:editGenericSystemField(<?php echo $characteristicType_data->id; ?>,'CharacteristicType','name','characteristic_type_<?php echo $characteristicType_data->id; ?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id; ?>');"> 
            	<img src="<?php echo base_url(); ?>img/edit_16.gif"  title="Edit characteristic type" alt="Edit characteristic type"/>
            </a>
	Short Display:<?php echo $characteristicType_data->short_display; ?>  
			<a href="javascript:editGenericSystemField(<?php echo $characteristicType_data->id; ?>,'CharacteristicType','shortDisplay','characteristic_type_<?php echo $characteristicType_data->id; ?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id; ?>');"> 
            	<img src="<?php echo base_url(); ?>img/edit_16.gif"  title="Edit characteristic type (short version)" alt="Edit characteristic type (short version)"/></a>
	Question: <?php echo $characteristicType_data->question_display; ?> 
			<a href="javascript:editGenericSystemField(<?php echo $characteristicType_data->id; ?>,'CharacteristicType','question','characteristic_type_<?php echo $characteristicType_data->id; ?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id;?>');">
            	<img src="<?php echo base_url(); ?>img/edit_16.gif"  title="Edit question" alt="Edit question"/>
            </a>
				 	
	<a href="javascript:editCharacteristic(<?php echo $characteristicType_data->id; ?>,<?php echo $characteristicType_data->id; ?>,'deleteType','characteristic_type_<?php echo $characteristicType_data->id;?>');">
    			<img src="<?php echo base_url(); ?>img/deletes.gif" title="Delete Characteristic type" alt="Delete characteristic type" title="Delete characteristic type"/>
            </a>
		<?php 
		if ($characteristicType_data->value_type == "NOT SET")
		{ ?>
			<br/>
			<a href="javascript:editGenericSystemField(<?php echo $characteristicType_data->id; ?>,'CharacteristicType','AnswerType','characteristic_type_<?php echo $characteristicType_data->id; ?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id; ?>');" class="smaller">
				 Set answer Type
		    </a>
		    "boolean" for <b>yes or no</b> questions, "text" for all others
			<?php
			}
			else
			{
			?>			
					
					
		<ul>
			<?php
			
			$characteristic = $this->characteristics_model->getCharacteristicsForType($characteristicType_data->id);
			$characteristic_data = $characteristic->result();
			$characteristic_count = $characteristic->num_rows();
			$ictr = 0;
			foreach($characteristic_data as $rsChar)
			{
				
			
			/*
			List<Characteristic> characteristics = cm.getCharacteristicsForType(type);
			for(int i = 0 ; i < characteristics.size() ; i++ )
			{
				Characteristic ch = characteristics.get(i);%>
			*/	
			?>	
				<li><span title="<?php echo $rsChar->description;?>"><?php echo $rsChar->name;?></span> 
                <a href="javascript:editGenericSystemField(<?php echo $rsChar->id;?>,'Characteristic','name','characteristic_type_<?php echo $characteristicType_data->id;?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id;?>');">
                	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit characteristic value" alt="Edit characteristic value"/>
              	</a>
				<?php
				if($ictr > 0)
				{
				?>
					<a href="javascript:editCharacteristic(<?php echo $rsChar->id;?>,<?php echo $characteristicType_data->id;?>,'up','#characteristic_type_<?php echo $characteristicType_data->id;?>');">
                    	<img src="<?php echo base_url();?>img/up2.gif"  alt="move up" title="move up"/></a>
                <?php
				}
				if($ictr < $characteristic_count - 1)
				{ ?>
					<a href="javascript:editCharacteristic(<?php echo $rsChar->id;?>,<?php echo $characteristicType_data->id;?>,'down','#characteristic_type_<?php echo $characteristicType_data->id;?>');">
                    	<img src="<?php echo base_url();?>img/down2.gif"  alt="move down" title="move down"/></a>
                <?php 
				} 
				?>
					 <a href="javascript:editGenericSystemField(<?php echo $rsChar->id;?>,'Characteristic','description','characteristic_type_<?php echo $characteristicType_data->id;?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id;?>');" class="smaller">
                     	<img src="<?php echo base_url();?>img/edit_16.gif"  title="Edit Description" alt="Edit Description"/>Edit description
                     </a>
				
					<a href="javascript:editCharacteristic(<?php echo $rsChar->id;?>,<?php echo $characteristicType_data->id;?>,'delete','#characteristic_type_<?php echo $characteristicType_data->id;?>');">
                    	<img src="<?php echo base_url();?>/img/deletes.gif"  alt="Delete characteristic" title="Delete characteristic"/>
                    </a>
					
				</li>
            <?php
			$ictr++;
			}
				
				if($characteristicType_data->value_type != "Boolean")
				{?>
					<li>
						<a href="javascript:editGenericSystemField('','Characteristic','name','characteristic_type_<?php echo $characteristicType_data->id;?>','modify_system/characteristicTypeEdit?type_id=<?php echo $characteristicType_data->id;?>','part_of_id=<?php echo $characteristicType_data->id;?>');" class="smaller">
							<img src="<?php echo base_url();?>img/add_24.gif"  height="10px;" title="Add Characteristic" alt="Add option" title="Add option"/> 
							Add option
						</a>
					</li>
				<?php 
				}	
				echo "</ul>";
				
			

		}
			
		
?>	
	


		
