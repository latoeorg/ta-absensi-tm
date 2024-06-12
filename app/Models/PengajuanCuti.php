<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date_start', 'date_end', 'type', 'status', 'notes', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
