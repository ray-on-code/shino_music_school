<?php
/**
 * Template for page slug "access".
 *
 * @package shino-music-school
 */

get_header();
?>

<main>

<!-- ページヘッダー -->
<section class="relative overflow-hidden bg-white">
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.32em">ACCESS</span>
		<h1 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(26px,4vw,40px) var(--font-serif);letter-spacing:.1em">アクセス</h1>
		<p class="m-0 mt-3 text-[#5d584f] max-w-[560px]" style="font:400 14px/2 var(--font-sans)">
			静かな住宅街にある、白い壁の小さな教室。電車でもお車でもお越しいただけます。
		</p>
	</div>
</section>

<!-- 地図プレースホルダー -->
<section data-reveal>
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(36px,4vw,56px) clamp(18px,4vw,40px)">
		<div class="rounded-[22px] bg-brand-light flex items-end justify-end p-4" style="min-height:clamp(280px,40vw,420px);box-shadow:0 16px 40px rgba(52,64,47,.12)">
			<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">Googleマップ等の地図</span>
		</div>
	</div>
</section>

<!-- 詳細情報 -->
<section data-reveal>
	<div class="max-w-[1080px] mx-auto grid items-start gap-[clamp(18px,2.6vw,32px)]" style="padding:0 clamp(18px,4vw,40px) clamp(40px,5vw,64px);grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
		<!-- 住所テーブル -->
		<div data-stagger class="flex flex-col bg-white rounded-[18px] py-2" style="box-shadow:0 10px 28px rgba(52,64,47,.07)">
			<?php
			$details = array(
				array( 'key' => '住所',   'val' => '〒811-1362<br>福岡県福岡市南区長住7丁目8-27' ),
				array( 'key' => '最寄り', 'val' => '最寄りバス停より徒歩すぐ<br>(詳しい経路はお問い合わせください)' ),
				array( 'key' => '駐車場', 'val' => 'あり(2台分)<br>近隣にコインパーキングもございます' ),
				array( 'key' => '受付',   'val' => '火〜土 10:00–20:00<br>定休:日・月' ),
			);
			$last = count( $details ) - 1;
			foreach ( $details as $i => $d ) :
				$border = ( $i < $last ) ? 'border-b' : '';
			?>
			<div class="flex gap-4 <?php echo esc_attr( $border ); ?>" style="padding:18px 24px;border-color:rgba(52,64,47,.08)">
				<span class="text-brand-green flex-shrink-0 pt-0.5" style="font:600 11px var(--font-mono);width:72px"><?php echo esc_html( $d['key'] ); ?></span>
				<span class="text-brand-text" style="font:400 13.5px/1.8 var(--font-sans)"><?php echo wp_kses( $d['val'], array( 'br' => array() ) ); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
		<!-- 外観写真 -->
		<div data-stagger class="grid grid-cols-2 gap-3">
			<div class="bg-brand-light rounded-[16px] flex items-end justify-end p-3" style="aspect-ratio:4/3">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">教室外観</span>
			</div>
			<div class="bg-brand-light rounded-[16px] flex items-end justify-end p-3" style="aspect-ratio:4/3">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">入口・表札</span>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
