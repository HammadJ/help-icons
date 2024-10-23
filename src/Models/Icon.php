<?php

namespace Hammadj\HelpIcons\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable = ['svg_name', 'code_svg'];
}