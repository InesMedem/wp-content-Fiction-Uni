<?php

get_header();
while (have_posts()) {
    the_post(); 
    pageBanner();?>


    <div class="container container--narrow page-section">

        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail("professorPortraid"); ?>
                </div>
                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php
        $relatedProgram = get_field("related_program");

        if ("related_program") {
            echo '<hr>';
            echo '<h2 class="headline headline--medium"> Subject(s) Tought </h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedProgram as $program) { ?>
                <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
        <?php
            }
        }
        echo "</ul>";
        ?>
    </div>


<?php }
get_footer();

?>