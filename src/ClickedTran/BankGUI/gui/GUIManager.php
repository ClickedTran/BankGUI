<?php
declare(strict_types=1);
/**
*░█████╗░██╗░░░░░██╗░█████╗░██╗░░██╗███████╗██████╗░████████╗██████╗░░█████╗░███╗░░██╗
*██╔══██╗██║░░░░░██║██╔══██╗██║░██╔╝██╔════╝██╔══██╗╚══██╔══╝██╔══██╗██╔══██╗████╗░██║
*██║░░╚═╝██║░░░░░██║██║░░╚═╝█████═╝░█████╗░░██║░░██║░░░██║░░░██████╔╝███████║██╔██╗██║
*██║░░██╗██║░░░░░██║██║░░██╗██╔═██╗░██╔══╝░░██║░░██║░░░██║░░░██╔══██╗██╔══██║██║╚████║
*╚█████╔╝███████╗██║╚█████╔╝██║░╚██╗███████╗██████╔╝░░░██║░░░██║░░██║██║░░██║██║░╚███║
*░╚════╝░╚══════╝╚═╝░╚════╝░╚═╝░░╚═╝╚══════╝╚═════╝░░░░╚═╝░░░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝
*
*                                                              Copyright (C) 2023-2024 ClickedTran
*/
namespace ClickedTran\BankGUI\gui;

use Closure;
use pocketmine\player\Player;
use pocketmine\item\{StringToItemParser, LegacyStringToItemParser};
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\EnchantmentInstance;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\{InvMenuTransaction, InvMenuTransactionResult};

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\language\LanguageManager;

class GUIManager {
  
  public const MAX_LIST = 45;
  public $listPlayer = [];

