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
namespace ClickedTran\BankGUI\manager;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

use ClickedTran\BankGUI\BankGUI;

final class BankManager {
  //use SingletonTrait;
  private BankGUI $plugin;
  private Player $player;
  private ?Config $data = null;
  
  public function __construct(Player $player){
     $this->plugin = BankGUI::getInstance();
     $this->player = $player;
     @mkdir($this->plugin->getDataFolder() . "bank/");
  }
    
  public function getData() : Config{
    $this->data ?? $this->data = new Config($this->plugin->getDataFolder() . "bank/".$this->player->getName().".yml", Config::YAML);
    return $this->data;
  }
  
  public function createPlayerData(){
    $this->getData()->set("money", 0);
    $this->getData()->save();
    $this->getData()->set("transaction", []);
    $this->getData()->save();
  }
  
  public function getMoney(){
    return $this->getData()->get("money");
  }
  
  public function addMoney(int|float $money){
    $this->getData()->set("money", $this->getData()->get("money") + $money);
    $this->getData()->save();
  }
  
  public function reduceMoney(int|float $money){
    $this->getData()->set("money", $this->getData()->get("money") - $money);
    $this->getData()->save();
  }
  
  public function getTransaction(bool $key = false) : array{
     return $this->getData()->get("transaction");
  }
  
  public function addTransaction(string $transaction){
    if($this->getData()->get("transaction") === []){
       $this->getData()->set("transaction", array_merge($this->getData()->get("transaction"), ["§9[§c".date("H:i:s d/m/y")."§9] - §a".$transaction]));
       $this->getData()->save();
    }else{
       $this->getData()->set("transaction", array_merge($this->getData()->get("transaction"), ["§9[§c".date("H:i:s d/m/y")."§9] - §a".$transaction]));
       $this->getData()->save();
    }
  }
}
