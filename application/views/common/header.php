<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

?>  



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php /*
<%@ page import="java.util.*,java.net.*,ca.usask.gmcte.*,ca.usask.ocd.ldap.*,ca.usask.gmcte.util.*,ca.usask.gmcte.currimap.action.*,ca.usask.gmcte.currimap.model.*"%> 
<%
StringBuilder parameters = new StringBuilder();
Enumeration e = request.getParameterNames();
while(e.hasMoreElements())
{
	String pName = (String)e.nextElement();
	if(pName.equals("ticket")) //don't include possible invalid tickets
		continue;
	
	if(parameters.length()==0)
	{
		parameters.append("?");
	}
	else
	{
		parameters.append("&");
	}
	
	String value = request.getParameter(pName);
	parameters.append(pName);
	parameters.append("=");
	parameters.append(value);
}
int programIdParameter = HTMLTools.getInt(request.getParameter("program_id"));
if(programIdParameter > -1)
{
	session.setAttribute("programId",""+programIdParameter);
}
*/

$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$userid = $this->session->userdata('username');
$uagent = $_SERVER['HTTP_USER_AGENT'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>Curriculum Alignment Tool</title>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/> 
		<meta content="IE=9" http-equiv="X-UA-Compatible"/>
        <meta content="IE=8" http-equiv="X-UA-Compatible"/>
 
 
 
    	<link href="http://www.usask.ca/favicon.ico" rel="apple-touch-icon"/>
    	<link href="http://www.usask.ca/favicon.ico" rel="shortcut icon"/>
    	<link href="<?php echo base_url(); ?>css/default.css" media="screen" rel="stylesheet" type="text/css"/>
 	   	<link href="<?php echo base_url(); ?>css/print.css" media="print" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>css/standard.css" rel="stylesheet" type="text/css"/>
		<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js" type="text/javascript"></script>
	
		<script  type="text/javascript">
		var clientBrowser = '<?php $this->common->os_info($uagent);?>';
		$(document).ready(function() {
			  // Handler for .ready() called.
	
 //deactivate menu items if something other
	//than a menu item is clicked
	$("html").click(function()
	{
/*		$(".drop-down-menu").each(function()
       {
			$(this).removeClass('active');
			$(this).find(".submenu").hide();
       });*/
	});


	//do not deactivate menus if the user
	//clicks on the menu itself
	$('#main-menu').click(function(event)
	{
		event.stopPropagation();
	});



	//on click deactivate all menus and activate
	//the one clicked on unless its alread active then
	//deactivate it
   $(".drop-down-menu").click(function()
   {
		var clicked = $(this);
		//reset all menus to default status except the clicked one
       $(".drop-down-menu").each(function()
       {
			var current = $(this);

			//check to ensure that the current menu is not the clicked menu
			if (clicked.length !== current.length || clicked.length !==
clicked.filter(current).length)
			{
				$(this).removeClass('active');
				$(this).find(".submenu").hide();
			}
       });

    	//if the clicked menu is active then deactivate it otherwise activate it
		if ($(this).hasClass('active'))
		{
			$(this).removeClass("active");
			$(this).find(".submenu").hide();
		}
		else
		{
			$(this).addClass("active");
			$(this).find(".submenu").show();
		}
	});
		});
	</script>
		
		
		<script src="<?php echo base_url(); ?>js/b1global_lib.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/b1system_lib.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/b1program_lib.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/offering_lib.js" type="text/javascript"></script>
		
	</head>
<?php 
$bIncludeBody = true;

if(isset($noBody)){
	$bIncludeBody = false;	
}

if($bIncludeBody)
{
?>    
    
	<body>
		<div id="header">
			<div class="wrapper">
				<p id="uofs">
					<a href="http://www.usask.ca/" title="University of Saskatchewan">
						<img alt="University of Saskatchewan" src="<?php echo base_url(); ?>img/uofs-logo.png"/>
					</a>
				</p>
				<ul id="secondary-nav">
					<li class="paws-login"><a href="http://paws.usask.ca/">PAWS</a></li>
				</ul>
				<div id="search-options">
					<form action="http://www.usask.ca/search/" id="cse-search-box"><fieldset><legend class="hidden">Search</legend>
						<label class="hidden" for="q">Search:</label>
						<input class="search-box" id="q" name="q" size="20" type="text"/>
						<button class="submit" type="submit">Search</button></fieldset>
					</form>
				</div>
				<h1 id="site-name"><a href="index.jsp">Curriculum Alignment Tool</a></h1> 
				<div style="float:right;position:relative;top:-40px;left:-5px;" id="loginStatus">
                	<?php $this->load->view('common/login');?>
                    <!--<jsp:param name="url" value="<%=request.getRequestURI() + parameters.toString()%>"/></jsp:include>-->
                </div>
			</div>
		</div>
		<div id="global-nav">
		  	<div class="wrapper">
		  		<ul >
		  			<li><a href="<?php echo site_url(); ?>/my_courses">My Courses</a></li>
                    <?php 
					$organization = $this->permission_model->getOrganizationsForUser($userid, $sysadmin, true);
					
					$org_count = $organization->num_rows();
					
					if($org_count >= 0){
						$data_organization = $organization->result();
					?>
                    	<li class="drop-down-menu"><a href="#">Characteristics Admin</a>
		  					<ul style="display: none;" class="submenu">
                            <?php foreach($data_organization as $rsOrg){ ?>
		  					
		  						<li>
                                	<a href="javascript:loadModify('course_offering/organization?organization_id=<?php echo $rsOrg->id;?>');">
                                		<?php echo $rsOrg->name; ?>
                                    </a>
                                </li>
                             <?php }?>    
		  					</ul>
		  				</li>
                    <?php	
					}
					//print_r($organization);
					/*
		  			<%if(organizations!=null && !organizations.isEmpty()){ 
		  				%>
		  				<li class="drop-down-menu"><a href="#">Characteristics Admin</a>
		  					<ul style="display: none;" class="submenu">
		  					<%
		  					for(Organization organization:organizations){%>
		  						<li><a href="javascript:loadModify('/cat/auth/courseOffering/organization.jsp?organization_id=<%=organization.getId()%>');"><%=organization.getName()%></a></li> 
		  					<%}
		  					%>
		  					</ul>
		  				</li>
		  				<%}%>
					*/?>	
		  			<li><a href="<?php echo site_url(); ?>/program_admin">Program Admin</a></li>
		  			<?php if($sysadmin){?>
		  			<li><a href="<?php echo site_url(); ?>/modify_system">System Admin</a></li>
		  			<?php }?>
		  			
		  			
				</ul>
			</div>
		</div>
		<div  class="headerBar" id="closeLinkDiv"><a href="javascript:closeEdit();" id="closeLink" >Close <img src="<?php echo base_url(); ?>img/closer.png" style="padding-right:5px;padding-top:5px;"/></a></div>
		
		<div class="editFloat" id="outerEditDiv">
			
			<div id="editDiv" >
			
			</div>
			<!-- <div  class="footerBar"><a href="javascript:closeEdit();" id="closeLink2" >Close <img src="/cat/images/closer.png" style="padding-right:5px;padding-bottom:0px;"/></a></div> -->
		
		</div>
		<div class="disableEverything" id="disableDiv"></div>
<?php 
}
?>		
	
                