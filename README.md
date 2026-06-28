# Shino Music School (WordPress local)

Docker でローカルに WordPress を起動するための構成です。
**Git 管理対象は Docker 関連ファイルとテーマ（`themes/`）のみ**で、WordPress コア一式は
コンテナ初回起動時に `./wp/` へ自動展開されます（`.gitignore` 済み）。

## 構成

```
.
├── .env.example          # 環境変数テンプレート（コミット対象）
├── .env                  # 実値（gitignore）
├── docker-compose.yml
├── Makefile
├── wp/                   # WordPress コア（自動展開 / gitignore）
└── themes/
    └── shino-music-school/   # テーマ（コミット対象）
```

## 必要なもの

- Docker / Docker Compose v2

## クイックスタート

```bash
# 1. 環境変数を用意
cp .env.example .env

# 2. 起動 → インストール → テーマ有効化 を一括実行
make setup
```

起動後、ブラウザで http://localhost:8080 にアクセスします
（管理画面: http://localhost:8080/wp-admin , 既定 admin / admin）。

## 主な Make ターゲット

| ターゲット | 内容 |
|------------|------|
| `make up` | コンテナ起動（初回にコアを `./wp` へ展開） |
| `make down` | 停止・削除 |
| `make setup` | 起動 + WordPress インストール + テーマ有効化 |
| `make download` | コア（日本語版）を `./wp` に明示ダウンロード |
| `make install` | wp-cli で初期セットアップ |
| `make activate-theme` | `.env` の `WP_THEME` を有効化 |
| `make wp ARGS="plugin list"` | 任意の wp-cli 実行 |
| `make assets` | Tailwind を watch ビルド（開発中つけっぱなし） |
| `make build-css` | 本番用に Tailwind を minify ビルド（1回） |
| `make logs` | ログ追従 |
| `make clean` | コンテナ・ボリューム・`./wp` を全削除 |

## 環境変数（`.env`）

ポート・DB 接続情報・サイト情報・有効化テーマ名などを定義し、
`docker-compose.yml` の変数展開および `wp-cli` インストール時に読み込まれます。
詳細は `.env.example` を参照してください。

## テーマ開発

`themes/shino-music-school/` を編集すると、`/var/www/html/wp-content/themes/` に
マウントされているため即座に反映されます。新しいテーマを追加した場合は
`.env` の `WP_THEME` を変更してください。

### スタイル（Tailwind CSS）

スタイルは Tailwind CSS v4 でビルドします。**ホストに Node を入れる必要はなく**、
専用のビルドコンテナ（`node:22-alpine`）内で完結します。

- 入力: `themes/shino-music-school/assets/src/app.css`
- 出力: `themes/shino-music-school/assets/css/app.css`（WordPress が読み込む。コミット対象）

```bash
# 開発中（ファイル変更を監視して自動ビルド・つけっぱなし）
make assets

# 本番反映前などに 1 回だけビルド（minify）
make build-css
```

`app.css`（テーマ全体）と WP Simple Booking Calendar の見た目調整は同じ入力ファイルに
集約されています。テンプレート（`*.php`）内の Tailwind ユーティリティクラスは自動検出されます。
`node_modules/` は `.gitignore` 済みです。
