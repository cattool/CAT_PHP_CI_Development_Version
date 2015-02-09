<?php
/*
<%
CharacteristicManager cm = CharacteristicManager.instance();
List<CharacteristicType> allTypes = cm.getAllCharacteristicTypes();
%>
*/
?>
<h2>Available characteristics:</h2>
<ul>

<?php
/*
<%

for(CharacteristicType type : allTypes)
{
	%>
	
	<li><div id="characteristic_type_<%=type.getId()%>" >
		<jsp:include page="characteristicTypeEdit.jsp" >
			<jsp:param value="<%=type.getId()%>" name="type_id"/>
		</jsp:include>
		</div>
	</li>

	<%
}%>

*/
$charType = $this->characteristics_model->getAllCharacteristicTypes();
$charType_data = $charType->result();
foreach($charType_data as $rscharType)
{
?>
	<li><div id="characteristic_type_<?php echo $rscharType->id;?>" >
		<?php 								  
			$data['type_id'] = $rscharType->id;
			$this->load->view('modify_system/characteristicTypeEdit', $data);
			//echo $rscharType->id;
		/*
        <jsp:include page="characteristicTypeEdit.jsp" >
			<!--<jsp:param value="<%=type.getId()%>" name="type_id"/>-->
		</jsp:include>
		*/
		?>
		</div>
	</li>
<?php } ?>

    <li>
        <a href="javascript:editGenericSystemField('','CharacteristicType','name','adminCharacteristics','modify_system/adminCharacteristics');">
            Create new characteristic
        </a>
    </li>
</ul>

		
