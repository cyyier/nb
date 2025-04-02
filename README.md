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

- **バックエンド**：PHP 7.3（フレームワーク未使用）
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

<img src="https://github.com/cyyier/nb/assets/52512369/c0dfc3e0-2444-47c0-9b6b-0d72891120fa" height="700">
<img src="https://github.com/cyyier/nb/assets/52512369/df576d93-d686-46a0-80b0-b6c31c785740" height="700">
<img src="https://github.com/cyyier/nb/assets/52512369/bac367fd-1080-473d-8387-687b7b2ad50f" height="700">

---

##  備考

- 著作権の関係により、一部の画像・フォント・音声ファイルを削除しています。
