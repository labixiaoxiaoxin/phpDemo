<!DOCTYPE html>
<html>
<head>
	<title>jQuery时间控件</title>
	<script type="text/javascript" src="/flipcountdown-master/jquery.min.js"></script>
	<script type="text/javascript" src="/flipcountdown-master/jquery.flipcountdown.js"></script>
	<link rel="stylesheet" type="text/css" href="/flipcountdown-master/jquery.flipcountdown.css" />

	<link rel="stylesheet" type="text/css" href="/datetimepicker-master/jquery.datetimepicker.css"/ >
	<!-- <script src="/datetimepicker-master/jquery.js"></script> -->
	<script src="/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
</head>
<body>
	<p>flipcountdown</p>
	<span id="flipcountdown1"></span>
	<script type="text/javascript">
		jQuery(function(){
		  jQuery('#flipcountdown1').flipcountdown({
		  	size:"md"
		  	//pm:true
		  });
		})
	</script>

	<p>datetimepicker</p>
	<input type="text" id="datetimepicker" name="">
	<script type="text/javascript">
		jQuery('#datetimepicker').datetimepicker();
	</script>
</body>
</html>