<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<link href="<?php echo base_url('assets/plugins/morrisjs/morris.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/tui/tui-calendar.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/tui/date-picker/tui-date-picker.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/tui/time-picker/tui-time-picker.css'); ?>" rel="stylesheet" />
<!-- #END HEAD HERE -->


<?php $this->load->view('app/_template/2topbar.php'); ?>


<?php $this->load->view('app/_template/3sidebar.php'); ?>


<?php $this->load->view('app/_template/4content.php'); ?>
<!-- CONTENT HERE -->
<div class="">
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">Semua Jadwal</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo $all; ?>" data-speed="5" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">Sedang Berlangsung</div>
                    <div class="number count-to" data-from="0" data-to="<?= $onprocess ?>" data-speed="5" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">Selesai</div>
                    <div class="number count-to" data-from="0" data-to="<?= $done ?>" data-speed="5" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Sedang Menunggu</div>
                    <div class="number count-to" data-from="0" data-to="<?= $waiting ?>" data-speed="5" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <!-- CPU Usage -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Jadwal</h2>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div id="menu">
                        <span class="dropdown">
                            <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true">
                                <i id="calendarTypeIcon" class="material-icons" style="margin-right: 4px;">format_align_justify</i>
                                <span id="calendarTypeName">Dropdown</span>&nbsp;
                                <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                <li role="presentation">
                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                        <i class="calendar-icon ic_view_day"></i>Daily
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                        <i class="calendar-icon ic_view_week"></i>Weekly
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                        <i class="calendar-icon ic_view_month"></i>Month
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                        <i class="calendar-icon ic_view_week"></i>2 weeks
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                        <i class="calendar-icon ic_view_week"></i>3 weeks
                                    </a>
                                </li>
                                <li role="presentation" class="dropdown-divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" data-action="toggle-workweek">
                                        <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                        <span class="checkbox-title"></span>Show weekends
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" data-action="toggle-start-day-1">
                                        <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                        <span class="checkbox-title"></span>Start Week on Monday
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" data-action="toggle-narrow-weekend">
                                        <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                        <span class="checkbox-title"></span>Narrower than weekdays
                                    </a>
                                </li>
                            </ul>
                        </span>
                        <span id="menu-navi">
                            <button type="button" class="btn btn-primary btn-sm move-today" data-action="move-today">Today</button>
                            <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                                <i class="material-icons" data-action="move-prev">navigate_before</i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                                <i class="material-icons" data-action="move-next">navigate_next</i>
                            </button>
                        </span>
                        <span id="renderRange" class="render-range"></span>
                    </div>

                    <div id="jadwal" class="" style="height:800px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->

    <!--
    <div class="row clearfix">
        -# Visitors #-
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-pink">
                    <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                         data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                         data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                         data-fill-Color="rgba(0, 188, 212, 0)">
                        12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                    </div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        -# #END# Visitors #-
        -# Latest Social Trends #-
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-cyan">
                    <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            #socialtrends
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                        <li>
                            #materialdesign
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                        <li>#adminbsb</li>
                        <li>#freeadmintemplate</li>
                        <li>#bootstraptemplate</li>
                        <li>
                            #freehtmltemplate
                            <span class="pull-right">
                                <i class="material-icons">trending_up</i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        -# #END# Latest Social Trends #-
        -# Answered Tickets #-
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-teal">
                    <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                    <ul class="dashboard-stat-list">
                        <li>
                            TODAY
                            <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            YESTERDAY
                            <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST WEEK
                            <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST MONTH
                            <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            LAST YEAR
                            <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                        </li>
                        <li>
                            ALL
                            <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        -# #END# Answered Tickets #-
    </div>

    <div class="row clearfix">
        -# Task Info #-
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="header">
                    <h2>TASK INFOS</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Manager</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Task A</td>
                                    <td><span class="label bg-green">Doing</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Task B</td>
                                    <td><span class="label bg-blue">To Do</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Task C</td>
                                    <td><span class="label bg-light-blue">On Hold</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Task D</td>
                                    <td><span class="label bg-orange">Wait Approvel</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Task E</td>
                                    <td>
                                        <span class="label bg-red">Suspended</span>
                                    </td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        -# #END# Task Info #-
        -# Browser Usage #-
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>BROWSER USAGE</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div id="donut_chart" class="dashboard-donut-chart"></div>
                </div>
            </div>
        </div>
        -# #END# Browser Usage #-
    </div>
     -->
