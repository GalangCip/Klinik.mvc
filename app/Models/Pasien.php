<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pasien extends Model
{
    protected $table      = 'pasien';
    protected $primaryKey = 'nomedrec';
    public    $incrementing = false;
    protected $keyType    = 'string';
    public    $timestamps = false;

    // Ambil semua pasien dengan email terdekripsi AES
    public static function getAllWithDecryptedEmail()
    {
        return DB::select("
            SELECT
                nomedrec,
                nama_pasien,
                tempat_lahir,
                tgl_lahir,
                jenkel,
                alamat,
                kota,
                telepon,
                CAST(AES_DECRYPT(email, 'key_rahasia') AS CHAR) AS email_asli
            FROM pasien
        ");
    }
}