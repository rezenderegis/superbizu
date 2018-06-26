
	</div> <!-- / #content-wrapper -->
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->

<script src="jquery.transit.js"></script>

<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url('assets/javascripts/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/javascripts/pixel-admin.min.js');?>"></script>

<!-- Main Quill library -->
<!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script> -->
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet"> -->

<!-- Core build with no theme, formatting, non-essential modules -->
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet"> -->
<!-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->

<script type="text/javascript">
	init.push(function () {
		// Javascript code here
	});
	window.PixelAdmin.start(init);
</script>
<script src="<?php echo base_url('js/bysale.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('js/highcharts.js');?>"
	type="text/javascript"></script>
	<script src="<?php echo base_url('js/highstock.js');?>"
	type="text/javascript"></script>
	<script src="<?php echo base_url('js/highmaps.js');?>"
	type="text/javascript"></script>

</body>
</html>
