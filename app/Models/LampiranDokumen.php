<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Media.php
class LampiranDokumen extends Model
{
    protected $table = 'lampiran_dokumen';
    protected $primaryKey = 'lampiran_id';

    protected $fillable = [
        'dokumen_id',
        'keterangan',
    ];
}
