<?php
/**
 * The template for displaying content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( is_search() ) : ?>
        <!-- ================= MODULE 5: KẾT QUẢ TÌM KIẾM ================= -->
        <div class="search-item-row" style="display: flex; align-items: center; gap: 20px; margin-bottom: 25px; border-bottom: 1px solid #e1e1e1; padding-bottom: 20px;">
            <div class="search-item-thumb" style="flex: 0 0 220px;">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) { the_post_thumbnail('medium', array('style' => 'width: 100%; height: 120px; object-fit: cover;')); } ?>
                </a>
            </div>
            <?php
                $post = get_post();
                $post_date = get_the_date('d', $post->ID);
                $post_month = get_the_date('m', $post->ID);
            ?>
            <div class="search-item-date" style="text-align: center; background: #f8f9fa; padding: 10px 15px; border: 1px solid #ddd; min-width: 70px;">
                <span class="day" style="display: block; font-size: 24px; font-weight: bold; color: #222; line-height: 1;"><?php echo $post_date; ?></span>
                <span class="month" style="display: block; font-size: 11px; color: #666; margin-top: 5px; text-transform: uppercase;">THÁNG <?php echo $post_month; ?></span>
            </div>
            <div class="search-item-info" style="flex: 1;">
                <h3 style="margin: 0 0 10px 0; font-size: 18px;">
                    <a href="<?php the_permalink(); ?>" style="color: #004085; text-decoration: none; font-weight: bold;"><?php the_title(); ?></a>
                </h3>
                <div class="excerpt" style="font-size: 14px; color: #555;"><?php the_excerpt(); ?></div>
            </div>
        </div>

    <?php elseif ( is_singular() ) : ?>
        <!-- ================= MODULE 6: CHI TIẾT BÀI VIẾT (DETAIL) ================= -->
        <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
            
            <!-- Khung bao bọc: Tiêu đề bên trái, Huy hiệu màu vàng nằm CHÍNH XÁC SÁT BÊN PHẢI -->
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 30px; border-bottom: 2px solid #eaeaea; padding-bottom: 20px;">
                
                <!-- Tiêu đề bài viết -->
                <h1 class="entry-title" style="margin: 0; font-size: 34px; font-weight: bold; color: #111; line-height: 1.2; font-family: Georgia, serif; flex: 1;">
                    <?php the_title(); ?>
                </h1>

                <?php 
                    $d = get_the_date('d');
                    $m = get_the_date('m');
                    $y = get_the_date('y');
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
            <?php 
            if ( ! is_search() ) {
                get_template_part( 'template-parts/featured-image' );
            }
            ?>

            <!-- Nội dung chi tiết bài viết (Hiện đầy đủ nội dung) -->
            <div class="post-inner" style="margin-top: 25px; font-family: Georgia, serif; font-size: 17px; line-height: 1.7; color: #333;">
                <?php the_content(); ?>
            </div>

            <?php
            get_template_part( 'template-parts/navigation' );

            if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
                ?>
                <div class="comments-wrapper section-inner" style="margin-top: 40px;">
                    <?php comments_template(); ?>
                </div>
                <?php
            }
            ?>

        </div>

    <?php else : ?>
        <!-- ================= GIAO DIỆN MẶC ĐỊNH (Trang chủ / Danh mục) ================= -->
        <?php
        get_template_part( 'template-parts/entry-header' );

        if ( ! is_search() ) {
            get_template_part( 'template-parts/featured-image' );
        }
        ?>

        <div class="post-inner">
            <?php
            if ( is_search() || ! is_singular() ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>
        </div>

        <?php
        if ( is_single() ) {
            get_template_part( 'template-parts/navigation' );
        }

        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
            ?>
            <div class="comments-wrapper section-inner">
                <?php comments_template(); ?>
            </div>
            <?php
        }
        ?>
    <?php endif; ?>

</article><!-- .post -->