</div>
<!-- #END CONTENT HERE -->


<?php $this->load->view('app/_template/5js.php'); ?>
<!-- JS HERE -->
<!-- Select Plugin Js -->
<script src="<?php echo base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="<?php echo base_url('assets/plugins/jquery-countto/jquery.countTo.js'); ?>"></script>
<!-- Morris Plugin Js -->
<script src="<?php echo base_url('assets/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/morrisjs/morris.js'); ?>"></script>
<!-- ChartJs -->
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?php echo base_url('assets/plugins/jquery-sparkline/jquery.sparkline.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pages/index.js'); ?>"></script>
<!-- Demo Js -->
<script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>
<!-- #END JS HERE -->

<script src="<?php echo base_url('assets/plugins/tui/code-snippet/tui-code-snippet.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/tui/tui-calendar.min.js'); ?>"></script>
<script type="text/javascript">
    var cal = new tui.Calendar('#jadwal', {
        usageStatistics: false,
        defaultView: 'month',
        taskView: true
    });

    var data_jadwal = <?= $data_jadwal_json ?>;
    var lastClickSchedule;

    cal.createSchedules(data_jadwal);

    cal.on('clickSchedule', function(event) {
        var schedule = event.schedule;
        // focus the schedule
        if (lastClickSchedule) {
            cal.updateSchedule(lastClickSchedule.id, lastClickSchedule.calendarId, {
                isFocused: false
            });
        }
        cal.updateSchedule(schedule.id, schedule.calendarId, {
            isFocused: true
        });
        lastClickSchedule = schedule;
        // open detail view
    });

    cal.on('clickMore', function(event) {
        console.log('clickMore', event.date, event.target);
    });

</script>

