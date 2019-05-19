<?php
/**
* The header template file
*
* @file           header.php
* @package        Impulse Press
* @author         Two Impulse
* @copyright      2014 Two Impulse
* @license        license.txt
* @version        Release: 1.3
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<title>
		<?php wp_title('&#124;', true, 'right'); ?>
	</title>
	<?php
	if(impulse_press_options('custom_favicon') !== '')
	{
		?>
		<link rel="icon" type="image/png" href="<?php echo impulse_press_options('custom_favicon'); ?>"/>
		<?php
	}
	else
	{
		?>
		<link rel="shortcut icon" href="<?php echo impulse_press_directory_uri(); ?>/favicon.png"/>
		<?php
	}  ?>

	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>


	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo impulse_press_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo impulse_press_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>"/>

	<?php echo impulse_press_options('tracking_header'); ?>

</head>

<body <?php body_class(); ?>>

	<div id="wrap">
	<header id="q23Head">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<a href="/" title=""><img class="logo img-responsive" src="/thm/usr/img/logo.png" alt="{variable.company.name}" /></a>
					</div>
					<div class="col-sm-8 info">
					</div>
					<nav class="navbar navbar-default fhmm" role="navigation">
		                <div class="navbar-header">
		          			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle">
			          			<span class="icon-bar"></span>
			          			<span class="icon-bar"></span>
			          			<span class="icon-bar"></span>
		          			</button>
						</div>
			            <div id="defaultmenu" class="navbar-collapse collapse">
			                <ul class="nav navbar-nav pull-right">
			                    <li class="active"><a href="/" title="Home">Home</a></li>	
								<li class="dropdown fhmm-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Wineries Tours">Wineries Tours <b class="caret"></b></a>
			                        <ul class="dropdown-menu fullwidth">
			                            <li class="fhmm-content withoutdesc">
			                                <div class="row">
			                                    <div class="col-sm-3">
			                                    	<p class="title">La Rioja</p>
			                                        <ul>
			                                        	<li><a href="/en/show/tour/--a-comprehensive-introduction-to-la-rioja-1/" title="- A comprehensive introduction to La Rioja">- A comprehensive introduction to La Rioja</a></li>
			                                        	<li><a href="/en/show/tour/--la-rioja-premium-tour-2/" title="- La Rioja Premium Tour">- La Rioja Premium Tour</a></li>
			                                        </ul>
			                                    </div>

			                                    <div class="col-sm-3">
			                                    	<p class="title">Ribero del Duero</p>
			                                        <ul>
			                                        	<li><a href="/en/show/tour/rueda---ribera-del-duero-wines-and-castles-5/" title="Rueda - Ribera del Duero Wines and Castles">Rueda - Ribera del Duero Wines and Castles</a></li>
			                                        	<li><a href="/en/show/tour/rueda---ribera-de-duero---cigales---toro-6/" title="Rueda - Ribera de Duero - Cigales - Toro">Rueda - Ribera de Duero - Cigales - Toro</a></li>
			                                        	<li><a href="/en/show/tour/self-drive-tour-ribera-del-duero---rueda-12/" title="Self-Drive Tour Ribera del Duero - Rueda">Self-Drive Tour Ribera del Duero - Rueda</a></li>
			                                        </ul>
			                                    </div>

			                                    <div class="col-sm-3">
			                                    	<p class="title">Jerez-Xérès-Sherry</p>
			                                        <ul>
			                                        	<li><a href="/en/show/tour/sherry-wines-of-the-mediterranean-4/" title="Sherry Wines of the Mediterranean">Sherry Wines of the Mediterranean</a></li>
			                                        	<li><a href="/en/show/tour/andalusian-wine-tour-7/" title="Andalusian Wine Tour">Andalusian Wine Tour</a></li>
			                                        	<li><a href="/en/show/tour/self-drive-andalusia-11/" title="Self Drive Andalusia">Self Drive Andalusia</a></li>
			                                        </ul>
			                                    </div>

			                                    <div class="col-sm-3">
			                                    	<p class="title">Wines & More</p>
			                                        <ul>
			                                        	<li><a href="/en/show/tour/golf-costa-del-sol-10/" title="Golf Costa del Sol">Golf Costa del Sol</a></li>
			                                        </ul>
			                                    </div>
			                                	<div class="clearfix"></div>
			                                </div>
			                            </li>
			                        </ul>
								</li>
								<li class="dropdown fhmm-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Wine Regions <b class="caret"></b></a>
			                        <ul class="dropdown-menu half">
			                            <li class="fhmm-content withoutdesc">
			                                <div class="row">
			                                	<div class="col-sm-12">
			                                		<p class="title">Protected Designation of Origin PDO</p>
			                                	</div>
			                                    <div class="col-sm-4">
			                                        <ul>
				                 						<li><a href="/en/pdo-la-rioja/" title="">La Rioja</a></li>
				                						<li><a href="/en/pdo-ribera-del-duero/" title="">Ribera del Duero</a></li>
				                						<li><a href="/en/pdo-wines-of-the-duero/" title="">Wines of the Duero</a></li>
				                						<li><a href="/en/pdo-navarra-and-pyrenees/" title="">Navarra & Pyrenees</a></li>
	                                                </ul>
			                                    </div>
			                                    <div class="col-sm-4">
			                                        <ul>
				                						<li><a href="/en/pdo-northeast-spain/" title="">Northeast Spain</a></li>
				                						<li><a href="/en/pdo-catalonia/" title="">Catalonia</a></li>
				                						<li><a href="/en/pdo-jerez-sherry/" title="">Jerez - Sherry</a></li>
			                                        </ul>
			                                    </div>
			                                    <div class="col-sm-4">
			                                        <ul>
				                						<li><a href="/en/pdo-malaga-and-sierra/" title="">Malaga & Sierra</a></li>
				                						<li><a href="/en/pdo-galicia/" title="">Galicia</a></li>
				                						<li><a href="/en/pdo-portugal/" title="">Portugal</a></li>               							
			                                        </ul>
			                                    </div>
			                                </div>
			                                <div class="row">
			                                	<div class="col-sm-12">
			                                		<p class="title">Tour Types</p>
			                                	</div>
			                                    <div class="col-sm-6">
			                                        <ul>
														<li><a href="/en/escorted-tour/" title="Escorted Tours">Escorted Tours</a></li>
	                                                </ul>
			                                    </div>
			                                    <div class="col-sm-6">
			                                        <ul>
														<li><a class="last" href="/en/self-drive-tour/" title="Self Drive Tours">Self Drive Tours</a></li>
			                                        </ul>
			                                    </div>
			                                </div>
			                            </li>
			                        </ul>
								</li>
								<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Lifestyle & Advice">Lifestyle & Advice <b class="caret"></b></a>
			                        <ul class="dropdown-menu" role="menu">
										<li><a href="/en/lifestyle-and-advice/" title="Lifestyle & Advice">Lifestyle & Advice</a></li>
										<li><a href="/en/wine-culture-in-iberia/" title="Wine Culture in Iberia">Wine Culture in Iberia</a></li>
										<li><a href="/en/travel-tips/" title="Travel Tips">Travel Tips</a></li>
										<li><a href="/en/how-to-get-there/" title="How to Get There">How to Get There</a></li>	
										<li><a href="/en/faq/" title="FAQ">FAQ</a></li>
										<li><a href="/en/how-to-book/" title="How to Book">How to Book</a></li>
										<li><a class="last" href="/en/gift-voucher/" title="Gift Voucher">Gift Voucher</a></li>
			                        </ul>
								</li>
								<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Travel with SW">Travel with SW <b class="caret"></b></a>
			                        <ul class="dropdown-menu" role="menu">
										<li><a href="/en/our-team/" title="Our Team">Our Team</a></li>
										<li><a href="/en/our-services/" title="Our Services">Our Services</a></li>
										<li><a href="/en/groups-and-clubs/" title="Corporate & Clubs">Corporate & Clubs</a></li>
										<li><a href="/en/why-travel-with-us/" title="Why Travel with Us">Why Travel with Us</a></li>
										<li><a href="/en/inbound-agent-and-dmc/" title="Inbound Agent & DMC">Inbound Agent & DMC</a></li>
										<li><a href="/en/become-a-partner/" title="Become a Partner">Become a Partner</a></li>
										<li><a class="last" href="/en/travel-agents/" title="Travel Agents">Travel Agents</a></li>
										<!--li><a href="/en/responsible-travel/" title="Responsible Travel">Responsible Travel</a></li-->
			                        </ul>
								</li>
			                    <li><a href="/news/" title="">Blog</a></li>	
			                    <li><a href="/en/contact/" title="">Contact</a></li>	
		                	</ul>
						</div>
					</nav>
				</div>
			</div>
		</header>