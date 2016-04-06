<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIP | </title>

    <!-- Bootstrap core CSS -->

    <link href="<?php   echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?php   echo base_url('assets/fonts/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php   echo base_url('assets/css/animate.min.css') ?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php  echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url('assets/css/maps/jquery-jvectormap-2.0.1.css') ?> " />
    <link href="<?php   echo base_url('assets/css/icheck/flat/green.css') ?>" rel="stylesheet" />
    <link href="<?php  echo base_url('assets/css/floatexamples.css') ?>" rel="stylesheet" type="text/css" />

    <script src="<?php  echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php  echo base_url('assets/js/nprogress.js') ?>"></script>
    <script>
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <?php  echo isset($sidebar)? $sidebar : ''; ?>

            <?php echo isset($top)? $top:''; ?>


            <!-- page content -->
            <div class="right_col" role="main">

               <?php 
                   echo isset($content)? $content:'';
                ?>

                <?php 
                   // echo isset($footer)? $footer:'';
                 ?>
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php  echo base_url('assets/js/bootstrap.min.js') ?>"></script>

    <!-- gauge js -->
    <script type="text/javascript" src="<?php   echo base_url('assets/js/gauge/gauge.min.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/gauge/gauge_demo.js') ?>"></script>
    <!-- chart js -->
    <script src="<?php  echo base_url('assets/js/chartjs/chart.min.js') ?>"></script>
    <!-- bootstrap progress js -->
    <script src="<?php  echo base_url('assets/js/progressbar/bootstrap-progressbar.min.js') ?>"></script>
    <script src="<?php  echo base_url('assets/js/nicescroll/jquery.nicescroll.min.js') ?>"></script>
    <!-- icheck -->
    <script src="<?php  echo base_url('assets/js/icheck/icheck.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php   echo base_url('assets/js/moment.min.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/datepicker/daterangepicker.js') ?>"></script>

    <script src="<?php  echo base_url('assets/js/custom.js') ?>"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.pie.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.orderBars.js') ?>"></script>
    <script type="text/javascript" src="<?php  echo base_url('assets/js/flot/jquery.flot.time.min.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/date.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.spline.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.stack.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/curvedLines.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/flot/jquery.flot.resize.js') ?>"></script>
    <script>
        $(document).ready(function () {
           
        });
    </script>

    <!-- worldmap -->
    <script type="text/javascript" src="<?php   echo base_url('assets/js/maps/jquery-jvectormap-2.0.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/maps/gdp-data.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/maps/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script type="text/javascript" src="<?php   echo base_url('assets/js/maps/jquery-jvectormap-us-aea-en.js') ?>"></script>
    <script>
        $(function () {
            // $('#world-map-gdp').vectorMap({
            //     map: 'world_mill_en',
            //     backgroundColor: 'transparent',
            //     zoomOnScroll: false,
            //     series: {
            //         regions: [{
            //             values: gdpData,
            //             scale: ['#E6F2F0', '#149B7E'],
            //             normalizeFunction: 'polynomial'
            //         }]
            //     },
            //     onRegionTipShow: function (e, el, code) {
            //         el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            //     }
            // });
        });
    </script>
    <!-- skycons -->
    <script src="<?php  echo base_url('assets/js/skycons/skycons.js') ?>"></script>
    <script>
        // var icons = new Skycons({
        //         "color": "#73879C"
        //     }),
        //     list = [
        //         "clear-day", "clear-night", "partly-cloudy-day",
        //         "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        //         "fog"
        //     ],
        //     i;

        // for (i = list.length; i--;)
        //     icons.set(list[i], list[i]);

        // icons.play();
    </script>

    <!-- dashbord linegraph -->
    <script>
    //     var doughnutData = [
    //         {
    //             value: 30,
    //             color: "#455C73"
    //         },
    //         {
    //             value: 30,
    //             color: "#9B59B6"
    //         },
    //         {
    //             value: 60,
    //             color: "#BDC3C7"
    //         },
    //         {
    //             value: 100,
    //             color: "#26B99A"
    //         },
    //         {
    //             value: 120,
    //             color: "#3498DB"
    //         }
    // ];
    //     var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    </script>
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            // var cb = function (start, end, label) {
            //     console.log(start.toISOString(), end.toISOString(), label);
            //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //     //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            // }

            // var optionSet1 = {
            //     startDate: moment().subtract(29, 'days'),
            //     endDate: moment(),
            //     minDate: '01/01/2012',
            //     maxDate: '12/31/2015',
            //     dateLimit: {
            //         days: 60
            //     },
            //     showDropdowns: true,
            //     showWeekNumbers: true,
            //     timePicker: false,
            //     timePickerIncrement: 1,
            //     timePicker12Hour: true,
            //     ranges: {
            //         'Today': [moment(), moment()],
            //         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            //         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            //         'This Month': [moment().startOf('month'), moment().endOf('month')],
            //         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            //     },
            //     opens: 'left',
            //     buttonClasses: ['btn btn-default'],
            //     applyClass: 'btn-small btn-primary',
            //     cancelClass: 'btn-small',
            //     format: 'MM/DD/YYYY',
            //     separator: ' to ',
            //     locale: {
            //         applyLabel: 'Submit',
            //         cancelLabel: 'Clear',
            //         fromLabel: 'From',
            //         toLabel: 'To',
            //         customRangeLabel: 'Custom',
            //         daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            //         monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            //         firstDay: 1
            //     }
            // };
            // $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            // $('#reportrange').daterangepicker(optionSet1, cb);
            // $('#reportrange').on('show.daterangepicker', function () {
            //     console.log("show event fired");
            // });
            // $('#reportrange').on('hide.daterangepicker', function () {
            //     console.log("hide event fired");
            // });
            // $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
            //     console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            // });
            // $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
            //     console.log("cancel event fired");
            // });
            // $('#options1').click(function () {
            //     $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            // });
            // $('#options2').click(function () {
            //     $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            // });
            // $('#destroy').click(function () {
            //     $('#reportrange').data('daterangepicker').remove();
            // });
        });
    </script>
    <script>
        // NProgress.done();
    </script>
    <!-- /datepicker -->
    <!-- /footer content -->
</body>

</html>
