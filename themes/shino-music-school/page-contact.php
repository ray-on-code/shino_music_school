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
				<div class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70" style="border-bottom:1px solid rgba(52,64,47,.08)">
					<span class="w-11 h-11 rounded-xl bg-[#06C755] text-white flex items-center justify-center" style="font:700 11px var(--font-mono)">LINE</span>
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)">LINEで相談</div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">@sora-piano(友だち追加)</div>
					</div>
				</div>
				<div class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70" style="border-bottom:1px solid rgba(52,64,47,.08)">
					<span class="w-11 h-11 rounded-xl bg-brand-green text-white flex items-center justify-center" style="font:700 10px var(--font-mono)">IG</span>
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)">Instagram</div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">@sora_piano_studio</div>
					</div>
				</div>
				<a href="<?php echo esc_url( 'tel:00012345678' ); ?>" class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70">
					<span class="w-11 h-11 rounded-xl bg-brand-dark text-white flex items-center justify-center text-lg">☎</span>
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)"><?php echo esc_html( '000-1234-5678' ); ?></div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)"><?php echo esc_html( '受付 火〜土 10:00–20:00' ); ?></div>
					</div>
				</a>
			</div>
			<!-- 営業時間 -->
			<div class="bg-brand-light rounded-[18px] p-6">
				<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.24em">HOURS</span>
				<div class="mt-3 flex flex-col gap-2">
					<div class="flex justify-between text-brand-text" style="font:400 13px var(--font-sans)">
						<span><?php echo esc_html( '火曜 〜 土曜' ); ?></span>
						<span class="font-semibold"><?php echo esc_html( '10:00 – 20:00' ); ?></span>
					</div>
					<div class="flex justify-between text-[#8a857a]" style="font:400 13px var(--font-sans)">
						<span><?php echo esc_html( '日曜・月曜' ); ?></span>
						<span class="font-semibold"><?php echo esc_html( '定休日' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
