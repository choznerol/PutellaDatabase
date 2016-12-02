<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PutellaDatabase - Results</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

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
        <li><a href="JobHistory.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Job History</a></li>
        <li class="active"><a href="Results.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Results</a></li>

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
            <div id="curve_chart">
                <?php
                $contig = $_GET["contig"];
                mysql_connect("localhost", "callsobing", "wannatobetop") or die("sql connect fail!");
                mysql_select_db("SNP") or die("database connect fail!");
                $sql = "SELECT * FROM `PutellaContigExpression` WHERE `Transcripts_ID`='$contig'";
                $result = mysql_query($sql) or die("insert fail");
                $row = mysql_fetch_row($result);
                $FCC22HDACXX_L4 = $row[1];
                $FCC21UVACXX_L1	= $row[2];
                $SHA1 = $row[3];
                $SHA2 = $row[4];
                $SHB1 = $row[5];
                $SHB2 = $row[6];
                $SHC1 = $row[7];
                $SHC2 = $row[8];
                $SHD1 = $row[9];
                $SHD2 = $row[10];
                $SUS14G = $row[11];
                $M_RESIST2G = $row[12];
                $SH_FCC22HDACXX_L4 = $row[13];
                $SH1_SUS2G = $row[14];
                $SHM_RESIS2G = $row[15];
                ?>
                <script type='text/javascript'>
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Condition', 'Expression Value'],
                            ['12SH-1_FCC22HDACXX_L4',  <?php echo $FCC22HDACXX_L4 ?>],
                            ['12SH-2_FCC21UVACXX_L1',  <?php echo $FCC21UVACXX_L1 ?>],
                            ['12SHA1',  <?php echo $SHA1 ?>],
                            ['12SHA2',  <?php echo $SHA2 ?>],
                            ['12SHB1',  <?php echo $SHB1 ?>],
                            ['12SHB2',  <?php echo $SHB2 ?>],
                            ['12SHC1',  <?php echo $SHC1 ?>],
                            ['12SHC2',  <?php echo $SHC2 ?>],
                            ['12SHD1',  <?php echo $SHD1 ?>],
                            ['12SHD2',  <?php echo $SHD2 ?>],
                            ['944_SUS14G',  <?php echo $SUS14G ?>],
                            ['944M_RESIST2G',  <?php echo $M_RESIST2G ?>],
                            ['SH_FCC22HDACXX_L4',  <?php echo $SH_FCC22HDACXX_L4 ?>],
                            ['SH1_SUS2G',  <?php echo $SH1_SUS2G ?>],
                            ['SHM_RESIS2G',  <?php echo $SHM_RESIS2G ?>]
                        ]);

                        var options = {
                            title: 'Expression profile of <?php echo $contig ?> across 14 conditions',
                            curveType: 'function',
                            legend: { position: 'bottom' }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <?php
            $contig = $_GET["contig"];
            mysql_connect("localhost", "callsobing", "wannatobetop") or die("sql connect fail!");
            mysql_select_db("SNP") or die("database connect fail!");
            $sql = "SELECT * FROM `PutellaAnnotation` WHERE `Transcripts_ID`='$contig'";
            $result = mysql_query($sql) or die("insert fail");
            $row = mysql_fetch_row($result);
            ?>
            <table>
                <tr>
                    <th>Transcripts_ID</th>
                    <td><?php echo $row[0] ?></td>
                </tr>
                <tr>
                    <th>China_id</th>
                    <td><?php echo $row[1] ?></td>
                </tr>
                <tr>
                    <th>China_annotation</th>
                    <td><?php echo $row[2] ?></td>
                </tr>
                <tr>
                    <th>Drosophila_id</th>
                    <td><?php echo $row[3] ?></td>
                </tr>
                <tr>
                    <th>Drosophila_annotation</th>
                    <td><?php echo $row[4] ?></td>
                </tr>
                <tr>
                    <th>Insecta_id</th>
                    <td><?php echo $row[5] ?></td>
                </tr>
                <tr>
                    <th>Insecta_annotaion</th>
                    <td><?php echo $row[6] ?></td>
                </tr>
                <tr>
                    <th>Silkworm_id</th>
                    <td><?php echo $row[7] ?></td>
                </tr>
                <tr>
                    <th>Silkworm_annotation</th>
                    <td><?php echo $row[8] ?></td>
                </tr>
                <tr>
                    <th>NR_ID</th>
                    <td><?php echo $row[9] ?></td>
                </tr>
                <tr>
                    <th>NR_annotation</th>
                    <td><?php echo $row[10] ?></td>
                </tr>
                <tr>
                    <th>EC_id</th>
                    <td><?php echo $row[11] ?></td>
                </tr>
                <tr>
                    <th>EC</th>
                    <td><?php echo $row[12] ?></td>
                </tr>
                <tr>
                    <th>Up/Down Regulate</th>
                    <td><?php echo $row[13] ?></td>
                </tr>
            </table>
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
</body>

</html>
