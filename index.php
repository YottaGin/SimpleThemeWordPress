<?php get_header(); ?>
      <main>
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
         ?>
        <section class="post">
          <div class="post-header">
            <h2>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="post-meta">
              <?php echo get_the_date(); ?> 【<?php the_category(', '); ?>】
            </div>
          </div>
          <div class="post-content">
            <div class="post-body">
              <?php the_excerpt(); ?>
            </div>
          </div>
        </section><!--  /post  -->
        <?php
          endwhile;
        else:
        ?>
        <p>記事はありません。</p>
        <?php
        endif ?>
        <div class="navigation">
          <div class="prev"><?php previous_posts_link(); ?></div>
          <div class="next"><?php next_posts_link(); ?></div>
        </div><!--  /navigation  -->
      </main>
      <?php get_sidebar(); ?>
    <?php get_footer(); ?>
