<?php

namespace Turkalp\Language;


trait LanguageTrait
{
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_'.strtolower(class_basename($this)), strtolower(class_basename($this)).'_id', 'language_id');
    }
}