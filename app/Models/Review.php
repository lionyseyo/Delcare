<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'review',
        'rating',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
    }