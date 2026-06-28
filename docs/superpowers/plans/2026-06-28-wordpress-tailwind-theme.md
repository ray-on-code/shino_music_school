# WordPress + Tailwind テーマ実装計画

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** `docs/index.html` の静的SPAデザインを、WordPress の `page-{slug}.php` テンプレート方式 + Tailwind CSS v4 で再実装する。

**Architecture:** `page-{slug}.php` 命名規則でURLスラッグとテンプレートを1対1対応させる。`header.php` / `footer.php` で共通パーツを共有。Vanilla JS でスクロールアニメーション・ヘッダー縮小・ハンバーガーメニューを実装。お問い合わせフォームは Contact Form 7 ショートコードで埋め込む。

**Tech Stack:** WordPress 6.x, PHP 8.x, Tailwind CSS v4 (`@tailwindcss/cli ^4`), Vanilla JS (ES6), Contact Form 7

## Global Constraints

- テーマディレクトリ: `themes/shino-music-school/`
- Tailwind ビルドコマンド: `npm run build`（`themes/shino-music-school/` で実行）
- 参照元デザイン: `docs/index.html`（変更しない）
- フォント: Google Fonts CDN から Noto Sans JP / Noto Serif JP / IBM Plex Mono
- カラーパレット: bg=#F7F3EA, text=#3E3A33, dark=#34402F, green=#7E8B6B, light=#EEF0E6, orange=#D67A4C
- 画像: すべてプレースホルダー（`bg-brand-light` の `<div>` + 説明テキスト）
- お知らせ: PHP に3件ハードコード
- ナビリンク: `header.php` に PHP 配列で直書き（WP メニュー管理画面不使用）
- WP 環境: `docker compose up -d` で起動（`docker-compose.yml` 参照）

---

### Task 1: CSS 基盤更新（デザイントークン + アニメーション）

**Files:**
- Modify: `themes/shino-music-school/assets/src/app.css`

**Interfaces:**
- Produces: `bg-brand-bg`, `bg-brand-green`, `bg-brand-orange`, `bg-brand-dark`, `bg-brand-light`, `text-brand-text`, `text-brand-dark`, `text-brand-green`, `text-brand-orange`, `font-serif`, `font-mono` ユーティリティクラス（後続タスク全体で使用）

- [ ] **Step 1: app.css を以下の内容で全置換する**

