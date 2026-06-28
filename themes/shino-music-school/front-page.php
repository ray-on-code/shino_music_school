<?php
/**
 * Front page template.
 *
 * @package shino-music-school
 */

get_header();
?>

<main>

<!-- ===== HERO ===== -->
<section id="heroWrap" class="relative bg-brand-bg" style="height:calc(165svh - var(--hdr-h,66px))">
	<div id="heroSection" class="sticky overflow-hidden bg-brand-bg" style="top:var(--hdr-h,66px);height:calc(100svh - var(--hdr-h,66px));min-height:494px">
		<!-- 背景（パラックス） -->
		<div id="heroBg" class="absolute left-0 right-0" style="top:-8%;height:118%;will-change:transform">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-bg.jpg"
			     alt="しのはら音楽教室 外観"
			     class="absolute inset-0 w-full h-full"
			     style="object-fit:cover;object-position:center 25%"
			     loading="eager" decoding="async">
			<div class="absolute inset-0 pointer-events-none"
			     style="background:linear-gradient(180deg,rgba(255,255,255,.22),rgba(126,139,107,.08) 55%,rgba(126,139,107,.2))"></div>
		</div>

		<!-- Ivory curved panel -->
		<svg viewBox="0 0 100 100" preserveAspectRatio="none"
		     class="absolute inset-0 w-full h-full block pointer-events-none ivory-svg">
			<path id="heroCurve" d="M0,0 L42,0 Q58,50 30,100 L0,100 Z" fill="#F7F3EA"></path>
		</svg>

		<!-- 同心円アーク（左下） -->
		<svg viewBox="0 0 320 320" class="absolute pointer-events-none overflow-visible"
		     style="left:-70px;bottom:-70px;width:min(420px,52vw);height:min(420px,52vw)">
			<g fill="none" stroke="#7E8B6B">
				<circle cx="0" cy="320" r="120" stroke-opacity=".42" stroke-width="1.4"/>
				<circle cx="0" cy="320" r="180" stroke-opacity=".3"  stroke-width="1.4" stroke-dasharray="2 6"/>
				<circle cx="0" cy="320" r="245" stroke-opacity=".24" stroke-width="1.4"/>
				<circle cx="0" cy="320" r="305" stroke-opacity=".16" stroke-width="1.4" stroke-dasharray="2 6"/>
			</g>
		</svg>

		<!-- 縦書き見出し -->
		<div class="absolute flex gap-[clamp(8px,1.2vw,16px)] items-start z-10"
		     style="top:clamp(80px,13vh,140px);left:clamp(18px,5vw,72px)">
			<h1 class="text-brand-dark m-0"
			    style="writing-mode:vertical-rl;font-family:var(--font-serif);font-weight:600;font-size:clamp(26px,4.4vw,50px);line-height:1.5;letter-spacing:.14em">
				音を、楽しむ。<br>はじめの一歩を、<br>ここで。
			</h1>
			<span class="text-brand-green mt-1.5"
			      style="writing-mode:vertical-rl;font:500 11px var(--font-mono);letter-spacing:.42em">BEGIN YOUR MUSIC HERE</span>
		</div>

		<!-- 写真側テキスト + CTA -->
		<div id="heroPhotoText" class="absolute flex flex-col items-end text-right gap-4 z-10"
		     style="right:clamp(18px,5vw,72px);bottom:clamp(64px,11vh,92px);max-width:min(400px,66vw);will-change:opacity">
			<p class="m-0 text-white"
			   style="font:400 14px/2 var(--font-sans);letter-spacing:.06em;text-shadow:0 1px 14px rgba(52,64,47,.55)">
				子どもから大人まで、初心者も大歓迎。<br>
				一人ひとりのペースに寄り添う、まちのピアノ教室です。
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
			   class="flex items-center gap-2 bg-brand-orange text-white no-underline rounded-full font-bold transition-colors hover:bg-[#c96f42]"
			   style="padding:15px 26px;font:700 14px var(--font-sans);letter-spacing:.04em;box-shadow:0 10px 26px rgba(214,122,76,.45)">
				体験レッスンを申し込む<span style="font-size:15px">→</span>
			</a>
		</div>

		<!-- スクロールキュー -->
		<div id="scrollCue" class="absolute flex flex-col items-center gap-1.5 pointer-events-none z-10"
		     style="bottom:22px;left:50%;transform:translateX(-50%);will-change:opacity">
			<span class="text-brand-green" style="font:500 9px var(--font-mono);letter-spacing:.34em">SCROLL</span>
			<span class="flex items-center justify-center w-7 h-7 rounded-full text-white"
			      style="background:rgba(214,122,76,.95);box-shadow:0 6px 16px rgba(214,122,76,.45);animation:cueBounce 1.8s ease-in-out infinite">
				<span style="font-size:13px;line-height:1">↓</span>
			</span>
		</div>
	</div>
