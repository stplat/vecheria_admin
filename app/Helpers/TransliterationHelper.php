<?php

/**
 * Транслитерация кирилицы.
 *
 * @param $string string
 * @return String
 */

function TransliterationHelper($name, $article)
{
  $rus = array('.', '/', '№', '”', '"', ',', ':', '»', '«', ' ', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $lat = array('-', '', '', '', '', '', '', '', '', '-', 'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Sch', '', 'Y', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya');

  $name = str_replace($article, '', $name);
  $name = str_replace($rus, $lat, $name);
  $article = str_replace($rus, $lat, $article);

  if (strlen($name) > 50) {
    $pos = strpos($name, '-', '30');

    if ($pos) {
      $name = substr($name, 0, $pos);
    }
  }
  return mb_strtolower("$name-$article");
}
