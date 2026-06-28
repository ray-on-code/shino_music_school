<?php
/**
 * @package shino-music-school
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ===== STICKY HEADER ===== -->
<header id="siteHeader" class="sticky top-0 z-50 transition-all duration-300"
        style="background:rgba(247,243,234,.9);backdrop-filter:blur(10px);border-bottom:1px solid rgba(52,64,47,.08)">
	<div id="siteHeaderInner"
	     class="max-w-[1200px] mx-auto flex items-center gap-4 transition-all duration-300"
	     style="padding:11px 18px">
		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		   class="flex items-center gap-3 no-underline flex-shrink-0">
			<img src="https://shino-music.com/_astro/ShinoharaMusicSchool.CpggLnVA.svg"
			     alt="しのはら音楽教室" referrerpolicy="no-referrer"
			     style="height:44px;width:auto;display:block">
		</a>

		<!-- Desktop Nav -->
		<nav class="hidden lg:flex gap-0.5 ml-auto">
			<?php
			$nav_items = array(
				array( 'url' => home_url( '/lessons/' ), 'label' => 'レッスン案内', 'slug' => 'lessons' ),
				array( 'url' => home_url( '/price/' ),   'label' => '料金',         'slug' => 'price' ),
				array( 'url' => home_url( '/gallery/' ), 'label' => '発表会・生徒の声', 'slug' => 'gallery' ),
				array( 'url' => home_url( '/access/' ),  'label' => 'アクセス',     'slug' => 'access' ),
				array( 'url' => home_url( '/contact/' ), 'label' => 'お問い合わせ', 'slug' => 'contact' ),
			);
			foreach ( $nav_items as $item ) :
				$active_class = is_page( $item['slug'] ) ? 'text-brand-green' : 'text-brand-dark';
			?>
			<a href="<?php echo esc_url( $item['url'] ); ?>"
			   class="px-4 py-2 rounded-full text-[13px] font-medium no-underline transition-colors hover:bg-brand-green/10 <?php echo esc_attr( $active_class ); ?>"
			   style="font-family:var(--font-sans);letter-spacing:.03em">
				<?php echo esc_html( $item['label'] ); ?>
			</a>
			<?php endforeach; ?>
		</nav>

		<!-- Trial CTA -->
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
		   class="flex items-center gap-1.5 bg-brand-orange text-white no-underline rounded-full text-[12.5px] font-bold whitespace-nowrap transition-colors hover:bg-[#c96f42]"
		   style="margin-left:auto;padding:10px 16px;box-shadow:0 6px 16px rgba(214,122,76,.32);letter-spacing:.03em">
			体験レッスン申込<span style="font-size:13px">→</span>
		</a>

		<!-- Hamburger -->
		<button id="menuToggle" aria-label="メニュー" aria-expanded="false"
		        class="lg:hidden flex-shrink-0 w-11 h-11 rounded-full bg-white text-brand-dark flex items-center justify-center text-lg cursor-pointer transition-colors hover:bg-brand-bg"
		        style="border:1px solid rgba(52,64,47,.16)">
			☰
		</button>
	</div>
</header>

<!-- ===== MOBILE OVERLAY MENU ===== -->
<div id="mobileMenu" class="fixed inset-0 z-[70] hidden" aria-hidden="true">
	<div id="menuOverlay" class="absolute inset-0"
	     style="background:rgba(52,64,47,.4);backdrop-filter:blur(3px)"></div>
	<div class="absolute top-0 right-0 h-full bg-brand-bg overflow-y-auto flex flex-col"
	     style="width:min(360px,86vw);padding:22px 22px 32px;box-shadow:-12px 0 40px rgba(52,64,47,.22);animation:menuIn .25s ease">
		<div class="flex items-center justify-between mb-6">
			<span class="text-brand-green text-[13px] font-semibold"
			      style="font-family:var(--font-serif);letter-spacing:.2em">MENU</span>
			<button id="menuClose"
			        class="w-10 h-10 rounded-full bg-white text-brand-dark text-[17px] flex items-center justify-center cursor-pointer"
			        style="border:1px solid rgba(52,64,47,.16)">✕</button>
		</div>
		<?php
		$mobile_items = array(
			array( 'url' => home_url( '/' ),        'label' => 'トップ',         'en' => 'HOME' ),
			array( 'url' => home_url( '/lessons/' ), 'label' => 'レッスン案内',   'en' => 'LESSON' ),
			array( 'url' => home_url( '/price/' ),   'label' => '料金',           'en' => 'PRICE' ),
			array( 'url' => home_url( '/gallery/' ), 'label' => '発表会・生徒の声', 'en' => 'GALLERY' ),
			array( 'url' => home_url( '/access/' ),  'label' => 'アクセス',       'en' => 'ACCESS' ),
			array( 'url' => home_url( '/contact/' ), 'label' => 'お問い合わせ',   'en' => 'CONTACT' ),
		);
		foreach ( $mobile_items as $item ) :
		?>
		<a href="<?php echo esc_url( $item['url'] ); ?>"
		   class="flex flex-col no-underline text-brand-dark transition-colors hover:text-brand-green"
		   style="padding:16px 0;border-bottom:1px solid rgba(52,64,47,.08)">
			<span class="text-brand-green text-[9px]"
			      style="font-family:var(--font-mono);letter-spacing:.2em"><?php echo esc_html( $item['en'] ); ?></span>
			<span class="text-[15px] font-medium mt-0.5"><?php echo esc_html( $item['label'] ); ?></span>
		</a>
		<?php endforeach; ?>
		<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
		   class="mt-6 flex items-center justify-center gap-2 bg-brand-orange text-white no-underline rounded-2xl py-4 text-[14px] font-bold"
		   style="box-shadow:0 8px 20px rgba(214,122,76,.32)">
			体験レッスンを申し込む<span>→</span>
		</a>
	</div>
</div>