</section>

<!-- ===== 地域・想い ===== -->
<section id="chiikiSection" class="relative overflow-hidden" style="background:#7E8B6B;color:#F7F3EA">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/chiiki-bg.jpg"
	     alt=""
	     class="absolute inset-0 w-full h-full"
	     style="object-fit:cover;object-position:center 40%"
	     loading="lazy" decoding="async">
	<div class="absolute inset-0 pointer-events-none"
	     style="background:linear-gradient(180deg,rgba(126,139,107,.55),rgba(52,64,47,.5))"></div>
	<div class="relative max-w-[1180px] mx-auto flex justify-between items-center flex-wrap-reverse"
	     style="padding:clamp(64px,12vh,140px) clamp(18px,4vw,40px);gap:clamp(24px,4vw,60px);min-height:80vh">
		<div class="flex-1 min-w-[280px] max-w-[560px] flex flex-col gap-6">
			<p data-reveal class="m-0 text-white" style="font:400 14.5px/2.2 var(--font-sans);letter-spacing:.04em;text-shadow:0 1px 12px rgba(52,64,47,.4)">
				しのはら音楽教室は、福岡市南区長住で続けてきた、地域に根ざした小さなピアノ教室です。子どもからご年配の方まで、世代を超えて音楽を楽しむ場所でありたいと考えています。
			</p>
			<p data-reveal class="m-0" style="font:400 14.5px/2.2 var(--font-sans);letter-spacing:.04em;color:rgba(255,255,255,.92);text-shadow:0 1px 12px rgba(52,64,47,.4)">
				「弾けた!」という小さな喜びを、一つひとつ一緒に。技術の上達だけでなく、音楽が一生の友だちになるような時間を、この町で届けていきます。
			</p>
			<a data-reveal href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
			   class="self-start flex items-center gap-2 text-white no-underline transition-opacity hover:opacity-80"
			   style="font:600 13.5px var(--font-sans);letter-spacing:.04em">
				<span class="w-7 h-7 rounded-full bg-brand-orange flex items-center justify-center text-[13px]">→</span>
				体験レッスンのご案内
			</a>
		</div>
		<div class="flex gap-[clamp(10px,1.6vw,22px)] items-start">
			<h2 data-reveal data-reveal-dist="70" data-reveal-dur="0.9" class="m-0 text-white"
			    style="writing-mode:vertical-rl;font-family:var(--font-serif);font-weight:600;font-size:clamp(28px,4.6vw,48px);line-height:1.5;letter-spacing:.16em;text-shadow:0 2px 18px rgba(52,64,47,.4)">
				音楽のある暮らしを、<br>このまちで。
			</h2>
		</div>
	</div>
</section>

<!-- ===== お知らせ ===== -->
<section class="bg-white">
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(40px,6vw,68px) clamp(18px,4vw,40px)">
		<div data-reveal class="flex items-baseline gap-3.5 mb-6">
			<h2 class="m-0 text-brand-dark" style="font:600 19px var(--font-serif);letter-spacing:.1em">お知らせ</h2>
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.28em">NEWS</span>
		</div>
		<div data-stagger class="flex flex-col">
			<?php
			$news_items = array(
				array( 'date' => '2026.06.20', 'tag' => '発表会', 'text' => '夏の発表会「ちいさなコンサート」の参加申込を受付中です。' ),
				array( 'date' => '2026.06.01', 'tag' => '体験',   'text' => '大人のための初心者コースに、平日夜の時間帯を新設しました。' ),
				array( 'date' => '2026.05.12', 'tag' => 'お知らせ', 'text' => 'ゴールデンウィーク期間の休講についてご案内します。' ),
			);
			foreach ( $news_items as $item ) :
			?>
			<div class="flex flex-wrap items-center gap-3.5"
			     style="padding:17px 4px;border-top:1px solid rgba(52,64,47,.1)">
				<span class="text-[#8a857a] w-24" style="font:500 13px var(--font-mono)"><?php echo esc_html( $item['date'] ); ?></span>
				<span class="text-white text-[11px] font-medium px-2.5 py-1 rounded-md"
				      style="background:var(--color-brand-green);font-family:var(--font-sans);letter-spacing:.06em"><?php echo esc_html( $item['tag'] ); ?></span>
				<span class="flex-1 min-w-[200px]" style="font:400 14px/1.7 var(--font-sans)"><?php echo esc_html( $item['text'] ); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== 4つの魅力 ===== -->
