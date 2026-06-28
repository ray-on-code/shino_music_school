<?php
/**
 * Template for page slug "gallery".
 *
 * @package shino-music-school
 */

get_header();
?>

<main>

<!-- ページヘッダー -->
<section class="relative overflow-hidden bg-white">
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.32em">GALLERY &amp; VOICE</span>
		<h1 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(26px,4vw,40px) var(--font-serif);letter-spacing:.1em">発表会・生徒の声</h1>
		<p class="m-0 mt-3 text-[#5d584f] max-w-[560px]" style="font:400 14px/2 var(--font-sans)">
			練習を重ねた成果を発表する、特別な一日。会場の様子と、生徒さん・保護者のみなさまの声をご紹介します。
		</p>
	</div>
</section>

<!-- フォトグリッド -->
<section>
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<div data-reveal class="flex items-baseline gap-3.5 mb-5">
			<h2 class="m-0 text-brand-dark" style="font:600 20px var(--font-serif);letter-spacing:.08em">発表会・イベント</h2>
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.26em">RECITAL</span>
		</div>
		<div data-stagger class="grid gap-3.5" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));grid-auto-rows:180px">
			<?php
			$gallery_items = array(
				array( 'label' => 'ステージ全景', 'file' => 'gallery-stage.jpg',       'span' => 'row-span-2 h-full' ),
				array( 'label' => '演奏する生徒', 'file' => 'gallery-performance.jpg', 'span' => 'h-full' ),
				array( 'label' => '連弾',         'file' => 'gallery-duet.jpg',        'span' => 'h-full' ),
				array( 'label' => '記念撮影',     'file' => 'gallery-photo.jpg',       'span' => 'h-full' ),
				array( 'label' => '花束',         'file' => 'gallery-bouquet.jpg',     'span' => 'h-full' ),
			);
			foreach ( $gallery_items as $item ) :
			?>
			<div class="rounded-[18px] overflow-hidden <?php echo esc_attr( $item['span'] ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/<?php echo esc_attr( $item['file'] ); ?>"
				     alt="<?php echo esc_attr( $item['label'] ); ?>" class="w-full h-full"
				     style="object-fit:cover;object-position:center" loading="lazy" decoding="async">
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- 生徒の声 -->
<section class="bg-white">
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<div data-reveal class="flex items-baseline gap-3.5 mb-5">
			<h2 class="m-0 text-brand-dark" style="font:600 20px var(--font-serif);letter-spacing:.08em">生徒さん・保護者の声</h2>
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.26em">VOICE</span>
		</div>
		<div data-stagger class="grid gap-4" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
			<?php
			$voices = array(
				array( 'age' => '8yo', 'name' => '小学3年生 ＆ 保護者',  'course' => '子どもコース・2年目',  'text' => '「練習しなさい」と言わなくても、自分から鍵盤に向かうように。発表会のあとは特に意欲的になりました。' ),
				array( 'age' => '50s', 'name' => '50代・女性',            'course' => '大人コース・1年目',    'text' => '定年後の趣味にと思い始めました。憧れだったあの曲を、ゆっくりですが弾けるように。毎週が楽しみです。' ),
				array( 'age' => '30s', 'name' => '30代・男性',            'course' => '再開コース・半年',      'text' => '学生以来のピアノ。指が動かず焦りましたが、先生が根気よく付き合ってくださり少しずつ感覚が戻ってきました。' ),
			);
			foreach ( $voices as $v ) :
			?>
			<div class="bg-brand-bg rounded-[18px] p-6 flex flex-col gap-3.5">
				<div class="flex items-center gap-3">
					<span class="w-12 h-12 rounded-full bg-[#dfe2d3] flex items-center justify-center text-brand-green"
					      style="font:500 10px var(--font-mono)"><?php echo esc_html( $v['age'] ); ?></span>
					<div>
						<div class="text-brand-dark" style="font:600 13px var(--font-sans)"><?php echo esc_html( $v['name'] ); ?></div>
						<div class="text-[#8a857a]" style="font:400 11px var(--font-sans)"><?php echo esc_html( $v['course'] ); ?></div>
					</div>
				</div>
				<p class="m-0 text-brand-text" style="font:400 13px/1.95 var(--font-sans)"><?php echo esc_html( $v['text'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
