# HERO・Footer スマホレスポンシブ 実装計画

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** スマホ（767px 以下）で HERO セクションの余分なスクロールをなくし、Footer のナビリンクを左揃えにする。

**Architecture:** CSS メディアクエリで HERO の高さと sticky を上書き、JS の `onScroll()` にモバイル判定を追加してパラックスをスキップ、Footer の Tailwind クラスをレスポンシブ対応に変更。

**Tech Stack:** Tailwind CSS v4（CLI ビルド）、Vanilla JS

## Global Constraints

- ブレークポイントは `767px`（max-width）/ `768px`（min-width）で統一すること
- デスクトップ（768px 以上）の挙動は一切変更しないこと
- inline style を CSS から上書きする場合は `!important` を使うこと（inline style は CSS より優先度が高いため）
- ビルドコマンド: `themes/shino-music-school/` ディレクトリで `npm run build`
- Tailwind の `md:` プレフィクスは 768px 以上に対応する

---

## ファイル構成

| ファイル | 変更内容 |
|---|---|
| `themes/shino-music-school/footer.php` | ナビリンクの `justify-end` → `md:justify-end` |
| `themes/shino-music-school/assets/src/app.css` | HERO モバイル用メディアクエリを追加 |
| `themes/shino-music-school/assets/js/main.js` | `onScroll()` にモバイル判定を追加 |
| `themes/shino-music-school/assets/css/app.css` | ビルド成果物（自動生成） |

---

## Task 1: Footer ナビリンク左揃え

**Files:**
- Modify: `themes/shino-music-school/footer.php:49`
- Modify: `themes/shino-music-school/assets/css/app.css`（ビルド成果物）

**Interfaces:**
- Produces: スマホで Footer のナビリンクが左揃え、デスクトップでは右揃えを維持

- [ ] **Step 1: `footer.php` の `justify-end` を `md:justify-end` に変更**

`footer.php` 49 行目を変更する。

変更前:
```html
<div class="flex justify-end">
```

変更後:
```html
<div class="flex md:justify-end">
```

- [ ] **Step 2: CSS をビルド**

```bash
cd themes/shino-music-school && npm run build
```

Expected: `assets/css/app.css` が更新される（エラーなし）

- [ ] **Step 3: ブラウザで確認**

ブラウザ DevTools でウィンドウ幅を 375px に設定し、Footer を確認する。

確認項目:
- ナビリンク（LESSON / GALLERY / ACCESS / PRICE / CONTACT）がロゴ・住所ブロックと同じ左端に揃っている
- デスクトップ（1200px）では右寄せのまま

- [ ] **Step 4: コミット**

```bash
git add themes/shino-music-school/footer.php themes/shino-music-school/assets/css/app.css
git commit -m "fix: left-align footer nav links on mobile with md:justify-end"
```

---

## Task 2: HERO スマホ CSS（高さ・sticky 解除・背景リセット）

**Files:**
- Modify: `themes/shino-music-school/assets/src/app.css`
- Modify: `themes/shino-music-school/assets/css/app.css`（ビルド成果物）

**Interfaces:**
- Produces: スマホで `#heroWrap` が `100svh`、`#heroSection` が `relative`、`#heroBg` の余白なし

- [ ] **Step 1: `app.css` にモバイル用メディアクエリを追加**

`themes/shino-music-school/assets/src/app.css` の末尾（WPSBCスタイルより前、最後のブロックの後ろ）に追記する。

```css
/* ===== HERO スマホ最適化 ===== */
@media (max-width: 767px) {
  #heroWrap {
    height: calc(100svh - var(--hdr-h, 66px)) !important;
  }
  #heroSection {
    position: relative !important;
    top: 0 !important;
  }
  #heroBg {
    top: 0 !important;
    height: 100% !important;
  }
}
```

追記場所の目安: `/* ===== WP Simple Booking Calendar` のコメント行の直前。

- [ ] **Step 2: CSS をビルド**

```bash
cd themes/shino-music-school && npm run build
```

Expected: `assets/css/app.css` が更新される（エラーなし）

- [ ] **Step 3: ブラウザで確認（CSS のみ）**

ブラウザ DevTools でウィンドウ幅を 375px に設定し、HERO を確認する。

確認項目:
- HERO が画面高さちょうど（100svh - ヘッダー）で収まっている
- HERO を抜けるのに余分なスクロールがない（すぐ次のセクションが来る）
- 背景画像が正しく表示されている（はみ出しや黒帯がない）
- デスクトップ（1200px）では従来通り 165svh の sticky スクロール演出が維持されている

- [ ] **Step 4: コミット**

```bash
git add themes/shino-music-school/assets/src/app.css themes/shino-music-school/assets/css/app.css
git commit -m "fix: disable HERO parallax height on mobile with CSS media query"
```

---

## Task 3: HERO スマホ JS（パラックス無効化）

**Files:**
- Modify: `themes/shino-music-school/assets/js/main.js:18-20`

**Interfaces:**
- Consumes: Task 2 の CSS（`#heroSection` が `relative` になっている状態）
- Produces: スマホで背景画像の `transform` 更新と ivory パネルアニメーションがスキップされる

**背景:** `onScroll()` 内で `heroBg.style.transform = 'translateY(' + (y * 0.22) + 'px)'` が常に実行されているため、Task 2 の CSS だけではスクロール中に背景がずれ続ける。JS 側でもスマホを判定してスキップする必要がある。

- [ ] **Step 1: `main.js` の `onScroll()` を修正**

`main.js` の `onScroll()` 関数内（18〜20 行目付近）を以下のように変更する。

変更前:
```js
var heroBg = document.getElementById('heroBg');
if (heroBg) heroBg.style.transform = 'translateY(' + (y * 0.22) + 'px)';
updateHeroCurve();
```

変更後:
```js
var heroBg = document.getElementById('heroBg');
if (heroBg) {
  if (window.innerWidth > 767) {
    heroBg.style.transform = 'translateY(' + (y * 0.22) + 'px)';
  } else {
    heroBg.style.transform = '';
  }
}
if (window.innerWidth > 767) {
  updateHeroCurve();
}
```

- [ ] **Step 2: ブラウザで確認**

ブラウザ DevTools でウィンドウ幅を 375px に設定し、HERO を確認する。

確認項目:
- スクロール中に背景画像がずれない（`transform` が空のまま）
- ivory パネルが静止したままである（アニメーションしない）
- `#heroPhotoText`（説明文 + CTA）が常に表示されている（opacity: 1 のまま）
- `#scrollCue`（SCROLL インジケーター）が表示されている
- デスクトップ（1200px）ではパラックス・ivory パネルアニメーションが従来通り動作する

- [ ] **Step 3: コミット**

```bash
git add themes/shino-music-school/assets/js/main.js
git commit -m "fix: skip parallax and ivory panel animation on mobile"
```
