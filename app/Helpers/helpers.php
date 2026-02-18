<?php

use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Setkop;
use App\Models\SimpananKeluar;
use App\Models\SimpananMasuk;

function terbilang($angka)
{
    $angka = abs((int) $angka);

    $bilangan = [
        '',
        'satu', 'dua', 'tiga', 'empat', 'lima',
        'enam', 'tujuh', 'delapan', 'sembilan',
        'sepuluh', 'sebelas'
    ];

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) {
        return terbilang(intval($angka / 10)) . ' puluh ' . terbilang($angka % 10);
    } elseif ($angka < 200) {
        return 'seratus ' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return terbilang(intval($angka / 100)) . ' ratus ' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return 'seribu ' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang(intval($angka / 1000)) . ' ribu ' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang(intval($angka / 1000000)) . ' juta ' . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        return terbilang(intval($angka / 1000000000)) . ' miliar ' . terbilang($angka % 1000000000);
    } elseif ($angka < 1000000000000000) {
        return terbilang(intval($angka / 1000000000000)) . ' triliun ' . terbilang($angka % 1000000000000);
    }

    return 'jumlah terlalu besar';
}

function tambah_file($source, $subFolder)
{
    // --- Upload file jika ada ---
    $filePath = null;
    if ($source) {
        
        $originalName = pathinfo($source->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $source->getClientOriginalExtension();
        $cleanName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);

        $filename = uniqid() . '_' . $cleanName . '.' . $extension;
        $destinationDir = public_path('storage/' . $subFolder);

        if (!is_dir($destinationDir)) {
            if (!mkdir($destinationDir, 0755, true)) {
                throw new \Exception('Gagal membuat folder tujuan: ' . $destinationDir);
            }
        }

        $destinationPath = $destinationDir . '/' . $filename;

        try {
            $source->move($destinationDir, $filename);
        } catch (\Exception $e) {
            $tempPath = $source->getRealPath();
            if ($tempPath && file_exists($tempPath)) {
                if (!copy($tempPath, $destinationPath)) {
                    throw new \Exception('Gagal menyalin file ke tujuan.');
                }
            } else {
                throw new \Exception('File temporary tidak ditemukan.');
            }
        }

        $filePath = $subFolder . '/' . $filename;
    }

    return $filePath;
}


function update_file($source, $fileLama, $subFolder)
{
    if ($source) {
        // --- Sanitasi nama file ---
        $originalName = pathinfo($source->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $source->getClientOriginalExtension();
        $cleanName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);

        $filename = uniqid() . '_' . $cleanName . '.' . $extension;
        $destinationDir = public_path('storage/' . $subFolder);

        // --- Pastikan folder ada ---
        if (!is_dir($destinationDir)) {
            if (!mkdir($destinationDir, 0755, true)) {
                throw new \Exception('Gagal membuat folder tujuan: ' . $destinationDir);
            }
        }

        $destinationPath = $destinationDir . '/' . $filename;

        // --- Pindahkan file ---
        try {
            // Gunakan metode Laravel
            $source->move($destinationDir, $filename);
        } catch (\Exception $e) {
            // Jika gagal, fallback ke copy
            $tempPath = $source->getRealPath();
            if ($tempPath && file_exists($tempPath)) {
                if (!copy($tempPath, $destinationPath)) {
                    throw new \Exception('Gagal menyalin file ke tujuan.');
                }
            } else {
                throw new \Exception('File temporary tidak ditemukan.');
            }
        }

        // --- Hapus file lama jika ada ---
        if ($fileLama) {
            $oldPath = public_path('storage/' . $fileLama);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $filePath = $subFolder . '/' . $filename;
    } else {
        $filePath = $fileLama;
    }

    return $filePath;
}

function delete_file($source)
{
    if (!empty($source)) 
    { 
        $filePath = public_path('storage/' . $source); 
        if (file_exists($filePath)) 
        { 
            @unlink($filePath); 
        }
    }
}