```css
@import "tailwindcss" source("../..");

/* ===== デザイントークン ===== */
@theme {
  --color-brand-bg:     #F7F3EA;
  --color-brand-text:   #3E3A33;
  --color-brand-dark:   #34402F;
  --color-brand-green:  #7E8B6B;
  --color-brand-light:  #EEF0E6;
  --color-brand-orange: #D67A4C;

  --font-sans:  'Noto Sans JP', sans-serif;
  --font-serif: 'Noto Serif JP', serif;
  --font-mono:  'IBM Plex Mono', monospace;
}

/* ===== アニメーション ===== */
@keyframes floatY {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-7px); }
}
@keyframes cueBounce {
  0%, 100% { transform: translateY(0); opacity: 1; }
  50%       { transform: translateY(7px); opacity: .55; }
}
@keyframes menuIn {
  from { opacity: 0; transform: translateY(-8px); }
  to   { opacity: 1; transform: none; }
}

/* ===== ベース ===== */
@layer base {
  *, *::before, *::after { box-sizing: border-box; }
  html, body { margin: 0; padding: 0; }
  body {
    background: var(--color-brand-bg);
    color: var(--color-brand-text);
    font-family: var(--font-sans);
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
  }
  ::selection { background: var(--color-brand-green); color: #fff; }
}

/* ===== WP Simple Booking Calendar（既存のまま維持） ===== */
.wpsbc-container .wpsbc-calendars .wpsbc-calendar {
  @apply overflow-hidden rounded-md bg-white;
  border: 1px solid #e2e2e2;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-wrapper {
  padding: 0 !important;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-header {
  background: #fff;
  padding: 14px 10px;
  border-bottom: 1px solid #ededed;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-header .wpsbc-calendar-header-navigation {
  padding: 0 40px;
  min-height: 34px;
  line-height: 34px;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-header .wpsbc-select-container select {
  border: 1px solid #d9d9d9;
  border-radius: 4px;
  height: 34px;
  line-height: 34px;
  font-size: 16px;
  font-weight: 700;
  color: var(--color-brand-text);
  background: #fff;
  text-align: center;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-header .wpsbc-calendar-header-navigation .wpsbc-prev,
.wpsbc-container .wpsbc-calendars .wpsbc-calendar .wpsbc-calendar-header .wpsbc-calendar-header-navigation .wpsbc-next {
  width: 34px; height: 34px; line-height: 34px; margin-top: -17px;
  border-radius: 50%; background: #6f7d5a;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table thead tr th {
  padding: 12px 0 !important; font-size: 13px; font-weight: 600;
  color: #8a8a8a; background: #fff;
  border: 1px solid #ededed !important; box-sizing: border-box !important;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table thead tr th.wpsbc-sun { color: #d64545; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table thead tr th.wpsbc-sat { color: #2f6fb0; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td {
  border: 1px solid #ededed !important; padding: 0 !important;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date-inner { height: 54px; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date-inner .wpsbc-date-number {
  @apply flex items-center justify-center;
  font-size: 15px; font-weight: 500; color: #2b2b2b;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td.wpsbc-sun .wpsbc-date-number { color: #d64545; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td.wpsbc-sat .wpsbc-date-number { color: #2f6fb0; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date.wpsbc-gap { background: #fafafa; }
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date .wpsbc-legend-item-icon {
  top: 50%; left: 50%; width: 40px; height: 40px;
  transform: translate(-50%, -50%); border-radius: 50%; overflow: hidden;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date .wpsbc-legend-item-icon .wpsbc-legend-item-icon-color {
  border-radius: 50%;
}
.wpsbc-container .wpsbc-calendars .wpsbc-calendar table tbody tr td .wpsbc-date .wpsbc-legend-item-icon::after {
  content: ""; position: absolute; top: 2px; right: 2px; bottom: 2px; left: 2px;
  background: #fff; border-radius: 50%; z-index: 1;
}
```

- [ ] **Step 2: ビルドして CSS が生成されることを確認する**

```bash
cd themes/shino-music-school && npm run build
```

期待出力: `themes/shino-music-school/assets/css/app.css` が更新される（エラーなし）

- [ ] **Step 3: コミットする**

```bash
git add themes/shino-music-school/assets/src/app.css themes/shino-music-school/assets/css/app.css
git commit -m "style: update design tokens and animations for shino-music theme"
```

---

### Task 2: JavaScript 基盤（main.js）作成

**Files:**
- Create: `themes/shino-music-school/assets/js/main.js`

**Interfaces:**
- Consumes: DOM要素 `#siteHeader`, `#siteHeaderInner`, `#heroBg`, `#heroWrap`, `#heroCurve`, `#heroPhotoText`, `#scrollCue`, `#menuToggle`, `#menuClose`, `#mobileMenu`, `#menuOverlay`（後続タスクで定義）
- Produces: スクロールreveal（`data-reveal` / `data-stagger` 属性）、ヘッダー縮小、ハンバーガー開閉

- [ ] **Step 1: main.js を新規作成する**

