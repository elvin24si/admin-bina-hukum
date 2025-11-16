<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table      = 'jenis_dokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable   = ['nama_jenis', 'deskripsi'];

    public function dokumen()
    {
        return $this->hasMany(dokumen_hukum::class, 'jenis_id');
    }
};
