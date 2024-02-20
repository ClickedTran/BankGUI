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

namespace ClickedTran\BankGUI\language\data;

class English {
  public static function init() : array {
    return [
      "reset" => false,
      "version" => 1,
      "plugininfo.use_ingame" => "§aPlease use command in-game!",
      "plugininfo.reload_language" => "§aLanguage §b%1 §ahas been reloaded!",
      "plugininfo.message_not_found" => "§aMessage §b%1 §bdoes not exist in the data of language §d%2",
      
      "playerinfo.money" => "§aYour money: §b%1",
      "playerinfo.money_in_bank" => "§aYour money in bank: §b%1",
      "playerinfo.not_exists" => "§cPlayer data §b%1 §cdoes not exist!",
      "playerinfo.transfer.fail" => "§cYou do not have enough money §b%1 §cin your bank to transfer to §9%2 §c!",
      "playerinfo.transfer.successfully" => "§aYou have transferred the amount §b%1 §ato §9%2's bank",
      "playerinfo.transfer.player_claimed.successfully" => "§aYou have received the amount §b%1 §ainto your account from §9%2",
      "playerinfo.transfer.transaction" => "§aTransfer the amount §b%1 §ato the bank of §9%2",
      "playerinfo.transfer.player_claimed.transaction" => "§aReceive §b%1 §afrom player §9%2",
      
      "bank.create" => "§aCreate new account successfully!",
      "bank.error" => "§cInvalid operation, please try again!",
      "bank.cancel" => "§aYou have successfully canceled the operation!",
      
      "bank.claimed_interest" => "§aReceive §b%1 §ato account from interest",
      "bank.player_claimed_interest" => "§aYou have received the amount §b%1 §ainto your bank account from interest!",
      
      "bank.deposit.half" => "§aDeposit half",
      "bank.deposit.custom" => "§aDeposit custom",
      "bank.deposit.custom_message" => "§aEnter §ball §ato send all §f/§a Enter §bcancel §ato cancel the operation",
      "bank.deposit.all" => "§aDeposit all",
      "bank.deposit.message" => "§aYou have deposited §b%1 §ainto the bank!",
      "bank.deposit.transaction" => "§aDeposit §b%1 §ainto the bank!",
      "bank.deposit.fail" => "§cYou do not have enough amount §b%1 §c to deposit in the bank!",
      
      "bank.withdraw.half" => "§aWithdraw half",
      "bank.withdraw.custom" => "§aWithdraw custom",
      "bank.withdraw.custom_message" => "§aEnter §ball §ato withdraw all §f/§a Enter §bcancel §ato cancel the operation",
      "bank.withdraw.all" => "§aWithdraw all",
      "bank.withdraw.message" => "§aYou have withdrawn §b%1 §ara from the bank!",
      "bank.withdraw.transaction" => "§aWithdraw §b%1 §ara from the bank!",
      "bank.withdraw.fail" => "§cYou do not have enough §b%1 §camount in the bank to withdraw!",
      
      "bank.create_bank_note" => "§aEnter §ball §a to create a check for the full amount §f/§a Enter §bcancel §a to cancel the operation",

      
      "banknote.create.name" => "§l§bBANK NOTE",
      "banknote.create.lore" => "§aBank note have value: §b%1\n§aCreated by: §9%2\n \n§9( §bRIGHT CLICK TO USE §9)",
      "banknote.create.transaction" => "§aCreated a bank note with value §b%1",
      "banknote.create.fail" => "§cYour account does not have enough funds §b%1 §c to create a bank note",
      "banknote.create.successfully" => "§aYou have successfully created a bank note with value §b%1",
      "banknote.use" => "§aYou have received §b%1 §afrom the bank note",
      

      "menu.title.bank_menu" => "§bBankGUI §f| §cMenu",
      
      "menu.title.bank_transaction_history" => "§bTransaction history",
      
      "menu.button.1" => "§aTransfer",
      "menu.button.2" => "§aCreate bank note",
      "menu.button.3" => "§aTransaction history",
      
      "menu.button.exit" => "§cEXIT",
      "menu.button.back" => "§cBack to the home",
      
      "menu.button.page.next" => "§bNext page",
      "menu.button.page.previous" => "§bPrevious page",
      "menu.button.page.total" => "§b%1 §f/ §9%2",
      
      "form.title" => "§bBankGUI §f| §cTRANSFER",
      "form.dropdown" => "Select players:",
      "form.input" => "§aEnter the amount you want to transfer",
      
      "form.not_input" => "§aPlease enter the amount to transfer!"
      
    ];
  }
}
