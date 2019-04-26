<?php

include("includes/header.php");
include("includes/config.php");
session_start();
include("includes/functions.php");

if(logged_in()) {
    header("location:login.php");
}

else if(isset($_COOKIE['name'])) {

    $email=$_COOKIE['name'];
    $result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$email'");
    $retrieve=mysqli_fetch_array($result);
    $firstname=$retrieve['first_name'];
    $lastname=$retrieve['last_name'];
    ?>

<!DOCTYPE html>
<html>
<head>
<title>GTM Home Services | Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<style class="cp-pen-styles">

@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&subset=latin-ext");
html, body {
  height: 100%;
  width: 100%;
}

body {
  margin: 0;
  padding: 0;
  font-family: "Open Sans";
  font-size: 14px;
  font-weight: 400;
  overflow: hidden;
  background-color: #ececec;
  color: #102c58;
}

* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

::-webkit-input-placeholder {
  color: #c3c3c3;
}

h1 {
  font-size: 24px;
}

h2 {
  font-size: 20px;
}

h3 {
  font-size: 18px;
}

.u-list {
  margin: 0;
  padding: 0;
  list-style: none;
}

.u-input {
  outline: 0;
  border: 1px solid #d0d0d0;
  padding: 5px 10px;
  height: 35px;
  font-size: 12px;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background-clip: padding-box;
}

.c-badge {
  font-size: 10px;
  font-weight: 700;
  min-width: 17px;
  padding: 5px 4px;
  border-radius: 100px;
  display: block;
  line-height: 0.7;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  background-color: #f91605;
}
.c-badge--header-icon {
  position: absolute;
  bottom: -9px;
}

.tooltip {
  width: 120px;
}
.tooltip-inner {
  padding: 8px 10px;
  color: #fff;
  text-align: center;
  background-color: #051835;
  font-size: 12px;
  border-radius: 3px;
}
.tooltip-arrow {
  border-right-color: #051835 !important;
}

.hamburger-toggle {
  position: relative;
  padding: 0;
  background: transparent;
  border: 1px solid transparent;
  cursor: pointer;
  order: 1;
}
.hamburger-toggle [class*='bar-'] {
  display: block;
  background: #102c58;
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .2s ease all;
  transition: .2s ease all;
  border-radius: 2px;
  height: 2px;
  width: 24px;
  margin-bottom: 4px;
}
.hamburger-toggle [class*='bar-']:nth-child(2) {
  width: 18px;
}
.hamburger-toggle [class*='bar-']:last-child {
  margin-bottom: 0;
  width: 12px;
}
.hamburger-toggle.is-opened {
  left: 3px;
}
.hamburger-toggle.is-opened [class*='bar-'] {
  background: #102c58;
}
.hamburger-toggle.is-opened .bar-top {
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  -webkit-transform-origin: 15% 15%;
  transform-origin: 15% 15%;
}
.hamburger-toggle.is-opened .bar-mid {
  opacity: 0;
}
.hamburger-toggle.is-opened .bar-bot {
  -webkit-transform: rotate(45deg);
  transform: rotate(-45deg);
  -webkit-transform-origin: 15% 95%;
  transform-origin: 15% 95%;
  width: 24px;
}
.hamburger-toggle:focus {
  outline-width: 0;
}
.hamburger-toggle:hover [class*='bar-'] {
  background: #4EA8E7;
}
.header-icons-group {
  display: flex;
  order: 3;
  margin-left: auto;
  height: 100%;
  border-left: 1px solid #cccccc;
}
.header-icons-group .c-header-icon:last-child {
  border-right: 0;
}
.c-header-icon {
  position: relative;
  display: flex;
  float: left;
  width: 70px;
  height: 100%;
  align-items: center;
  justify-content: center;
  line-height: 1;
  cursor: pointer;
  border-right: 1px solid #cccccc;
}
.c-header-icon i {
  font-size: 18px;
  line-height: 40px;
  color: #000;
}
.c-header-icon--in-circle {
  border: 1px solid #d0d0d0;
  border-radius: 100%;
}
.c-header-icon:hover i {
  color: #4EA8E7;
}
.l-header {
  padding-left: 70px;
  position: fixed;
  top: 0;
  right: 0;
  z-index: 10;
  width: 100%;
  background: #ffffff;
  -webkit-transition: padding 0.5s ease-in-out;
  -moz-transition: padding 0.5s ease-in-out;
  -ms-transition: padding 0.5s ease-in-out;
  -o-transition: padding 0.5s ease-in-out;
  transition: padding 0.5s ease-in-out;
}
.l-header__inner {
  height: 100%;
  width: 100%;
  display: flex;
  height: 70px;
  align-items: center;
  justify-content: stretch;
  border-bottom: 1px solid;
  border-color: #cccccc;
}
.sidebar-is-expanded .l-header {
  padding-left: 220px;
}
.c-search {
  display: flex;
  height: 100%;
  width: 350px;
}
.c-search__input {
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-right: 0;
  flex-basis: 100%;
  height: 100%;
  border: 0;
  font-size: 14px;
  padding: 0 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.c-dropdown {
  opacity: 0;
  text-align: left;
  position: absolute;
  flex-direction: column;
  display: none;
  width: 300px;
  top: 30px;
  right: -40px;
  background-color: #fff;
  overflow: hidden;
  min-height: 300px;
  border: 1px solid #d0d0d0;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background-clip: padding-box;
  -webkit-box-shadow: 0px 5px 14px -1px #cecece;
  -moz-box-shadow: 0px 5px 14px -1px #cecece;
  box-shadow: 0px 5px 14px -1px #cecece;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.l-sidebar {
  width: 70px;
  position: absolute;
  z-index: 10;
  left: 0;
  top: 0;
  bottom: 0;
  background: #102c58;
  -webkit-transition: width 0.5s ease-in-out;
  -moz-transition: width 0.5s ease-in-out;
  -ms-transition: width 0.5s ease-in-out;
  -o-transition: width 0.5s ease-in-out;
  transition: width 0.5s ease-in-out;
}
.l-sidebar .logo {
  width: 100%;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #051835;
}
.l-sidebar__content {
  height: 100%;
  position: relative;
}
.sidebar-is-expanded .l-sidebar {
  width: 220px;
}
.c-menu > ul {
  display: flex;
  flex-direction: column;
}
.c-menu > ul .c-menu__item {
  color: #fff;
  max-width: 100%;
  overflow: hidden;
}
.c-menu > ul .c-menu__item__inner {
  display: flex;
  flex-direction: row;
  align-items: center;
  min-height: 60px;
  position: relative;
  cursor: pointer;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item__inner:before {
  position: absolute;
  content: " ";
  min-height: 60px;
  width: 3px;
  left: 0;
  background-color: #5f9cfd;
  opacity: 0;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner {
  border-left-color: #4b7aba;
  background-color: #1e3e6f;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner i {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner .c-menu-item__title span {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner:before {
  height: 36px;
  opacity: 1;
}
.c-menu > ul .c-menu__item:not(.is-active):hover .c-menu__item__inner i {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item:not(.is-active):hover .c-menu__item__inner .c-menu-item__title span {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item i {
  flex: 0 0 70px;
  font-size: 18px;
  font-weight: normal;
  text-align: center;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item .c-menu-item__expand {
  position: relative;
  left: 100px;
  padding-right: 20px;
  margin-left: auto;
  -webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -ms-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}
.sidebar-is-expanded .c-menu > ul .c-menu__item .c-menu-item__expand {
  left: 0px;
}
.c-menu > ul .c-menu__item .c-menu-item__title {
  flex-basis: 100%;
  padding-right: 10px;
  position: relative;
  left: 220px;
  opacity: 0;
  -webkit-transition: all 0.7s ease-in-out;
  -moz-transition: all 0.7s ease-in-out;
  -ms-transition: all 0.7s ease-in-out;
  -o-transition: all 0.7s ease-in-out;
  transition: all 0.7s ease-in-out;
}
.c-menu > ul .c-menu__item .c-menu-item__title span {
  font-weight: 400;
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.sidebar-is-expanded .c-menu > ul .c-menu__item .c-menu-item__title {
  left: 0px;
  opacity: 1;
}
.c-menu > ul .c-menu__item .c-menu__submenu {
  background-color: #051835;
  padding: 15px;
  font-size: 12px;
  display: none;
}
.c-menu > ul .c-menu__item .c-menu__submenu li {
  padding-bottom: 15px;
  margin-bottom: 15px;
  border-bottom: 1px solid;
  border-color: #072048;
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item .c-menu__submenu li:last-child {
  margin: 0;
  padding: 0;
  border: 0;
}
main.l-main {
  width: 100%;
  height: 100%;
  padding: 70px 0 0 70px;
  -webkit-transition: padding 0.5s ease-in-out;
  -moz-transition: padding 0.5s ease-in-out;
  -ms-transition: padding 0.5s ease-in-out;
  -o-transition: padding 0.5s ease-in-out;
  transition: padding 0.5s ease-in-out;
}
main.l-main .content-wrapper {
  padding: 25px;
  height: 100%;
}
main.l-main .content-wrapper .page-content {
  border-top: 1px solid #d0d0d0;
  padding-top: 25px;
}
main.l-main .content-wrapper--with-bg .page-content {
  background: #fff;
  border-radius: 3px;
  border: 1px solid #d0d0d0;
  padding: 25px;
}
main.l-main .page-title {
  font-weight: 400;
  margin-top: 0;
  margin-bottom: 25px;
}
.sidebar-is-expanded main.l-main {
  padding-left: 220px;
}
.logo img {
    height: 32px;
    width: 30px;
}
</style>
</head>
<body>

<body class="sidebar-is-reduced">
  <header class="l-header">
    <div class="l-header__inner clearfix">
      <div class="c-header-icon js-hamburger">
        <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
      </div>
      
      <div class="header-icons-group">
        <a href='logout.php'><div class="c-header-icon logout"><i class="fa fa-sign-out"></i></div></a>
      </div>
    </div>
  </header>
  <div class="l-sidebar">
    <div class="logo">
      <img src="img/icon.png">
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <li class="c-menu__item is-active" data-toggle="tooltip" title="Dashboard" rel="dashboard">
            <div class="c-menu__item__inner"><i class="fa fa-tachometer"></i>
              <div class="c-menu-item__title"><span>Dashboard</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Jobs" rel="jobs">
            <div class="c-menu__item__inner"><i class="fa fa-tasks"></i>
              <div class="c-menu-item__title"><span>Jobs</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Calendar" rel="calendar">
            <div class="c-menu__item__inner"><i class="fa fa-calendar"></i>
              <div class="c-menu-item__title"><span>Calendar</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Messages" rel="messages">
            <div class="c-menu__item__inner"><i class="fa fa-comments"></i>
              <div class="c-menu-item__title"><span>Messages</span></div>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</body>
<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <div id="dashboard">
      <h1 class="page-title">Dashboard</h1>
      <div class="page-content">
        Hello, <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?>!
      </div>
    </div>
    <div id="jobs" style="display: none;">
      <h1 class="page-title">Jobs</h1>
      <div class="page-content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
        in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
        sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
    <div id="calendar" style="display: none;">
      <h1 class="page-title">Calendar</h1>
      <div class="page-content"></div>
    </div>
    <div id="messages" style="display: none;">
      <h1 class="page-title">Messages</h1>
      <div class="page-content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
        in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
        sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
  </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src='https://use.fontawesome.com/2188c74ac9.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>"use strict";

  $(document).ready(function() {
  var calendar = $('#calendar .page-content').fullCalendar({
    eventColor: '#102c58',
    eventTextColor: '#ffffff',
    header: {
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay) {
      var title = prompt("Enter Event Title");
      if(title) {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
          url:"insert.php",
          type:"POST",
          data:{title:title, start:start, end:end},
          success:function() {
            calendar.fullCalendar('refetchEvents');
            alert("Added Successfully");
          }
        })
      }
    },
    editable:true,
    eventResize:function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()  {
          calendar.fullCalendar('refetchEvents');
          alert('Event Update');
        }
      })
    },
    eventDrop:function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function() {
          calendar.fullCalendar('refetchEvents');
          alert("Event Updated");
        }
      });
    },
    eventClick:function(event) {
      if(confirm("Are you sure you want to remove it?")) {
        var id = event.id;
        $.ajax({
          url:"delete.php",
          type:"POST",
          data:{id:id},
          success:function() {
            calendar.fullCalendar('refetchEvents');
            alert("Event Removed");
          }
        })
      }
    },
  });
});

$('.u-list li').on('click', function() {
  var target = $(this).attr('rel');
  $("#"+target).show().siblings("div").hide();
});

var Dashboard = function () {
	var global = {
		tooltipOptions: {
			placement: "right"
		},
		menuClass: ".c-menu"
  };

  var menuChangeActive = function menuChangeActive(el) {
    var hasSubmenu = $(el).hasClass("has-submenu");
    $(global.menuClass + " .is-active").removeClass("is-active");
    $(el).addClass("is-active");

    if (hasSubmenu) {
      $(el).find("ul").slideDown();
    }
  };

  var sidebarChangeWidth = function sidebarChangeWidth() {
    var $menuItemsTitle = $("li .menu-item__title");

    $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
    $(".hamburger-toggle").toggleClass("is-opened");

    if ($("body").hasClass("sidebar-is-expanded")) {
      $('[data-toggle="tooltip"]').tooltip("destroy");
    } 
    else {
      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };

  return {
    init: function init() {
      $(".js-hamburger").on("click", sidebarChangeWidth);

      $(".js-menu li").on("click", function (e) {
        menuChangeActive(e.currentTarget);
      });

      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };
}();

Dashboard.init();

</script>
</body>
</html>
<?php
}

else {

    $email=$_SESSION['mail'];
    $result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$email'");
    $retrieve=mysqli_fetch_array($result);
    $firstname=$retrieve['first_name'];
    $lastname=$retrieve['last_name'];
    ?>

<!DOCTYPE html>
<html>
<head>
<title>GTM Home Services | Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<style class="cp-pen-styles">

@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&subset=latin-ext");
html, body {
  height: 100%;
  width: 100%;
}

body {
  margin: 0;
  padding: 0;
  font-family: "Open Sans";
  font-size: 14px;
  font-weight: 400;
  overflow: hidden;
  background-color: #ececec;
  color: #102c58;
}

* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

::-webkit-input-placeholder {
  color: #c3c3c3;
}

h1 {
  font-size: 24px;
}

h2 {
  font-size: 20px;
}

h3 {
  font-size: 18px;
}

.u-list {
  margin: 0;
  padding: 0;
  list-style: none;
}

.u-input {
  outline: 0;
  border: 1px solid #d0d0d0;
  padding: 5px 10px;
  height: 35px;
  font-size: 12px;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background-clip: padding-box;
}

.c-badge {
  font-size: 10px;
  font-weight: 700;
  min-width: 17px;
  padding: 5px 4px;
  border-radius: 100px;
  display: block;
  line-height: 0.7;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  background-color: #f91605;
}
.c-badge--header-icon {
  position: absolute;
  bottom: -9px;
}

.tooltip {
  width: 120px;
}
.tooltip-inner {
  padding: 8px 10px;
  color: #fff;
  text-align: center;
  background-color: #051835;
  font-size: 12px;
  border-radius: 3px;
}
.tooltip-arrow {
  border-right-color: #051835 !important;
}

.hamburger-toggle {
  position: relative;
  padding: 0;
  background: transparent;
  border: 1px solid transparent;
  cursor: pointer;
  order: 1;
}
.hamburger-toggle [class*='bar-'] {
  display: block;
  background: #102c58;
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .2s ease all;
  transition: .2s ease all;
  border-radius: 2px;
  height: 2px;
  width: 24px;
  margin-bottom: 4px;
}
.hamburger-toggle [class*='bar-']:nth-child(2) {
  width: 18px;
}
.hamburger-toggle [class*='bar-']:last-child {
  margin-bottom: 0;
  width: 12px;
}
.hamburger-toggle.is-opened {
  left: 3px;
}
.hamburger-toggle.is-opened [class*='bar-'] {
  background: #102c58;
}
.hamburger-toggle.is-opened .bar-top {
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  -webkit-transform-origin: 15% 15%;
  transform-origin: 15% 15%;
}
.hamburger-toggle.is-opened .bar-mid {
  opacity: 0;
}
.hamburger-toggle.is-opened .bar-bot {
  -webkit-transform: rotate(45deg);
  transform: rotate(-45deg);
  -webkit-transform-origin: 15% 95%;
  transform-origin: 15% 95%;
  width: 24px;
}
.hamburger-toggle:focus {
  outline-width: 0;
}
.hamburger-toggle:hover [class*='bar-'] {
  background: #4EA8E7;
}
.header-icons-group {
  display: flex;
  order: 3;
  margin-left: auto;
  height: 100%;
  border-left: 1px solid #cccccc;
}
.header-icons-group .c-header-icon:last-child {
  border-right: 0;
}
.c-header-icon {
  position: relative;
  display: flex;
  float: left;
  width: 70px;
  height: 100%;
  align-items: center;
  justify-content: center;
  line-height: 1;
  cursor: pointer;
  border-right: 1px solid #cccccc;
}
.c-header-icon i {
  font-size: 18px;
  line-height: 40px;
  color: #000;
}
.c-header-icon--in-circle {
  border: 1px solid #d0d0d0;
  border-radius: 100%;
}
.c-header-icon:hover i {
  color: #4EA8E7;
}
.l-header {
  padding-left: 70px;
  position: fixed;
  top: 0;
  right: 0;
  z-index: 10;
  width: 100%;
  background: #ffffff;
  -webkit-transition: padding 0.5s ease-in-out;
  -moz-transition: padding 0.5s ease-in-out;
  -ms-transition: padding 0.5s ease-in-out;
  -o-transition: padding 0.5s ease-in-out;
  transition: padding 0.5s ease-in-out;
}
.l-header__inner {
  height: 100%;
  width: 100%;
  display: flex;
  height: 70px;
  align-items: center;
  justify-content: stretch;
  border-bottom: 1px solid;
  border-color: #cccccc;
}
.sidebar-is-expanded .l-header {
  padding-left: 220px;
}
.c-search {
  display: flex;
  height: 100%;
  width: 350px;
}
.c-search__input {
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  border-right: 0;
  flex-basis: 100%;
  height: 100%;
  border: 0;
  font-size: 14px;
  padding: 0 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.c-dropdown {
  opacity: 0;
  text-align: left;
  position: absolute;
  flex-direction: column;
  display: none;
  width: 300px;
  top: 30px;
  right: -40px;
  background-color: #fff;
  overflow: hidden;
  min-height: 300px;
  border: 1px solid #d0d0d0;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background-clip: padding-box;
  -webkit-box-shadow: 0px 5px 14px -1px #cecece;
  -moz-box-shadow: 0px 5px 14px -1px #cecece;
  box-shadow: 0px 5px 14px -1px #cecece;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.l-sidebar {
  width: 70px;
  position: absolute;
  z-index: 10;
  left: 0;
  top: 0;
  bottom: 0;
  background: #102c58;
  -webkit-transition: width 0.5s ease-in-out;
  -moz-transition: width 0.5s ease-in-out;
  -ms-transition: width 0.5s ease-in-out;
  -o-transition: width 0.5s ease-in-out;
  transition: width 0.5s ease-in-out;
}
.l-sidebar .logo {
  width: 100%;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #051835;
}
.l-sidebar__content {
  height: 100%;
  position: relative;
}
.sidebar-is-expanded .l-sidebar {
  width: 220px;
}
.c-menu > ul {
  display: flex;
  flex-direction: column;
}
.c-menu > ul .c-menu__item {
  color: #fff;
  max-width: 100%;
  overflow: hidden;
}
.c-menu > ul .c-menu__item__inner {
  display: flex;
  flex-direction: row;
  align-items: center;
  min-height: 60px;
  position: relative;
  cursor: pointer;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item__inner:before {
  position: absolute;
  content: " ";
  min-height: 60px;
  width: 3px;
  left: 0;
  background-color: #5f9cfd;
  opacity: 0;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner {
  border-left-color: #4b7aba;
  background-color: #1e3e6f;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner i {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner .c-menu-item__title span {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item.is-active .c-menu__item__inner:before {
  height: 36px;
  opacity: 1;
}
.c-menu > ul .c-menu__item:not(.is-active):hover .c-menu__item__inner i {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item:not(.is-active):hover .c-menu__item__inner .c-menu-item__title span {
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item i {
  flex: 0 0 70px;
  font-size: 18px;
  font-weight: normal;
  text-align: center;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.c-menu > ul .c-menu__item .c-menu-item__expand {
  position: relative;
  left: 100px;
  padding-right: 20px;
  margin-left: auto;
  -webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -ms-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}
.sidebar-is-expanded .c-menu > ul .c-menu__item .c-menu-item__expand {
  left: 0px;
}
.c-menu > ul .c-menu__item .c-menu-item__title {
  flex-basis: 100%;
  padding-right: 10px;
  position: relative;
  left: 220px;
  opacity: 0;
  -webkit-transition: all 0.7s ease-in-out;
  -moz-transition: all 0.7s ease-in-out;
  -ms-transition: all 0.7s ease-in-out;
  -o-transition: all 0.7s ease-in-out;
  transition: all 0.7s ease-in-out;
}
.c-menu > ul .c-menu__item .c-menu-item__title span {
  font-weight: 400;
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
}
.sidebar-is-expanded .c-menu > ul .c-menu__item .c-menu-item__title {
  left: 0px;
  opacity: 1;
}
.c-menu > ul .c-menu__item .c-menu__submenu {
  background-color: #051835;
  padding: 15px;
  font-size: 12px;
  display: none;
}
.c-menu > ul .c-menu__item .c-menu__submenu li {
  padding-bottom: 15px;
  margin-bottom: 15px;
  border-bottom: 1px solid;
  border-color: #072048;
  color: #5f9cfd;
}
.c-menu > ul .c-menu__item .c-menu__submenu li:last-child {
  margin: 0;
  padding: 0;
  border: 0;
}
main.l-main {
  width: 100%;
  height: 100%;
  padding: 70px 0 0 70px;
  -webkit-transition: padding 0.5s ease-in-out;
  -moz-transition: padding 0.5s ease-in-out;
  -ms-transition: padding 0.5s ease-in-out;
  -o-transition: padding 0.5s ease-in-out;
  transition: padding 0.5s ease-in-out;
}
main.l-main .content-wrapper {
  padding: 25px;
  height: 100%;
}
main.l-main .content-wrapper .page-content {
  border-top: 1px solid #d0d0d0;
  padding-top: 25px;
}
main.l-main .content-wrapper--with-bg .page-content {
  background: #fff;
  border-radius: 3px;
  border: 1px solid #d0d0d0;
  padding: 25px;
}
main.l-main .page-title {
  font-weight: 400;
  margin-top: 0;
  margin-bottom: 25px;
}
.sidebar-is-expanded main.l-main {
  padding-left: 220px;
}
.logo img {
    height: 32px;
    width: 30px;
}
</style>
</head>
<body>

<body class="sidebar-is-reduced">
  <header class="l-header">
    <div class="l-header__inner clearfix">
      <div class="c-header-icon js-hamburger">
        <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
      </div>
      
      <div class="header-icons-group">
        <a href='logout.php'><div class="c-header-icon logout"><i class="fa fa-sign-out"></i></div></a>
      </div>
    </div>
  </header>
  <div class="l-sidebar">
    <div class="logo">
      <img src="img/icon.png">
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <li class="c-menu__item is-active" data-toggle="tooltip" title="Dashboard" id="dashclick" rel="dashboard">
            <div class="c-menu__item__inner"><i class="fa fa-tachometer"></i>
              <div class="c-menu-item__title"><span>Dashboard</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Jobs" id="jobsclick" rel="jobs">
            <div class="c-menu__item__inner"><i class="fa fa-tasks"></i>
              <div class="c-menu-item__title"><span>Jobs</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Calendar" id="calendarclick" rel="calendar">
            <div class="c-menu__item__inner"><i class="fa fa-calendar"></i>
              <div class="c-menu-item__title"><span>Calendar</span></div>
            </div>
          </li>
          <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Messages" id="messagesclick" rel="messages">
            <div class="c-menu__item__inner"><i class="fa fa-comments"></i>
              <div class="c-menu-item__title"><span>Messages</span></div>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</body>
<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <div id="dashboard">
      <h1 class="page-title" name="Dashboardh1">Dashboard</h1>
      <div class="page-content">
        Hello, <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?>!
      </div>
    </div>
    <div id="jobs" style="display: none;">
      <h1 class="page-title" name="Jobsh1">Jobs</h1>
      <div class="page-content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
        in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
        sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
    <div id="calendar" style="display: none;">
      <h1 class="page-title" name="Calendarh1">Calendar</h1>
      <div class="page-content"></div>
    </div>
    <div id="messages" style="display: none;">
      <h1 class="page-title" name="Messagesh1">Messages</h1>
      <div class="page-content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
        in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
        sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
  </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src='https://use.fontawesome.com/2188c74ac9.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>"use strict";

  $(document).ready(function() {
  var calendar = $('#calendar .page-content').fullCalendar({
    eventColor: '#102c58',
    eventTextColor: '#ffffff',
    header: {
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay) {
      var title = prompt("Enter Event Title");
      if(title) {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
          url:"insert.php",
          type:"POST",
          data:{title:title, start:start, end:end},
          success:function() {
            calendar.fullCalendar('refetchEvents');
            alert("Added Successfully");
          }
        })
      }
    },
    editable:true,
    eventResize:function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()  {
          calendar.fullCalendar('refetchEvents');
          alert('Event Update');
        }
      })
    },
    eventDrop:function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function() {
          calendar.fullCalendar('refetchEvents');
          alert("Event Updated");
        }
      });
    },
    eventClick:function(event) {
      if(confirm("Are you sure you want to remove it?")) {
        var id = event.id;
        $.ajax({
          url:"delete.php",
          type:"POST",
          data:{id:id},
          success:function() {
            calendar.fullCalendar('refetchEvents');
            alert("Event Removed");
          }
        })
      }
    },
  });
});

$('.u-list li').on('click', function() {
  var target = $(this).attr('rel');
  $("#"+target).show().siblings("div").hide();
});

var Dashboard = function () {
	var global = {
		tooltipOptions: {
			placement: "right"
		},
		menuClass: ".c-menu"
  };

  var menuChangeActive = function menuChangeActive(el) {
    var hasSubmenu = $(el).hasClass("has-submenu");
    $(global.menuClass + " .is-active").removeClass("is-active");
    $(el).addClass("is-active");

    if (hasSubmenu) {
      $(el).find("ul").slideDown();
    }
  };

  var sidebarChangeWidth = function sidebarChangeWidth() {
    var $menuItemsTitle = $("li .menu-item__title");

    $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
    $(".hamburger-toggle").toggleClass("is-opened");

    if ($("body").hasClass("sidebar-is-expanded")) {
      $('[data-toggle="tooltip"]').tooltip("destroy");
    } 
    else {
      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };

  return {
    init: function init() {
      $(".js-hamburger").on("click", sidebarChangeWidth);

      $(".js-menu li").on("click", function (e) {
        menuChangeActive(e.currentTarget);
      });

      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };
}();

Dashboard.init();

</script>
</body>
</html>
<?php
}
?>