<script type="text/javascript">
    var resizeThrottled;
   var useCreationPopup = true;
   var useDetailPopup = true;
   var datePicker, selectedCalendar;

   // event handlers
   cal.on({
       'clickMore': function(e) {
           console.log('clickMore', e);
       },
       'clickSchedule': function(e) {
           console.log('clickSchedule', e);
       },
       'clickDayname': function(date) {
           console.log('clickDayname', date);
       },
       'beforeUpdateSchedule': function(e) {
           var schedule = e.schedule;
           var changes = e.changes;

           console.log('beforeUpdateSchedule', e);

           if (changes && !changes.isAllDay && schedule.category === 'allday') {
               changes.category = 'time';
           }

           cal.updateSchedule(schedule.id, schedule.calendarId, changes);
           refreshScheduleVisibility();
       },
       'beforeDeleteSchedule': function(e) {
           console.log('beforeDeleteSchedule', e);
           cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);
       },
       'afterRenderSchedule': function(e) {
           var schedule = e.schedule;
           // var element = cal.getElement(schedule.id, schedule.calendarId);
           // console.log('afterRenderSchedule', element);
       },
       'clickTimezonesCollapseBtn': function(timezonesCollapsed) {
           console.log('timezonesCollapsed', timezonesCollapsed);

           if (timezonesCollapsed) {
               cal.setTheme({
                   'week.daygridLeft.width': '77px',
                   'week.timegridLeft.width': '77px'
               });
           } else {
               cal.setTheme({
                   'week.daygridLeft.width': '60px',
                   'week.timegridLeft.width': '60px'
               });
           }

           return true;
       }
   });

   /**
    * Get time template for time and all-day
    * @param {Schedule} schedule - schedule
    * @param {boolean} isAllDay - isAllDay or hasMultiDates
    * @returns {string}
    */
   function getTimeTemplate(schedule, isAllDay) {
       var html = [];
       var start = moment(schedule.start.toUTCString());
       if (!isAllDay) {
           html.push('<strong>' + start.format('HH:mm') + '</strong> ');
       }
       if (schedule.isPrivate) {
           html.push('<span class="calendar-font-icon ic-lock-b"></span>');
           html.push(' Private');
       } else {
           if (schedule.isReadOnly) {
               html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
           } else if (schedule.recurrenceRule) {
               html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
           } else if (schedule.attendees.length) {
               html.push('<span class="calendar-font-icon ic-user-b"></span>');
           } else if (schedule.location) {
               html.push('<span class="calendar-font-icon ic-location-b"></span>');
           }
           html.push(' ' + schedule.title);
       }

       return html.join('');
   }

   /**
    * A listener for click the menu
    * @param {Event} e - click event
    */
   function onClickMenu(e) {
       var target = $(e.target).closest('a[role="menuitem"]')[0];
       var action = getDataAction(target);
       var options = cal.getOptions();
       var viewName = '';

       // console.log(target);
       // console.log(action);
       switch (action) {
           case 'toggle-daily':
               viewName = 'day';
               break;
           case 'toggle-weekly':
               viewName = 'week';
               break;
           case 'toggle-monthly':
               options.month.visibleWeeksCount = 0;
               viewName = 'month';
               break;
           case 'toggle-weeks2':
               options.month.visibleWeeksCount = 2;
               viewName = 'month';
               break;
           case 'toggle-weeks3':
               options.month.visibleWeeksCount = 3;
               viewName = 'month';
               break;
           case 'toggle-narrow-weekend':
               options.month.narrowWeekend = !options.month.narrowWeekend;
               options.week.narrowWeekend = !options.week.narrowWeekend;
               viewName = cal.getViewName();

               target.querySelector('input').checked = options.month.narrowWeekend;
               break;
           case 'toggle-start-day-1':
               options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
               options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
               viewName = cal.getViewName();

               target.querySelector('input').checked = options.month.startDayOfWeek;
               break;
           case 'toggle-workweek':
               options.month.workweek = !options.month.workweek;
               options.week.workweek = !options.week.workweek;
               viewName = cal.getViewName();

               target.querySelector('input').checked = !options.month.workweek;
               break;
           default:
               break;
       }

       cal.setOptions(options, true);
       cal.changeView(viewName, true);

       setDropdownCalendarType();
       setRenderRangeText();
   }

   function onClickNavi(e) {
       var action = getDataAction(e.target);

       switch (action) {
           case 'move-prev':
               cal.prev();
               break;
           case 'move-next':
               cal.next();
               break;
           case 'move-today':
               cal.today();
               break;
           default:
               return;
       }

       setRenderRangeText();
   }

   function onNewSchedule() {
       var title = $('#new-schedule-title').val();
       var location = $('#new-schedule-location').val();
       var isAllDay = document.getElementById('new-schedule-allday').checked;
       var start = datePicker.getStartDate();
       var end = datePicker.getEndDate();
       var calendar = selectedCalendar ? selectedCalendar : CalendarList[0];

       if (!title) {
           return;
       }

       cal.createSchedules([{
           id: String(chance.guid()),
           calendarId: calendar.id,
           title: title,
           isAllDay: isAllDay,
           start: start,
           end: end,
           category: isAllDay ? 'allday' : 'time',
           dueDateClass: '',
           color: calendar.color,
           bgColor: calendar.bgColor,
           dragBgColor: calendar.bgColor,
           borderColor: calendar.borderColor,
           raw: {
               location: location
           },
           state: 'Busy'
       }]);

       $('#modal-new-schedule').modal('hide');
   }

   function onChangeNewScheduleCalendar(e) {
       var target = $(e.target).closest('a[role="menuitem"]')[0];
       var calendarId = getDataAction(target);
       changeNewScheduleCalendar(calendarId);
   }

   function changeNewScheduleCalendar(calendarId) {
       var calendarNameElement = document.getElementById('calendarName');
       var calendar = findCalendar(calendarId);
       var html = [];

       html.push('<span class="calendar-bar" style="background-color: ' + calendar.bgColor + '; border-color:' + calendar.borderColor + ';"></span>');
       html.push('<span class="calendar-name">' + calendar.name + '</span>');

       calendarNameElement.innerHTML = html.join('');

       selectedCalendar = calendar;
   }

   function createNewSchedule(event) {
       var start = event.start ? new Date(event.start.getTime()) : new Date();
       var end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

       if (useCreationPopup) {
           cal.openCreationPopup({
               start: start,
               end: end
           });
       }
   }

   function onChangeCalendars(e) {
       var calendarId = e.target.value;
       var checked = e.target.checked;
       var viewAll = document.querySelector('.lnb-calendars-item input');
       var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
       var allCheckedCalendars = true;

       if (calendarId === 'all') {
           allCheckedCalendars = checked;

           calendarElements.forEach(function(input) {
               var span = input.parentNode;
               input.checked = checked;
               span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
           });

           CalendarList.forEach(function(calendar) {
               calendar.checked = checked;
           });
       } else {
           findCalendar(calendarId).checked = checked;

           allCheckedCalendars = calendarElements.every(function(input) {
               return input.checked;
           });

           if (allCheckedCalendars) {
               viewAll.checked = true;
           } else {
               viewAll.checked = false;
           }
       }

       refreshScheduleVisibility();
   }

   function refreshScheduleVisibility() {
       var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

       CalendarList.forEach(function(calendar) {
           cal.toggleSchedules(calendar.id, !calendar.checked, false);
       });

       cal.render(true);

       calendarElements.forEach(function(input) {
           var span = input.nextElementSibling;
           span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
       });
   }

   function setDropdownCalendarType() {
       var calendarTypeName = document.getElementById('calendarTypeName');
       var calendarTypeIcon = document.getElementById('calendarTypeIcon');
       var options = cal.getOptions();
       var type = cal.getViewName();
       var iconClassName;

       if (type === 'day') {
           type = 'Daily';
           iconClassName = 'view_day';
       } else if (type === 'week') {
           type = 'Weekly';
           iconClassName = 'view_week';
       } else if (options.month.visibleWeeksCount === 2) {
           type = '2 weeks';
           iconClassName = 'view_week';
       } else if (options.month.visibleWeeksCount === 3) {
           type = '3 weeks';
           iconClassName = 'view_week';
       } else {
           type = 'Monthly';
           iconClassName = 'view_module';
       }

       calendarTypeName.innerHTML = type;
       calendarTypeIcon.innerHTML = iconClassName;
   }

   function currentCalendarDate(format) {
     var currentDate = moment([cal.getDate().getFullYear(), cal.getDate().getMonth(), cal.getDate().getDate()]);

     return currentDate.format(format);
   }

   function setRenderRangeText() {
       var renderRange = document.getElementById('renderRange');
       var options = cal.getOptions();
       var viewName = cal.getViewName();

       var html = [];
       if (viewName === 'day') {
           html.push(currentCalendarDate('YYYY.MM.DD'));
       } else if (viewName === 'month' &&
           (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
           html.push(currentCalendarDate('YYYY.MM'));
       } else {
           html.push(moment(cal.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
           html.push(' ~ ');
           html.push(moment(cal.getDateRangeEnd().getTime()).format(' MM.DD'));
       }
       renderRange.innerHTML = html.join('');
   }

   function setEventListener() {
       $('#menu-navi').on('click', onClickNavi);
       $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
       $('#lnb-calendars').on('change', onChangeCalendars);

       $('#btn-save-schedule').on('click', onNewSchedule);
       $('#btn-new-schedule').on('click', createNewSchedule);

       $('#dropdownMenu-calendars-list').on('click', onChangeNewScheduleCalendar);

       window.addEventListener('resize', resizeThrottled);
   }

   function getDataAction(target) {
       return target.dataset ? target.dataset.action : target.getAttribute('data-action');
   }

   resizeThrottled = tui.util.throttle(function() {
       cal.render();
   }, 50);

   window.cal = cal;

   setDropdownCalendarType();
   setRenderRangeText();
   setEventListener();
</script>


<?php $this->load->view('app/_template/6end.php'); ?>
