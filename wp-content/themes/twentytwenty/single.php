<?php
/**
 * The template for displaying all single posts
 * Styled according to FIT-TDC format with yellow date clock (Module 6)
 */

get_header();
?>

<style>
/* ========================================================
   FIT TDC SINGLE POST STYLES (MODULE 6 - ĐỒNG HỒ VÀNG)
   ======================================================== */
.fit-tdc-single-wrapper {
    max-width: 850px;
    margin: 35px auto 60px auto;
    padding: 0 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #333;
}

/* Khung tiêu đề và đồng hồ ngày tháng */
.fit-tdc-header-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 12px;
}

.fit-tdc-single-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.3;
    flex: 1;
}

/* Đồng hồ ngày tháng năm màu vàng tròn chuẩn mẫu */
.fit-tdc-date-clock {
    background: #f2ba1d;
    width: 62px;
    height: 62px;
    min-width: 62px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    flex-shrink: 0;
    user-select: none;
}

.fit-tdc-date-clock-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #222;
    font-family: Georgia, "Times New Roman", serif;
}

.fit-tdc-date-fraction {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.fit-tdc-date-day {
    font-size: 13px;
    font-weight: bold;
}

.fit-tdc-date-line {
    display: block;
    width: 18px;
    height: 1px;
    background-color: #222;
    margin: 2px 0;
}

.fit-tdc-date-month {
    font-size: 13px;
    font-weight: bold;
}

.fit-tdc-date-year {
    font-size: 15px;
    font-weight: bold;
    margin-left: 3px;
    line-height: 1;
}

/* Đường kẻ ngang phân cách có mũi nhọn chỉ xuống */
.fit-tdc-divider {
    position: relative;
    border-bottom: 1px solid #e0e0e0;
    margin: 15px 0 25px 0;
}

.fit-tdc-divider::after {
    content: "";
    position: absolute;
    left: 45px;
    bottom: -6px;
    width: 10px;
    height: 10px;
    background: #fff;
    border-right: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    transform: rotate(45deg);
}

/* Nội dung bài viết */
.fit-tdc-body-content {
    font-size: 15.5px;
    color: #333;
    line-height: 1.8;
    text-align: justify;
}

.fit-tdc-body-content p {
    margin-bottom: 18px;
}

/* Đoạn văn đầu tiên (Sapo / tóm tắt) in nghiêng */
.fit-tdc-body-content p:first-of-type {
    font-style: italic;
    color: #555;
    font-size: 15.5px;
    line-height: 1.7;
    margin-bottom: 22px;
}

.fit-tdc-body-content img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin: 15px 0;
}

/* Nguồn bài viết (nếu có đoạn cuối) */
.fit-tdc-source {
    text-align: right;
    font-style: italic;
    color: #666;
    margin-top: 25px;
}

@media (max-width: 600px) {
    .fit-tdc-header-row {
        gap: 15px;
    }
    .fit-tdc-single-title {
        font-size: 22px;
    }
    .fit-tdc-date-clock {
        width: 55px;
        height: 55px;
        min-width: 55px;
    }
    .fit-tdc-date-day,
    .fit-tdc-date-month {
        font-size: 11px;
    }
    .fit-tdc-date-year {
        font-size: 13px;
    }
}
</style>

<main id="site-content" class="fit-tdc-single-wrapper">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            $d = get_the_date( 'd' );
            $m = get_the_date( 'm' );
            $y = get_the_date( 'y' ); // 2 số cuối năm (ví dụ: '18' hoặc '26')
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <!-- 1. Hàng Tiêu đề bên trái & Đồng hồ ngày tháng năm màu vàng bên phải -->
                <div class="fit-tdc-header-row">
                    <h1 class="entry-title fit-tdc-single-title">
                        <?php the_title(); ?>
                    </h1>

                    <!-- Đồng hồ ngày tháng năm màu vàng chuẩn hình tròn có ngày/tháng + năm -->
                    <div class="fit-tdc-date-clock" title="<?php echo esc_attr( get_the_date( 'd/m/Y' ) ); ?>">
                        <div class="fit-tdc-date-clock-inner">
                            <div class="fit-tdc-date-fraction">
                                <span class="fit-tdc-date-day"><?php echo esc_html( $d ); ?></span>
                                <span class="fit-tdc-date-line"></span>
                                <span class="fit-tdc-date-month"><?php echo esc_html( $m ); ?></span>
                            </div>
                            <span class="fit-tdc-date-year"><?php echo esc_html( $y ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- 2. Đường kẻ ngang có mũi nhọn hướng xuống -->
                <div class="fit-tdc-divider"></div>

                <!-- 3. Nội dung chi tiết bài viết -->
                <div class="entry-content fit-tdc-body-content">
                    <?php the_content(); ?>
                </div>

                <?php
                // Điều hướng bài viết trước/sau
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

            </article>

            <?php
        endwhile;
    endif;
    ?>

</main>

<?php
get_footer();
