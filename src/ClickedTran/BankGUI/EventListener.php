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

namespace ClickedTran\BankGUI;

use pocketmine\event\Listener;
use pocketmine\event\Event;
use pocketmine\event\player\{PlayerItemUseEvent, PlayerJoinEvent, PlayerChatEvent, PlayerQuitEvent};
use pocketmine\player\Player;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\Config;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\EnchantmentInstance;

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\language\LanguageManager;

class EventListener implements Listener {
  public BankGUI $plugin;
  public function __construct(BankGUI $plugin){
    $this->plugin = $plugin;
  }
  
  public function onJoin(PlayerJoinEvent $event) : void{
    $player = $event->getPlayer();
    if(!file_exists($this->plugin->getDataFolder() . "bank/".$player->getName().".yml")){
       $this->plugin->getBankManager($player)->createPlayerData();
    }
  }
       
  public function onChat(PlayerChatEvent $event) : void{
    $player = $event->getPlayer();
    if(isset($this->plugin->addCustom[$player->getName()])){
      $event->cancel();
      $args = explode(" ", $event->getMessage());
      if(!$args[0] == "all" || !$args[0] == "cancel"){
        $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.error"));
         unset($this->plugin->addCustom[$player->getName()]);
         return;
      }else{
        if($args[0] == "all"){
          $this->plugin->getEconomyData()->getMoney($player, function(int|float $money) use ($player){
            $this->plugin->getBankManager($player)->addMoney((int)$money);
            $this->plugin->getEconomyData()->takeMoney($player, (int)$money);
            $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
              "bank.deposit.transaction",
              ["$".$money]
              ));
            $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
              "bank.deposit.message",
              ["$".$money]
              ));
            unset($this->plugin->addCustom[$player->getName()]);
          });
        }
        
        if($args[0] == "cancel"){
          unset($this->plugin->addCustom[$player->getName()]);
          $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.cancel"));
        }
        
        if(is_numeric($args[0])){
          $this->plugin->getEconomyData()->getMoney($player, function(int|float $money) use ($player, $args){
            if($money < $args[0]){
               $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
                 "bank.deposit.fail",
                 ["$".$args[0]]
                 ));
               unset($this->plugin->addCustom[$player->getName()]);
            }else{
               $this->plugin->getBankManager($player)->addMoney((int)$args[0]);
               $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
                 "bank.deposit.transaction",
                 ["$".$args[0]]
                 ));
               $this->plugin->getEconomyData()->takeMoney($player, (int)$args[0]);
               $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
                 "bank.deposit.message",
                 ["$".$args[0]]
                 ));
               unset($this->plugin->addCustom[$player->getName()]);
            }
          });
        }
      }
    }
    
    if(isset($this->plugin->takeCustom[$player->getName()])){
       $event->cancel();
       $args = explode(" ", $event->getMessage());
       if(!$args[0] == "all" || !$args[0] == "cancel"){
         $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.error"));
         unset($this->plugin->takeCustom[$player->getName()]);
         return;
       }else{
         if($args[0] == "all"){
            $money = $this->plugin->getBankManager($player)->getMoney();
            $this->plugin->getBankManager($player)->reduceMoney((int)$money);
            $this->plugin->getEconomyData()->giveMoney($player, (int)$money);
            $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
              "bank.withdraw.message",
              ["$".$money]
              ));
            $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
              "bank.withdraw.transaction",
              ["$".$money]
              ));
            unset($this->plugin->takeCustom[$player->getName()]);
         }
         
         if($args[0] == "cancel"){
           unset($this->plugin->takeCustom[$player->getName()]);
           $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.cancel"));
         }
         
         if(is_numeric($args[0])){
           if($this->plugin->getBankManager($player)->getMoney() < $args[0]){
              $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
                "bank.withdraw.fail",
                ["$".$args[0]]
                ));
              unset($this->plugin->takeCustom[$player->getName()]);
           }else{
             $this->plugin->getBankManager($player)->reduceMoney((int)$args[0]);
             $this->plugin->getEconomyData()->giveMoney($player, (int)$args[0]);
             $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
               "bank.withdraw.transaction",
               ["$".$args[0]]
               ));
             $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
               "bank.withdraw.message",
               ["$".$args[0]]
               ));
             unset($this->plugin->takeCustom[$player->getName()]);
           }
         }
       }
    }
