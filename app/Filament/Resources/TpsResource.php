<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TpsResource\Pages;
use App\Filament\Resources\TpsResource\RelationManagers;
use App\Models\Tps;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TpsResource extends Resource
{
    protected static ?string $model = Tps::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Nama TPS')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kel_id')
                    ->label('Kelurahan')
                    ->relationship('kel', 'name')
                    ->required(),
                Forms\Components\Select::make('kec_id')
                    ->label('Kecamatan')
                    ->relationship('kec', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Nama TPS')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kel.name')
                    ->label('Desa/Kel')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kec.name')
                    ->label('Kecamatan')
                    ->sortable(),
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
                SelectFilter::make('user')
                ->relationship('kel', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTps::route('/'),
            'create' => Pages\CreateTps::route('/create'),
            'edit' => Pages\EditTps::route('/{record}/edit'),
        ];
    }
}
