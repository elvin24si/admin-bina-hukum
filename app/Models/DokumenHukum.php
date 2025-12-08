<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DokumenHukum extends Model
{
    use HasFactory;
    protected $table      = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id';
    protected $fillable   = [
        'jenis_id', 'kategori_id', 'nomor', 'judul', 'tanggal', 'ringkasan', 'status',
    ];
    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id');
    }
        public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }}
        return $query;
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
