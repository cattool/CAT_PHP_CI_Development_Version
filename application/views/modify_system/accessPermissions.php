<?php



$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$userid = $this->session->userdata('username');
$uagent = $_SERVER['HTTP_USER_AGENT'];
$clientBrowser = $this->common->os_info($uagent);
/*
//simplify the client browser
if(clientBrowser.indexOf("Mac")>-1)
	clientBrowser="mac";
else if (clientBrowser.indexOf("Linux")>-1)
	clientBrowser="linux";
else
	clientBrowser="windows"; %>
*/
?>
<a href="javascript:toggleDisplay('organizationPermissionsSection','<?php echo $clientBrowser;?>','<?php echo base_url()?>');">
	<img src="<?php echo base_url()?>/img/closed_folder_<?php echo $clientBrowser;?>.gif" id="organizationPermissionsSection_img">
    	Manage Organization Permissions
</a>
<div id="organizationPermissionsSection_div" style="display:none;">
					
<h2>Organization Permissions</h2>

<ul>
<?php


/*
<%
List<Organization> organizations = OrganizationManager.instance().getAllOrganizations(false);
for(Organization organization : organizations)
{
%>
	<li><span style="color:<%=organization.getActive().equals("Y")?"black":"grey"%>;"><%=organization.getName()%> <%=organization.getActive().equals("Y")?"":"(inactive)"%></span>
<a href="javascript:deleteOrganization(<%=organization.getId()%>);"><img src="/cat/images/deletes.gif" style="height:10pt;" alt="Delete permission" title="Delete permission"/></a> 
<a href="javascript:loadModifyIntoDiv('/cat/auth/modify_system/organizationPermissions.jsp?organization_id=<%=organization.getId()%>','modifyDiv');" class="smaller">
			<img src="/cat/images/edit_16.gif" style="height:10pt;" alt="Edit permissions" title="Edit permissions"/>
				Edit Permissions
			</a></li>

<%
}
%>
*/
$allOrganization = $this->organization_model->getAllOrganizations(false);
$allOrganization_data = $allOrganization->result();
foreach($allOrganization_data as $rsallOrganization){
?>	
<li><span style="color:<?php if($rsallOrganization->active == 'Y'){ echo "black";}else{ echo "grey";}?>;">
		<?php echo $rsallOrganization->name;?> <?php if($rsallOrganization->active == "Y"){echo "";}else{ echo "(inactive)";}?>
    </span>
<a href="javascript:deleteOrganization(<?php echo $rsallOrganization->id;?>);">
	<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Delete permission" title="Delete permission"/>
</a> 
<a href="javascript:loadModifyIntoDiv('modify_system/organizationPermissions?organization_id=<?php echo $rsallOrganization->id;?>','modifyDiv');" class="smaller">
<img src="<?php echo base_url();?>img/edit_16.gif" style="height:10pt;" alt="Edit permissions" title="Edit permissions"/>
    Edit Permissions
</a></li>

<?php	
}
?>
</ul>
</div>
	<div class="formElement">
		<div class="label">&nbsp;</div>
		<div class="field"><div id="message2Div" class="completeMessage"></div></div>
		<div class="spacer"> </div>
	</div>

<hr/>

<a href="javascript:toggleDisplay('systemSection','<?php echo $clientBrowser;?>','<?php echo base_url()?>');">
	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser;?>.gif" id="systemSection_img">Manage System Permissions</a>
						<div id="systemSection_div" style="display:none;">
						
<h2>System Permissions</h2>
<a href="javascript:loadModifyIntoDiv('modify_system/systemPermissions','modifyDiv');">
				<img src="<?php echo base_url();?>img/edit_16.gif" style="height:10pt;" alt="Edit System permissions" title="Edit System permissions"/>
				System Permissions
</a>
</div>
<hr/>
<a href="javascript:toggleDisplay('importSection','<?php echo $clientBrowser;?>','<?php echo base_url()?>');">
				<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser;?>.gif" id="importSection_img">Course Import</a>
						<div id="importSection_div" style="display:none;">
						
<h2>Importing Course Offerings</h2>
<a href="importCourses.jsp" target="_blank">Course Import</a>
</div>

