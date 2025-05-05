<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['expected_salary', 'user_id', 'job_id' , 'cv_path', 'cv_name', 'status'];

    public static array $status = [
        'accepted',
        'rejected',
        'pending',
    ];

    public function job(): BelongsTo {
        return $this->belongsTo(Job::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
