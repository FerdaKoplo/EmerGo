<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Enums\StatusLaporan;
use App\Enums\KategoriLaporan;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;
protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $pluralModelLabel = 'Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')->required(),
                Forms\Components\TextInput::make('nama_insiden')->required(),
                Forms\Components\DateTimePicker::make('tanggal_waktu')->required(),
                Forms\Components\TextInput::make('lokasi')->required(),
                Forms\Components\Select::make('status')
                    ->options(StatusLaporan::class)
                    ->required()
                    ->default(StatusLaporan::Waiting),
                Forms\Components\Select::make('kategori')
                    ->options(KategoriLaporan::class)
                    ->required()
                    ->default(KategoriLaporan::Damkar),
                Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto Insiden')
                    ->disk('public')
                    ->image()
                    ->directory('laporan-insiden')
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(3)->schema([
                    Infolists\Components\Group::make()->schema([
                        Infolists\Components\Section::make('Detail Laporan')
                            ->schema([
                                Infolists\Components\TextEntry::make('nama_insiden'),
                                Infolists\Components\TextEntry::make('tanggal_waktu')->dateTime('d M Y, H:i'),
                                Infolists\Components\TextEntry::make('lokasi'),
                            ])->columns(2),
                    ])->columnSpan(2),
                    Infolists\Components\Group::make()->schema([
                        Infolists\Components\Section::make('Informasi Tambahan')
                            ->schema([
                                Infolists\Components\ImageEntry::make('foto')
                                    ->disk('public') 
                                    ->hiddenLabel()
                                    ->height(150),
                                Infolists\Components\TextEntry::make('status')->badge(),
                                Infolists\Components\TextEntry::make('kategori')->badge(),
                                Infolists\Components\TextEntry::make('nomor'),
                            ]),
                    ])->columnSpan(1),
                ]),
                Infolists\Components\Section::make('Deskripsi')
                    ->schema([
                        Infolists\Components\TextEntry::make('deskripsi')->hiddenLabel()->prose()->html(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')->searchable(),
                Tables\Columns\TextColumn::make('nama_insiden')->searchable()->limit(25),
                Tables\Columns\TextColumn::make('tanggal_waktu')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->searchable(),
                Tables\Columns\TextColumn::make('kategori')->badge()->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->url(fn (Laporan $record): string => static::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'view' => Pages\ViewLaporan::route('/{record}'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
}