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
namespace ClickedTran\BankGUI\task;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\language\LanguageManager;

class TaskManager extends Task {
  public BankGUI $plugin;
  public string $players;
  
  public function __construct(BankGUI $plugin){
    $this->plugin = $plugin;
  }
  
  public function onRun() : void{
    date_default_timezone_set($this->plugin->getConfig()->get("timezone"));
    $time = date("H:i");
    $interest = $this->plugin->getConfig()->get("interest");
    if($time == $this->plugin->getConfig()->get("time-to-add-interest")){
       foreach(glob($this->plugin->getDataFolder() . "bank/*.yml") as $player){
          $data = new Config($player);
          $playerMoney = $data->get("money");
          $recevied_money = ($playerMoney*($interest/100));
          $data->set("money", $data->get("money") + $recevied_money);
          $data->save();
          if($data->get("transaction") === []){
             $data->set("transaction", array_merge($data->get("transaction"), ["§9[§c".date("H:i:s d/m/y")."§9] - ".LanguageManager::getTranslate(
               "bank.claimed_interest",
               ["$".$recevied_money]
               )]));
             $data->save();
          }else{
             $data->set("transaction", array_merge($data->get("transaction"), ["§9[§c".date("H:i:s d/m/y")."§9] - ".LanguageManager::getTranslate(
               "bank.claimed_interest",
               ["$".$recevied_money]
               )]));
             $data->save();
          }
       }
       foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
           $money = ($this->plugin->getBankManager($player)->getMoney()*($interest/100));
           $player->sendMessage(BankGUI::PREFIX . LanguageManager:: getTranslate(
             "bank.player_claimed_interest",
             ["$".$money]));
       }
    }
  }
}
