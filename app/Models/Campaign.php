<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'template_id',
    'status',
    'scheduled_at',
    'started_at',
    'completed_at'
])]
class Campaign extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduled_at'  =>  'datetime',
            'started_at'    =>  'datetime',
            'completed_at'  =>  'datetime',
        ];
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }
}
