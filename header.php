<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Content-Language" content="en">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500;700&family=Raleway:wght@600;900&display=swap" rel="stylesheet">
    <title><?php echo wp_title(); ?></title>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <header>
        <div class="container">
            <div class="cols">
                <div class="col is-12">
                    <?php get_template_part('includes/logo'); ?>
                </div>
            </div>
        </div>
    </header>