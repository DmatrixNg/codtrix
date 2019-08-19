<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tutorial extends Model
{
  protected $fillable = [
      'title', 'body', 'desc','category',
'user_type', 'desc', ];
}
