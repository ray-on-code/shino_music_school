ENV_FILE := .env
COMPOSE  := docker compose

# .env から WP_THEME / WP_* を読み込む（install ターゲット等で使用）
ifneq (,$(wildcard $(ENV_FILE)))
include $(ENV_FILE)
export
endif

.DEFAULT_GOAL := help

.PHONY: help
help: ## 利用可能なターゲット一覧
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-16s\033[0m %s\n", $$1, $$2}'

.PHONY: env
env: ## .env を .env.example から生成（無ければ）
	@test -f $(ENV_FILE) || (cp .env.example $(ENV_FILE) && echo "created $(ENV_FILE)")

.PHONY: pull
pull: ## 使用イメージを取得
	$(COMPOSE) pull

.PHONY: up
up: env ## コンテナ起動（初回はコアが ./wp に自動展開される）
	$(COMPOSE) up -d

.PHONY: down
down: ## コンテナ停止・削除
	$(COMPOSE) down

.PHONY: restart
restart: ## 再起動
	$(COMPOSE) restart

.PHONY: logs
logs: ## ログ追従
	$(COMPOSE) logs -f

.PHONY: ps
ps: ## 稼働状況
	$(COMPOSE) ps

.PHONY: download
download: env ## WordPress コアを ./wp に明示的にダウンロード（日本語版）
	$(COMPOSE) run --rm wpcli wp core download --locale=ja --force

.PHONY: install
install: ## wp-cli で WordPress を初期セットアップ
	$(COMPOSE) run --rm wpcli wp core install \
		--url="$(WP_URL)" \
		--title="$(WP_TITLE)" \
		--admin_user="$(WP_ADMIN_USER)" \
		--admin_password="$(WP_ADMIN_PASSWORD)" \
		--admin_email="$(WP_ADMIN_EMAIL)" \
		--skip-email

.PHONY: activate-theme
activate-theme: ## .env の WP_THEME を有効化
	$(COMPOSE) run --rm wpcli wp theme activate "$(WP_THEME)"

.PHONY: setup
setup: up install activate-theme ## 起動〜インストール〜テーマ有効化を一括実行
	@echo "Done. -> $(WP_URL)"

.PHONY: wp
wp: ## 任意の wp-cli を実行 例: make wp ARGS="plugin list"
	$(COMPOSE) run --rm wpcli wp $(ARGS)

.PHONY: shell
shell: ## wordpress コンテナに入る
	$(COMPOSE) exec wordpress bash

.PHONY: assets
assets: ## Tailwind を watch ビルド（npm install 込み・フォアグラウンド）
	$(COMPOSE) run --rm assets

.PHONY: build-css
build-css: ## 本番用に Tailwind を minify ビルド（1回のみ）
	$(COMPOSE) run --rm assets sh -c "npm install && npm run build"

.PHONY: clean
clean: ## コンテナ・ボリューム・展開済みコアを削除
	$(COMPOSE) down -v
	rm -rf ./wp
