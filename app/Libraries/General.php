<?php
namespace App\Libraries;
use DB;
class General {
// function to get gravatar photo/image from gravatar.com using email id.
public static function getEnumValues($table, $column) {
    $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = array();
    foreach( explode(',', $matches[1]) as $value )
    {
      $v = trim( $value, "'" );
      //$enum = array_add($enum, $v, $v);
      $enum[] = $v;
    }
    return $enum;
  }
}