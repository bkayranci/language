<?php

namespace Turkalp\Language;


trait LanguageTrait
{
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_'.$this->getTable(), $this->getTable().'_id', 'language_id');
    }
}
