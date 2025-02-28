<!DOCTYPE html>
<html>
  <head>
	<!-- Technical SEO -->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="https://example.com/page">
    <meta name="robots" content="none">
	<?php if($seo_social_data['created_at'] != ''){ ?>
	<meta property="article:published_time" content="<?php echo $seo_social_data['created_at']; ?>" />
	<?php } ?>
	<?php if($seo_social_data['created_at'] != ''){ ?>
	<meta property="article:modified_time" content="<?php echo $seo_social_data['created_at']; ?>" />
	<?php } ?>
	
	<!-- Basic SEO Meta Tags -->
	<title><?php echo $seo_social_data['title']; ?><?php if($seo_social_data['title'] !=""){echo ' | ';}?><?php echo DEFAULT_TITLE; ?></title>
    <meta name="description" content="<?php echo substr($seo_social_data['content_intro'] ?? '',0,160); ?>">
	<meta name="keywords" content="">
	<meta name="author" content="DevCraft Solutions">
	<meta name="company" content="DevCraft Solutions Inc.">
	<meta name="industry" content="Web Development">
	
	<!-- Open Graph Tags for Facebook -->
	<?php if(!isset($_REQUEST['alias'])){ $_REQUEST['alias'] = ""; } ?>
	<meta property="og:site_name" content="">
	<meta property="og:url" content="<?php echo get_URL(); ?><?php echo $_REQUEST['alias']; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $seo_social_data['title']; ?>" />
	<meta property="og:description" content="<?php echo $seo_social_data['content_intro']; ?>" />
	<meta property="og:site_name" content="<?php echo DEFAULT_AUTHOR; ?>" />
	<meta property="og:image" content="<?php echo blog_images_Url() ?><?php echo $seo_social_data['image_primary']; ?>" />
	<meta property="fb:app_id" content="">
	<meta property="og:locale" content="en_US" />
	<meta property="og:image:width" content="">
	<meta property="og:image:height" content="">
	<meta property="og:image:alt" content="">
	<meta property="og:updated_time" content="2017-11-27T00:32:23+00:00" />

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@DevCraft">
    <meta name="twitter:title" content="Professional Web Design Services">
    <meta name="twitter:description" content="Create stunning websites that drive results">
    <meta name="twitter:image" content="https://example.com/images/preview.jpg">
    
	<!-- Pinterest Meta Tags -->
    <meta name="p:domain_verify" content="pinterest-verification-code">
    <meta property="og:price:amount" content="2999.00">
    <meta property="og:price:currency" content="USD">
    <meta name="pinterest:description" content="Create your dream website with our professional web design services #webdesign #business">
    <meta name="pinterest:media" content="https://example.com/images/pinterest-vertical.jpg">
	
    <!-- LinkedIn Meta Tags -->
    <meta name="company" content="DevCraft Solutions Inc.">
    <meta name="industry" content="Web Development">

	<!-- Instagram Meta Tags -->
    <meta property="instapp:owner_id" content="12345678">
    <meta property="instapp:hashtags" content="#webdesign #digitalmarketing">
	
	<!-- Google Tag Manager -->
	<?php if (defined('GMT') && GMT !== '') { ?>
    <script>
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo GTM; ?>'); // GTM var in config file
    </script>
	<?php } ?>

	<!-- Google fonts-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
	<!-- Stylesheets -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_Url().''.APP_DIRECTORY; ?>bottle_cap_Assets/css/custom.css" as="style">
	<?php if($_REQUEST['alias'] = "") { ?>
	<link rel="stylesheet" href="<?php echo get_Url().''.APP_DIRECTORY; ?>bottle_cap_Assets/css/hero_slider90.css" as="style">
	<?php } ?>
	
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="<?php echo images_Url(); ?>favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo images_Url(); ?>favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo images_Url(); ?>favicon-16x16.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo images_Url(); ?>apple-touch-icon.png">


 </head>
 <body class="<?php echo DARK_LIGHT_MODE; ?>">
	<?php if (defined('GMT') && GMT !== '') { ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo GTM; ?>" <!-- GTM var in config file -->
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php } ?>