```javascript
(function () {
  'use strict';

  /* ── ヘッダー縮小 + パラックス ── */
  function onScroll() {
    var y = window.scrollY || window.pageYOffset || 0;
    var hdr = document.getElementById('siteHeader');
    var inner = document.getElementById('siteHeaderInner');
    if (hdr) {
      hdr.style.boxShadow = y > 16 ? '0 6px 22px rgba(52,64,47,.10)' : 'none';
      hdr.style.background = y > 16 ? 'rgba(247,243,234,.97)' : 'rgba(247,243,234,.9)';
    }
    if (inner) {
      var pad = y > 16 ? '6px' : '11px';
      inner.style.paddingTop = pad;
      inner.style.paddingBottom = pad;
    }
    var heroBg = document.getElementById('heroBg');
    if (heroBg) heroBg.style.transform = 'translateY(' + (y * 0.22) + 'px)';
    updateHeroCurve();
    runReveal();
  }

  /* ── Ivory パネル拡張アニメーション ── */
  function updateHeroCurve() {
    var wrap = document.getElementById('heroWrap');
    var path = document.getElementById('heroCurve');
    if (!wrap || !path) return;
    var scrollable = wrap.offsetHeight - (window.innerHeight || 700);
    var scrolled = Math.min(Math.max(-wrap.getBoundingClientRect().top, 0), Math.max(scrollable, 1));
    var p = scrollable > 0 ? scrolled / scrollable : 0;
    p = Math.max(0, Math.min(1, p));
    var e = 1 - Math.pow(1 - p, 2);
    var x1 = (42 + 104 * e).toFixed(1);
    var cx = (58 + 118 * e).toFixed(1);
    var x2 = (30 + 126 * e).toFixed(1);
    path.setAttribute('d', 'M0,0 L' + x1 + ',0 Q' + cx + ',50 ' + x2 + ',100 L0,100 Z');
    var pt = document.getElementById('heroPhotoText');
    if (pt) pt.style.opacity = String(Math.max(0, 1 - Math.max(0, (p - 0.3)) / 0.35));
    var cue = document.getElementById('scrollCue');
    if (cue) cue.style.opacity = String(Math.max(0, 1 - p / 0.35));
  }

  /* ── スクロール Reveal ── */
  function runReveal() {
    var vh = window.innerHeight || 800;
    var trigger = vh * 0.9;
    function handle(el, delay) {
      if (!el) return;
      var st = el.getAttribute('data-reveal-state');
      if (st === 'done') return;
      if (st !== 'pending') {
        var dist = el.getAttribute('data-reveal-dist') || '26';
        var dur  = el.getAttribute('data-reveal-dur')  || '0.7';
        el.setAttribute('data-reveal-state', 'pending');
        el.style.opacity    = '0';
        el.style.transform  = 'translateY(' + dist + 'px)';
        el.style.transition = 'opacity ' + dur + 's cubic-bezier(.22,.61,.36,1), transform ' + dur + 's cubic-bezier(.22,.61,.36,1)';
        el.style.transitionDelay = delay + 's';
      }
      if (el.getBoundingClientRect().top < trigger) {
        el.setAttribute('data-reveal-state', 'done');
        el.style.opacity   = '1';
        el.style.transform = 'none';
      }
    }
    document.querySelectorAll('[data-stagger]').forEach(function (c) {
      Array.from(c.children).forEach(function (ch, i) { handle(ch, Math.min(i, 6) * 0.09); });
    });
    document.querySelectorAll('[data-reveal]').forEach(function (el) { handle(el, 0); });
  }

  /* ── ハンバーガーメニュー ── */
  function initMenu() {
    var toggle  = document.getElementById('menuToggle');
    var closeBtn = document.getElementById('menuClose');
    var menu    = document.getElementById('mobileMenu');
    var overlay = document.getElementById('menuOverlay');
    if (!toggle || !menu) return;

    function open() {
      menu.classList.remove('hidden');
      menu.setAttribute('aria-hidden', 'false');
      toggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }
    function close() {
      menu.classList.add('hidden');
      menu.setAttribute('aria-hidden', 'true');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
    toggle.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (overlay)  overlay.addEventListener('click', close);
  }

  /* ── 初期化 ── */
  window.addEventListener('scroll', onScroll, { passive: true });
  document.addEventListener('DOMContentLoaded', function () {
    initMenu();
    onScroll();
    updateHeroCurve();
    runReveal();
  });
})();
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/assets/js/main.js
git commit -m "feat: add main.js for scroll animations and hamburger menu"
```

---

### Task 3: functions.php 更新（main.js 登録 + CF7 サポート）

**Files:**
- Modify: `themes/shino-music-school/functions.php`

**Interfaces:**
- Consumes: `assets/js/main.js`（Task 2 で作成）
- Produces: `wp_enqueue_script('shino-music-school-main', ...)` — WordPress が footer に main.js を出力する

- [ ] **Step 1: functions.php の `sms_enqueue_assets()` に main.js の登録を追加する**

