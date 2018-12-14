<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
		body{
			padding: 0;
			margin: 0;
		}
		#FrameID{
			width: 100%;
			height:1000px;
		}
	</style>
<iframe id="FrameID" height="100%" src="{{asset('php/graficasMensuales.php?type=bar')}}"></iframe>
</body>
</html>