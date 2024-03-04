## General
<div align="center">
<img src="https://github.com/ClickedTran/BankGUI/blob/Master/line.gif"><br>
<img src="https://github.com/ClickedTran/BankGUI/blob/Master/bank_icon.png" width="164px" height="auto"><br>
<p>BankGUI for PocketMine-MP</p>
<p>The plugin is inspired by a minecraft java server (<b>Minelock.online</b>)</p><br>
<img src="https://github.com/ClickedTran/BankGUI/blob/Master/line.gif">
</div>

## Features
- [x] Multi Language
- [x] Transfer money to other player's bank
- [x] Interest rate per day
- [x] Deposit / Withdraw money

## Command
| **COMMAND** | **DESCRIPTION** | **PERMISSION** | **ALIASES** |
| --- | --- | --- | --- |
| `/bankgui` | `Open Bank Menu` | *`bankgui.command`* | `/bank` |

## Config
```yaml
#language list:
#vi-VN => Vietnamese
#en-US => English
#hi-IN => Hindi

language: en-US
economy-type:
 provider: economyapi #change it to `bedrockeconomy` if you want use BedrockEconomy!


timezone: "Asia/Ho_Chi_Minh" #See time-zone in website `https://www.php.net/manual/en/timezones.php`
time-to-add-interest: "00:00"
interest: 0.1 #cannot be less than 0, example: `0.1`
```

## Language Supported
- [x] Vietnamese (vi-VN)
- [x] English (en-US)
- [x] Hindi (hi-IN)
<br>
If you want a language of your country in this plugin please translate file `English.php` into your country's language

## Virions
- [InvMenu](https://github.com/muqsit/InvMenu)(Muqsit)
- [libPiggyEconomy](https://github.com/DaPigGuy/libPiggyEconomy)(DaPigGuy)

## For Developer
### API
```php
$api = BankGUI::getInstance()->getBankManager($player);
```
### Get Player Money In Bank
```php
$api->getMoney();
```
### Reduce Player Money In Bank
```php
$api->reduceMoney(int|float $amount);
```
### Add Player Money In Bank
```php
$api->addMoney(int|float $amount);
```
### Get All Transaction
```php
$api->getTransaction() : array{

EXAMPLE:
foreach($api->getTransaction() as $list => $transaction){
    //@params $form instanceof FormAPI
    $form->setContent("All your transactions:, $list);
}
```
### Add New Transaction
```php
$api->addTransaction(string $text);
```

## Contact
[![DISCORD](https://img.shields.io/badge/ClickedTran_VN-white?logo=discord&logoColor=white&label=Discord&labelColor=blue&color=yellow)](https://discord.com/invite/ZgWveaFH)
[![YOUTUBE](https://img.shields.io/badge/ClickedTran_VN-white?logo=youtube&logoColor=red&label=Youtube&labelColor=white&color=blue)](https://youtube.com/@clickedtran_vn)

[![TELEGRAM](https://img.shields.io/badge/ClickedTran-white?logo=telegram&logoColor=blue&label=Telegram&labelColor=white&color=0000FF&link)](https://t.me/clickedtran1)
[![FACEBOOK](https://img.shields.io/badge/Ph%C3%A1t_Tr%E1%BA%A7n-blue?logo=facebook&logoColor=white&label=Facebook&labelColor=blue&color=g)](https://facebook.com/clicked.tran.01)
