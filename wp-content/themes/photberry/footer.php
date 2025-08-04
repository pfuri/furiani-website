<?php
    $footer_status = photberry_get_prefered_option('footer_status');
?>

<?php
if ($footer_status !== 'hide') {
    ?>
	<footer class="photberry_footer">
		<div class="photberry_footer_inner photberry_container">
			<div class="photberry_footer_widgets photberry_widgets_in_line<?php echo esc_attr(photberry_get_prefered_option('footer_columns')); ?>">
				<?php dynamic_sidebar('sidebar-footer'); ?>
			</div>
		</div>
    </footer>
    <?php
}
?>
</div><!-- .photberry_site_wrapper -->
<?php
photberry_header_type_check();
photberry_transparent_header_check();
wp_footer(); ?>
</body>
</html>