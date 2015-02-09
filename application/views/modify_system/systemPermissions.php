

<h3>System Administration Permissions</h3>
<ul>
<?php
//PermissionsManager manager = PermissionsManager.instance();
//List<SystemAdmin> list = manager.getSystemAdmins();
$systemAdminList = $this->permission_model->getSystemAdmins();
$systemAdminList_data = $systemAdminList->result();
//LdapConnection ldap = LdapConnection.instance();

foreach($systemAdminList_data as $rsAdminList)
{
?>
	<li><?php echo $rsAdminList->first_name.' '.$rsAdminList->last_name; ?>
    	<a href="javascript:modifyPermission(-1,-1,'<?php $rsAdminList->type; ?>',escape('<?php echo str_replace("'","\\\\'",$rsAdminList->name);?>'),'','','delete',<?php echo $rsAdminList->id; ?>);">
				<img src="<?php echo base_url();?>img/deletes.gif" style="height:10pt;" alt="Remove permission" title="Remove permission"/></a>
	</li>
<?php
}?>
	
</ul>
<hr/>
<a href="javascript:loadModifyIntoDiv('modify_system/addPermission?program_id=-1','membersDiv');" class="smaller">
				<img src="<?php echo base_url();?>/img/add_24.gif" style="height:10pt;" alt="Add person"/>
				Add a Person
			</a>
<br/>
<div id="messageDiv" class="completeMessage"></div>
<hr/>
<div id="membersDiv"></div>
