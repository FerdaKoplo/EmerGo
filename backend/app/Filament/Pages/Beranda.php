<?php


namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ResponseTeam;

class Beranda extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.beranda';

    public function getViewData(): array
    {
        return [
            'responseTeams' => ResponseTeam::all()
        ];
    }
}