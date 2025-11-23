<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JenisDokumen extends Model
{
    protected $table      = 'jenis_dokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable   = ['nama_jenis', 'deskripsi'];

    public function dokumen()
    {
        return $this->hasMany(dokumen_hukum::class, 'jenis_id');
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
