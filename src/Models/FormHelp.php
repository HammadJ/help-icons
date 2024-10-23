<?php

namespace Hammadj\HelpIcons\Models;

use Illuminate\Database\Eloquent\Model;

class FormHelp extends Model
{
    protected $fillable = ['form_id', 'icon_id', 'form_field_id', 'form_help_text'];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }
}