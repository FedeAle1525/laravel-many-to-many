<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Indico una Relazione: Technology(ies) [N:N] Project(s), cioe' un Tag puo' essere associati a piu' Progetti
    public function projects()
    {

        return $this->belongsToMany(Project::class);
    }
}
