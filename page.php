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
          </div>
          <div class="post-content">
            <div class="post-body">
              <?php the_content(); ?>
            </div>
          </div>
        </section><!--  /post  -->
        <?php
          endwhile;
        else:
        ?>
        <p>ページはありません。</p>
        <?php
        endif ?>
      </main>
      <?php get_sidebar(); ?>
    <?php get_footer(); ?>
