<?php
/**
 * The template for displaying single posts and pages
 */

get_header();
?>

<main id="site-content">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="padding: 40px 0;">
                
                <div style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
                    
                    <!-- Khung chứa Tiêu đề bên trái và Huy hiệu tròn màu vàng sát bên phải -->
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 30px; border-bottom: 2px solid #eaeaea; padding-bottom: 20px;">
                        
                        <!-- Tiêu đề bài viết -->
                        <h1 class="entry-title" style="margin: 0; font-size: 34px; font-weight: bold; color: #111; line-height: 1.2; font-family: Georgia, serif; flex: 1;">
                            <?php the_title(); ?>
                        </h1>

                        <?php 
                            $d = get_the_date('d');
                            $m = get_the_date('m');
                            $y = get_the_date('y'); // Lấy 2 số cuối năm (ví dụ: '18 hoặc '26)
                        ?>

                        <!-- Huy hiệu tròn màu vàng chuẩn mẫu -->
                        <div class="date-badge-circle" style="background-color: #f1c40f; width: 75px; height: 75px; min-width: 75px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
                            <div style="text-align: center; color: #222; font-family: Georgia, serif; line-height: 1.1;">
                                <span style="font-size: 18px; font-weight: bold; display: block;"><?php echo $d; ?></span>
                                <div style="border-top: 1.5px solid #222; width: 20px; margin: 2px auto;"></div>
                                <span style="font-size: 15px; font-weight: bold; display: block;"><?php echo $m; ?></span>
                            </div>
                            <span style="font-size: 15px; font-weight: bold; color: #222; font-family: Georgia, serif; margin-left: 3px; margin-top: 2px;">'<?php echo $y; ?></span>
                        </div>

                    </div>

                    <!-- Ảnh đại diện bài viết -->
                    <?php get_template_part( 'template-parts/featured-image' ); ?>

                    <!-- Nội dung chi tiết bài viết -->
                    <div class="post-inner" style="margin-top: 25px; font-family: Georgia, serif; font-size: 17px; line-height: 1.7; color: #333;">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    // Điều hướng bài viết
                    get_template_part( 'template-parts/navigation' );

                    // Khung bình luận
                    if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
                        ?>
                        <div class="comments-wrapper section-inner" style="margin-top: 40px;">
                            <?php comments_template(); ?>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </article>

            <?php
        endwhile;
    endif;
    ?>

</main>

<?php
get_footer();