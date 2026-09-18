<?php
/**
 * The main template file
 * Styled according to FIT-TDC format (Ảnh 1)
 */

get_header();

// Helper function to get post image URL
if ( ! function_exists( 'fit_tdc_get_post_image' ) ) {
    function fit_tdc_get_post_image( $post_id ) {
        // 1. Featured image
        if ( has_post_thumbnail( $post_id ) ) {
            $thumb = get_the_post_thumbnail_url( $post_id, 'medium_large' );
            if ( ! empty( $thumb ) ) {
                return $thumb;
            }
        }

        // 2. First image in post content
        $content = get_post_field( 'post_content', $post_id );
        if ( ! empty( $content ) && preg_match( '/<img[^>]+src=[\'"]([^\'"]+)[\'"]/i', $content, $matches ) ) {
            return $matches[1];
        }

        // 3. Any attached media image
        $attachments = get_posts( array(
            'post_type'      => 'attachment',
            'posts_per_page' => 1,
            'post_parent'    => $post_id,
            'post_mime_type' => 'image',
        ) );
        if ( ! empty( $attachments ) ) {
            $att_url = wp_get_attachment_url( $attachments[0]->ID );
            if ( ! empty( $att_url ) ) {
                return $att_url;
            }
        }

        // 4. Default branded fallback SVG for posts without images
        return 'data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22300%22%20height%3D%22180%22%20viewBox%3D%220%200%20300%20180%22%3E%3Crect%20fill%3D%22%23eef2f7%22%20width%3D%22300%22%20height%3D%22180%22%2F%3E%3Ctext%20fill%3D%22%230854a0%22%20font-family%3D%22sans-serif%22%20font-size%3D%2218%22%20font-weight%3D%22bold%22%20x%3D%2250%25%22%20y%3D%2250%25%22%20text-anchor%3D%22middle%22%20dominant-baseline%3D%22middle%22%3EFIT%20-%20TDC%3C%2Ftext%3E%3C%2Fsvg%3E';
    }
}

// Helper to safely render image src attribute
if ( ! function_exists( 'fit_tdc_render_image_src' ) ) {
    function fit_tdc_render_image_src( $url ) {
        if ( strpos( $url, 'data:image/' ) === 0 ) {
            return esc_attr( $url );
        }
        return esc_url( $url );
    }
}
?>

<style>
/* ========================================================
   FIT TDC POSTS LIST - ĐỊNH DẠNG CHUẨN THEO ẢNH 1
   ======================================================== */
.fit-tdc-wrapper {
    max-width: 960px;
    margin: 40px auto 60px auto;
    padding: 0 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #333;
}

