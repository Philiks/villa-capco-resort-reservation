<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingsRelationManager extends RelationManager
{
    protected static string $relationship = 'ratings';

    protected static ?string $recordTitleAttribute = 'comment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_featured'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating_score'),
                Tables\Columns\BooleanColumn::make('is_featured'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
            ])
            ->filters([
                Filter::make('is_admin')->toggle(),

                // Rating score
                Filter::make('rating_score')
                    ->form([
                        Forms\Components\TextInput::make('rating_score')
                            ->required()
                            ->label('Rating score of this particular user.')
                            ->placeholder(5)
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(5)
                                ->normalizeZeros()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['rating_score'],
                                fn (Builder $query, $rating_score): Builder => $query->where('rating_score', $rating_score)
                            );
                    }),
            ])
            ->headerActions([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
