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

class Vietnamese {
  public static function init() : array {
    return [
      "reset" => false,
      "version" => 1,
      "plugininfo.use_ingame" => "§aVui lòng sử dụng lệnh trong trò chơi",
      "plugininfo.reload_language" => "§aNgôn ngữ §b%1 §ađã được tải lại!",
      "plugininfo.message_not_found" => "§aTin nhắn §b%1 §bkhông tồn tại trong dữ liệu của ngôn ngữ §d%2",
      
      "playerinfo.money" => "§aSố tiền của bạn: §b%1",
      "playerinfo.money_in_bank" => "§aSố tiền trong ngân hàng của bạn: §b%1",
      "playerinfo.not_exists" => "§cDữ liệu của người chơi §b%1 §ckhông tồn tại!",
      "playerinfo.transfer.fail" => "§cBạn không đủ số tiền §b%1 §ctrong tài khoản để chuyển đến §9%2 §c!",
      "playerinfo.transfer.successfully" => "§aBạn đã chuyển số tiền §b%1 §ađến ngân hàng của §9%2",
      "playerinfo.transfer.player_claimed.successfully" => "§aBạn đã nhận được số tiền §b%1 §avào tài khoản từ §9%2",
      "playerinfo.transfer.transaction" => "§aChuyển số tiền §b%1 §ađến ngân hàng của §9%2",
      "playerinfo.transfer.player_claimed.transaction" => "§aNhận §b%1 §atừ người chơi §9%2",
      
      "bank.error" => "§cThao tác không hợp lệ, vui lòng thử lại!",
      "bank.cancel" => "§aBạn đã hủy thao tác thành công!",
      
      "bank.claimed_interst" => "§aNhận được §b%1 §avào tài khoản từ lãi xuất",
      "bank.player_claimed_interst" => "§aBạn đã nhận được số tiền §b%1 §avào tài khoản ngân hàng từ lãi xuất!",
      
      "bank.deposit.half" => "§aGửi một nửa",
      "bank.deposit.custom" => "§aGửi tùy chỉnh",
      "bank.deposit.custom_message" => "§aNhập §ball §ađể gửi toàn bộ §f/§a Nhập §bcancel §ađể hủy thao tác",
      "bank.deposit.all" => "§aGửi toàn bộ",
      "bank.deposit.message" => "§aBạn đã gửi §b%1 §avào ngân hàng!",
      "bank.deposit.transaction" => "§aGửi §b%1 §avào ngân hàng!",
      "bank.deposit.fail" => "§cBạn không đủ số tiền §b%1 §cđể gửi vào ngân hàng!",
      
      "bank.withdraw.half" => "§aRút một nửa",
      "bank.withdraw.custom" => "§aRút tùy chỉnh",
      "bank.withdraw.custom_message" => "§aNhập §ball §ađể rút toàn bộ §f/§a Nhập §bcancel §ađể hủy thao tác",
      "bank.withdraw.all" => "§aRút toàn bộ",
      "bank.withdraw.message" => "§aBạn đã rút §b%1 §ara khỏi ngân hàng!",
      "bank.withdraw.transaction" => "§aRút §b%1 §ara khỏi ngân hàng!",
      "bank.withdraw.fail" => "§cBạn không đủ số tiền §b%1 §ctrong ngân hàng để rút!",
      
      "bank.create_bank_note" => "§aNhập §ball §ađể tạo ngân phiếu với toàn bộ số tiền §f/§a Nhập §bcancel §ađể hủy thao tác",
      
      "banknote.create.name" => "§l§bNGÂN PHIẾU",
      "banknote.create.lore" => "§aNgân phiếu có giá trị: §b%1\n§aĐược tạo bởi: §9%2\n §9( §bẤN CHUỘT PHẢI ĐỂ DÙNG §9)",
      "banknote.create.transaction" => "§aĐã tạo ngân phiếu với giá trị §b%1",
      "banknote.create.fail" => "§cTài khoản của bạn không đủ số tiền §b$%1 §cđể tạo ngân phiếu!",
      "banknote.create.successfully" => "§aBạn đã tạo thành công ngân phiếu với giá trị §b%1",
      "banknote.use" => "§aBạn đã nhận được §b%1 §atừ ngân phiếu",
      

      "menu.title.bank_menu" => "§bBankGUI §f| §cMenu",
      
      "menu.title.bank_transaction_history" => "§bLịch Sử Giao Dịch",
      
      "menu.button.1" => "§aChuyển khoản",
      "menu.button.2" => "§aTạo ngân phiếu",
      "menu.button.3" => "§aLịch sử giao dịch",
      
      "menu.button.exit" => "§cTHOÁT",
      "menu.button.back" => "§cTrở lại trang trước",
      
      "menu.button.page.next" => "§bTrang tiếp theo",
      "menu.button.page.previous" => "§bTrang trước",
      "menu.button.page.total" => "§b%1 §f/ §9%2",
      
      "form.title" => "§bBankGUI §f| §cTRANSFER",
      "form.dropdown" => "Chọn người chơi:",
      "form.input" => "§aNhập số tiền muốn chuyển",
      
      "form.not_input" => "§aVui lòng nhập số tiền để chuyển khoản!"

    ];
  }
}
