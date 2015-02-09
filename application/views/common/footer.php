<?php 
$bIncludeBody = true;

if(isset($noBody)){
	$bIncludeBody = false;	
}

if($bIncludeBody)
{
?>
		<div id="footer">
				<div class="wrapper">
				<div id="footer-uofs">
					<a href="http://www.usask.ca/" title="University of Saskatchewan">
					<img alt="University of Saskatchewan" src="<?php echo base_url(); ?>img/uofs-logo-grey.png"/></a>
					<p></p>
				</div>
				<ul id="footer-nav">
					<li><a href="http://www.usask.ca/samplesite/site-map.php" title="Site Map">Site Map</a></li>
					<li><a href="http://www.usask.ca/disclaimer.php">Disclaimer</a></li>
					<li><a href="http://www.usask.ca/privacy.php">Privacy</a></li>
				</ul>
				<p id="copyright">© University of Saskatchewan</p>
			</div>
		</div>
		<div id="loginCheckDiv">
			<!---<iframe style="width:1px;height:1px" src="/cat/auth/loginCheck.jsp"></iframe>-->
		</div>
	</body>
</html>
<?php
}
?>