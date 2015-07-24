<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			Maintenance - GEKKO
		</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="author" content="Daniel McAssey" />
		<meta name="robots" content="all, index, follow" />
		<meta name="revisit-after" content="7 days" />
		<meta name="Rating" content="General" />
		<meta name="description" content="GEKKO URL Shortener" />

		<link rel="shortcut icon" type="image/x-icon" href="/assets/ico/favicon.ico" />

		<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/start.css" />
		<link rel="stylesheet" type="text/css" href="/assets/css/app.css" />
		<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script type="text/javascript">
			(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)
		</script>

	</head>
	<body>

		<div id="content">
			<div class="container-fluid">
				<div id="header">
					<div id="header-logo" class="col-md-12 col-xs-18">
						<a href="/manage/" title="GEKKO URL Shortener"><img src="/assets/img/logo.png" class="img-responsive" alt="GEKKO URL Shortener" /></a>
					</div>
				</div>
				<div class="col-sm-6 col-sm-offset-3">
					<div class="row no-gutter">
						<div id="flash_notice" class="alert-message alert-message-info">
							<h4><i class="fa fa-info-circle"></i>&nbsp;<strong>MAINTENANCE</strong></h4>
							<p>We will be right back!</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="footer" class="container">
			<section class="footer-body">
				<ul class="glokon-footer">
					<li>
						GEKKO URL Shortener
						<?php
							$_version_string = "";
							$_version_file = app_path().'/.version';
							if( file_exists( $_version_file ) ) {
								$_version_string = file_get_contents( $_version_file );
							}
						?>
						<span id="footer-build-information">(<?php if($_version_string != false) { echo '#'.$_version_string; } ?>)</span>
					</li>
					<li>
						<a id="footer-report-problem-link" href="mailto:hello@glokon.me?subject=GEKKO%20Support">Report a problem</a>
					</li>
				</ul>
				<div id="footer-logo"><a href="http://www.glokon.me/" target="_blank">GLOKON</a></div>
			</section>
		</div>

		<script tpye="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script tpye="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script tpye="text/javascript">(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
		<script tpye="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
	</body>
</html>