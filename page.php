<?php
/**
 * CJC Kadence Child — Page Template
 *
 * Immersive page template with hero, styled content area,
 * kapa dividers, and explore-more section.
 *
 * @package CJC_Kadence_Child
 */

defined('ABSPATH') || exit;

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<!-- 1. Page Hero -->
<section class="page-hero <?php echo $featured_img_url ? '' : 'page-hero--no-image'; ?>">
    <?php if ($featured_img_url) : ?>
        <img class="page-hero__image"
             src="<?php echo esc_url($featured_img_url); ?>"
             alt="<?php echo esc_attr(get_the_title()); ?>"
             loading="eager">
    <?php endif; ?>
    <div class="page-hero__overlay" aria-hidden="true"></div>
    <div class="page-hero__content">
        <nav class="page-hero__breadcrumbs" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span class="page-hero__breadcrumb-sep" aria-hidden="true">&rsaquo;</span>
            <span aria-current="page"><?php the_title(); ?></span>
        </nav>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<!-- 2. Kapa Triangle Divider -->
<div class="kapa-divider kapa-divider--triangle" aria-hidden="true"></div>

<!-- 3. Page Content -->
<article class="page-content" data-reveal>
    <div class="page-content__inner">
        <?php the_content(); ?>
    </div>
</article>

<!-- 4. Kapa Wave Divider -->
<div class="kapa-divider kapa-divider--wave" aria-hidden="true"></div>

<!-- 5. Explore More Section -->
<?php
$explore_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);

if ($explore_query->have_posts()) :
    $reveal_delay = 0;
?>
<section class="page-explore">
    <h2 class="homepage-section__header" data-reveal>Explore Our Recipes</h2>
    <div class="homepage-featured__grid page-explore__grid">
        <?php while ($explore_query->have_posts()) : $explore_query->the_post();
            $cats = get_the_category();
            $cat  = !empty($cats) ? $cats[0] : null;
        ?>
        <a class="featured-card" href="<?php the_permalink(); ?>"
           data-reveal data-reveal-delay="<?php echo esc_attr($reveal_delay); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <img class="featured-card__image"
                     src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>"
                     alt="<?php echo esc_attr(get_the_title()); ?>"
                     loading="lazy">
            <?php else : ?>
                <div class="featured-card__placeholder">
                    <span class="featured-card__placeholder-icon" aria-hidden="true">&#127860;</span>
                </div>
            <?php endif; ?>
            <div class="featured-card__body">
                <?php if ($cat) : ?>
                    <span class="featured-card__category"><?php echo esc_html($cat->name); ?></span>
                <?php endif; ?>
                <h3 class="featured-card__title"><?php the_title(); ?></h3>
                <p class="featured-card__excerpt">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 15, '...')); ?>
                </p>
            </div>
        </a>
        <?php $reveal_delay += 100; endwhile; ?>
    </div>
    <div class="homepage-section__footer" data-reveal>
        <a class="homepage-section__view-all" href="<?php echo esc_url(home_url('/recipes/')); ?>">View All Recipes &rarr;</a>
    </div>
</section>
<?php
    wp_reset_postdata();
endif;
?>

<!-- 6. Kapa Zigzag Divider -->
<div class="kapa-divider kapa-divider--zigzag" aria-hidden="true"></div>

<!-- 7. Footer -->
<footer class="cjc-footer lava-rock-bg">
    <div class="cjc-footer__wave-border" aria-hidden="true"></div>
    <p>&copy; <?php echo esc_html(date('Y')); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>">CurtisJCooks.com</a>
        &mdash; Authentic Hawaiian Recipes &amp; Island Flavors
    </p>
</footer>

<?php
    endwhile;
endif;

get_footer();
?>
