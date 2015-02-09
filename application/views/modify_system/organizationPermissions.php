<?php
$organizationId = $this->input->get("organization_id");
//Organization organization  = OrganizationManager.instance().getOrganizationById(Integer.parseInt(organizationId));
$organization  = $this->organization_model->getOrganizationById(intval($organizationId));
$organization_data = $organization->row();

?>
<h2>Access Permissions for "<?php echo $organization_data->name; ?>" granted to:</h2>
<ul>
<?php
/*
PermissionsManager manager = PermissionsManager.instance();
List<OrganizationAdmin> list = manager.getAdminsForOrganization(organizationId);
*/
$orgAdminList = $this->permission_model->getAdminsForOrganization($organizationId);
$orgAdminList_data = $orgAdminList->result();

//LdapConnection ldap = LdapConnection.instance();

//for(OrganizationAdmin organizationAdmin : list)
foreach($orgAdminList_data as $rsAdminList)
{
?>
	<li>
    	<?php echo $rsAdminList->first_name.' '.$rsAdminList->last_name; ?>
        <a href="javascript:modifyPermission(-1,<?php echo $organizationId;?>,'<?php echo $rsAdminList->type;?>',escape('<?php echo str_replace("'","\\\\'",$rsAdminList->name);?>'),'','','delete',<?php echo $rsAdminList->id;?>);">
			<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove permission" title="Remove permission"/></a>
	</li>

<?php
}?>
	
</ul>
<hr/>
<a href="javascript:loadModifyIntoDiv('modify_system/addPermission?organization_id=<?php echo $organizationId?>','membersDiv');" class="smaller">
				<img src="<?php echo base_url();?>img/add_24.gif" style="height:10pt;" alt="Add person" title="Add person"/>
				Add a Person
			</a>
<br/>
<div id="messageDiv" class="completeMessage"></div>
<hr/>
<div id="membersDiv"></div>
