<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Panels</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

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

<body>
<?php
//3. php obtain value
$email = $_POST["email"];
$text = $_POST["text"];
$query = $_POST["sequence"];
$job_id = "Plutella_" . md5(uniqid(rand()));
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>plutella</span>database</a>
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
        <li class="active"><a href="SubmitJob.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Submit Jobs</a></li>
        <li><a href="JobHistory.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Job History</a></li>
        <li><a href="Results.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Results</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Keyword search result for <b><?php echo $query ?></b></h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">

            <?php
            //1.   Connect to server and select database.
            $link = mysql_connect("localhost", "callsobing", "wannatobetop") or
            die("
                <div class=\"alert bg-danger\" role=\"alert\"><svg class=\"glyph stroked cancel\">
                <use xlink:href=\"#stroked-cancel\"></use></svg>Oooops, Something went wrong. Seems like we are facing some technical issues during connecting to database....</div><img src=\"img/sorry.jpg\">
                <meta http-equiv=\"refresh\" content=\"5;url=submit.html\">
            ");

            //4. one by one search for query
            //search entire DB table SELECT * From `DB_table` WHERE * like '%$text%'
            mysql_select_db("SNP") or die("database connect fail!");
            $sql_text="SELECT * FROM `PutellaAnnotation` WHERE `Transcripts_ID` like '%{$query}%' OR `China_id` like '%{$query}%' OR `China_annotation` like '%{$query}%'  OR `Drosophila_id` like '%{$query}%' OR `Drosophila_annotation` like '%{$query}%' OR `Insecta_id` like '%{$query}%' OR `Insecta_annotaion` like '%{$query}%' OR `Silkworm_id` like '%{$query}%' OR `Silkworm_annotation` like '%{$query}%' OR `NR_ID` like '%{$query}%' OR `NR_annotation` like '%{$query}%' OR `EC_id` like '%{$query}%' OR `EC` like '%{$query}%'";
            $res_text = mysql_query($sql_text) or die("
                <div class=\"alert bg-danger\" role=\"alert\"><svg class=\"glyph stroked cancel\">
                <use xlink:href=\"#stroked-cancel\"></use></svg>Oooops, Something went wrong. Seems like we are facing some technical issues during selecting new records in the database....</div><img src=\"img/sorry.jpg\">
                <meta http-equiv=\"refresh\" content=\"5;url=submit.html\">
            ");
                
            //$res_text=$con->query($sql)
            // while($row=$res->fetch_assoc()){ echo 'First_name: '.$row["First_Name"]; } 
            ?>
            <div class="col-lg-12">
                    <table>
                        <tr>
                            <th>Transcripts_ID</th>
                            <th>China_id</th>
                            <th>China_annotation</th>
                            <th>Drosophila_id</th>
                            <th>Drosophila_annotation</th>
                            <th>Insecta_id</th>
                            <th>Insecta_annotaion</th>
                            <th>Silkworm_id</th>
                            <th>Silkworm_annotation</th>
                            <th>NR_ID</th>
                            <th>NR_annotation</th>
                            <th>EC_id</th>
                            <th>EC</th>
                            <th>Up/Down Regulate</th>
                        </tr>
            <?php
                while ($row = mysql_fetch_row($res_text)){
            ?>
                        <tr>
                            <td><a href="contig.php?contig=<?php echo $row[0] ?>"><?php echo $row[0] ?></a></td>
                            <td><?php echo $row[1] ?></td>
                            <td><?php echo $row[2] ?></td>
                            <td><?php echo $row[3] ?></td>
                            <td><?php echo $row[4] ?></td>
                            <td><?php echo $row[5] ?></td>
                            <td><?php echo $row[6] ?></td>
                            <td><?php echo $row[7] ?></td>
                            <td><?php echo $row[8] ?></td>
                            <td><?php echo $row[9] ?></td>
                            <td><?php echo $row[10] ?></td>
                            <td><?php echo $row[11] ?></td>
                            <td><?php echo $row[12] ?></td>
                            <td><?php echo $row[13] ?></td>
                        </tr>
            <?php
            }
            ?>
                </table>
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
<script>
    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
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
