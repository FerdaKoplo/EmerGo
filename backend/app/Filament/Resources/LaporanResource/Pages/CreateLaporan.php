<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporan extends CreateRecord
{
    protected static string $resource = LaporanResource::class;

    protected function afterCreate(): void
    {
        $recipients = \App\Models\User::all();

        \Illuminate\Support\Facades\Notification::send($recipients, new \App\Notifications\LaporanBaruNotification($this->record));

        // dd('TES: Kode pengiriman notifikasi sudah selesai dijalankan.');
    }
}
