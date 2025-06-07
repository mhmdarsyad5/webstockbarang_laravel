<?php

namespace App\Filament\Resources\DataBarangResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BarangMasukRelationManager extends RelationManager
{
    protected static string $relationship = 'barangMasuk';

    protected static ?string $recordTitleAttribute = 'bm_kode';

    protected static ?string $title = 'Barang Masuk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bm_kode')
                    ->label('Kode Barang Masuk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('id_staff')
                    ->label('Staff')
                    ->relationship('staff', 'nama_staff')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('bk_tanggal')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\TextInput::make('bk_jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bm_kode')
            ->columns([
                Tables\Columns\TextColumn::make('bm_kode')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('staff.nama_staff')
                    ->label('Staff')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bk_tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bk_jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 