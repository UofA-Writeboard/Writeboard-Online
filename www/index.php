<html>
	<head>
		<title>Writeboard</title>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<style type="text/css">
			body {
				margin: 0;
				background: url("/img/bg.jpg") repeat;
				display: flex;
				align-items: center;
				flex-direction: column;
			}
			
			#banner {
				width: 60%;
				max-height: 60%;
				object-fit: contain;
				margin-bottom: 5vh;
				margin-top: -5vh;
			}
			
			.flex-padding {
				width: 100%;
				flex-basis: 0px;
				flex-grow: 2;
			}
			
			.field {
				box-sizing: border-box;
				min-width: 25%;
				min-height: 40.5px;
				flex-basis: 40.5px;
				background: #ffffff;
				border: 1px solid #efefef;
				margin: 10px 0;
				box-shadow: black 0px 5px 16px -7px;
				font-family: 'Raleway', sans-serif;
			}
			
			.button {
				padding: 10px 20px;
				text-align: center;
				cursor: pointer;
				transition: background 0.07s, border 0.07s, box-shadow 0.07s;
				box-shadow: black 0px 6px 18px -8px;
				font-size: 16px;
			}
			
			.button:hover {
				background: #fbfbfb;
				border: 1px solid #e8e8e8;
				box-shadow: black 0px 5px 16px -7px;
			}
			
			.button:active {
				background: #f8f8f8;
				border: 1px solid #e0e0e0;
				box-shadow: black 0px 4px 14px -6px;
			}
			
			a {
				text-decoration: inherit;
				color: inherit;
			}
			
			.noselect {
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			
			.invisiform {
				width: 100%;
				display: flex;
				flex-direction: column;
				align-items: center;
				margin: 10px 0;
			}
			
			.field.text {
				display: flex;
				flex-direction: row;
				align-items: stretch;
				padding: 0;
			}
			
			.field.text span {
				flex-basis: 60px;
				background: #f8f8f8;
				border-right: 1px solid #ccc;
				text-align: right;
				line-height: 40.5px;
				padding: 0 8px;
				font-weight: bold;
			}
			
			.field.text input {
				flex-grow: 2;
				border: none;
				padding: 10px;
				font-family: inherit;
				line-height: 40.5px;
			}
		</style>
	</head>
	<body>
		<div class="flex-padding"></div>
		<img id="banner" class="noselect" src="/img/logo_ds_300.png" />
		<form class="invisiform" enctype="multipart/form-data" method="POST" action="/svg.php">
			<input class="field button" name="userfile" type="file" />
			<input class="field button" type="submit" value="Plot SVG" />
		</form>
		<form class="invisiform" method="POST" action="/math.php">
			<div class="field text">
				<span>y(x)=</span>
				<input name="math" type="text" value="e^x+0.333*sin(30*x)" />
			</div>
			<div class="field text">
				<span>min. x</span>
				<input name="xmin" type="text" value="-1.5" />
			</div>
			<div class="field text">
				<span>max. x</span>
				<input name="xmax" type="text" value="1.5" />
			</div>
			<input class="field button" type="submit" value="Plot Graph" />
		</form>
		<!--
		<form class="invisiform" method="POST" action="/park.php">
			<input class="field button" type="submit" value="Park Plotter" />
		</form>
		-->
		<div class="flex-padding"></div>
	</body>
</html>
