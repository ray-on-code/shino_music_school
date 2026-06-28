<?php
/**
 * @package shino-music-school
 */
?>
<!-- ===== FOOTER ===== -->
<footer class="relative overflow-hidden" style="background:#7E8B6B;color:#F7F3EA">

	<div class="relative max-w-[1180px] mx-auto grid gap-10"
	     style="padding:clamp(44px,5vw,64px) clamp(18px,4vw,40px) 28px;grid-template-columns:repeat(auto-fit,minmax(260px,1fr))">
		<!-- ロゴ・住所 -->
		<div class="flex flex-col gap-4">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
			     alt="しのはら音楽教室"
			     class="self-start"
			     style="height:30px;width:auto;display:block">
			<div style="font:300 12.5px/2 var(--font-sans);color:rgba(247,243,234,.9)">
				〒811-1362<br>
				福岡県福岡市南区長住7丁目8-27<br>
				受付 火〜土 10:00–20:00
			</div>
			<div class="flex gap-2">
				<a href="<?php echo esc_url( 'https://www.instagram.com/sora_piano_studio/' ); ?>"
				   target="_blank" rel="noopener noreferrer"
				   aria-label="Instagram"
				   class="transition-opacity hover:opacity-80">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/instagram.svg"
					     alt=""
					     width="40" height="40"
					     style="display:block;width:40px;height:40px">
				</a>
				<a href="<?php echo esc_url( 'https://line.me/R/ti/p/@sora-piano' ); ?>"
				   target="_blank" rel="noopener noreferrer"
				   aria-label="LINE"
				   class="transition-opacity hover:opacity-80">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/line.svg"
					     alt=""
					     width="40" height="40"
					     style="display:block;width:40px;height:40px">
				</a>
			</div>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
			   class="self-start flex items-center gap-2 bg-brand-orange text-white no-underline rounded-full text-[13px] font-bold transition-colors hover:bg-[#c96f42]"
			   style="padding:13px 24px;box-shadow:0 8px 20px rgba(214,122,76,.32)">
				体験レッスン申込<span>→</span>
			</a>
		</div>
		<!-- ナビリンク -->
		<div class="flex md:justify-end">
			<div class="grid gap-y-2.5" style="grid-template-columns:1fr 1fr;column-gap:48px">
				<?php
				$footer_items = array(
					array( 'url' => home_url( '/lessons/' ), 'label' => 'レッスン案内',   'en' => 'LESSON' ),
					array( 'url' => home_url( '/gallery/' ), 'label' => '発表会・生徒の声', 'en' => 'GALLERY' ),
					array( 'url' => home_url( '/access/' ),  'label' => 'アクセス',       'en' => 'ACCESS' ),
					array( 'url' => home_url( '/price/' ),   'label' => '料金',           'en' => 'PRICE' ),
					array( 'url' => home_url( '/contact/' ), 'label' => 'お問い合わせ',   'en' => 'CONTACT' ),
				);
				foreach ( $footer_items as $item ) :
				?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"
				   class="flex flex-col no-underline transition-opacity hover:opacity-100"
				   style="color:rgba(247,243,234,.75);opacity:.75">
					<span class="text-[9px]"
					      style="font-family:var(--font-mono);letter-spacing:.2em;opacity:.7"><?php echo esc_html( $item['en'] ); ?></span>
					<span class="text-[13px] font-medium mt-0.5"><?php echo esc_html( $item['label'] ); ?></span>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="relative text-center"
	     style="border-top:1px solid rgba(247,243,234,.2);padding:18px 20px;font:400 11px var(--font-mono);letter-spacing:.1em;color:rgba(247,243,234,.75)">
		© しのはら音楽教室 / shino-music.com
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
