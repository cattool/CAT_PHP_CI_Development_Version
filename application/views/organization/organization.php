<?php
/*
<%!Logger logger = Logger.getLogger("organizations.jsp"); %> 
<%
Boolean sessionValue = (Boolean)session.getAttribute("userIsSysadmin");
boolean sysadmin = sessionValue != null && sessionValue;
//TreeMap<Organization, ArrayList<Organization>> map = OrganizationManager.instance().getOrganizationsOrderedByName();
List<Organization> list = OrganizationManager.instance().getParentOrganizationsOrderedByName(true);

*/
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$userid = $this->session->userdata('username');
$uagent = $_SERVER['HTTP_USER_AGENT'];

$organization = $this->organization_model->getParentOrganizationsOrderedByName(true);
$organization_data = $organization->result();
foreach($organization_data as $rsOrg)

{
?>	
	<div id="<?php echo 'Organization_'.$rsOrg->id;?>">
		<?php

			$this->load->view('organization/sub_organization',$rsOrg); 
		?>
	</div>
<?php 
}
echo "<hr/>";

if($sysadmin){
?>
<a href="javascript:loadModify('modify_system/editOrganization');" class="smaller">
	<img src="<?php echo base_url(); ?>img/add_24.gif" style="height:14pt;" alt="Add organization" title="Add organization"> 
    	Add an Organization
</a>

<?php
}
/*
for(Organization o : list)
{
	%>
	<div id="Organization_<%=o.getId()%>">
		<jsp:include page="organization.jsp">
			<jsp:param name="organization_id" value="<%=o.getId()%>" />
		</jsp:include>
	</div>
	<%
}
%>
<hr/>
<%

if(sysadmin) {%><a href="javascript:loadModify('/cat/auth/modify_system/organization.jsp');" class="smaller"><img src="/cat/images/add_24.gif" style="height:14pt;" alt="Add organization" title="Add organization"> Add an Organization</a><%}%>

*/



?>
