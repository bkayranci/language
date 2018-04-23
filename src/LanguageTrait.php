<?php

namespace Turkalp\Language;


trait LanguageTrait
{
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_'.$this->table, $this->table.'_id', 'language_id');
    }
}