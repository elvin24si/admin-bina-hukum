<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KategoriDokumen extends Model
{
    use HasFactory;
    protected $table      = 'kategori_dokumen';
    protected $primaryKey = 'kategori_id';
    protected $fillable   = ['nama', 'deskripsi'];

    public function dokumen()
    {
        return $this->hasMany(dokumen_hukum::class, 'kategori_id');
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
