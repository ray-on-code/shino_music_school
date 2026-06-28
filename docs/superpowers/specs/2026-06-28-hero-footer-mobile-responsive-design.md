# HERO・Footer スマホレスポンシブ 設計ドキュメント

**日付**: 2026-06-28  
**対象ファイル**: `themes/shino-music-school/front-page.php`, `themes/shino-music-school/footer.php`, `themes/shino-music-school/assets/src/app.css`

---

## 背景と課題

### HERO セクション

現在の構造：

- `#heroWrap`: `height: calc(165svh - var(--hdr-h, 66px))` — スクロール空間の確保
- `#heroSection`: `position: sticky; top: var(--hdr-h,66px); height: calc(100svh - var(--hdr-h,66px))` — 画面に貼り付く
- `#heroBg`: `top: -8%; height: 118%; will-change: transform` — JS でパラックス変形

デスクトップでは「スクロールしながら背景が視差で動く」演出として機能するが、スマホでは **約65svh 分の余分なスクロール**が発生し、次のセクションにたどり着くまでが長く感じられる。

### Footer

現在の構造：

- グリッド `repeat(auto-fit, minmax(260px, 1fr))` — スマホで自動的に縦積み
- ナビリンクブロックが `justify-end`（右寄せ）のまま

スマホで縦積みになったとき、ナビリンクが右側に寄り、上のロゴ・住所ブロックと視覚的に不統一になる。

---

## 設計

### HERO: スマホ（767px 以下）での変更

#### CSS（`app.css` に追加）

```css
@media (max-width: 767px) {
  #heroWrap {
    height: calc(100svh - var(--hdr-h, 66px));
  }
  #heroSection {
    position: relative;
    top: 0;
  }
  #heroBg {
    top: 0;
    height: 100%;
  }
}
```

- `#heroWrap` の高さを `100svh` に縮め、余分なスクロール空間をなくす
- `#heroSection` を `sticky` → `relative` に変更し、貼り付き挙動を解除
- `#heroBg` の `top: -8%; height: 118%` をリセット（パラックス用の余白を除去）

#### JS（パラックス処理のスキップ）

パラックスを担う JS（`#heroBg` の transform 更新処理）に、スマホ幅判定を追加してスキップする。

```js
// 既存のスクロールハンドラ内に追加
if (window.innerWidth <= 767) return;
```

リサイズ時にも再判定する（`window.addEventListener('resize', ...)` で `innerWidth` を再チェック）。

---

### Footer: スマホでのナビリンク左揃え

#### HTML（`footer.php`）

ナビリンクブロックの `justify-end` を Tailwind のレスポンシブプレフィクスで制御する。

**変更前:**
```html
<div class="flex justify-end">
```

**変更後:**
```html
<div class="flex md:justify-end">
```

スマホでは `justify-start`（デフォルト）、`md`（768px 以上）では `justify-end` になる。

---

## 影響範囲

| ファイル | 変更内容 |
|---|---|
| `assets/src/app.css` | モバイル用 HERO メディアクエリを追加 |
| `front-page.php` | JS のパラックス処理にスマホ判定を追加（JS ファイルが別ファイルなら該当 JS を修正） |
| `footer.php` | `justify-end` → `md:justify-end` に変更 |

---

## 非変更事項

- HERO 内部のアイボリーパネル（SVG）・縦書き見出し・CTA ボタンの配置は変更しない
- デスクトップ（768px 以上）の挙動は一切変更しない
- Footer の `grid-template-columns` はそのまま（auto-fit が正しく機能している）
