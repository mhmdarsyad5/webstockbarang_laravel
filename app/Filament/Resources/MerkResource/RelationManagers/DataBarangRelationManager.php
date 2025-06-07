<?php

namespace App\Filament\Resources\MerkResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DataBarangRelationManager extends RelationManager
{
    protected static string $relationship = 'dataBarang';

    protected static ?string $recordTitleAttribute = 'nama_barang';

    protected static ?string $title = 'Data Barang';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('barang_kode')
                    ->label('Kode Barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenisbarang_id')
                    ->label('Jenis Barang')
                    ->relationship('jenisBarang', 'jenisbarang_ket')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('stock_barang')
                    ->label('Stock')
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga_barang')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('gambar_barang')
                    ->label('Gambar')
                    ->image()
                    ->required()
                    ->directory('barang-images')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_barang')
            ->columns([
                Tables\Columns\TextColumn::make('barang_kode')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisBarang.jenisbarang_ket')
                    ->label('Jenis')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_barang')
                    ->label('Stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_barang')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('gambar_barang')
                    ->label('Gambar')
                    ->circular(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenisbarang_id')
                    ->label('Jenis Barang')
                    ->relationship('jenisBarang', 'jenisbarang_ket')
                    ->searchable()
                    ->preload(),
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
            ])
            ->defaultSort('nama_barang', 'asc');
    }
} 