<?php
    $hero_text = get_field('hero_text');
    $hero_img = get_field('hero_image');
?>

<section class="section hero has-bg" style="background-image:url('<?php echo $hero_img['url']; ?>');">
    <div class="hero-content">
        <div class="hero-text">
            <?php echo $hero_text; ?>
        </div>
        <span class="hero-typed-text"></span>
    </div>
    <div class="scroll-anchor">
        <a class="mouse-scroll" href="#">
            <span class="mouse">
                <span class="mouse-movement">
                </span>
            </span>
            <span class="mouse-message fadeIn">scroll</span>
        </a>
    </div>
</section>
