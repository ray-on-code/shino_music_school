# 投稿タイプ実装プラン

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** ACF 6+ を使ってお知らせ・ブログ・生徒の声の3投稿タイプとカスタムタクソノミーを管理画面から登録し、CMSとして運用できる状態にする。

**Architecture:** ACF 6+ プラグインを使い、投稿タイプ・タクソノミーは管理画面のUIから登録。生徒の声用のカスタムフィールド（お名前・年齢）もACFフィールドグループで管理。DBバックアップで環境リセット時の再構築リスクを軽減する。

**Tech Stack:** WordPress 6.x、ACF 6.x（Advanced Custom Fields）、WP-CLI（プラグインインストール）、Docker Compose

## Global Constraints

- ACF は無料版（Advanced Custom Fields）を使用。ACF Proは不要。
- 投稿タイプ・タクソノミー登録はコードではなく管理画面UIで行う。
- テンプレートファイル（archive-news.php 等）の実装はこのプランのスコープ外。
- 環境: http://localhost:8080（管理画面: http://localhost:8080/wp-admin）

---

### Task 1: Makefile に plugins ターゲットを追加して ACF をインストール

**Files:**
- Modify: `Makefile`

**Interfaces:**
- Produces: `make install-plugins` で ACF がインストール・有効化される

- [ ] **Step 1: Makefile に `install-plugins` ターゲットを追加**

`Makefile` の `setup` ターゲットの後に以下を追記する：

```makefile
.PHONY: install-plugins
install-plugins: ## 必要プラグインをインストール・有効化
	$(COMPOSE) run --rm wpcli wp plugin install advanced-custom-fields --activate
```

また `setup` ターゲットを更新して `install-plugins` を含める：

```makefile
.PHONY: setup
setup: up install activate-theme install-plugins ## 起動〜インストール〜テーマ有効化〜プラグインを一括実行
	@echo "Done. -> $(WP_URL)"
```

- [ ] **Step 2: コンテナが起動していることを確認**

```bash
make ps
```

`wordpress` と `wpcli` が `running` 状態であることを確認。起動していなければ `make up` を実行。

- [ ] **Step 3: ACF をインストール**

```bash
make install-plugins
```

期待出力：
```
Plugin 'advanced-custom-fields' installed successfully.
Activating 'advanced-custom-fields'...
Plugin 'advanced-custom-fields' activated.
```

- [ ] **Step 4: 管理画面でACFが有効化されていることを確認**

ブラウザで http://localhost:8080/wp-admin/plugins.php を開き、「Advanced Custom Fields」が有効化（青色）になっていることを確認。左メニューに「カスタムフィールド」が表示されていることを確認。

- [ ] **Step 5: コミット**

```bash
git add Makefile
git commit -m "feat: add install-plugins target for ACF"
```

---

### Task 2: カスタム投稿タイプを ACF 管理画面から登録

**Files:**
- 変更なし（ACFがDBに保存するため）

**Interfaces:**
- Produces: `news`・`blog`・`voice` の3投稿タイプが管理画面の左メニューに表示される

- [ ] **Step 1: `news`（お知らせ）を登録**

管理画面 → カスタムフィールド → 投稿タイプ → 「投稿タイプを追加」

| 設定項目 | 値 |
|---|---|
| 複数形ラベル | お知らせ一覧 |
| 単数形ラベル | お知らせ |
| 投稿タイプキー | `news` |
| 説明 | 教室からの案内・スケジュール変更など |
| 公開 | はい |
| アーカイブあり | はい |
| REST API で表示 | はい |
| サポートする機能 | タイトル、エディター、アイキャッチ画像 |

「保存」をクリック。

- [ ] **Step 2: `blog`（ブログ）を登録**

管理画面 → カスタムフィールド → 投稿タイプ → 「投稿タイプを追加」

| 設定項目 | 値 |
|---|---|
| 複数形ラベル | ブログ一覧 |
| 単数形ラベル | ブログ |
| 投稿タイプキー | `blog` |
| 説明 | 発表会・イベントレポート、レッスン風景 |
| 公開 | はい |
| アーカイブあり | はい |
| REST API で表示 | はい |
| サポートする機能 | タイトル、エディター、アイキャッチ画像 |

「保存」をクリック。

- [ ] **Step 3: `voice`（生徒の声）を登録**

管理画面 → カスタムフィールド → 投稿タイプ → 「投稿タイプを追加」

| 設定項目 | 値 |
|---|---|
| 複数形ラベル | 生徒の声一覧 |
| 単数形ラベル | 生徒の声 |
| 投稿タイプキー | `voice` |
| 説明 | 生徒・保護者のテスティモニアル |
| 公開 | はい |
| アーカイブあり | はい |
| REST API で表示 | はい |
| サポートする機能 | タイトル、エディター（アイキャッチ画像はチェックしない） |

「保存」をクリック。

- [ ] **Step 4: 3タイプが管理画面左メニューに表示されることを確認**

管理画面の左サイドバーに「お知らせ」「ブログ」「生徒の声」が表示されていることを確認。

---

### Task 3: カスタムタクソノミーを ACF 管理画面から登録

**Files:**
- 変更なし（ACFがDBに保存するため）

**Interfaces:**
- Produces: `news_cat`・`blog_cat` のタクソノミーが各投稿タイプに紐付く

- [ ] **Step 1: `news_cat`（お知らせカテゴリ）を登録**

管理画面 → カスタムフィールド → タクソノミー → 「タクソノミーを追加」

