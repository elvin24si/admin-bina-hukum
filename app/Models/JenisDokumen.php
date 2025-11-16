<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jenis_dokumen extends Model
{
    protected $table      = 'jenis_dokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable   = ['nama_jenis', 'deskripsi'];

    public function dokumenHukum()
    {
        return $this->hasMany(dokumen_hukum::class, 'jenis_id');
    }
};
