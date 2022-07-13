<?php

use Illuminate\Support\Facades\Auth;

class SkemaStatus
{
  const SUBMIT_DOCUMENT = 'submit_document';
  const VALIDASI_DOCUMENT = 'validasi_document';
}


function isValidAsesi()
{

  $user = Auth::user();

  if (!$user) {
    return false;
  }

  if ($user->role != 'asesi') {
    return false;
  }

  $asesi = $user->asesi;

  $deletedProperty = ['created_at', 'updated_at', 'deleted_at', 'is_filled', 'office_phone', 'house_phone'];

  foreach ($deletedProperty as $property) {
    unset($asesi->{$property});
  }

  // cek kelengkapan data
  foreach ($asesi->getAttributes() as $key => $value) {
    if ($value == null) {
      return false;
    }
  }


  return true;
}
