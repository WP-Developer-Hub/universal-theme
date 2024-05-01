<?php 
/**
 * The template for displaying search filter controls.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<script>
jQuery(document).ready(function($) {
    $('#universal_search_filter_form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form values
        var date = $('#universal_date').val();
        var time = $('#universal_time').val();
        var user = $('#universal_user').val();
        var category = $('#category').val();
        var tag = $('#tag').val();
        var postFormat = $('#post_format').val();
        var sortBy = $('#sort_by').val();
        var sortDir = $('#sort_dir').val();

        // Build URL query string
        var url = '<?php echo esc_url(home_url()); ?>'; // Start with home URL
        url += '/?s=<?php echo esc_attr(get_search_query()); ?>'; // Append search query

        // Add query parameters based on form values
        url = addQueryParameter(url, 'date', date);
        url = addQueryParameter(url, 'time', time);
        url = addQueryParameter(url, 'user', user);
        url = addQueryParameter(url, 'category', category);
        url = addQueryParameter(url, 'tag', tag);
        url = addQueryParameter(url, 'post_format', postFormat);
        url = addQueryParameter(url, 'sort_by', sortBy);
        url = addQueryParameter(url, 'sort_dir', sortDir);

        // Redirect to the constructed URL
        window.location.href = url;
    });

    $('#universal_reset').on('click', function(e) {
        e.preventDefault(); // Prevent default button action
        $('#universal_search_filter_form')[0].reset(); // Reset form fields
    });

    // Helper function to add query parameter to URL
    function addQueryParameter(url, key, value) {
        if (value) {
            return url + '&' + key + '=' + encodeURIComponent(value);
        }
        return url;
    }
});
</script>

<form id="universal_search_filter_form">
    <section id="universal_search_filter_inputs" class="u-flex u-flex-row u-jc-sb u-flex-wrap u-flex-gap-10">
        <input type="date" id="universal_date" name="universal_date" class="u-max-100">

        <input type="time" id="universal_time" name="universal_time" class="u-max-100">

        <select id="universal_user" name="universal_user" class="u-ai-s u-max-100">
        <option value="all">All Users</option>
        <!-- Options populated dynamically based on WordPress users -->
        <?php
            $user_query = new WP_User_Query(array(
                'role' => 'author',
            ));
            if (!empty($user_query->results)) {
                foreach ($user_query->results as $user) {
                    $display_name = $user->display_name;
                    $user_id = $user->ID;
                    echo "<option value='$user_id'>$display_name</option>";
                }
            }
        ?>
        </select>

        <select id="category" name="category" placeholder="Select Category" class="u-max-100">
            <option value="">All</option>
            <?php
            // Fetch categories dynamically
            $categories = get_categories();
            foreach ($categories as $category) {
                // Concatenate post count with category name
                $label = $category->name . ' (' . $category->count . ')';
                echo "<option value='" . $category->term_id . "'>$label</option>";
            }
            ?>
        </select>

        <select id="tag" name="tag" class="u-ac-s u-max-100">
            <option value="">All</option>
            <?php
            // Fetch tags dynamically
            $tags = get_tags();
            foreach ($tags as $tag) {
                // Concatenate post count with tag name
                $label = $tag->name . ' (' . $tag->count . ')';
                echo "<option value='" . $tag->term_id . "'>$label</option>";
            }
            ?>
        </select>

        <select id="post_format" name="post_format" class="u-max-100">
          <option value="">All</option>
          <?php
              // Fetch available post formats
              $post_formats = get_theme_support('post-formats');
              if ($post_formats && is_array($post_formats[0])) {
                  foreach ($post_formats[0] as $post_format) {
          ?>
              <option value='<?php echo esc_attr($post_format); ?>'><?php echo ucfirst($post_format); ?></option>
          <?php
                  }
              }
          ?>
        </select>

        <select id="sort_by" name="sort_by" class="u-max-100">
            <option value="date">Date</option>
            <option value="modified">Last Modified Date</option>
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="popularit">popularit</option>
        </select>

        <select id="sort_dir" name="sort_dir" class="u-max-100">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </section>
    <section id="universal_search_filter_buttons" class="u-grid u-grid-col-2 u-grid-gap-10">
        <input type="reset" id="universal_reset" name="universal_reset" value="Clear Selected Filter">
        <input type="submit" id="universal_submit" name="universal_submit" value="Apply Selected Filter">
    </section>
</form>

