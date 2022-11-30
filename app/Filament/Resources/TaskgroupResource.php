<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskgroupResource\Pages;
use App\Filament\Resources\TaskgroupResource\RelationManagers;
use App\Models\Taskgroup;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskgroupResource extends Resource
{
    protected static ?string $model = Taskgroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationBadge(): ?string {
        return static::getModel()::count();
     }
     protected static ?string $navigationGroup = "Grupos de Tarefas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                        ->sortable()
                        ->searchable(),

                Tables\Columns\TextColumn::make('description')
                        ->sortable()
                        ->searchable()
                        ->limit(30),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTaskgroups::route('/'),
        ];
    }    
}
