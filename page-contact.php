<?php
/*
Template Name: Contact
*/
?>
<?php

$noindexaccess = true;
include('contactFunction.php');
?>

<?php get_header(); ?>
      <main>
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
            <div id="respond"><!-- contactForm -->
              <p>
                <?php echo $response; ?>
              </p>
              <form action="<?php the_permalink(); ?>" method="post">
                <p>
                  <label for="name">
                    Name: <span>*</span> <br>
                    <input type="text" name="message_name" value="<?php echo esc_attr(@$_POST['message_name']); ?>">
                  </label>
                </p>
                <p>
                  <label for="message_email">Email: <span>*</span> <br>
                  <input type="text" name="message_email" value="<?php echo esc_attr(@$_POST['message_email']); ?>">
                  </label>
                </p>
                <p>
                  <label for="message_text">Message: <span>*</span> <br>
                  <textarea type="text" name="message_text"><?php echo esc_textarea(@$_POST['message_text']); ?></textarea>
                  </label>
                </p>
                <p>
                  <label for="message_human">Human Verification: <span>*</span> <br>
                  <input type="text" style="width: 60px;" name="message_human"> + 3 = 5
                  </label>
                </p>
                <input type="hidden" name="submitted" value="1">
                <?php wp_nonce_field( 'my-form', 'myform_nonce' ) ?>
                <p><input type="submit"></p>
              </form>
            </div><!-- contactForm -->
          </section><!--  /post  -->
          <?php
            endwhile;
          else:
          ?>
          <p>ページはありません。</p>
          <?php
          endif ?>
        </main>
      </main>
      <?php get_sidebar(); ?>
    <?php get_footer(); ?>
