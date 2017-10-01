<!DOCTYPE html>
<html>
<head>
	<title>jQuery时间控件</title>
	<script type="text/javascript" src="/flipcountdown-master/jquery.min.js"></script>
	<script type="text/javascript" src="/flipcountdown-master/jquery.flipcountdown.js"></script>
	<link rel="stylesheet" type="text/css" href="/flipcountdown-master/jquery.flipcountdown.css" />
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
</body>
</html>