  public function bankMenu(Player $player) : void{
    $plugin = BankGUI::getInstance();
    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->setName(LanguageManager::getTranslate('menu.title.bank_menu'));
    //$menu->setName("BankGUI §f| Menu");
    $menu->readonly();
    $menu->setListener(Closure::fromCallable([$this, "menuBankListener"]));
    $inv = $menu->getInventory();
    
    /**BORDER*/
    $inv->setItem(0, StringToItemParser::getInstance()->parse("emerald_block")->setCustomName("§r"));
    $inv->setItem(1, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    $inv->setItem(9, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    
    $inv->setItem(7, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    $inv->setItem(8, StringToItemParser::getInstance()->parse("emerald_block")->setCustomName("§r"));
    $inv->setItem(17, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    
    $inv->setItem(27, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    $inv->setItem(36, StringToItemParser::getInstance()->parse("emerald_block")->setCustomName("§r"));
    $inv->setItem(37, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    
    $inv->setItem(35, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    $inv->setItem(43, StringToItemParser::getInstance()->parse("emerald")->setCustomName("§r"));
    $inv->setItem(44, StringToItemParser::getInstance()->parse("emerald_block")->setCustomName("§r"));
    
    for($i = 45; $i <= 53; $i++){
      $inv->setItem($i, StringToItemParser::getInstance()->parse("barrier")->setCustomName("§r"));
    }
    $inv->setItem(49, StringToItemParser::getInstance()->parse("redstone_block")->setCustomName(LanguageManager::getTranslate(
      'menu.button.exit'
      )));
    /*******************************/
    /**ADD MONEY*/
    $inv->setItem(11, LegacyStringToItemParser::getInstance()->parse("160:5")->setCustomName(LanguageManager::getTranslate(
      'bank.deposit.half'
      )));
    $inv->setItem(19, LegacyStringToItemParser::getInstance()->parse("160:5")->setCustomName(LanguageManager::getTranslate(
      'bank.deposit.custom'
      )));
    $inv->setItem(29, LegacyStringToItemParser::getInstance()->parse("160:5")->setCustomName(LanguageManager::getTranslate(
      'bank.deposit.all'
      )));
    /********************************/
    /**TAKE MONEY*/
    $inv->setItem(15, LegacyStringToItemParser::getInstance()->parse("160:14")->setCustomName(LanguageManager::getTranslate(
      'bank.withdraw.half'
      )));
    $inv->setItem(25, LegacyStringToItemParser::getInstance()->parse("160:14")->setCustomName(LanguageManager::getTranslate(
      'bank.withdraw.custom'
      )));
    $inv->setItem(33, LegacyStringToItemParser::getInstance()->parse("160:14")->setCustomName(LanguageManager::getTranslate(
      'bank.withdraw.all'
      )));
    /*******************************/
    /**YOUR STATUS*/
    $plugin->getEconomyData()->getMoney($player, function(int|float $money) use ($player, $plugin, $inv){
    $inv->setItem(13, StringToItemParser::getInstance()->parse("player_head")->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BankGUI::FAKE_ENCHANTMENT)))->setCustomName(LanguageManager::getTranslate(
        'playerinfo.money',
        ["$".$money])
        ."\n".
        LanguageManager::getTranslate(
        'playerinfo.money_in_bank',
        ["$".$plugin->getBankManager($player)->getMoney()])));
    });
    
    $inv->setItem(21, StringToItemParser::getInstance()->parse("writable_book")->setCustomName(LanguageManager:: getTranslate(
      'menu.button.1'
      )));
    
    $inv->setItem(22, StringToItemParser::getInstance()->parse("paper")->setCustomName(LanguageManager:: getTranslate(
      'menu.button.2'
      )));
      
    $inv->setItem(23, StringToItemParser::getInstance()->parse("book")->setCustomName(LanguageManager:: getTranslate(
      'menu.button.3'
      )));
    /************************************/
    $menu->send($player);
  }
  
  public function menuBankListener(InvMenuTransaction $transaction) : InvMenuTransactionResult{
    $plugin = BankGUI::getInstance();
    $action = $transaction->getAction();
    $inv = $action->getInventory();
    $item = $transaction->getItemClicked();
    $player = $transaction->getPlayer();

    switch($item->getCustomName()){
      /**ADD MONEY INTO BANK*/
      case LanguageManager::getTranslate('bank.deposit.half'):
        $plugin->getEconomyData()->getMoney($player, function(int|float $money) use ($player, $plugin){
          $add_bank = $money/2;
          $plugin->getBankManager($player)->addMoney($add_bank);
          $plugin->getEconomyData()->takeMoney($player, $add_bank);
          $plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
            "bank.deposit.transaction",
            ["$".$add_bank]
            ));
          $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
            "bank.deposit.message",
            ["$".$add_bank]
            ));
          $player->removeCurrentWindow();
       });
      break;
      case LanguageManager::getTranslate('bank.deposit.custom'):
        $player->removeCurrentWindow();
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
          "bank.deposit.custom_message"
          ));
        $plugin->addCustom[$player->getName()] = $inv->getItem(19);
      break;
      case LanguageManager::getTranslate('bank.deposit.all'):
        $plugin->getEconomyData()->getMoney($player, function(int|float $money) use ($player, $plugin){
          $plugin->getBankManager($player)->addMoney($money);
          $plugin->getEconomyData()->setMoney($player, 0);
          $plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
            "bank.deposit.transaction",
            ["$".$money]
            ));
          $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
            "bank.deposit.message",
            ["$".$money]
            ));
          $player->removeCurrentWindow();
       });
      break;
      /***************************/
      
      /**TAKE MONEY FROM BANK*/
      case LanguageManager::getTranslate('bank.withdraw.half'):
        $money = $plugin->getBankManager($player)->getMoney()/2;
        $take_money = $plugin->getBankManager($player)->reduceMoney($money);
        $plugin->getEconomyData()->giveMoney($player, $money);
        $plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
          "bank.withdraw.transaction",
          ["$".$money]
          ));
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
          "bank.withdraw.message",
          ["$".$money]
          ));
        $player->removeCurrentWindow();
      break;
      case LanguageManager::getTranslate('bank.withdraw.custom'):
        $player->removeCurrentWindow();
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
          "bank.withdraw.custom_message"
          ));
        $plugin->takeCustom[$player->getName()] = $inv->getItem(25);
      break;
      case LanguageManager::getTranslate('bank.withdraw.all'):
        $money = $plugin->getBankManager($player)->getMoney();
        $take_money = $plugin->getBankManager($player)->reduceMoney($money);
        $plugin->getEconomyData()->giveMoney($player, $money);
        $plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
          "bank.withdraw.transaction",
          ["$".$money]
          ));
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
          "bank.withdraw.message",
          ["$".$money]
          ));
        $player->removeCurrentWindow();
      break;
      /***********************/
      /**TRANSFER MONEY TO OTHER PLAYER*/
      case LanguageManager::getTranslate('menu.button.1'):
        $player->removeCurrentWindow();
        $this->transferPlayer($player);
      break;
      /**CREATE BANK NOTE*/
      case LanguageManager::getTranslate('menu.button.2'):
        $player->removeCurrentWindow();
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
          "bank.create_bank_note"
          ));
        $plugin->bankNote[$player->getName()] = $inv->getItem(22);
      break;
      /**TRANSACTION LIST*/
      case LanguageManager::getTranslate('menu.button.3'):
        $player->removeCurrentWindow();
        $this->transactionHistory($player);
      break;
      case "§r":
      break;
      case LanguageManager::getTranslate('menu.button.exit'):
        $player->removeCurrentWindow();
      break;
    }
    return $transaction->discard();
  }
  
  public function transactionHistory(Player $player, int $pages = 1) : void{
    $plugin = BankGUI::getInstance();
    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->readonly();
    $menu->setName(LanguageManager::getTranslate(
      "menu.title.bank_transaction_history"
      ));
    $inv = $menu->getInventory();
    for($a = 45; $a <= 53; ++$a){
       $inv->setItem($a, StringToItemParser::getInstance()->parse("barrier")->setCustomName("§r"));
    }
    
    $inv->setItem(45, StringToItemParser::getInstance()->parse("paper")->setCustomName(LanguageManager::getTranslate("menu.button.back")));
    
    if($pages > 1){
       $inv->setItem(48, StringToItemParser::getInstance()->parse("arrow")->setCustomName(LanguageManager::getTranslate("menu.button.page.previous")));
    }
    
    $i = 0;
    $data = $plugin->getBankManager($player)->getTransaction();
    $playerList = self::MAX_LIST;
    $total_page = ceil(count($data) / $playerList);
    $start = ($pages - 1) * $playerList;
    $end = min($start + $playerList, count($data));
    foreach($data as $slot => $key){
      if($slot >= $start && $slot < $end){
        $ex = explode(" - ", $key);
        $inv->setItem($i, StringToItemParser::getInstance()->parse("paper")->setCustomName($ex[0])->setLore(["\n\n".$ex[1]]));
        $i++;
      }
      $slot++;
    }
    
    $inv->setItem(49, StringToItemParser::getInstance()->parse("lime_wool")->setCustomName(LanguageManager::getTranslate(
      "menu.button.page.total",
    ["$pages", "$total_page"]))->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BankGUI::FAKE_ENCHANTMENT))));
    
    if($total_page > $pages){
       $inv->setItem(50, StringToItemParser::getInstance()->parse("arrow")->setCustomName(LanguageManager::getTranslate("menu.button.page.next")));
    }
      
    $menu->setListener(function(InvMenuTransaction $transaction) use ($player, $pages, $total_page) : InvMenuTransactionResult {
      $action = $transaction->getAction();
      $item = $transaction->getItemClicked();
        
      switch($item->getCustomName()){
        case LanguageManager::getTranslate("menu.button.page.next"):
          if(($pages + 1) > $total_page) break;
            $pages++;
            $this->transactionHistory($player, (int)$pages);
        break;
        case LanguageManager::getTranslate("menu.button.page.previous"):
          if(($pages - 1) < 0) break;
            $pages--;
            $this->transactionHistory($player, (int)$pages);
        break;
        case "§r":
        break;
        case LanguageManager::getTranslate("menu.button.back"):
          $player->removeCurrentWindow();
          $this->bankMenu($player);
        break;  
        case LanguageManager::getTranslate("menu.button.page.total"):
        break;
      }
      return $transaction->discard();
    });
    
    $menu->send($player);
  }
   
   public function transferPlayer(Player $player, int $pages = 1) : void{
    $plugin = BankGUI::getInstance();
    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
    $menu->readonly();
    $menu->setName(LanguageManager::getTranslate(
      "menu.title.bank_transfer"
      ));
    $inv = $menu->getInventory();
    for($a = 45; $a <= 53; ++$a){
       $inv->setItem($a, StringToItemParser::getInstance()->parse("barrier")->setCustomName("§r"));
    }
    
    $inv->setItem(45, StringToItemParser::getInstance()->parse("paper")->setCustomName(LanguageManager::getTranslate("menu.button.back")));
    
    if($pages > 1){
       $inv->setItem(48, StringToItemParser::getInstance()->parse("arrow")->setCustomName(LanguageManager::getTranslate("menu.button.page.previous")));
    }
    
    $i = 0;
    $data = $plugin->getServer()->getOnlinePlayers();
    arsort($data);
    $playerList = self::MAX_LIST;
    $total_page = ceil(count($data) / $playerList);
    $start = ($pages - 1) * $playerList;
    $end = min($start + $playerList, count($data));
    foreach($data as $players){
      if($players->getName() !== $player->getName()){
        if($i >= $start && $i < $end){
          $inv->setItem($i, StringToItemParser::getInstance()->parse("player_head")->setCustomName($players->getName())->setLore(["\n§l§bClick To Transfer Money"]));
          $i++;
        }
      }
    }
    
    $inv->setItem(49, StringToItemParser::getInstance()->parse("lime_wool")->setCustomName(LanguageManager::getTranslate(
      "menu.button.page.total",
    ["$pages", "$total_page"]))->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BankGUI::FAKE_ENCHANTMENT))));
    
    if($total_page > $pages){
       $inv->setItem(50, StringToItemParser::getInstance()->parse("arrow")->setCustomName(LanguageManager::getTranslate("menu.button.page.next")));
    }
    
    $menu->setListener(function(InvMenuTransaction $transaction) use ($plugin, $player, $pages, $total_page) : InvMenuTransactionResult {
      $action = $transaction->getAction();
      $item = $transaction->getItemClicked();
        
      switch($item->getCustomName()){
        case LanguageManager::getTranslate("menu.button.page.next"):
          if(($pages + 1) > $total_page) break;
            $pages++;
            $this->transactionHistory($player, (int)$pages);
        break;
        case LanguageManager::getTranslate("menu.button.page.previous"):
          if(($pages - 1) < 0) break;
            $pages--;
            $this->transactionHistory($player, (int)$pages);
        break;
        case "§r":
        break;
        case LanguageManager::getTranslate("menu.button.back"):
          $player->removeCurrentWindow();
          $this->bankMenu($player);
        break;  
        case LanguageManager::getTranslate("menu.button.page.total"):
        break;
        default:
          $plugin->transferToPlayer[$player->getName()] = $item->getCustomName();
          $player->removeCurrentWindow();
          $player->sendMessage(LanguageManager::getTranslate(
            "bank.transfer.custom_message"
            ));
        break;
      }
      return $transaction->discard();
    });
    
    $menu->send($player);
   }
}
