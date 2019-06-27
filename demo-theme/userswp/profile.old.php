<h2>before before</h2>
<?php do_action('uwp_template_before', 'profile'); ?>
<h2>after before</h2>

<?php
  $url_type = apply_filters('uwp_profile_url_type', 'slug');
  $enable_profile_body   = uwp_get_option('enable_profile_body', false);

  $author_slug = get_query_var('uwp_profile');
  if ($url_type == 'id') {
      $user = get_user_by('id', $author_slug);
  } else {
      $user = get_user_by('slug', $author_slug);
  }
  $profile_access = apply_filters('uwp_profile_access', true, $user);
?>

<div class="uwp-content-wrap">
    <?php if ($profile_access) {
        ?>
        <?php do_action('uwp_template_display_notices', 'profile'); ?>
        <?php if ($enable_profile_body == '1') { ?>
            <div class="uwp-profile-main">
                <div class="uwp-profile uwp-profile-side">
                  <?php
                    do_action('uwp_profile_title', $user );
                    //do_action('uwp_profile_social', $user );
                    //do_action('uwp_profile_bio', $user );
                    //do_action('uwp_profile_buttons', $user );
                  ?>
                </div>
                <?php do_action('uwp_profile_content', $user); ?>
            </div>
        <?php } ?>
        <?php
    } else {
        do_action('uwp_profile_access_denied', $user);
    } ?>
</div>


<h2>before after</h2>
<?php do_action('uwp_template_after', 'profile'); ?>
<h2>after after</h2>
