<?php
/**
 * Template for page slug "price".
 *
 * @package shino-music-school
 */

get_header();
?>

<main>

<!-- ページヘッダー -->
<section class="relative overflow-hidden bg-white">
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.32em">PRICE</span>
		<h1 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(26px,4vw,40px) var(--font-serif);letter-spacing:.1em">料金</h1>
		<p class="m-0 mt-3 text-[#5d584f] max-w-[560px]" style="font:400 14px/2 var(--font-sans)">
			月謝制のわかりやすい料金設定。表示はすべて税込みです。(金額は仮の参考価格です)
		</p>
	</div>
</section>

<!-- 体験レッスン無料ハイライト -->
<section data-reveal>
	<div class="max-w-[1000px] mx-auto" style="padding:clamp(28px,3vw,40px) clamp(18px,4vw,40px) 0">
		<div class="bg-brand-dark rounded-[20px] flex flex-wrap items-center justify-between gap-4" style="padding:clamp(26px,3.4vw,40px);box-shadow:0 16px 40px rgba(52,64,47,.16)">
			<div>
				<span class="text-brand-orange" style="font:500 10px var(--font-mono);letter-spacing:.3em">TRIAL LESSON</span>
				<h2 class="m-0 mt-2 mb-1 text-white" style="font:600 clamp(20px,2.6vw,26px) var(--font-serif);letter-spacing:.06em">体験レッスン</h2>
				<p class="m-0 text-white/80" style="font:300 12.5px var(--font-sans)">約30分・お一人さま1回限り</p>
			</div>
			<div class="flex items-baseline gap-1.5">
				<span class="text-white" style="font:700 clamp(34px,5vw,52px) var(--font-serif);line-height:1">無料</span>
				<span class="text-white/80" style="font:400 13px var(--font-sans)">/ 0円</span>
			</div>
		</div>
	</div>
</section>

<!-- 料金テーブル -->
<section data-reveal>
	<div class="max-w-[1000px] mx-auto" style="padding:clamp(30px,4vw,48px) clamp(18px,4vw,40px)">
		<div class="bg-white rounded-[20px] overflow-hidden" style="box-shadow:0 12px 32px rgba(52,64,47,.08)">
			<div class="overflow-x-auto">
				<table class="w-full border-collapse" style="min-width:520px">
					<thead>
						<tr class="text-white" style="background:var(--color-brand-green)">
							<th scope="col" class="text-left" style="padding:16px 22px;font:600 13px var(--font-sans);letter-spacing:.04em">コース</th>
							<th scope="col" class="text-center" style="padding:16px 14px;font:600 13px var(--font-sans)">回数 / 月</th>
							<th scope="col" class="text-center" style="padding:16px 14px;font:600 13px var(--font-sans)">1回</th>
							<th scope="col" class="text-right" style="padding:16px 22px;font:600 13px var(--font-sans)">月謝(税込)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$prices = array(
							array( 'course' => '子どもコース',      'freq' => '月4回', 'time' => '30分', 'fee' => '¥8,000',  'bg' => '' ),
							array( 'course' => '大人コース',          'freq' => '月2回', 'time' => '45分', 'fee' => '¥7,000',  'bg' => '#FBF8F0' ),
							array( 'course' => '初心者コース',        'freq' => '月3回', 'time' => '40分', 'fee' => '¥9,000',  'bg' => '' ),
							array( 'course' => '再開・経験者コース', 'freq' => '月4回', 'time' => '45分', 'fee' => '¥12,000', 'bg' => '#FBF8F0' ),
						);
						foreach ( $prices as $p ) :
							$bg_style = $p['bg'] ? 'background:' . $p['bg'] . ';' : '';
						?>
						<tr style="border-bottom:1px solid rgba(52,64,47,.09);<?php echo esc_attr( $bg_style ); ?>">
							<td class="text-brand-dark" style="padding:18px 22px;font:600 14px var(--font-sans)"><?php echo esc_html( $p['course'] ); ?></td>
							<td class="text-center text-[#5d584f]" style="padding:18px 14px;font:400 13px var(--font-sans)"><?php echo esc_html( $p['freq'] ); ?></td>
							<td class="text-center text-[#5d584f]" style="padding:18px 14px;font:400 13px var(--font-sans)"><?php echo esc_html( $p['time'] ); ?></td>
							<td class="text-right text-brand-dark" style="padding:18px 22px;font:700 15px var(--font-serif)"><?php echo esc_html( $p['fee'] ); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- 諸費用カード -->
		<div data-stagger class="grid gap-3.5 mt-4" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr))">
			<?php
			$fees = array(
				array( 'en' => 'ENTRY FEE',  'label' => '入会金',  'value' => '¥5,000' ),
				array( 'en' => 'MATERIALS',  'label' => '教材費',  'value' => '実費' ),
				array( 'en' => 'EVENT',      'label' => '発表会費', 'value' => '別途' ),
			);
			foreach ( $fees as $f ) :
			?>
			<div class="bg-white rounded-[14px] p-5">
				<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.2em"><?php echo esc_html( $f['en'] ); ?></span>
				<div class="flex items-baseline gap-2 mt-1.5">
					<span class="text-brand-dark" style="font:600 16px var(--font-sans)"><?php echo esc_html( $f['label'] ); ?></span>
					<span class="text-brand-dark ml-auto" style="font:700 18px var(--font-serif)"><?php echo esc_html( $f['value'] ); ?></span>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<p class="mt-4 mb-6 text-[#8a857a]" style="font:400 11.5px/1.8 var(--font-sans)">
			※ 上記は仮の参考価格です。きょうだい割引・年間費用など、詳しくは体験レッスン時にご案内します。
		</p>
		<div class="text-center">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
			   class="inline-flex items-center gap-2 bg-brand-orange text-white no-underline rounded-full font-bold transition-colors hover:bg-[#c96f42]"
			   style="padding:17px 36px;font:700 15px var(--font-sans);letter-spacing:.04em;box-shadow:0 12px 30px rgba(214,122,76,.4)">
				体験レッスンを申し込む<span style="font-size:16px">→</span>
			</a>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
