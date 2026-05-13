<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'custom_fields'])]
class Contact extends Model
{
    protected function casts(): array
    {
        return [
            'custom_fields' => 'array',
        ];
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