<section class="relative overflow-hidden">
	<div class="max-w-[1080px] mx-auto relative" style="padding:clamp(48px,7vw,84px) clamp(18px,4vw,40px)">
		<div data-reveal class="text-center" style="margin-bottom:clamp(34px,5vw,52px)">
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">WHY SHINOHARA</span>
			<h2 class="text-brand-dark m-0 mt-2" style="font:600 clamp(23px,3.4vw,32px) var(--font-serif);letter-spacing:.08em">しのはら音楽教室の、4つの魅力</h2>
		</div>
		<div data-stagger class="grid gap-[clamp(16px,2.2vw,26px)]" style="grid-template-columns:repeat(auto-fit,minmax(290px,1fr))">
			<?php
			$strengths = array(
				array( 'icon' => '個', 'title' => '一人ひとりに合わせた個別指導', 'font' => "600 22px var(--font-serif)", 'desc' => '目標やペースは人それぞれ。レベルや目的に合わせて、レッスン内容を丁寧に組み立てます。' ),
				array( 'icon' => '♪', 'title' => '本番の経験が積める発表会',   'font' => "normal normal 24px inherit",  'desc' => '年に一度の発表会をはじめ、人前で弾く機会を大切に。達成感が次への自信になります。' ),
				array( 'icon' => '♡', 'title' => 'アットホームで通いやすい',   'font' => "normal normal 24px inherit",  'desc' => '緊張せず、自分の音と向き合える空間。「また来たい」と思える雰囲気を心がけています。' ),
				array( 'icon' => '大', 'title' => '大人・初心者も大歓迎',       'font' => "600 20px var(--font-serif)", 'desc' => '「楽譜が読めなくても大丈夫?」もちろんです。はじめての一音から、一緒に楽しみましょう。' ),
			);
			foreach ( $strengths as $s ) :
			?>
			<div class="flex gap-4 bg-white rounded-[18px] p-6" style="box-shadow:0 10px 28px rgba(52,64,47,.07)">
				<span class="flex-shrink-0 w-14 h-14 rounded-[14px] bg-brand-light text-brand-green flex items-center justify-center"
				      style="font:<?php echo esc_attr( $s['font'] ); ?>"><?php echo esc_html( $s['icon'] ); ?></span>
				<div>
					<h3 class="mt-0.5 mb-2 text-brand-dark" style="font:700 16px var(--font-sans);letter-spacing:.04em"><?php echo esc_html( $s['title'] ); ?></h3>
					<p class="m-0 text-[#5d584f]" style="font:400 13px/1.9 var(--font-sans)"><?php echo esc_html( $s['desc'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== 講師紹介 ===== -->
<section class="bg-white">
	<div data-stagger class="max-w-[1080px] mx-auto grid items-center gap-[clamp(24px,3.6vw,48px)]"
	     style="padding:clamp(48px,7vw,84px) clamp(18px,4vw,40px);grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
		<div class="min-h-[320px] h-full rounded-[22px] overflow-hidden"
		     style="box-shadow:0 16px 40px rgba(52,64,47,.12)">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/teacher.jpg"
			     alt="講師 篠原"
			     class="w-full h-full"
			     style="object-fit:cover;object-position:center 20%"
			     loading="lazy" decoding="async">
		</div>
		<div class="flex flex-col gap-3.5">
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">PIANO INSTRUCTOR</span>
			<div class="flex items-baseline gap-3.5">
				<h2 class="m-0 text-brand-dark" style="font:600 clamp(24px,3vw,32px) var(--font-serif);letter-spacing:.08em">篠原 朋子</h2>
			</div>
			<p class="m-0 text-[#5d584f]" style="font:400 13.5px/2 var(--font-sans)">
				「音楽って楽しい！あの曲が弾けた！」その喜びを何より大切にしています。一人ひとりの「弾いてみたい」という気持ちを尊重し、目標に寄り添ったレッスンを心がけています。
			</p>
			<div class="flex flex-col gap-1.5 mt-0.5">
				<div class="flex gap-3 items-baseline">
					<span class="text-brand-green flex-shrink-0 w-14" style="font:600 11px var(--font-mono)">経歴</span>
					<span class="text-brand-text" style="font:400 13px/1.8 var(--font-sans)">
						3歳よりヤマハ音楽教室にてピアノを始める<br>
						ヤマハ指導グレードを取得<br>
						全日本エレクトーン指導協会に所属<br>
						ヤマハ福重音楽教室、自宅にて指導中
					</span>
				</div>
				<div class="flex gap-3 items-baseline">
					<span class="text-brand-green flex-shrink-0 w-14" style="font:600 11px var(--font-mono)">資格</span>
					<span class="text-brand-text" style="font:400 13px/1.8 var(--font-sans)">ヤマハグレード指導</span>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ===== レッスン/発表会 ハーフスプリット ===== -->
<section class="bg-white">
	<div class="max-w-[1180px] mx-auto flex flex-col" style="padding:clamp(36px,5vw,60px) clamp(18px,4vw,40px);gap:clamp(18px,2.4vw,30px)">
		<!-- レッスン -->
		<div data-reveal class="grid rounded-[22px] overflow-hidden" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr));box-shadow:0 14px 36px rgba(52,64,47,.08)">
			<div class="min-h-[260px] h-full w-full overflow-hidden">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/lesson.jpg"
				     alt="レッスン室の様子"
				     class="w-full h-full"
				     style="object-fit:cover;object-position:center"
				     loading="lazy" decoding="async">
			</div>
			<div class="bg-brand-green text-[#F7F3EA] flex flex-col justify-center gap-3.5" style="padding:clamp(28px,3.6vw,46px)">
				<span style="font:500 10px var(--font-mono);letter-spacing:.3em;color:rgba(247,243,234,.75)">LESSON</span>
				<h3 class="m-0" style="font:600 clamp(20px,2.6vw,26px) var(--font-serif);letter-spacing:.08em">レッスンについて</h3>
				<p class="m-0" style="font:300 13.5px/2 var(--font-sans);color:rgba(247,243,234,.9)">お子さま向けから大人の趣味、再開組まで。目的に合わせた多彩なコースをご用意しています。</p>
				<a href="<?php echo esc_url( home_url( '/lessons/' ) ); ?>"
				   class="self-start flex items-center gap-2 text-white no-underline rounded-full mt-1 transition-colors hover:bg-white/10"
				   style="border:1px solid rgba(247,243,234,.5);padding:11px 20px;font:600 12.5px var(--font-sans)">
					コースを見る<span class="text-brand-orange">→</span>
				</a>
			</div>
		</div>
		<!-- 発表会 -->
		<div data-reveal class="grid rounded-[22px] overflow-hidden" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr));box-shadow:0 14px 36px rgba(52,64,47,.08)">
			<div class="flex flex-col justify-center gap-3.5 order-2" style="background:#34402F;color:#F7F3EA;padding:clamp(28px,3.6vw,46px)">
				<span style="font:500 10px var(--font-mono);letter-spacing:.3em;color:rgba(247,243,234,.7)">EVENT</span>
				<h3 class="m-0" style="font:600 clamp(20px,2.6vw,26px) var(--font-serif);letter-spacing:.08em">発表会・イベント</h3>
				<p class="m-0" style="font:300 13.5px/2 var(--font-sans);color:rgba(247,243,234,.88)">年に一度の発表会や季節のミニコンサート。練習の成果を発表できる、心に残る舞台です。</p>
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"
				   class="self-start flex items-center gap-2 text-white no-underline rounded-full mt-1 transition-colors hover:bg-white/10"
				   style="border:1px solid rgba(247,243,234,.4);padding:11px 20px;font:600 12.5px var(--font-sans)">
					様子を見る<span class="text-brand-orange">→</span>
				</a>
			</div>
			<div class="min-h-[260px] h-full order-1 overflow-hidden">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/stage.jpg"
				     alt="発表会のステージ" class="w-full h-full" style="object-fit:cover;object-position:center"
				     loading="lazy" decoding="async">
			</div>
		</div>
	</div>
