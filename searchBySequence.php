<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PutellaDatabase - Submit Jobs</title>

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
            <a class="navbar-brand" href="#"><span>C4LAB</span>VARCLUST</a>
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
        <li><a href="index.html">
                <svg class="glyph stroked home">
                    <use xlink:href="#stroked-home"/>
                </svg>
                Introduction</a></li>
        <li><a href="SubmitJob.html">
                <svg class="glyph stroked dashboard dial">
                    <use xlink:href="#stroked-dashboard-dial"/>
                </svg>
                Submit Job </a></li>
        <li><a href="JobStatus.php">
                <svg class="glyph stroked clipboard with paper">
                    <use xlink:href="#stroked-clipboard-with-paper"/>
                </svg>
                Job Status</a></li>
        <li><a href="Results.html">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Results</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Search By Sequence Result</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">

            <?php

            $email = $_POST["email"];
            $method = "sequence" ;
            $sequence = $_POST["sequence"];
            $job_id = "putella_seq_" . md5(uniqid(rand()));
            $path_prefix = "var/";

            mysql_connect("localhost", "callsobing", "wannatobetop") or die("sql connect fail!");
            mysql_select_db("varclust") or die("database connect fail!");
            $sql="insert into putella_jobs (jobid,email,method,query) values ('$job_id','$email','$method','$sequence')";
            mysql_query($sql) or die("insert fail");

            exec("echo \"$sequence\" > $path_prefix$job_id.fasta");
            exec("blastn -db /home/callsobing/putella/putella_cufflinks -query $path_prefix$job_id.fasta -outfmt 6 -num_threads 4 -evalue 0.00000001 -perc_identity 100 > $path_prefix$job_id.output");
            exec("cat $path_prefix$job_id.output", $blastn_output);
            $blastn_output_arr = explode("\t", $blastn_output[0]);
            ?>

            <div class="alert bg-success" role="alert">
                <svg class="glyph stroked checkmark">
                    <use xlink:href="#stroked-checkmark"></use>
                </svg>
                Done Blast job. Result also saved to http://140.112.94.72/~<?php echo(exec("whoami")) ?>/PutellaDatabase/var/ <a href="#" class="pull-right"><span
                        class="glyphicon glyphicon-remove"></span></a>
            </div>
            <!--            <meta http-equiv="refresh" content="5;url=job_status.php">-->

            <div class="col-lg-12">
                <label>Job Submission Summary</label>
                <table>
                    <tr>
                        <td>E-mail</td>
                        <td><?php echo $email ?>
                    </tr>
                    <tr>
                        <td>Job ID</td>
                        <td><?php echo $job_id ?></td>
                    </tr>
                    <tr>
                        <td>Query sequence</td>
                        <td><?php echo $sequence ?></td>
                </table>

                <div class="panel panel-default">
                    <div class="panel-heading">Blastn Result</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <tr>
                                <th data-checkbox="true" >Query</th>
                                <th data-checkbox="true" >Subject</th>
                                <th data-checkbox="true" >% id</th>
                                <th data-checkbox="true" >alignment length</th>
                                <th data-checkbox="true" >mismatches</th>
                                <th data-checkbox="true" >gap openings</th>
                                <th data-checkbox="true" >q.start</th>
                                <th data-checkbox="true" >q.end</th>
                                <th data-checkbox="true" >s.start</th>
                                <th data-checkbox="true" >s.end</th>
                                <th data-checkbox="true" >e-value</th>
                                <th data-checkbox="true" >bit score</th>
                            </tr>
                            <?Php
                            $f = fopen("$path_prefix$job_id.output", "r");
                            $fr = fread($f, filesize("$path_prefix$job_id.output"));
                            fclose($f);
                            $lines = array();
                            $lines = explode("\n",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of...

                            for($i=0;$i<count($lines)-1;$i++)
                            {
                                echo "<tr>";
                                $cells = array();
                                $cells = explode("\t",$lines[$i]); // use the cell/row delimiter what u need!
                                for($k=0;$k<count($cells);$k++)
                                {
                                    echo "<td>".$cells[$k]."</td>";
                                }
				echo "</tr>";
                            }
                            ?>
			</table>
                    </div>
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
