<?php
    $html_skills_title = get_field('html_skills_title');
    $html_skills_value = get_field('html_skills_value');
    $css3_skills_title = get_field('css3_skills_title');
    $css3_skills_value = get_field('css3_skills_value');
    $php_skills_title = get_field('php_skills_title');
    $php_skills_value = get_field('php_skills_value');
    $wordpress_skills_title = get_field('wordpress_skills_title');
    $wordpress_skills_value = get_field('wordpress_skills_value');
    $javascript_skills_title = get_field('javascript_skills_title');
    $javascript_skills_value = get_field('javascript_skills_value');
    $git_skills_title = get_field('git_skills_title');
    $git_skills_value = get_field('git_skills_value');
?>

<section class="section has-padding">
    <h2>Skills</h2>
    <div class="progress-bar-content">
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $html_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $html_skills_value; ?>">
                    <?php echo $html_skills_value; ?>
                </div>
            </div>
        </div>
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $css3_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $css3_skills_value; ?>">
                    <?php echo $css3_skills_value; ?>
                </div>
            </div>
        </div>
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $php_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $php_skills_value; ?>">
                    <?php echo $php_skills_value; ?>
                </div>
            </div>
        </div>
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $wordpress_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $wordpress_skills_value; ?>">
                    <?php echo $wordpress_skills_value; ?>
                </div>
            </div>
        </div>
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $javascript_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $javascript_skills_value; ?>">
                    <?php echo $javascript_skills_value; ?>
                </div>
            </div>
        </div>
        <div class="progress-bar">
            <h4 class="progress-bar-title"><?php echo $git_skills_title; ?></h4>
            <div class="progress-basic">
                <div class="progress" style="width:<?php echo $git_skills_value; ?>">
                    <?php echo $git_skills_value; ?>
                </div>
            </div>
        </div>
    </div>
</section>
