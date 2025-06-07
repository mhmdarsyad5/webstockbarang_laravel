<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataBarangResource\Pages;
use App\Filament\Resources\DataBarangResource\RelationManagers;
use App\Models\DataBarang;
use App\Models\JenisBarang;
use App\Models\Merk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataBarangResource extends Resource
{
    protected static ?string $model = DataBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Data Barang';

    protected static ?string $modelLabel = 'Data Barang';         // singular (untuk edit/view)

    protected static ?string $pluralModelLabel = 'Data Barang';   // plural (untuk list/index)

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
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
                Forms\Components\Select::make('id_merk')
                    ->label('Merk')
                    ->relationship('merk', 'merk_nama')
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
                    ->disk('public')
                    ->directory('barang-images')
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('1000')
                    ->imageResizeTargetHeight('1080')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('merk.merk_nama')
                    ->label('Merk')
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
                    ->getStateUsing(fn ($record) => config('app.url') . '/storage/' . $record->gambar_barang)
                    ->width(100)
                    ->height(100),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BarangMasukRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataBarangs::route('/'),
            'create' => Pages\CreateDataBarang::route('/create'),
            'edit' => Pages\EditDataBarang::route('/{record}/edit'),
        ];
    }
}
