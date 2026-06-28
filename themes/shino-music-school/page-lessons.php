<?php
/**
 * Template for page slug "lessons".
 *
 * @package shino-music-school
 */

get_header();
?>

<main>

<!-- ページヘッダー -->
<section class="relative overflow-hidden bg-white">
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.32em">LESSON</span>
		<h1 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(26px,4vw,40px) var(--font-serif);letter-spacing:.1em">レッスン案内</h1>
		<p class="m-0 mt-3 text-[#5d584f] max-w-[560px]" style="font:400 14px/2 var(--font-sans)">
			年齢や目的に合わせた4つのコース。どのコースも、一人ひとりに合わせた個別レッスンです。
		</p>
	</div>
</section>

<!-- コース -->
<section>
	<div data-stagger class="max-w-[1080px] mx-auto grid gap-4" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px);grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
		<?php
		$courses = array(
			array( 'id' => 'kids',     'tag' => '3歳〜小学生', 'title' => '子どもコース',      'img_label' => '子どものレッスン', 'desc' => '音感やリズム感を育みながら、楽譜を読む力も少しずつ。「楽しい」を入り口に基礎を身につけます。' ),
			array( 'id' => 'adult',    'tag' => '大人・趣味',  'title' => '大人コース',          'img_label' => '大人のレッスン',   'desc' => '弾きたい曲を中心に、自分のペースで。お仕事帰りに通える夜の時間帯もご用意しています。' ),
			array( 'id' => 'beginner', 'tag' => 'はじめて',    'title' => '初心者コース',        'img_label' => '鍵盤に触れる手',   'desc' => '楽譜が読めなくても大丈夫。ドの位置から、一音ずつ。安心してはじめられます。' ),
			array( 'id' => 'return',   'tag' => '経験者・再開', 'title' => '再開・経験者コース', 'img_label' => '楽譜と演奏',       'desc' => 'ブランクがあっても心配いりません。これまでの経験を活かし、もう一度音楽を楽しみましょう。' ),
		);
		foreach ( $courses as $c ) :
		?>
		<div class="bg-white rounded-[20px] overflow-hidden" style="box-shadow:0 12px 30px rgba(52,64,47,.08)">
			<div class="min-h-[150px] bg-brand-light flex items-end justify-end p-3">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)"><?php echo esc_html( $c['img_label'] ); ?></span>
			</div>
			<div class="p-6">
				<span class="text-white text-[10px] font-medium px-2.5 py-1 rounded-md"
				      style="background:var(--color-brand-green);font-family:var(--font-sans);letter-spacing:.08em"><?php echo esc_html( $c['tag'] ); ?></span>
				<h3 class="mt-3.5 mb-2 text-brand-dark" style="font:700 18px var(--font-sans)"><?php echo esc_html( $c['title'] ); ?></h3>
				<p class="m-0 text-[#5d584f]" style="font:400 13px/1.9 var(--font-sans)"><?php echo esc_html( $c['desc'] ); ?></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- 入会フロー -->
<section class="bg-white">
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<div data-reveal class="text-center mb-7">
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">FLOW</span>
			<h2 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(22px,3vw,30px) var(--font-serif);letter-spacing:.08em">入会までの流れ</h2>
		</div>
		<div data-stagger class="grid gap-4" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr))">
			<?php
			$flow = array(
				array( 'num' => '01', 'title' => '体験レッスン', 'desc' => '教室の雰囲気を体験。ご希望をお聞かせください。' ),
				array( 'num' => '02', 'title' => 'ご入会',       'desc' => '曜日・時間を相談して決定。教材も準備します。' ),
				array( 'num' => '03', 'title' => '通常レッスン', 'desc' => '自分のペースで着実に。発表会も支えます。' ),
			);
			foreach ( $flow as $f ) :
			?>
			<div class="bg-brand-bg rounded-[18px] p-6">
				<span class="text-brand-orange" style="font:600 32px var(--font-serif)"><?php echo esc_html( $f['num'] ); ?></span>
				<h3 class="mt-2 mb-1.5 text-brand-dark" style="font:700 16px var(--font-sans)"><?php echo esc_html( $f['title'] ); ?></h3>
				<p class="m-0 text-[#5d584f]" style="font:400 13px/1.85 var(--font-sans)"><?php echo esc_html( $f['desc'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- FAQ -->
<section>
	<div class="max-w-[820px] mx-auto" style="padding:clamp(40px,5vw,64px) clamp(18px,4vw,40px)">
		<div data-reveal class="text-center mb-7">
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">FAQ</span>
			<h2 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(22px,3vw,30px) var(--font-serif);letter-spacing:.08em">よくあるご質問</h2>
		</div>
		<div data-stagger class="flex flex-col gap-3">
			<?php
			$faqs = array(
				array( 'q' => '楽器を持っていなくても大丈夫ですか?', 'a' => 'はい。教室には練習できるピアノがございます。ご自宅での練習用に、無理のない範囲での準備を一緒にご相談します。' ),
				array( 'q' => '何歳から始められますか?',               'a' => '3歳ごろから大人の方まで、どなたでも歓迎しています。年齢に合わせた進め方をご提案します。' ),
				array( 'q' => '振替レッスンはできますか?',               'a' => '事前にご連絡いただければ、可能な範囲で振替に対応しています。詳しくは体験時にご案内します。' ),
			);
			foreach ( $faqs as $faq ) :
			?>
			<details class="bg-white rounded-[14px] overflow-hidden" style="box-shadow:0 6px 18px rgba(52,64,47,.06)">
				<summary class="flex items-center gap-3.5 p-5 cursor-pointer list-none">
					<span class="text-brand-green flex-shrink-0" style="font:600 16px var(--font-serif)">Q</span>
					<span class="flex-1 text-brand-dark" style="font:600 14px var(--font-sans)"><?php echo esc_html( $faq['q'] ); ?></span>
					<span class="text-brand-orange text-lg select-none">+</span>
				</summary>
				<div class="text-[#5d584f]" style="padding:0 22px 20px 50px;font:400 13px/1.95 var(--font-sans)">
					<?php echo esc_html( $faq['a'] ); ?>
				</div>
			</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
