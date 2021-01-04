# Lightning

[關於我用 Laravel 寫 SPA 卻不寫 API 的那檔事](https://ithelp.ithome.com.tw/users/20113602/ironman/3322) 系列範例，使用和 Laravel + Vue.js + Inertia.js + Tailwind CSS 構建的簡易部落格平台。

本仓库使用Laravel 8 + jet-stream(inertia.js)重写Lightning。感谢作者[
Lucas Yang]("https://github.com/ycs77")。

## 安裝

下載專案後執行 Composer：

```bash
composer install
```

設定 `.env` 檔：

```bash
cp .env.example .env
vim .env

# .env
APP_URL=https://lightning.test
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lightning
DB_USERNAME=[username]
DB_PASSWORD=[password]
```

跑 Migrate：

```bash
php artisan migrate
```

然後新增本地 Storage 的公開連結：

```bash
php artisan storage:link
```

最後編譯前端資源：

```bash
yarn
yarn dev
```
