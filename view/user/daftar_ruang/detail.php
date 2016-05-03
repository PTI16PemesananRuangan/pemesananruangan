<link href="<?php echo base_url('assets/css/calendar/fullcalendar.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/calendar/fullcalendar.print.css') ?>" rel="stylesheet" media="print">
<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?php echo $nama; ?></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><?php echo $nama ?> (<?php echo $kampus_option[$id_kampus] ?>) </h2>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-8 col-lg-8 col-sm-7">
                                        <div class="thumbnail" style="height:auto">
                                        <img src="<?php echo base_url('upload/'.$foto )?>">
                                        </div>
                                        <!-- blockquote -->
                                       <!--  <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                            <footer>Someone famous in <cite title="Source Title">Source Title</cite>
                                            </footer>
                                        </blockquote>

                                        <blockquote class="blockquote-reverse">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                            <footer>Someone famous in <cite title="Source Title">Source Title</cite>
                                            </footer>
                                        </blockquote> -->
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-5">
                                         <blockquote>
                                            <p> <span class="label label-primary">Kapasitas</span> <br> <?php echo $kapasitas.' Orang' ?></p>
                                         </blockquote>
                                         <blockquote>
                                            <p> <span class="label label-primary">Fasilitas</span> <br> <?php echo $fasilitas ?></p>
                                         </blockquote>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-md-12">
                                         <a href="<?php echo site_url('daftar_ruang') ?>" class="btn btn-primary">Back</a>
                                         <a href="<?php echo site_url('daftar_ruang/booking/'.$id) ?>" class="btn btn-primary">Booking</a>
                                        <!-- <h4>Labels and badges</h4>
                                        <span class="label label-default">Default</span>
                                        <span class="label label-primary">Primary</span>
                                        <span class="label label-success">Success</span>
                                        <span class="label label-info">Info</span>
                                        <span class="label label-warning">Warning</span>
                                        <span class="label label-danger">Danger</span>

                                        <span class="badge badge-success">42</span> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                       
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Calender Events <small>Sessions</small></h2>
                                       
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div id='calendar'></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="<?php echo base_url('assets/js/moment.min.js') ?>"></script>
                    <script src="<?php echo base_url('assets/js/calendar/fullcalendar.min.js') ?> "></script>
                    <script>
            $(window).load(function () {
                console.log(<?php echo $pemesanan; ?>);

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                console.log(d,m,y);
                var started;
                var categoryClass;

                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        $('#fc_create').click();

                        started = start;
                        ended = end

                        $(".antosubmit").on("click", function () {
                            var title = $("#title").val();
                            if (end) {
                                ended = end
                            }
                            categoryClass = $("#event_type").val();

                            if (title) {
                                calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: started,
                                        end: end,
                                        allDay: allDay
                                    },
                                    true // make the event "stick"
                                );
                            }
                            $('#title').val('');
                            calendar.fullCalendar('unselect');

                            $('.antoclose').click();

                            return false;
                        });
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        //alert(calEvent.title, jsEvent, view);

                        $('#fc_edit').click();
                        $('#title2').val(calEvent.title);
                        categoryClass = $("#event_type").val();

                        $(".antosubmit2").on("click", function () {
                            calEvent.title = $("#title2").val();

                            calendar.fullCalendar('updateEvent', calEvent);
                            $('.antoclose2').click();
                        });
                        calendar.fullCalendar('unselect');
                    },
                    editable: true,
                    // events :  [
                    //     {
                    //          title: 'nyadaran',
                    //          start: new Date(2016, 3, 6, 13, 0 ),
                    //          end: new Date(2016, 3, 6 , 15,0)
                    // }]
                    events : <?php echo $pemesanan; ?>
                //     events: [
                //         {
                //             title: 'All Day Event',
                //             start: new Date(y, m, 1)
                //     },
                //         {
                //             title: 'Long Event',
                //             start: new Date(y, m, d - 5),
                //             end: new Date(y, m, d - 2)
                //     },
                //         {
                //             title: 'Meeting',
                //             start: new Date(y, m, d, 10, 30),
                //              end: new Date(y, m, d, 12, 30),
                //             allDay: false
                //     },
                //         {
                //             title: 'Lunch',
                //             start: new Date(y, m, d + 14, 12, 0),
                //             end: new Date(y, m, d, 14, 0),
                //             allDay: false
                //     },
                //         {
                //             title: 'Birthday Party',
                //             start: new Date(y, m, d + 1, 19, 0),
                //             end: new Date(y, m, d + 1, 22, 30),
                //             allDay: false
                //     },
                //         {
                //             title: 'Click for Google',
                //             start: new Date(y, m, 28),
                //             end: new Date(y, m, 29),
                //             url: 'http://google.com/'
                //     }
                // ]
                });
            });
        </script>