```php
<?php
/**
 * Shino Music School theme functions.
 *
 * @package shino-music-school
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sms_theme_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'wpcf7-nojs' );
}
add_action( 'after_setup_theme', 'sms_theme_setup' );

function sms_enqueue_assets(): void {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'shino-music-school-app',
		get_theme_file_uri( 'assets/css/app.css' ),
		array(),
		$theme_version
	);

	wp_enqueue_script(
		'shino-music-school-wpsbc',
		get_theme_file_uri( 'assets/js/wpsbc-custom.js' ),
		array(),
		$theme_version,
		true
	);

	wp_enqueue_script(
		'shino-music-school-main',
		get_theme_file_uri( 'assets/js/main.js' ),
		array(),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sms_enqueue_assets', 20 );
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/functions.php
git commit -m "feat: enqueue main.js and add CF7 theme support"
```

---

### Task 4: header.php 全書き換え

**Files:**
- Modify: `themes/shino-music-school/header.php`

**Interfaces:**
- Consumes: Task 1 の CSS トークン（`bg-brand-bg`, `text-brand-dark` 等）、Task 2 の `#menuToggle`, `#menuClose`, `#mobileMenu`, `#menuOverlay`, `#siteHeader`, `#siteHeaderInner` ID
- Produces: 全ページ共通ヘッダー（スティッキーナビ + モバイルドロワー）

- [ ] **Step 1: header.php を以下の内容で全置換する**

```php
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
		        class="flex-shrink-0 w-11 h-11 rounded-full bg-white text-brand-dark flex items-center justify-center text-lg cursor-pointer transition-colors hover:bg-brand-bg"
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/header.php
git commit -m "feat: rewrite header.php with sticky nav and mobile drawer"
```

---

### Task 5: footer.php 全書き換え

**Files:**
- Modify: `themes/shino-music-school/footer.php`

**Interfaces:**
- Consumes: Task 1 の CSS トークン
- Produces: 全ページ共通フッター（グリッドレイアウト + コピーライト）

- [ ] **Step 1: footer.php を以下の内容で全置換する**

```php
<?php
/**
 * @package shino-music-school
 */
?>
<!-- ===== FOOTER ===== -->
<footer class="relative overflow-hidden" style="background:#7E8B6B;color:#F7F3EA">
	<div class="absolute inset-0 opacity-50"
	     style="background:radial-gradient(circle at 1px 1px,rgba(247,243,234,.13) 1.2px,transparent 1.4px);background-size:22px 22px"></div>
	<div class="relative max-w-[1180px] mx-auto grid gap-10"
	     style="padding:clamp(44px,5vw,64px) clamp(18px,4vw,40px) 28px;grid-template-columns:repeat(auto-fit,minmax(260px,1fr))">
		<!-- ロゴ・住所 -->
		<div class="flex flex-col gap-4">
			<img src="https://shino-music.com/_astro/ShinoharaMusicSchool.CpggLnVA.svg"
			     alt="しのはら音楽教室" referrerpolicy="no-referrer"
			     style="height:30px;width:auto;display:block">
			<div style="font:300 12.5px/2 var(--font-sans);color:rgba(247,243,234,.9)">
				〒811-1362<br>
				福岡県福岡市南区長住7丁目8-27<br>
				受付 火〜土 10:00–20:00
			</div>
			<div class="flex gap-2">
				<span class="w-10 h-10 rounded-full flex items-center justify-center text-[10px] cursor-pointer"
				      style="border:1px solid rgba(247,243,234,.5);font-family:var(--font-mono)">IG</span>
				<span class="w-10 h-10 rounded-full flex items-center justify-center text-[10px] cursor-pointer"
				      style="border:1px solid rgba(247,243,234,.5);font-family:var(--font-mono)">LINE</span>
			</div>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
			   class="self-start flex items-center gap-2 bg-brand-orange text-white no-underline rounded-full text-[13px] font-bold transition-colors hover:bg-[#c96f42]"
			   style="padding:13px 24px;box-shadow:0 8px 20px rgba(214,122,76,.32)">
				体験レッスン申込<span>→</span>
			</a>
		</div>
		<!-- ナビリンク -->
		<div class="flex justify-end">
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/footer.php
git commit -m "feat: rewrite footer.php with grid layout"
```

