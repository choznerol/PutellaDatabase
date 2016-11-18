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
        <li><a href="submit.html">
                <svg class="glyph stroked dashboard dial">
                    <use xlink:href="#stroked-dashboard-dial"/>
                </svg>
                Submit Job </a></li>
        <li><a href="job_status.php">
                <svg class="glyph stroked clipboard with paper">
                    <use xlink:href="#stroked-clipboard-with-paper"/>
                </svg>
                Job Status</a></li>
        <li><a href="result.php">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Results</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Job Submission Status</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">

            <?php

//            $email = $_POST["email"];
            $sequence = $_POST["sequence"];
            $job_id = "putella_seq_" . md5(uniqid(rand()));
            $path_prefix = "var/";

            echo("pwd: ");
            system("pwd");

            exec("echo \"$sequence\" > $path_prefix$job_id.fasta");

            exec("blastn -db /home/callsobing/putella/putella_cufflinks -outfmt 6 -num_threads 4 -evalue 0.00000001 -perc_identity 100 -query $path_prefix$job_id.fasta
            > $path_prefix$job_id.output 
            2> $path_prefix$job_id.err");

            exec("blastn -db /home/callsobing/putella/putella_cufflinksa -outfmt 6 -num_threads 4 -evalue 0.00000001 -perc_identity 100 -query example.fasta
            > var/example_$job_id.output 
            2> var/example_$job_id.err");

            exec("cat $path_prefix$job_id.output", $output_file);

            exec("blastn -db /home/callsobing/putella/putella_cufflinks -query var/example.fasta -outfmt 6 -num_threads 4 -evalue 0.00000001 -perc_identity 100", $example_output);
//            system("blastn -db /home/callsobing/putella/putella_cufflinks -query var/example.fasta -outfmt 6 -num_threads 4 -evalue 0.00000001 -perc_identity 100");
//            system("ls");
//
            echo "<br>output_file:<br>";
            print_r($output_file);
            print_r($output_file[0]);

            echo "<br>example_output:<br>";
            print_r($example_output);
            print_r($example_output[0]);

            ?>

            <div class="alert bg-success" role="alert">
                <svg class="glyph stroked checkmark">
                    <use xlink:href="#stroked-checkmark"></use>
                </svg>
                Your job has been submitted! <a href="#" class="pull-right"><span
                        class="glyphicon glyphicon-remove"></span></a>
            </div>
<!--            <meta http-equiv="refresh" content="5;url=job_status.php">-->
            <div class="col-lg-12">
                <label>Job Submission Summary</label>
                <table>
                  <tr>
                    <td>E-mail</td>
                    <td><?php echo $email ?></td>
                  </tr>
                  <tr>
                    <td>Job ID</td>
                    <td><?php echo $job_id ?></td>
                  </tr>
                  <tr>
                    <td>Query sequence</td>
                    <td><?php echo $sequence ?></td>
                  </tr>
                  <tr>
                    <td>Blastn output</td>
                    <td><?php echo $output_file ?></td>
                  </tr>
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
