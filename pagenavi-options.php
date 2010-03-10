<?php
/*----------------------------------------------------------------*
	WordPress 2.8 Plugin: WP-PageNavi 2.60
	Copyright (c) 2009 Lester "GaMerZ" Chan

	File Written By:
	- Lester "GaMerZ" Chan
	- http://lesterchan.net

	File Information:
	- Page Navigation Options Page
	- wp-content/plugins/wp-pagenavi/pagenavi-options.php
 *----------------------------------------------------------------*/

$pagenavi_options = get_option('pagenavi_options');

var_dump('huh');
?>

<div class="wrap">
<form method="post" action="options.php">

	<?php screen_icon(); ?>
	<h2><?php _e('Page Navigation Options', 'wp-pagenavi'); ?></h2>
	<h3><?php _e('Page Navigation Text', 'wp-pagenavi'); ?></h3>

	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Number Of Pages', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[pages_text]" value="<?php echo esc_html($pagenavi_options['pages_text']); ?>" size="50" /><br />
				%CURRENT_PAGE% - <?php _e('The current page number.', 'wp-pagenavi'); ?><br />
				%TOTAL_PAGES% - <?php _e('The total number of pages.', 'wp-pagenavi'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Current Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[current_text]" value="<?php echo esc_html($pagenavi_options['current_text']); ?>" size="30" /><br />
				%PAGE_NUMBER% - <?php _e('The page number.', 'wp-pagenavi'); ?><br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[page_text]" value="<?php echo esc_html($pagenavi_options['page_text']); ?>" size="30" /><br />
				%PAGE_NUMBER% - <?php _e('The page number.', 'wp-pagenavi'); ?><br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For First Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[first_text]" value="<?php echo esc_html($pagenavi_options['first_text']); ?>" size="30" /><br />
				%TOTAL_PAGES% - <?php _e('The total number of pages.', 'wp-pagenavi'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Last Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[last_text]" value="<?php echo esc_html($pagenavi_options['last_text']); ?>" size="30" /><br />
				%TOTAL_PAGES% - <?php _e('The total number of pages.', 'wp-pagenavi'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Next Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[next_text]" value="<?php echo esc_html($pagenavi_options['next_text']); ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Previous Page', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[prev_text]" value="<?php echo esc_html($pagenavi_options['prev_text']); ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Next ...', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[dotright_text]" value="<?php echo esc_html($pagenavi_options['dotright_text']); ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Text For Previous ...', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[dotleft_text]" value="<?php echo esc_html($pagenavi_options['dotleft_text']); ?>" size="30" />
			</td>
		</tr>
	</table>
	<h3><?php _e('Page Navigation Options', 'wp-pagenavi'); ?></h3>
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><?php _e('Use pagenavi.css?', 'wp-pagenavi'); ?></th>
			<td>
				<input type="checkbox" name="pagenavi_options[use_css]" value="1" <?php checked('1', $pagenavi_options['use_css']); ?>>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Page Navigation Style', 'wp-pagenavi'); ?></th>
			<td>
				<select name="pagenavi_options[style]" size="1">
					<option value="1"<?php selected('1', $pagenavi_options['style']); ?>><?php _e('Normal', 'wp-pagenavi'); ?></option>
					<option value="2"<?php selected('2', $pagenavi_options['style']); ?>><?php _e('Drop Down List', 'wp-pagenavi'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Number Of Pages To Show?', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[num_pages]" value="<?php echo esc_html($pagenavi_options['num_pages']); ?>" size="4" />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Always Show Page Navigation?', 'wp-pagenavi'); ?></th>
			<td>
				<input type="checkbox" name="pagenavi_options[always_show]" value="1" <?php checked($pagenavi_options['always_show']); ?>>
				<?php _e("Show navigation even if there's only one page", 'wp-pagenavi'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Number Of Larger Page Numbers To Show?', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[num_larger_page_numbers]" value="<?php echo esc_html($pagenavi_options['num_larger_page_numbers']); ?>" size="4" />
				<br />
				<?php _e('Larger page numbers are in additional to the default page numbers. It is useful for authors who is paginating through many posts.', 'wp-pagenavi'); ?>
				<br />
				<?php _e('For example, WP-PageNavi will display: Pages 1, 2, 3, 4, 5, 10, 20, 30, 40, 50', 'wp-pagenavi'); ?>
				<br />
				<?php _e('Enter 0 to disable.', 'wp-pagenavi'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Show  Larger Page Numbers In Multiples Of:', 'wp-pagenavi'); ?></th>
			<td>
				<input type="text" name="pagenavi_options[larger_page_numbers_multiple]" value="<?php echo esc_html($pagenavi_options['larger_page_numbers_multiple']); ?>" size="4" />
				<br />
				<?php _e('If mutiple is in 5, it will show: 5, 10, 15, 20, 25', 'wp-pagenavi'); ?>
				<br />
				<?php _e('If mutiple is in 10, it will show: 10, 20, 30, 40, 50', 'wp-pagenavi'); ?>
			</td>
		</tr>
	</table>

	<h3>Customize the output HTML details</h3><?php _e('', 'wp-pagenavi'); ?>

	<table class="form-table">

		<tr>
			<th><?php _e('Wrapping HTML', 'wp-pagenavi'); ?></th>
			<td><input type="text" name="pagenavi_options[wrapper]" value="<?php echo esc_html($pagenavi_options['wrapper']); ?>" class="regular-text" />
				<div class="description"><?php _e('Wrapping HTML for whole pagination.', 'wp-pagenavi'); ?></div>
				<div class="description">You must use <code>%s</code> code to mark the place for inner content. Example (default): <code>&lt;div class=&quot;wp-pagenavi&quot;&gt;%s&lt;/div&gt;&lt;/code&gt;</div></td>
		</tr>
		<tr>
			<th><?php _e('Single item HTML (except the current)', 'wp-pagenavi'); ?></th>
			<td><input type="text" name="pagenavi_options[item]" value="<?php echo esc_html($pagenavi_options['item']); ?>" class="regular-text" />
				<div class="description"><?php _e('You must use <code>%s</code> code to mark the place for current page number. Example (default):', 'wp-pagenavi'); ?> <code>&lt;a href=&quot;%1$s&quot; class=&quot;page&quot;&gt;%2$s&lt;/a&gt;</code></div></td>
		</tr>
		<tr>
			<th><?php _e('Current item HTML', 'wp-pagenavi'); ?></th>
			<td><input type="text" name="pagenavi_options[item_current]" value="<?php echo esc_html($pagenavi_options['item_current']); ?>" class="regular-text" />
				<div class="description"><?php _e('You must use <code>%s</code> code to mark the place for current page number. Example (default): ', 'wp-pagenavi'); ?><code>&lt;span class=&quot;current&quot;&gt;%s&lt;/span&gt;</code></div></td>
		</tr>

	</table>


	<p class="submit">
		<?php wp_nonce_field('update-options') ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="pagenavi_options" />
		<input type="submit" class="button" value="<?php _e('Save Changes'); ?>" />
	</p>

</form>
</div>