/* Danh sách bài viết */
.fit-tdc-results-list {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Khung hiển thị từng bài viết - Chuẩn ảnh 1 */
.fit-tdc-item {
    display: flex;
    align-items: flex-start;
    padding: 24px 0;
    border-bottom: 1px solid #e5e5e5;
    background: transparent;
    transition: background-color 0.2s ease;
}

.fit-tdc-item:first-child {
    padding-top: 0;
}

.fit-tdc-item:last-child {
    border-bottom: none;
}

/* 1. Thumbnail bên trái */
.fit-tdc-thumb {
    flex: 0 0 280px;
    width: 280px;
    height: 175px;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 0;
}

.fit-tdc-thumb a {
    display: block;
    width: 100%;
    height: 100%;
}

.fit-tdc-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.fit-tdc-thumb a:hover img {
    transform: scale(1.03);
}

/* 2. Khối Ngày / Tháng ở giữa */
.fit-tdc-date {
    flex: 0 0 95px;
    width: 95px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    text-align: center;
    margin: 0 22px;
    padding-top: 2px;
}

.fit-tdc-day {
    font-family: Georgia, "Playfair Display", "Times New Roman", serif;
    font-size: 48px;
    line-height: 1;
    font-weight: 400;
    color: #1a1a1a;
}

.fit-tdc-month {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    font-size: 11px;
    font-weight: 700;
    color: #777;
    margin-top: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

/* 3. Khối Tiêu đề & Mô tả bên phải (Có đường kẻ viền dọc ngăn cách) */
.fit-tdc-content {
    flex: 1;
    min-width: 0;
    border-left: 1px solid #dcdcdc;
    padding-left: 24px;
    padding-top: 2px;
    padding-bottom: 2px;
}

.fit-tdc-title {
    margin: 0 0 10px 0;
    font-size: 18px;
    line-height: 1.35;
    font-weight: 700;
}

.fit-tdc-title a {
    color: #0b57a4;
    text-decoration: none;
    text-transform: uppercase;
    display: inline;
    transition: color 0.2s ease;
}

.fit-tdc-title a:hover {
    color: #00356b;
    text-decoration: underline;
}

.fit-tdc-excerpt {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Phân trang */
.fit-tdc-pagination {
    margin-top: 40px;
    text-align: center;
}
.fit-tdc-pagination .nav-links {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}
.fit-tdc-pagination .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 12px;
    border: 1px solid #dcdcdc;
    color: #0b57a4;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    background: #fff;
    border-radius: 3px;
    transition: all 0.2s ease;
}
.fit-tdc-pagination .page-numbers:hover,
.fit-tdc-pagination .page-numbers.current {
    background: #0b57a4;
    color: #fff;
    border-color: #0b57a4;
}

/* Responsive cho tablet & mobile */
@media (max-width: 768px) {
    .fit-tdc-item {
        flex-direction: column;
        align-items: stretch;
    }
    .fit-tdc-thumb {
        width: 100%;
        height: 200px;
        margin-bottom: 16px;
    }
    .fit-tdc-date {
        margin: 0 16px 0 0;
        flex: 0 0 80px;
        width: 80px;
    }
    .fit-tdc-content {
        border-left: 1px solid #dcdcdc;
        padding-left: 16px;
    }
}
</style>

<main id="site-content" class="fit-tdc-wrapper">

    <!-- Danh sách bài viết định dạng chuẩn FIT TDC -->
    <div class="fit-tdc-results-list">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                $post_id    = get_the_ID();
                $post_day   = get_the_date( 'd' );
                $post_month = get_the_date( 'm' );
                $image_url  = fit_tdc_get_post_image( $post_id );

                // Xử lý mô tả ngắn kết thúc bằng [..] y chang ảnh 1
                $excerpt = get_the_excerpt();
                if ( empty( $excerpt ) ) {
                    $excerpt = wp_strip_all_tags( get_the_content() );
                }
                $excerpt = wp_trim_words( $excerpt, 32, '.[..]' );
        ?>
                <!-- Khung item hiển thị y chang Ảnh 1 -->
                <article id="post-<?php echo esc_attr( $post_id ); ?>" class="fit-tdc-item">
                    
                    <!-- 1. Ảnh Thumbnail bên trái -->
                    <div class="fit-tdc-thumb">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <img src="<?php echo fit_tdc_render_image_src( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </a>
                    </div>

                    <!-- 2. Khối Ngày / Tháng ở giữa -->
                    <div class="fit-tdc-date">
                        <span class="fit-tdc-day"><?php echo esc_html( $post_day ); ?></span>
                        <span class="fit-tdc-month">THÁNG <?php echo esc_html( $post_month ); ?></span>
                    </div>

                    <!-- 3. Khối Tiêu đề và Mô tả ngắn bên phải (có đường kẻ dọc ngăn cách) -->
                    <div class="fit-tdc-content">
                        <h2 class="fit-tdc-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="fit-tdc-excerpt">
                            <?php echo esc_html( $excerpt ); ?>
                        </div>
                    </div>

                </article>
        <?php
            endwhile;

            // Phân trang
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&laquo; Trước',
                'next_text' => 'Sau &raquo;',
                'class'     => 'fit-tdc-pagination',
            ) );

        else :
            echo '<p style="text-align: center; font-size: 16px; color: #666; padding: 40px 0;">Không tìm thấy bài viết nào phù hợp.</p>';
        endif;
        ?>
    </div>

</main>

<?php
get_footer();