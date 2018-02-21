<?php /* Template Name: Мои достижения */ ?>
<?php get_header(); ?>
<div class='container'>
    <!--get field data with register post type-->
    <?php $query = new WP_Query( array( 'post_type' => 'my_achievements' ) ); ?>
<?php if ( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th>Вид</th>
                    <th>Задание</th>
                    <th>Затраченное время в часах</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=get_post_meta (get_the_ID(),'select_type', true)?></td>
                    <td><?=get_post_meta (get_the_ID(),'select_task', true)?></td>
                    <td ><?=get_post_meta (get_the_ID(),'select_time', true)?></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
<?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>
</div>;