---

### Task 6: front-page.php 作成（トップページ）

**Files:**
- Create: `themes/shino-music-school/front-page.php`

**Interfaces:**
- Consumes: `get_header()` / `get_footer()`（Task 4/5）、CSS トークン（Task 1）、JS（Task 2）の `#heroWrap`, `#heroSection`, `#heroBg`, `#heroCurve`, `#heroPhotoText`, `#scrollCue` ID

- [ ] **Step 1: front-page.php を新規作成する**

```php
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
<section id="heroWrap" class="relative bg-brand-bg" style="height:165vh">
	<div id="heroSection" class="sticky top-0 overflow-hidden bg-brand-bg" style="height:100vh;min-height:560px">
		<!-- 背景（パラックス） -->
		<div id="heroBg" class="absolute left-0 right-0" style="top:-8%;height:118%;will-change:transform">
			<!-- 画像プレースホルダー -->
			<div class="absolute inset-0 w-full h-full bg-brand-light flex items-end justify-end p-4">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">教室のある町の風景・空</span>
			</div>
			<div class="absolute inset-0 pointer-events-none"
			     style="background:linear-gradient(180deg,rgba(255,255,255,.22),rgba(126,139,107,.08) 55%,rgba(126,139,107,.2))"></div>
		</div>

		<!-- Ivory curved panel -->
		<svg viewBox="0 0 100 100" preserveAspectRatio="none"
		     class="absolute inset-0 w-full h-full block pointer-events-none">
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
<section class="relative overflow-hidden" style="background:#7E8B6B;color:#F7F3EA">
	<div class="absolute inset-0 bg-brand-light flex items-end justify-end p-4">
		<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">教室周辺の町並み・外観</span>
	</div>
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
			<span data-reveal data-reveal-dist="70" data-reveal-dur="0.9" class="mt-1.5"
			      style="writing-mode:vertical-rl;font:500 11px var(--font-mono);letter-spacing:.4em;color:rgba(247,243,234,.85)">MUSIC IN YOUR TOWN</span>
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
			foreach ( $news_items as $i => $item ) :
				$border_b = ( $i === count( $news_items ) - 1 ) ? 'border-b' : '';
			?>
			<a class="flex flex-wrap items-center gap-3.5 no-underline text-inherit transition-colors hover:bg-[#FBF8F0] <?php echo esc_attr( $border_b ); ?>"
			   style="padding:17px 4px;border-top:1px solid rgba(52,64,47,.1)">
				<span class="text-[#8a857a] w-24" style="font:500 13px var(--font-mono)"><?php echo esc_html( $item['date'] ); ?></span>
				<span class="text-white text-[11px] font-medium px-2.5 py-1 rounded-md"
				      style="background:var(--color-brand-green);font-family:var(--font-sans);letter-spacing:.06em"><?php echo esc_html( $item['tag'] ); ?></span>
				<span class="flex-1 min-w-[200px]" style="font:400 14px/1.7 var(--font-sans)"><?php echo esc_html( $item['text'] ); ?></span>
			</a>
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
		<!-- 画像プレースホルダー -->
		<div class="min-h-[320px] h-full bg-brand-light rounded-[22px] flex items-end justify-end p-4"
		     style="box-shadow:0 16px 40px rgba(52,64,47,.12)">
			<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">講師の顔写真</span>
		</div>
		<div class="flex flex-col gap-3.5">
			<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.3em">PIANO TEACHER</span>
			<div class="flex items-baseline gap-3.5">
				<h2 class="m-0 text-brand-dark" style="font:600 clamp(24px,3vw,32px) var(--font-serif);letter-spacing:.08em">講師名 篠原朋子</h2>
				<span class="text-[#8a857a]" style="font:400 11px var(--font-mono);letter-spacing:.2em">PIANO INSTRUCTOR</span>
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
			<div class="min-h-[260px] h-full w-full bg-brand-light flex items-end justify-end p-4">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">レッスンの様子</span>
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
			<div class="min-h-[260px] h-full order-1 bg-brand-light flex items-end justify-end p-4">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">発表会のステージ</span>
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
			<div class="w-full min-h-[230px] h-full rounded-[20px] bg-brand-light flex items-end justify-end p-4" style="box-shadow:0 12px 30px rgba(52,64,47,.1)">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)">地図サムネイル</span>
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
	<div class="absolute text-white/10 pointer-events-none select-none" style="top:-40px;right:-20px;font:600 200px var(--font-serif);line-height:1">♪</div>
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
<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
   class="fixed right-4 bottom-4 z-[60] flex items-center gap-3 text-white no-underline rounded-[18px] cursor-pointer hover:bg-[#c96f42] transition-colors"
   style="background:#D67A4C;padding:13px 18px 13px 15px;box-shadow:0 12px 30px rgba(214,122,76,.45);animation:floatY 4s ease-in-out infinite">
	<span class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-xl">♪</span>
	<span class="flex flex-col leading-[1.35] text-left">
		<span style="font:400 10px var(--font-sans);opacity:.92">かんたん・無料</span>
		<span style="font:700 13px var(--font-sans);letter-spacing:.02em">体験レッスンのお申し込み</span>
	</span>
</a>

</main>

<?php get_footer(); ?>
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/front-page.php
git commit -m "feat: create front-page.php with all top-page sections"
```

