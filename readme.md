# Larabel練習用
## 必要環境
* Docker
* docker-compose
## 起動方法
1. このプロジェクトをclone
2. コンテナのビルド
   1. `docker-compose build`
3. コンテナのビルドが終わったら起動
   1. `docker-compose up`
4. http://localhost/info.php にアクセスするとphpの情報が表示される
5. http://localhost/app/ にアクセスするとlaravelで作成されたページが表示される

## マイグレーション
1. コンテナ内に`bash`でログイン
   1. `docker-compose exec app bash`
2. `app` ディレクトリにいるので、プロジェクトフォルダに移動
   1. `cd api`
3. マイグレーション
   1. `php artisan migrate`

## ホットリロード
1. コンテナ内に`bash`でログイン
   1. `docker-compose exec app bash`
2. `app`ディレクトリにいるので、プロジェクトフォルダに移動
   1. `cd api`
3. ビルトインサーバを起動
   1. `php artisan serve --host 0.0.0.0`
4. 1と2を別ウィンドウで行う
5. ホットリロードを起動
   1. `npm run watch`

# TODO
* どうせやるならコマンドですべて起動するようにしたい。