</section>

<!-- ===== レッスンの流れ ===== -->
<section class="relative overflow-hidden">
	<div class="max-w-[1100px] mx-auto relative flex flex-wrap items-start" style="padding:clamp(48px,7vw,84px) clamp(18px,4vw,40px);gap:clamp(24px,4vw,56px)">
		<div data-reveal class="flex gap-3.5 items-start">
			<h2 class="m-0 text-brand-dark" style="writing-mode:vertical-rl;font-family:var(--font-serif);font-weight:600;font-size:clamp(26px,3.6vw,38px);line-height:1.5;letter-spacing:.16em">レッスンの流れ</h2>
			<span class="text-brand-green mt-1" style="writing-mode:vertical-rl;font:500 10px var(--font-mono);letter-spacing:.36em">3 STEPS</span>
		</div>
		<div data-stagger class="flex-1 min-w-[280px] flex flex-col gap-4">
			<?php
			$steps = array(
				array( 'num' => '01', 'title' => '体験レッスン', 'desc' => 'まずは教室の雰囲気を体験。ご希望やお悩みをお聞かせください。' ),
				array( 'num' => '02', 'title' => 'ご入会',       'desc' => '通う曜日・時間を一緒に決めます。教材もご相談しながら準備します。' ),
				array( 'num' => '03', 'title' => '通常レッスン', 'desc' => '一人ひとりのペースで、無理なく着実に。発表会という目標も支えます。' ),
			);
			foreach ( $steps as $step ) :
			?>
			<div class="flex gap-5 items-start bg-white rounded-[18px] p-6" style="box-shadow:0 8px 24px rgba(52,64,47,.07)">
				<span class="text-brand-orange flex-shrink-0 w-14" style="font:600 30px var(--font-serif);line-height:1"><?php echo esc_html( $step['num'] ); ?></span>
				<div>
					<h3 class="m-0 mb-1.5 text-brand-dark" style="font:700 16px var(--font-sans)"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="m-0 text-[#5d584f]" style="font:400 13px/1.85 var(--font-sans)"><?php echo esc_html( $step['desc'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== 生徒の声 ===== -->
<section class="bg-white">
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(44px,6vw,72px) clamp(18px,4vw,40px)">
		<div data-reveal class="flex items-end justify-between flex-wrap gap-4 mb-7">
			<div>
				<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">VOICE</span>
				<h2 class="m-0 mt-2 text-brand-dark" style="font:600 clamp(22px,3vw,30px) var(--font-serif);letter-spacing:.08em">生徒さん・保護者の声</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"
			   class="flex items-center gap-2 text-brand-dark no-underline font-bold text-[13px] transition-colors hover:text-brand-green">
				もっと見る<span class="text-brand-orange">→</span>
			</a>
		</div>
		<div data-stagger class="grid gap-4" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
			<?php
			$voices = array(
				array( 'age' => '40s', 'label' => '大人・趣味コース 40代女性', 'text' => '楽譜が全く読めない状態から始めましたが、好きな曲を1曲弾けるようになりました。毎週のレッスンが楽しみです。' ),
				array( 'age' => '7yo', 'label' => '小学2年生の保護者',         'text' => '人見知りの娘が、先生のおかげで発表会の舞台に立てました。本人の自信につながっています。' ),
				array( 'age' => '30s', 'label' => '再開コース 30代男性',       'text' => '10年ぶりにピアノを再開。ブランクに合わせて進めてくださるので、無理なく続けられています。' ),
			);
			foreach ( $voices as $v ) :
			?>
			<div class="bg-brand-bg rounded-[18px] p-6">
				<span class="text-brand-green" style="font:600 34px var(--font-serif);line-height:.6">"</span>
				<p class="m-0 mt-1.5 mb-4 text-brand-text" style="font:400 13.5px/1.95 var(--font-sans)"><?php echo esc_html( $v['text'] ); ?></p>
				<div class="flex items-center gap-2.5">
					<span class="w-9 h-9 rounded-full bg-[#dfe2d3] flex items-center justify-center text-brand-green"
					      style="font:500 9px var(--font-mono)"><?php echo esc_html( $v['age'] ); ?></span>
					<span class="text-[#5d584f]" style="font:500 12px var(--font-sans)"><?php echo esc_html( $v['label'] ); ?></span>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== アクセス抜粋 ===== -->
<section>
	<div class="max-w-[1080px] mx-auto" style="padding:clamp(44px,6vw,72px) clamp(18px,4vw,40px)">
		<div data-stagger class="grid items-center gap-[clamp(18px,2.6vw,32px)]" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
			<div class="w-full rounded-[20px] overflow-hidden" style="min-height:230px;box-shadow:0 12px 30px rgba(52,64,47,.1)">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.3183968744015!2d130.3956325!3d33.545102899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354191f9c5ba3875%3A0x89108d893d3192f!2z44GX44Gu44Gv44KJ6Z-z5qW95pWZ5a6k!5e0!3m2!1sja!2sjp!4v1782631276953!5m2!1sja!2sjp"
				        width="100%" height="260" style="border:0;display:block;"
				        allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
				        title="しのはら音楽教室 地図"></iframe>
			</div>
			<div class="flex flex-col gap-3">
				<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">ACCESS</span>
				<h2 class="m-0 text-brand-dark" style="font:600 clamp(21px,2.8vw,28px) var(--font-serif);letter-spacing:.08em">アクセス</h2>
				<p class="m-0 text-[#5d584f]" style="font:400 13.5px/2 var(--font-sans)">
					福岡市南区長住、閑静な住宅街の一角。<br>白い建物が目印です。駐車スペースもございます。
				</p>
				<a href="<?php echo esc_url( home_url( '/access/' ) ); ?>"
				   class="self-start flex items-center gap-2 text-brand-dark no-underline rounded-full mt-1 text-[12.5px] font-bold transition-colors hover:border-brand-green hover:text-brand-green"
				   style="border:1px solid rgba(52,64,47,.2);padding:11px 20px;font:600 12.5px var(--font-sans)">
					アクセス詳細<span class="text-brand-orange">→</span>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- ===== 体験CTAバナー ===== -->
<section class="relative overflow-hidden" style="background:#34402F">
	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cta-bg.jpg"
	     alt=""
	     class="absolute inset-0 w-full h-full"
	     style="object-fit:cover;object-position:center"
	     loading="lazy" decoding="async">
	<div class="absolute inset-0 pointer-events-none"
	     style="background:linear-gradient(to right, #34402F 0%, #34402F 50%, rgba(52,64,47,.88) 63%, rgba(52,64,47,.45) 80%, rgba(52,64,47,.15) 100%)"></div>

	<div class="relative max-w-[1000px] mx-auto flex flex-col items-center text-center gap-4" style="padding:clamp(46px,6vw,76px) clamp(18px,4vw,40px)">
		<span class="text-brand-orange" style="font:500 10px var(--font-mono);letter-spacing:.36em">FREE TRIAL LESSON</span>
		<h2 class="m-0 text-white" style="font:600 clamp(24px,4vw,40px) var(--font-serif);letter-spacing:.1em;line-height:1.5">体験レッスン、受付中。</h2>
		<p class="m-0 max-w-[560px]" style="font:300 14px/2 var(--font-sans);color:rgba(247,243,234,.86)">
			「自分にもできるかな?」その気持ちのまま、まずは一度。<br>無理な勧誘は一切ありません。お気軽にお越しください。
		</p>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
		   class="mt-2 flex items-center gap-2 bg-brand-orange text-white no-underline rounded-full font-bold transition-colors hover:bg-[#c96f42]"
		   style="padding:17px 34px;font:700 15px var(--font-sans);letter-spacing:.04em;box-shadow:0 12px 30px rgba(214,122,76,.4)">
			体験レッスンを申し込む<span style="font-size:16px">→</span>
		</a>
	</div>
</section>

<!-- ===== フローティング CTA ===== -->
<a id="floatingCta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
   class="fixed right-4 bottom-4 z-[60] flex items-center gap-3 text-white no-underline rounded-[18px] cursor-pointer hover:bg-[#c96f42] transition-colors"
   style="background:#D67A4C;padding:13px 18px 13px 15px;box-shadow:0 12px 30px rgba(214,122,76,.45);animation:floatY 4s ease-in-out infinite;opacity:0;pointer-events:none;transition:opacity 0.6s ease">
	<span class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-xl">♪</span>
	<span class="flex flex-col leading-[1.35] text-left">
		<span style="font:400 10px var(--font-sans);opacity:.92">かんたん・無料</span>
		<span style="font:700 13px var(--font-sans);letter-spacing:.02em">体験レッスンのお申し込み</span>
	</span>
</a>

</main>

<?php get_footer(); ?>