---

### Task 7: page-lessons.php 作成（レッスン案内）

**Files:**
- Create: `themes/shino-music-school/page-lessons.php`

- [ ] **Step 1: page-lessons.php を新規作成する**

```php
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/page-lessons.php
git commit -m "feat: create page-lessons.php"
```

---

### Task 8: page-price.php 作成（料金）

**Files:**
- Create: `themes/shino-music-school/page-price.php`

- [ ] **Step 1: page-price.php を新規作成する**

```php
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
							<th class="text-left" style="padding:16px 22px;font:600 13px var(--font-sans);letter-spacing:.04em">コース</th>
							<th class="text-center" style="padding:16px 14px;font:600 13px var(--font-sans)">回数 / 月</th>
							<th class="text-center" style="padding:16px 14px;font:600 13px var(--font-sans)">1回</th>
							<th class="text-right" style="padding:16px 22px;font:600 13px var(--font-sans)">月謝(税込)</th>
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/page-price.php
git commit -m "feat: create page-price.php"
```

---

### Task 9: page-gallery.php 作成（発表会・生徒の声）

**Files:**
- Create: `themes/shino-music-school/page-gallery.php`

- [ ] **Step 1: page-gallery.php を新規作成する**

```php
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
				array( 'label' => 'ステージ全景',  'span' => 'row-span-2 h-full' ),
				array( 'label' => '演奏する生徒',  'span' => 'h-full' ),
				array( 'label' => '連弾',          'span' => 'h-full' ),
				array( 'label' => '記念撮影',      'span' => 'h-full' ),
				array( 'label' => '花束',          'span' => 'h-full' ),
			);
			foreach ( $gallery_items as $item ) :
			?>
			<div class="bg-brand-light rounded-[18px] flex items-end justify-end p-3 <?php echo esc_attr( $item['span'] ); ?>">
				<span class="text-brand-green text-xs" style="font-family:var(--font-mono)"><?php echo esc_html( $item['label'] ); ?></span>
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/page-gallery.php
git commit -m "feat: create page-gallery.php"
```

---

### Task 10: page-access.php 作成（アクセス）

**Files:**
- Create: `themes/shino-music-school/page-access.php`

- [ ] **Step 1: page-access.php を新規作成する**

```php
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
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/page-access.php
git commit -m "feat: create page-access.php"
```

---

### Task 11: page-contact.php 作成（お問い合わせ）

**Files:**
- Create: `themes/shino-music-school/page-contact.php`

**前提:** Contact Form 7 プラグインがインストール済みで、フォームが1件作成されていること。作成後に WP 管理画面でフォームのショートコード（例: `[contact-form-7 id="abc123"]`）を確認して、Step 1 の `$cf7_shortcode` に設定する。

- [ ] **Step 1: page-contact.php を新規作成する**

