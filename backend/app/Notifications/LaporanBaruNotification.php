<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Notifications\Notification;
use App\Filament\Resources\LaporanResource;

class LaporanBaruNotification extends Notification implements ShouldQueue 
{
    use Queueable;

    public Laporan $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
        $this->afterCommit(); 
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->laporan->nama_insiden,
            'location' => $this->laporan->lokasi,
            'url' => LaporanResource::getUrl('view', ['record' => $this->laporan->id]),
        ];
    }
}