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

namespace ClickedTran\BankGUI\language;

use pocketmine\utils\Config;

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\language\data\{
  Vietnamese,
  English
};

class LanguageManager {
  private BankGUI $plugin;
  private $lang = "?";
  private $version = null;
  private static $langData = null;
  
  public function __construct(BankGUI $plugin, string $lang){
    $this->plugin = $plugin;
    $this->lang = $lang;
    self::$langData = new Config($this->plugin->getDataFolder() . "language/".$this->lang.".yml", Config::YAML, array());
    $data = self::$langData->getAll();
    if(!isset($data["reset"]) or $data["reset"] === true){
      $this->reload();
      $this->getPlugin()->getLogger()->info(LanguageManager::getTranslate(
        "plugininfo.reload_language", 
        [$this->getLanguage()]
      ));
    }
    
    if(!isset($data["version"])){
      $this->reload();
      $this->getPlugin()->getLogger()->info(LanguageManager::getTranslate(
        "plugininfo.version_old",
        [$this->getLanguage(), $this->getVersion()]
      ));
    }else{
      $this->version = $data["version"];
      if($this->getVersion() !== 1){
         $this->getPlugin()->getLogger()->info(LanguageManager::getTranslate(
           "plugininfo.version_new",
           [$this->getLanguage(), $this->getVersion()]
         ));
      }
    }
  }
  
  public function reload() : void{
    if($this->getLanguage() === "vi-VN"){
      foreach(Vietnamese::init() as $key => $value){
        self::$langData->setNested($key, $value);
      }
    }
    
    if($this->getLanguage() === "en-US"){
      foreach(English::init() as $key => $value){
        self::$langData->setNested($key, $value);
      }
    }
    self::$langData->save();
  }
  
  public static function getTranslate(string|int $text, array $key = []) : string{
    $data = self::$langData;
    if(!$data->exists($text)){
      $message = $data->getNested($text);
      for($i = 0; $i < count($key); $i++){
        $message = str_replace('%'.($i + 1), $key[$i], $message);
      }
      return $message;
    }else{
      return LanguageManager::getTranslate(
        "plugininfo.message_not_found", 
        [$text, self::getLanguage()]
      );
    }
  }
  
  public function getLanguage() : string {
    return $this->lang;
  }
  
  public function getPlugin() : BankGUI {
    return $this->plugin;
  }
  
  public static function getData() : Config {
    return self::$langData;
  }
  
  public function getVersion() : int {
    return $this->version;
  }
}
