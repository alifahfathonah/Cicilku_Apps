<?php

function check_access($role_id, $menu_id)
{
   $db = \Config\Database::connect();
   $result = $db->table('tbl_user_access_menu')->where(['role_id' => $role_id, 'menu_id' => $menu_id])->get();

   if ($result->getRowArray() > 0) {
      return "checked='checked'";
   }
}


function rupiah($angka)
{

   $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
   return $hasil_rupiah;
}

function auto_paragraf($text)
{

   // memecah string input berdasarkan karakter '\r\n\r\n'
   $pecah = explode("\r\n\r\n", $text);

   // string kosong inisialisasi
   $text = "";

   // untuk setiap substring hasil pecahan, sisipkan <p> di awal dan </p> di akhir
   // lalu menggabungnya menjadi satu string utuh $text
   for ($i = 0; $i <= count($pecah) - 1; $i++) {
      $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
      $text .= $part;
   }
   // menampilkan outputnya
   return $text;
}
