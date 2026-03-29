<?php

namespace App\Http\Controllers;

use App\Models\Pasien;

class PasienController extends Controller
{
    public function dashboard()
    {
        if (!session()->has('user')) {
            return redirect()->route('login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $pasien = Pasien::getAllWithDecryptedEmail();

        return view('dashboard', compact('pasien'));
    }
}