```php
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
				<a href="tel:00012345678" class="flex items-center gap-3.5 py-3.5 text-inherit no-underline cursor-pointer transition-opacity hover:opacity-70">
					<span class="w-11 h-11 rounded-xl bg-brand-dark text-white flex items-center justify-center text-lg">☎</span>
					<div>
						<div class="text-brand-dark" style="font:600 14px var(--font-sans)">000-1234-5678</div>
						<div class="text-[#8a857a]" style="font:400 11.5px var(--font-sans)">受付 火〜土 10:00–20:00</div>
					</div>
				</a>
			</div>
			<!-- 営業時間 -->
			<div class="bg-brand-light rounded-[18px] p-6">
				<span class="text-brand-green" style="font:500 10px var(--font-mono);letter-spacing:.24em">HOURS</span>
				<div class="mt-3 flex flex-col gap-2">
					<div class="flex justify-between text-brand-text" style="font:400 13px var(--font-sans)">
						<span>火曜 〜 土曜</span>
						<span class="font-semibold">10:00 – 20:00</span>
					</div>
					<div class="flex justify-between text-[#8a857a]" style="font:400 13px var(--font-sans)">
						<span>日曜・月曜</span>
						<span class="font-semibold">定休日</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
```

- [ ] **Step 2: コミットする**

```bash
git add themes/shino-music-school/page-contact.php
git commit -m "feat: create page-contact.php with CF7 shortcode"
```

---

### Task 12: Tailwind ビルド・WP ページ作成・動作確認・最終コミット

**Files:**
- Modify: `themes/shino-music-school/assets/css/app.css`（ビルド成果物）

- [ ] **Step 1: Tailwind をビルドする**

```bash
cd themes/shino-music-school && npm run build && cd ../..
```

期待: エラーなし、`assets/css/app.css` が更新される。

- [ ] **Step 2: WordPress を起動する**

```bash
docker compose up -d
```

ブラウザで `http://localhost:8080/wp-admin` を開く。

- [ ] **Step 3: WordPress 管理画面でページを作成する**

「固定ページ」→「新規追加」で以下の6ページを作成する（スラッグが重要）:

| タイトル         | スラッグ  |
|------------------|-----------|
| トップページ     | （設定→表示設定で「フロントページ」に指定） |
| レッスン案内     | `lessons` |
| 料金             | `price`   |
| 発表会・生徒の声 | `gallery` |
| アクセス         | `access`  |
| お問い合わせ     | `contact` |

「設定」→「表示設定」→「フロントページの表示」を「固定ページ」にし、トップページを選択する。

- [ ] **Step 4: Contact Form 7 をインストールしてフォームを作成する**

1. 「プラグイン」→「新規追加」で "Contact Form 7" を検索してインストール・有効化
2. 「お問い合わせ」→「新規追加」でフォームを作成（フィールド: お名前・年齢/学年・電話番号・メールアドレス・ご希望の日時・メッセージ）
3. 生成されたショートコードをコピーして `page-contact.php` の `$cf7_shortcode` 変数に設定する

- [ ] **Step 5: 各ページをブラウザで確認する**

- `http://localhost:8080/` → ヒーロー・全セクション表示
- `http://localhost:8080/lessons/` → コース4種・FAQ 表示
- `http://localhost:8080/price/` → 料金テーブル表示
- `http://localhost:8080/gallery/` → フォトグリッド・声 表示
- `http://localhost:8080/access/` → 住所詳細 表示
- `http://localhost:8080/contact/` → CF7 フォーム表示

- [ ] **Step 6: スクロールアニメーションを確認する**

- トップページをスクロールし、`data-reveal` / `data-stagger` 要素がフェードインすること
- ヒーローのアイボリーパネルがスクロールで拡張すること
- スクロール 16px 超でヘッダーが縮小・shadow が付くこと

- [ ] **Step 7: ハンバーガーメニューを確認する**

ブラウザ幅を 1040px 未満に縮め、☰ ボタンでドロワーが開閉すること。

- [ ] **Step 8: 最終コミットして push する**

```bash
git add themes/shino-music-school/assets/css/app.css
git commit -m "build: rebuild Tailwind CSS for all new templates"
git push origin main
```
