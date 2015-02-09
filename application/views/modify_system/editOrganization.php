<?php


$organizationId = intval($this->input->get("organization_id"));

//Organization o = new Organization();
$Org_count = 0;
$Org_data = array();
$editing = false;
$hasChildren = false;
$parentId = 0;



if($organizationId > 0)
{
	//o  = OrganizationManager.instance().getOrganizationById(organizationId);
	$Org = $this->organization_model->getOrganizationById($organizationId);
	$Org_data = $Org->row();
	$Org_count = $Org->num_rows();
	$orgId = $Org_data->id;
	$parentId = $Org_data->parent_organization_id;
	
	$editing = true;
	//List<Organization> children = OrganizationManager.instance().getChildOrganizationsOrderedByName(o,true);
	$children = $this->organization_model->getChildOrganizationsOrderedByName($orgId,true);
	$children_count = $children->num_rows();
	//hasChildren = children != null && !children.isEmpty();
	
	if($children_count > 0){
		$hasChildren = true;	
	}
}
//int parentId = HTMLTools.getInt(request.getParameter("parent_organization_id"));

$parentId = intval($this->input->get("parent_organization_id"));
$hasParent = false;
if($parentId > 0)
{
	$hasParent = true;
}

$rootList = $this->organization_model->getParentOrganizationsOrderedByName(true);
$rootList_data = $rootList->result();
?>

<p> A organization can have 2 different names. The system-name is used for association of courses with organizations dynamically. 
  If data is loaded from an external system, this is the alternate name that can be used to identify the organization. </p>
<form name="newCourseForm" id="newCourseForm" method="post" action="" >
  <input type="hidden" name="objectClass" id="objectClass" value="Organization"/>
  <?php
	
	if($editing)
		{
	?>
  <input type="hidden" name="objectId" id="objectId" value="<?php echo $Org_data->id;?>"/>
  <?php
			if($hasParent)
			{
	?>
  <input type="hidden" name="old_parent_id" id="old_parent_id" value="<?php echo $parentId;?>"/>
  <?php
			}
		}
	if(!$hasChildren)
	{
	?>
  <div class="formElement">
    <div class="label">Parent Organization:</div>
    <div class="field">
    
    <?php /*		
      <select name="parent_organization_id" id="parent_organization_id">
        <option value="-1">This Organization has no parent</option>
        <?php 
				foreach($rootList_data as $rsRoot){
			?>
        <option value="<?php echo $rsRoot->id;?>" <?php if(intval($rsRoot->id) == intval($parentId)){?>selected="selected"<?php }?>><?php echo $rsRoot->name;?></option>
        <!--HTMLTools.createSelect("parent_organization_id",rootList, "Id", "Name", hasParent?""+parentId:null, null) -->
        <?php
				}
			?>
      </select>
      */
	  $temprootList = array();
	  $bogus = array();
	  $bogus['id'] = -1;
	  $bogus['name'] = "This Organization has no parent";
	  array_push($temprootList,$bogus);
	  foreach($rootList_data as $tempRootList){
			$bogus = array();
			$bogus['id'] = $tempRootList->id;
			$bogus['name'] = $tempRootList->name;
			array_push($temprootList,$bogus);
	  }
	  echo ($this->common->createSelect("parent_organization_id", $temprootList, "id", "name", $hasParent?$parentId:"",""));
	  ?>
    </div>
    <div class="error" id="nameMessage"></div>
    <div class="spacer"> </div>
  </div>
  <?php } ?>
  <div class="formElement">
    <div class="label">Name:</div>
    <div class="field">
      <input type="text" size="40" maxlength="100" name="name" id="name" value="<?php if($editing){ echo $Org_data->name; }else{ echo '';}?>" />
    </div>
    <div class="error" id="nameMessage"></div>
    <div class="spacer"> </div>
  </div>
  <br/>
  <div class="formElement">
    <div class="label">System Name:</div>
    <div class="field">

      <input type="text" size="50" name="system_name" id="system_name" value="<?php if($Org_count < 1){ echo ""; }else{ echo $Org_data->system_name;}?>"/>
    </div>
    <div class="error" id="system_nameMessage"></div>
    <div class="spacer"> </div>
  </div>
  <div class="formElement">
    <div class="label">Active:</div>
    <div class="field">
      <input type="radio" name="active" id="active" <?php if($Org_count > 0){ if($Org_data->active == "Y"){?> checked="checked" <?php }}?>  value="Y"/>
      Yes<br>
      <input type="radio" name="active" id="active" <?php if($Org_count > 0){ if($Org_data->active == "N"){?> checked="checked" <?php }}?> value="N"/>
      No<br>
    </div>
    <div class="error" id="activeMessage"></div>
    <div class="spacer"> </div>
  </div>
  <br/>
  <div class="formElement">
    <div class="label">
      <input type="button" name="saveButton" id="saveButton" value="Save Organization" onclick="saveSystem(new Array('name'),new Array('name','system_name','active','parent_organization_id','old_parent_id'));" />
    </div>
    <div class="field">
      <div id="messageDiv" class="completeMessage"></div>
    </div>
    <div class="spacer"> </div>
  </div>
</form>
<?php if($editing){?>
<p>Choose a subject for which you want to add/remove the home-organization.</p>
<div id="assignCoursesDiv"> 
	<?php
		$data['organizationId'] = $organizationId; 
		$this->load->view('modify_system/existingCourseSelector', $data);
	?>
  <!--
	<jsp:include page="existingCourseSelector.jsp">
		<jsp:param name="organization_id" value="<%=organizationId%>" />
	</jsp:include>
	--> 
</div>
<?php } ?>
