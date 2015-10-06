<?php 
session_start();

if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Welcome home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="initial-scale = 1.0, user-scalable = no">

	<link rel="stylesheet" type="text/css" href="css/semantic.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

<div class="user-toolbar">

	<!-- stats n shit -->
	<div class="stats-toolbar">
		<div class="ui tiny statistic inverted"><div class="value" id="taskCount">?</div><div class="label">Tasks</div></div>
		<div class="ui tiny statistic inverted"><div class="value" id="moneyCount">?</div><div class="label">Money</div></div>
		<div class="ui tiny statistic inverted"><div class="value" id="emailCount">?</div><div class="label">Emails</div></div>
	</div>

	<!-- user management -->
	<div class="user-info">
		<div class="ui dropdown">
			<i class="dropdown icon"></i>
			<div class="text">
		  		<?php echo $_SESSION['username']; ?>
		  		<i class="user icon"></i>
			</div>
			<div class="menu">
				<div class="item">Sign out</div>
				<div class="item">Manage details</div>
			</div>
		</div>
</div>
</div>

	<!-- PANEL ONE -->
	<div class="area" id="home">
		<div class="ui raised segment" id="welcome">

			<div class="flex-item one-half"><div class="padding">
                <h5 class="ui horizontal header divider"><i class="bar chart icon"></i>Ongoing</h5>

  			</div></div>


		</div>

		<div id="tasks" class="ui stacked segment">

			<div id="calendar" class="flex-item one-half"><div class="padding">
			    <h5 class="ui horizontal header divider"><i class="calendar icon"></i>Calendar</h5>
			    <div class="modal-calendar"></div>
			    <!--
			    <div id="messages"></div>
				<div class="calendar" id="cost-calendar"></div>
				<div class="information" id="information-panel"></div>
				-->
			</div></div>

			<div id="todo" class="flex-item one-half"><div class="padding">
			    <h5 class="ui horizontal header divider"><i class="checkmark box icon"></i>Tasks</h5>
			</div></div>

		</div>
		<div id="border" class="ui stacked segment">
			<div class="quote feed" id="bash"><h3>Random Bash Quote</h3></div>
		</div>
	</div>
	<!-- END PANEL -->

	<!-- PANEL TWO -->
	<div class="area" id="gmail"><div id="gmailContent" class="ui stacked segment">
		<h2>Your emails <span class="integer_count"></span></h2>
		<div id="login_container" class="pre_auth">Please <a href="#" id="login_link">authorise</a> Gmail to use this app.</div>
	</div></div>
	<!-- END PANEL -->

	<!-- PANEL THREE -->
	<div class="area" id="news"><div id="border" class="ui stacked segment">

 		<div class="resizable-grid">
      		<div class="news-item"><header>BBC News</header><div id="bbc" class="ui selection list feed"></div></div>
      		<div class="news-item"><header>Gamespot</header><div id="gamespot" class="ui selection list feed"></div></div>
      		<div class="news-item"><header>Clients from Hell</header><div id="clients" class="ui selection list feed"></div></div>
      		<div class="news-item"><header>Reddit</header><div id="reddit" class="ui selection list feed"></div></div>
      		<div class="news-item"><header>Preshing on Programming</header><div id="preshing" class="ui selection list feed"></div></div>
      		<div class="news-item"><header>Coding Horror</header><div id="coding" class="ui selection list feed"></div></div>
  		</div>

	</div></div>
	<!-- END PANEL -->

	<!-- FIXED NAVIGATION -->
	<div class="ui three item orange inverted menu fixed bottom">
		<a class="active item" id="home_link">Home</a>
		<a class="item" id="gmail_link">Emails</a>
		<a class="item" id="news_link">News Feeds</a>
	</div>
	<!-- END NAVIGATION -->

<!-- DEPENDENCIES -->
<script type="text/javascript" src="js/libraries/jquery.js"></script>
<script type="text/javascript" src="js/libraries/jquery-ui.js"></script>
<script type="text/javascript" src="js/libraries/shapeshift.js"></script>
<script type="text/javascript" src="js/libraries/smoothwheel.js"></script>
<script type="text/javascript" src="js/libraries/jcarousel.js"></script>
<script type="text/javascript" src="js/libraries/semantic.js"></script>
<script type="text/javascript" src="js/libraries/underscore.js"></script>
<script type="text/javascript" src="js/libraries/moment.js"></script>
<script type="text/javascript" src="js/libraries/form.js"></script>
<script type="text/javascript" src="js/libraries/google.js"></script>
<script type="text/javascript" src="js/libraries/encoding.js"></script>
<script type="text/javascript" src="js/modules/core.js"></script>
<script type="text/javascript" src="js/modules/interaction.js"></script>
<script type="text/javascript" src="js/modules/gmail.js"></script>
<script type="text/javascript" src="js/modules/feeds.js"></script>
<script type="text/javascript" src="js/modules/todo.js"></script>
<script type="text/javascript" src="js/modules/calendar-module.js"></script>
<script type="text/javascript" src="js/modules/display.js"></script>
<script src="https://apis.google.com/js/client.js?onload=OnLoadCallback"></script>
<script type="text/javascript">
	Calendar.initialise();
</script>

</body>
</html>