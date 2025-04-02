# php-certificate-app（証明書作成ウェブサイト）

PHPとMySQLを用いて開発した、ユーザーがログイン後に証明書を申請・発行できるWebアプリケーションです。  
申請された証明書には、画像処理機能を利用して、ユーザー名・申請日・有効期限などの情報が自動的に描画されます。

---

## 主な機能

- ユーザー登録・ログイン
- 証明書の申請
- ユーザー情報に基づき、証明書画像を自動生成（PNG形式）
- 発行済み証明書のプレビュー表示

---

## 技術スタック

- **バックエンド**：PHP 7.3
- **データベース**：MySQL 5.7
- **フロントエンド**：HTML / CSS / Bulma
- **画像処理**：PHP標準の画像描画機能（`imagecreate`, `imageTTFText` など）

---

## 学んだこと

- PHPによる画像出力処理（文字描画・ファイル保存）
- セッション管理によるログイン認証
- 画像の座標やフォントサイズの調整
- フォーム入力〜DB保存〜ファイル出力までの一連処理の流れ

---

## 証明書作成処理のコード例

```php
imageTTFText($image, 190, 0, 900, 1700, $black, $font_kanji, $username);

if ($enddate > "2100-1-1") {
    imageTTFText($image, 70, 0, 1100, 2200, $black, $font_kanji, "终身");
} else {
    imageTTFText($image, 70, 0, 980, 2200, $black, $font_alphabet, $enddate);
}

imageTTFText($image, 50, 0, 530, 2950, $black, $font_alphabet, $startdate);

$filename = 'certificates/certificate' . $id . '.png';
chmod($filename, 0777);
imagepng($image, $filename);
imagedestroy($image);
```

> ※ テキスト位置やフォントサイズなど、画像のレイアウト調整を試行錯誤しながら実装しました。画像描画処理の理解を深める良い経験となりました。

---

## スクリーンショット

<img src="https://github.com/cyyier/recipe/assets/52512369/a01e4ede-9cdf-40fc-8be4-42b32e5d9d80" width="200">
<img src="https://github.com/cyyier/recipe/assets/52512369/a3a221c4-e1ad-4956-9c72-bf8013ab405d" width="200">
<img src="https://github.com/cyyier/recipe/assets/52512369/d804c348-f6d9-46b5-b913-ed2d2db4b038" width="200">
<img src="https://github.com/cyyier/recipe/assets/52512369/f4ed14e3-6c2e-42f5-999c-fe012b787ac4" width="200">

---

## ℹ️ 備考

- 開発時にはユーモラスな画面（例：寄付内容に応じて牛や鶏を要求する表現）も含まれていましたが、現在は非表示としています。
- 表示言語はすべて中国語ですが、機能の理解に支障はありません。
- 著作権の関係により、一部の画像・フォント・音声ファイルを削除しています。
