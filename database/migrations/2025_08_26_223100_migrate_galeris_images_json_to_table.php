<?php

use App\Models\Galeri;
use App\Models\GaleriImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('galeris', 'images')) {
            $galeris = Galeri::query()->select(['id', 'images'])->get();
            foreach ($galeris as $g) {
                $items = $g->images;
                if (is_string($items)) {
                    $decoded = json_decode($items, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $items = $decoded;
                    } else {
                        $items = [$items];
                    }
                }
                $items = is_array($items) ? $items : [];
                $pos = 0;
                foreach ($items as $it) {
                    $val = $it;
                    if (is_array($val)) {
                        if (isset($val['path'])) {
                            $val = $val['path'];
                        } elseif (isset($val['url'])) {
                            $val = $val['url'];
                        } elseif (isset($val['name'])) {
                            $val = $val['name'];
                        }
                    }
                    $raw = (string) $val;
                    if ($raw === '') {
                        continue;
                    }
                    if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://')) {
                        $parsed = parse_url($raw);
                        $raw = $parsed['path'] ?? '';
                    }
                    $p = ltrim($raw, '/');
                    if (str_starts_with($p, 'storage/')) {
                        $p = substr($p, strlen('storage/'));
                    }
                    if (str_starts_with($p, 'public/')) {
                        $p = substr($p, strlen('public/'));
                    }
                    if (!str_starts_with($p, 'galeri-images/')) {
                        $p = 'galeri-images/' . $p;
                    }
                    if ($p === 'galeri-images/') {
                        continue;
                    }
                    GaleriImage::query()->create([
                        'galeri_id' => $g->id,
                        'path' => $p,
                        'position' => $pos++,
                    ]);
                }
            }
            Schema::table('galeris', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('galeris', 'images')) {
            Schema::table('galeris', function (Blueprint $table) {
                $table->json('images')->nullable();
            });
            $rows = DB::table('galeris')->select('id')->get();
            foreach ($rows as $row) {
                $imgs = DB::table('galeri_images')
                    ->where('galeri_id', $row->id)
                    ->orderBy('position')
                    ->pluck('path')
                    ->all();
                DB::table('galeris')->where('id', $row->id)->update([
                    'images' => json_encode($imgs),
                ]);
            }
        }
    }
};
