<?php
/**
 * Template for page slug "contact".
 *
 * @package shino-music-school
 */

get_header();

// Contact Form 7 のショートコードを設定する。
// WP 管理画面 → お問い合わせ でフォームを作成後、ショートコードに差し替える。
$cf7_shortcode = '[contact-form-7 id="FORM_ID_HERE" title="体験レッスン申込"]';
?>

<main>

<!-- ページヘッダー -->
<section class="relative overflow-hidden" style="background:#7E8B6B;color:#F7F3EA">
	<div class="absolute text-white/10 pointer-events-none select-none" style="top:-50px;right:-10px;font:600 220px var(--font-serif);line-height:1">♪</div>
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(44px,6vw,72px) clamp(18px,4vw,40px)">
		<span class="text-brand-orange" style="font:500 10px var(--font-mono);letter-spacing:.32em">CONTACT &amp; TRIAL</span>
		<h1 class="m-0 mt-2 text-white" style="font:600 clamp(26px,4vw,40px) var(--font-serif);letter-spacing:.1em">お問い合わせ・体験申込</h1>
		<p class="m-0 mt-3 max-w-[560px]" style="font:300 14px/2 var(--font-sans);color:rgba(247,243,234,.9)">
			体験レッスンのお申し込み・ご質問は、下記フォームまたはLINE・お電話でお気軽にどうぞ。無理な勧誘は一切いたしません。
		</p>
	</div>
</section>

<!-- フォーム + 連絡先 -->
<section>
	<div data-stagger class="max-w-[1080px] mx-auto grid items-start gap-[clamp(24px,3vw,40px)]" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px);grid-template-columns:repeat(auto-fit,minmax(300px,1fr))">
		<!-- CF7 フォーム -->
		<div class="bg-white rounded-[22px] flex flex-col gap-4" style="padding:clamp(24px,3vw,38px);box-shadow:0 14px 36px rgba(52,64,47,.08)">
			<h2 class="m-0 text-brand-dark" style="font:600 19px var(--font-serif);letter-spacing:.06em">体験レッスン申込フォーム</h2>
			<?php echo do_shortcode( $cf7_shortcode ); ?>
		</div>

		<!-- 連絡先チャンネル -->
		<div class="flex flex-col gap-3.5">
			<div class="bg-white rounded-[18px] p-6" style="box-shadow:0 10px 28px rgba(52,64,47,.07)">
				<h3 class="m-0 mb-4 text-brand-dark" style="font:600 16px var(--font-serif);letter-spacing:.06em">その他の連絡方法</h3>
				<a href="<?php echo esc_url( 'https://line.me/R/ti/p/@778jwbbj' ); ?>"
				   target="_blank" rel="noopener noreferrer"
				   class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70"
				   style="border-bottom:1px solid rgba(52,64,47,.08)">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/line.svg"
					     alt=""
					     width="44" height="44"
					     class="flex-shrink-0 rounded-xl"
					     style="display:block;width:44px;height:44px">
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)">LINEで相談</div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">@778jwbbj(友だち追加)</div>
					</div>
				</a>
				<a href="<?php echo esc_url( 'https://www.instagram.com/shino_m.studio/' ); ?>"
				   target="_blank" rel="noopener noreferrer"
				   class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70"
				   style="border-bottom:1px solid rgba(52,64,47,.08)">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/instagram.svg"
					     alt=""
					     width="44" height="44"
					     class="flex-shrink-0 rounded-xl"
					     style="display:block;width:44px;height:44px">
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)">Instagram</div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">@shino_m.studio</div>
					</div>
				</a>
				<a href="<?php echo esc_url( 'tel:00012345678' ); ?>" class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/phone.svg"
					     alt=""
					     width="44" height="44"
					     class="flex-shrink-0 rounded-xl"
					     style="display:block;width:44px;height:44px">
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)"><?php echo esc_html( '090-7294-9494' ); ?></div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">場合によっては電話に出られない場合は折り返しいたします。<br>冒頭に「体験レッスンのお問い合わせ」とお伝えください。</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
