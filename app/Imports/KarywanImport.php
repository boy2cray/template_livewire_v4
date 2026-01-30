<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class KarywanImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        $tanggal_lahir = null;

        if (!empty($row['tgl_lahir'])) {
            $tanggal_lahir = is_numeric($row['tgl_lahir'])
                ? Carbon::instance(Date::excelToDateTimeObject($row['tgl_lahir']))->format('Y-m-d')
                : Carbon::parse($row['tgl_lahir'])->format('Y-m-d');
        }

        return new Karyawan([
            'nik'           => $row['nik'],
            'nama'          => $row['nama'],
            'jk'            => $row['jk'],
            'asal'          => $row['asal'],
            'tgl_lahir'     => $tanggal_lahir,
            'alamat'        => $row['alamat']
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nik'     => 'required|min:3|unique:karyawan,nik',
            '*.nama'    => 'required|max:50',
            '*.jk'      => 'required|in:L,P',
            '*.alamat'  => 'required|max:150'
        ];
    }
}