| 設定項目 | 値 |
|---|---|
| 複数形ラベル | お知らせカテゴリ |
| 単数形ラベル | お知らせカテゴリ |
| タクソノミーキー | `news_cat` |
| 投稿タイプ | `news`（チェック） |
| 階層 | はい（カテゴリ型） |
| 公開 | はい |

「保存」をクリック。

- [ ] **Step 2: `blog_cat`（ブログカテゴリ）を登録**

管理画面 → カスタムフィールド → タクソノミー → 「タクソノミーを追加」

| 設定項目 | 値 |
|---|---|
| 複数形ラベル | ブログカテゴリ |
| 単数形ラベル | ブログカテゴリ |
| タクソノミーキー | `blog_cat` |
| 投稿タイプ | `blog`（チェック） |
| 階層 | はい（カテゴリ型） |
| 公開 | はい |

「保存」をクリック。

- [ ] **Step 3: タクソノミーが各投稿タイプに表示されることを確認**

管理画面 → お知らせ → カテゴリ（`news_cat`）がサイドバーに表示されることを確認。
管理画面 → ブログ → カテゴリ（`blog_cat`）がサイドバーに表示されることを確認。

---

### Task 4: 初期カテゴリを登録

**Files:**
- 変更なし（DBデータ）

**Interfaces:**
- Produces: 投稿作成時にカテゴリを選択できる状態になる

- [ ] **Step 1: お知らせカテゴリの初期値を登録**

管理画面 → お知らせ → お知らせカテゴリ（左メニュー）→ 以下を3件追加：

| 名前 | スラッグ |
|---|---|
| レッスンスケジュール | `lesson-schedule` |
| 発表会・イベント案内 | `event-info` |
| 一般 | `general` |

各カテゴリの「名前」と「スラッグ」を入力して「新規カテゴリを追加」をクリック。

- [ ] **Step 2: ブログカテゴリの初期値を登録**

管理画面 → ブログ → ブログカテゴリ（左メニュー）→ 以下を3件追加：

| 名前 | スラッグ |
|---|---|
| 発表会 | `recital` |
| イベント・コンサート | `event-concert` |
| レッスン風景 | `lesson-scene` |

- [ ] **Step 3: カテゴリが選択できることを確認**

管理画面 → お知らせ → 「新規お知らせを追加」で投稿作成画面を開き、右サイドバーに3カテゴリが表示されることを確認。ブログも同様に確認。

---

### Task 5: ACF フィールドグループ（生徒の声用）を登録

**Files:**
- 変更なし（ACFがDBとLocal JSONに保存）

**Interfaces:**
- Produces: 生徒の声の投稿作成画面に「お名前」「年齢」フィールドが表示される

- [ ] **Step 1: フィールドグループを作成**

管理画面 → カスタムフィールド → フィールドグループ → 「フィールドグループを追加」

グループ名: `生徒の声 詳細`

- [ ] **Step 2: 「お名前」フィールドを追加**

「フィールドを追加」をクリックして以下を設定：

| 設定項目 | 値 |
|---|---|
| フィールドラベル | お名前 |
| フィールド名 | `voice_name` |
| フィールドタイプ | テキスト |
| 説明 | 例：Aさん、山田様（匿名・イニシャル表記） |
| 必須 | いいえ |

- [ ] **Step 3: 「年齢」フィールドを追加**

「フィールドを追加」をクリックして以下を設定：

| 設定項目 | 値 |
|---|---|
| フィールドラベル | 年齢 |
| フィールド名 | `voice_age` |
| フィールドタイプ | テキスト |
| 説明 | 例：32歳、40代 |
| 必須 | いいえ |

- [ ] **Step 4: 表示ルールを設定**

ページ下部「設定」→「表示ルール」で以下を設定：

```
投稿タイプ が次の値と等しい: 生徒の声（voice）
```

「保存」をクリック。

- [ ] **Step 5: フィールドが表示されることを確認**

管理画面 → 生徒の声 → 「新規生徒の声を追加」で投稿作成画面を開き、「お名前」「年齢」の入力フィールドが表示されることを確認。

---

### Task 6: DB バックアップと動作確認

**Files:**
- 変更なし

**Interfaces:**
- Produces: 設定がバックアップされ、`make clean` 後に復元できる状態になる

- [ ] **Step 1: 動作確認（サンプル投稿を作成）**

各投稿タイプでサンプルを1件ずつ作成して公開できることを確認：

| 投稿タイプ | タイトル例 | カテゴリ |
|---|---|---|
| お知らせ | 【テスト】夏期レッスンスケジュールのご案内 | レッスンスケジュール |
| ブログ | 【テスト】春の発表会を開催しました | 発表会 |
| 生徒の声 | 【テスト】ピアノを習い始めて1年が経ちました | — |

生徒の声の投稿では「お名前」に「Aさん」、「年齢」に「32歳」を入力して保存。

- [ ] **Step 2: REST API で投稿タイプが取得できることを確認**

ブラウザまたは curl で以下のURLにアクセスし、JSONが返ることを確認：

```
http://localhost:8080/wp-json/wp/v2/news
http://localhost:8080/wp-json/wp/v2/blog
http://localhost:8080/wp-json/wp/v2/voice
```

- [ ] **Step 3: DB をバックアップ**

```bash
make wp ARGS="db export wp-backup-$(date +%Y%m%d).sql"
```

出力されたSQLファイルをプロジェクト外の安全な場所に保管（`.gitignore` 対象のため gitには入れない）。

- [ ] **Step 4: テスト用サンプル投稿を削除**

作成したテスト投稿3件をゴミ箱→完全削除して完了。
