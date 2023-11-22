# 証明書作成ウェブサイト

このプロジェクトは証明書作成ウェブサイトです。ユーザーはアカウントを登録し、ログイン後に証明書を申請することができます。申請された証明書には、PHPの画像処理機能を利用してユーザー名、申請日、および証明書の有効期限が自動的に追加されます。

## 技術スタック

- **バックエンド**: PHP 7.3
- **データベース**: MySQL 5.7
- **フロントエンド**: HTML, CSS, Bulma

## 証明書処理のコード例

```php
imageTTFText($image, 190, 0, 900, 1700, $black, $font_kanji,$username);
if ($enddate > "2100-1-1") {
	imageTTFText($image, 70, 0, 1100, 2200, $black, $font_kanji,"终身");
}else{
	imageTTFText($image, 70, 0, 980, 2200, $black, $font_alphabet,$enddate);}
imageTTFText($image, 50, 0, 530, 2950, $black, $font_alphabet,$startdate);

$filename = 'certificates/certificate' . $id . '.png';
chmod($filename,0777);
imagepng($image, $filename);
imagedestroy($image);
```

## スクリーンショット
![image](https://github.com/cyyier/nb/assets/52512369/6e02ea34-efcd-4b54-a5c3-65556d87a96e)
![image](https://github.com/cyyier/nb/assets/52512369/c0dfc3e0-2444-47c0-9b6b-0d72891120fa)
![image](https://github.com/cyyier/nb/assets/52512369/df576d93-d686-46a0-80b0-b6c31c785740)
![image](https://github.com/cyyier/nb/assets/52512369/270fb6fa-6f5b-4a26-9185-3674b5191bdf)
![image](https://github.com/cyyier/nb/assets/52512369/bac367fd-1080-473d-8387-687b7b2ad50f)