/**    
    if(isset($this->plugin->transferToPlayer[$player->getName()])){
      $event->cancel();
      $args = explode(" ", $event->getMessage());
      $players = $this->plugin->getServer()->getPlayerExact($this->plugin->transferToPlayer[$player->getName()]);
      if(!is_numeric($args[0]) or $args[0] <= -1){
          $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.error"));
          return;
       }
       
       if($this->plugin->getBankManager($player)->getMoney() < $args[0]){
          $player->sendMessage("§9[ §4BANKGUI §9]§c Your money in the bank is not enough §b".$args[0]." §cto transfer!");
       }else{
         $this->plugin->getBankManager($player)->reduceMoney((int)$args[0]);
         $this->plugin->getBankManager($players)->addMoney((int)$args[0]);
         $this->plugin->getBankManager($player)->addTransaction("Transfer §b$".$args[0] ."§a to §9".$players);
         $this->plugin->getBankManager($players)->addTransaction("Get §b$".$args[0]."§a from §9".$player->getName());
         $players->sendMessage("§9[ §4BANKGUI §9]§a You got §b$".$args[0]."§a into the bank from §9".$player->getName()."'s bank!");
         $player->sendMessage("§9[ §4BANKGUI §9]§a You have transferred the amount §b$".$args[0]."§a to ".$players."'s bank!");
         unset($this->plugin->transferToPlayer[$player->getName()]);
       }
    }
  */  
    if(isset($this->plugin->bankNote[$player->getName()])){
       $event->cancel();
       $args = explode(" ", $event->getMessage());
       if(!$args[0] == "all" || !$args[0] == "cancel"){
          $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.error"));
          unset($this->plugin->bankNote[$player->getName()]);
          return;
       }else{
         if($args[0] == "all"){
            $money = $this->plugin->getBankManager($player)->getMoney();
            $this->plugin->getBankManager($player)->reduceMoney((int)$money);
            $item = StringToItemParser::getInstance()->parse("paper");
            $item->setCustomName(LanguageManager::getTranslate("banknote.create.name"));
            $item->setLore(["\n". LanguageManager::getTranslate(
              "banknote.create.lore",
              ["$".$money, $player->getName()]
              )]);
            $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BankGUI::FAKE_ENCHANTMENT)));
            $item->getNamedTag()->setFloat("Amount", (int)$money);
            $player->getInventory()->addItem($item);
            $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
              "banknote.create.transaction",
              ["$".$money]
              ));
            $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
              "banknote.create.successfully",
              ["$".$money]
              ));
            unset($this->plugin->bankNote[$player->getName()]);
         }
         
         if($args[0] == "cancel"){
            unset($this->plugin->bankNote[$player->getName()]);
            $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate("bank.cancel"));
         }
         
         if(is_numeric($args[0])){
           if($this->plugin->getBankManager($player)->getMoney() < $args[0]){
             $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
               "banknote.create.fail",
               ["$".$args[0]]
               ));
             unset($this->plugin->bankNote[$player->getName()]);
           }else{
             $this->plugin->getBankManager($player)->reduceMoney((int)$args[0]);
             $item = StringToItemParser::getInstance()->parse("paper");
             $item->setCustomName(LanguageManager::getTranslate("banknote.create.name"));
             $item->setLore(["\n". LanguageManager::getTranslate(
              "banknote.create.lore",
              ["$".$args[0], $player->getName()]
              )]);
             $item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(BankGUI::FAKE_ENCHANTMENT)));
             $item->getNamedTag()->setFloat("Amount", (int)$args[0]);
             $player->getInventory()->addItem($item);
             $this->plugin->getBankManager($player)->addTransaction(LanguageManager::getTranslate(
               "banknote.create.transaction",
               ["$".$args[0]]
               ));
             $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
               "banknote.create.successfully",
               ["$".$args[0]]
               ));
             unset($this->plugin->bankNote[$player->getName()]);
           }
         }
       }
    }
  } 
  
  public function useBankNote(PlayerItemUseEvent $event) : void{
    $player = $event->getPlayer();
    $item = $event->getItem();
    
    if($item->getNamedTag()->getTag("Amount") !== null){
       $money = $item->getNamedTag()->getFloat("Amount");
       
       $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
       $this->plugin->getEconomyData()->giveMoney($player, $money);
       $player->sendMessage(BankGUI::PREFIX . LanguageManager::getTranslate(
         "banknote.use",
         ["$".$money]
         ));
    }
  }
}