<!-- TODO: 以email搜尋db，列出之前成功的job（以/result?=<job id>） -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PutellaDatabase - Job History</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><span>PUTELLA</span>DATABASE</a>

		</div>

	</div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<form role="search">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		</div>
	</form>
	<ul class="nav menu">
		<li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Introduction </a></li>
		<li><a href="SubmitJob.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Submit Jobs</a></li>
		<li class="active"><a href="JobHistory.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Job History</a></li>
		<li><a href="Results.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Results</a></li>

	</ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<div class="row">
		<div class="col-lg-12">
			<!--				<h1 class="page-header">Forms</h1>-->
			<font color="#f5f5f5">.</font>
		</div>
	</div><!--/.row-->


	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Find previous submitted job(s).</div>
				<div class="panel-body">
					<div class="col-md-6">
						<form action="JobHistory.php" method="get">

							<div class="form-group">
								<label>Your E-mail address:</label>
								<input name="user_token" class="form-control" placeholder="type-in your email address here....">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-default">Reset</button>

						</form>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

	<?php
	$connection = mysqli_connect("localhost", "callsobing", "wannatobetop", "varclust") or
	die("
		<div class=\"alert bg-danger\" role=\"alert\"><svg class=\"glyph stroked cancel\">
        <use xlink:href=\"#stroked-cancel\"></use></svg>Oops, Something went wrong. Seems like we have problem connecting to our database..</div>
        <meta http-equiv=\"refresh\" content=\"5;url=JobHistory.php\">
	");
	$user_token = array();
	$user_token = $_GET["user_token"];
	$sql = "SELECT * FROM `putella_jobs` WHERE `email`='$user_token'";
	$result = array();
	$result = mysqli_query($connection, $sql) or
	die ("
        <div class=\"alert bg-danger\" role=\"alert\"><svg class=\"glyph stroked cancel\">
        <use xlink:href=\"#stroked-cancel\"></use></svg>No job submitted for user @</div><img src=\"img/sorry.jpg\">
        <meta http-equiv=\"refresh\" content=\"5;url=JobHistory.php\">
    ");


	?>


	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Job History</div>
				<div class="panel-body">
<table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
						<tr>
							<th data-sortable="true">Job ID</th>
							<th data-sortable="true">Submit Data</th>
							<th data-sortable="true">Status</th>
							<th data-sortable="true">Result</th>
						</tr>
</thead>
						<?php
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>";
							echo "<td>" . $row['jobid'] . "</td>";
							echo "<td>" . $row['time'] . "</td>";
							echo "<td>";
							$line_count = Array();	
							$jobid=$row['jobid'];
							exec("cat var/$jobid.output | wc -l", $line_count);
							if ($line_count[0] == 0){
								echo "No result";
								break;
							} else {
								echo $line_count[0] . " result(s)";
							}
							echo "</td>";
							echo "<td>". 
								"<a href=http://140.112.94.72/~lc1024/PutellaDatabase/Results.php?jobid=".$row['jobid'].">view</a>"
							. "</td>";
							echo "</tr>";
						}
						?>
						
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div><!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap-table.js"></script>
<script>
	!function ($) {
		$(document).on("click","ul.nav li.parent > a > span.icon", function(){
			$(this).find('em:first').toggleClass("glyphicon-minus");
		});
		$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
	}(window.jQuery);

	$(window).on('resize', function () {
		if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
		if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})
</script>
</body>

</html>
