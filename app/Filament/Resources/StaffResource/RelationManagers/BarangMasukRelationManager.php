<?php

namespace App\Filament\Resources\StaffResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\Select::make('id_barang')
                    ->label('Barang')
                    ->relationship('barang', 'nama_barang')
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
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('bk_tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_from')->label('From'),
                        Forms\Components\DatePicker::make('tanggal_until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tanggal_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('bk_tanggal', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('bk_tanggal', '<=', $date),
                            );
                    })
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
            ->defaultSort('bk_tanggal', 'desc');
    }
} 