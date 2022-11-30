<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskResource\RelationManagers;
use Filament\Forms\Components\Select;

use Filament\Tables\Columns\BadgeColumn;

use Filament\Forms\Components\RichEditor;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static function getNavigationBadge(): ?string {
       return static::getModel()::count();
    }

    protected static ?string $navigationGroup = "Tasks";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('task_group_id')
                    ->relationship('taskGroup', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
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

                Tables\Columns\TextColumn::make('user.name')
                            ->sortable()
                            ->searchable(),

                
                Tables\Columns\BadgeColumn::make('taskGroup.title')
                        ->sortable()
                        ->searchable()
                        
                        ->colors([
                            'secondary', 
                            'primary' => 'Backlog',
                            'warning' => 'In Progress',
                            'success' => 'Done',
                            'danger' => 'To Do',
                        ]),
                        
                        
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
                SelectFilter::make('user')
                    ->searchable()
                    ->relationship('user', 'name'),
               
                SelectFilter::make('taskGroup')
                    ->searchable()
                    ->relationship('taskGroup', 'title')
                    ->multiple()
                    ->label('Grupo da Tarefa'),
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
            'index' => Pages\ManageTasks::route('/'),
        ];
    }    
}
