# WordPress + Tailwind テーマ実装設計

**日付:** 2026-06-28  
**対象:** `themes/shino-music-school/`  
**参照元:** `docs/index.html`（dc-runtime SPA）

---

## 背景・目的

`docs/index.html` はカスタムdc-runtimeによるSPAで、6ページ分のコンテンツを1ファイルに収めている。これをWordPressテーマとして再実装し、CMSとして運用できる状態にする。`docs/` 配下のファイルは参照用として残す。

---

## アーキテクチャ

### アプローチ：ページテンプレート方式（`page-{slug}.php`）

WordPressの標準命名規則 `page-{slug}.php` を使い、URLスラッグとテンプレートを1対1対応させる。管理画面でのテンプレート手動設定は不要。

---

## ファイル構成

```
themes/shino-music-school/
├── front-page.php       新規 — トップページ全セクション
├── page-lessons.php     新規 — レッスン案内
├── page-price.php       新規 — 料金
├── page-gallery.php     新規 — 発表会・生徒の声
├── page-access.php      新規 — アクセス
├── page-contact.php     新規 — お問い合わせ（CF7ショートコード埋込）
├── header.php           全書き換え — ロゴ・ナビ・ハンバーガー
├── footer.php           全書き換え — フッターグリッド・コピーライト
├── functions.php        追記 — CF7サポート（add_theme_support）
├── style.css            既存（テーマ宣言のみ、変更なし）
└── assets/
    ├── src/app.css      更新 — デザイントークン・アニメ定義
    ├── css/app.css      ビルド成果物（git管理）
    └── js/
        ├── wpsbc-custom.js  既存
        └── main.js          新規 — スクロールアニメ・ハンバーガー・ヘッダー縮小
```

---

## デザイントークン（`assets/src/app.css`）

既存のトークンを `docs/index.html` の実際の色に合わせて更新する。

```css
@theme {
  --color-brand-bg:     #F7F3EA;   /* アイボリー背景 */
  --color-brand-text:   #3E3A33;   /* メインテキスト */
  --color-brand-dark:   #34402F;   /* 見出し・ダーク */
  --color-brand-green:  #7E8B6B;   /* フォレストグリーン */
  --color-brand-light:  #EEF0E6;   /* 薄グリーン */
  --color-brand-orange: #D67A4C;   /* CTAオレンジ */

  --font-sans:  'Noto Sans JP', sans-serif;
  --font-serif: 'Noto Serif JP', serif;
  --font-mono:  'IBM Plex Mono', monospace;
}
```

アニメーション定義（`floatY`, `cueBounce`, `menuIn`, `drift`）もapp.cssに追加する。

---

## JavaScript（`assets/js/main.js`）

`docs/index.html` のインラインロジックをVanilla JSとして分離。以下を実装：

- **スクロールreveal**: `data-reveal` / `data-stagger` 属性要素をIntersectionObserverでフェードイン
- **ヒーローivoryパネル**: スクロール量に応じてSVG pathを変形
- **パラックス背景**: `#heroBg` を `translateY` でずらす
- **ヘッダー縮小**: スクロール16px超でpadding縮小・shadow追加
- **ハンバーガーメニュー**: モバイルドロワー開閉（`aria-expanded` 管理）

---

## ページテンプレート詳細

### `front-page.php`
1. ヒーローセクション（sticky ivory panel + 縦書き見出し + CTAボタン）
2. 地域・想いセクション（背景画像プレースホルダー + テキスト）
3. お知らせ（3件ハードコード）
4. 4つの魅力（グリッドカード）
5. 講師紹介（画像プレースホルダー + テキスト）
6. レッスン/発表会ハーフスプリットカード
7. レッスンの流れ（3ステップ）
8. 生徒の声（3件）
9. アクセス抜粋（地図サムネプレースホルダー + 住所）
10. 体験レッスンCTAバナー

### `page-lessons.php`
- コース4種カード（子ども・大人・初心者・再開）
- 入会フロー（3ステップ）
- FAQ（HTMLの `<details>/<summary>` タグで実装）

### `page-price.php`
- 体験レッスン無料ハイライトボックス
- 料金テーブル（4コース）
- 諸費用カード（入会金・教材費・発表会費）

### `page-gallery.php`
- 発表会写真グリッド（5枚プレースホルダー）
- 生徒・保護者の声カード（3件）

### `page-access.php`
- 地図プレースホルダー
- 住所・アクセス詳細テーブル
- 外観写真プレースホルダー（2枚グリッド）

### `page-contact.php`
- ページヘッダー（緑背景）
- CF7ショートコード（`[contact-form-7 id="..." title="体験レッスン申込"]`）
- 連絡先チャンネルカード（LINE・Instagram・電話）
- 営業時間カード

### `header.php`
- スティッキーヘッダー（`position: sticky; top: 0; z-index: 50`）
- ロゴ画像（`https://shino-music.com/` から参照）
- デスクトップナビゲーション（5リンク、直書き）
- 体験申込CTAボタン
- ハンバーガーボタン（`aria-expanded`）
- モバイルドロワー（右からスライド）

### `footer.php`
- グリッドレイアウト（ロゴ+住所+SNS | ナビリンク）
- コピーライト

---

## お問い合わせフォーム

Contact Form 7プラグインを使用。テンプレート側はショートコード `<?php echo do_shortcode('[contact-form-7 ...]'); ?>` で埋め込む。フォームのフィールド定義（お名前・年齢/学年・電話番号・メール・希望日時・メッセージ）はCF7管理画面で設定。

---

## お知らせ

`front-page.php` にハードコード（3件固定）。将来的にWP投稿タイプへの移行は別タスク。

---

## 画像

すべてプレースホルダー（グレー背景 + 説明テキスト）で実装。`<div>` でサイズを確保し、後からWPのアイキャッチ画像やメディアライブラリ画像に差し替えられる構造にする。

---

## Tailwindビルド

既存の `package.json` スクリプトをそのまま使用：

```bash
npm run dev    # watch
npm run build  # minify
```

テンプレートファイル追加後は `assets/src/app.css` の `@import "tailwindcss" source("../..")` がテーマルート全体を自動スキャンするため、設定変更不要。

---

## 実装順序

1. デザイントークン更新（`app.css`）
2. `main.js` 作成
3. `header.php` / `footer.php` 書き換え
4. `front-page.php` 作成
5. `page-lessons.php` 作成
6. `page-price.php` 作成
7. `page-gallery.php` 作成
8. `page-access.php` 作成
9. `page-contact.php` 作成
10. `functions.php` 追記（CF7サポート）
11. Tailwindビルド（`npm run build`）
12. git commit & push
