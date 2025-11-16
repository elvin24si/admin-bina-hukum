<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori_dokumen extends Model
{
    protected $table      = 'kategori_dokumen';
    protected $primaryKey = 'kategori_id';
    protected $fillable   = ['nama_jenis', 'deskripsi'];

    public function dokumen_hukum()
    {
        return $this->hasMany(dokumen_hukum::class, 'kategori_id');
    }
}
