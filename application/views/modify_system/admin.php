<?php 
$sysadmin = $this->common->check_if_admin($this->session->userdata('username'));
$userid = $this->session->userdata('username');
$uagent = $_SERVER['HTTP_USER_AGENT'];
$clientBrowser = $this->common->os_info($uagent);
?>
		<div id="content-and-context" style="overflow:auto;">
			<div class="wrapper" style="overflow:auto;"> 
				<div id="content" style="overflow:auto;"> 
					<div id="breadcrumbs"><p><a href="http://www.usask.ca/gmcte/">The Gwenna Moss Centre for Teaching Effectiveness</a> 
						&gt; <a href="<?php echo site_url();?>">Curriculum Alignment Tool</a> &gt; System Admin </p></div>  

					<div id="administration" class="module" style="overflow:auto;">
						<a href="javascript:toggleDisplay('organizationEditSection','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
                        	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="organizationEditSection_img">
                            	Edit/Add Organizations
                        </a>
						<div id="organizationEditSection_div" style="display:none;">
							<div id="adminOrganizationsDiv">
								<?php $this->load->view('modify_system/adminOrganization'); ?>
							</div>
						</div>
						<hr/>
						<div id="accessPermissions">
                        	<?php $this->load->view('modify_system/accessPermissions'); ?>
						</div>
						<hr/>
						<a href="javascript:toggleDisplay('characteristicSection','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
                        	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="characteristicSection_img">
                            	Manage Characteristics
                        </a>
						<div id="characteristicSection_div" style="display:none;">
							
							<div id="adminCharacteristics" class="module" style="overflow:auto;">
								<?php $this->load->view('modify_system/adminCharacteristics'); ?>
							</div>
						</div>
						<hr/>
						<a href="javascript:toggleDisplay('assessmentSection','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
                        	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="assessmentSection_img">
                            	Manage Assessment Methods
                        </a>
						<div id="assessmentSection_div" style="display:none;">
						
							<div id="assessmentMethodAdmin" class="module" style="overflow:auto;">
                                <?php $this->load->view('modify_system/assessmentMethodAdmin'); ?>
							</div>
						</div>
						<hr/>
						<a href="javascript:toggleDisplay('instructorsSection','<?php echo $clientBrowser; ?>','<?php echo base_url()?>');">
                        	<img src="<?php echo base_url();?>img/closed_folder_<?php echo $clientBrowser; ?>.gif" id="instructorsSection_img">
                            	Manage Instructors
                        </a>
						<div id="instructorsSection_div" style="display:none;">
						
							<div id="instructorAdmin" class="module" style="overflow:auto;">
								 <?php $this->load->view('modify_system/adminInstructors'); ?>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</div>