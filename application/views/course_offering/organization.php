<?php
//Organization o = new Organization();
$id = $this->input->get("organization_id");
if($this->common->isValid($id))
{
	$o =$this->organization_model->getOrganizationById(intval($id));
}
else
{
	?><h2>Organization id not found!</h2><?php
	return;
}
?>
<script type="text/javascript">
$(document).ready(function() 
{
	$(".error").hide();
});
</script>

<form name="newObjectForm" id="newObjectForm" method="post" action="" >
	<!--
	<div id="organizationCharacteristicsDiv">
		<jsp:include page="organizationCharacteristics.jsp"/>
	</div>
	-->
    <div id="organizationCharacteristicsDiv">
    <?php
    	$this->load->view('course_offering/organizationCharacteristics');
	?>
	</div>
</form>

		
