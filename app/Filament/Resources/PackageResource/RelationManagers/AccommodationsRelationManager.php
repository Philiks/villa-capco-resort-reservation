<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

use App\Facades\Format;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AccommodationsRelationManager extends RelationManager
{
    protected static string $relationship = 'accommodations';

    protected static ?string $recordTitleAttribute = 'name';

    protected bool $allowDuplicates = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TagsInput::make('details')
                    ->required()
                    ->separator(',')
                    ->suggestions([
                        'x pools',
                        'x beds',
                        'x rooms',
                        'x bathrooms',
                    ]),
                Forms\Components\TextInput::make('rate')
                    ->required()
                    ->hint('Min: 1 - Max: 99,999')
                    ->placeholder(1_299)
                    ->prefix('₱')
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->minValue(1)
                        ->maxValue(99_999)
                        ->normalizeZeros()
                        ->thousandsSeparator(',')),
                Forms\Components\TextInput::make('max_people')
                    ->required()
                    ->label('Maximum number of people.')
                    ->placeholder(20)
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(99)
                        ->normalizeZeros()),
                Forms\Components\Repeater::make('file_path')
                    ->relationship('images')
                    ->columnSpan(2)
                    ->grid(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->required()
                            ->imagePreviewHeight(200)
                            ->directory('images/accommodations')
                            ->preserveFilenames()
                            ->image()
                            ->imageCropAspectRatio('16:9')
                            ->panelAspectRatio('2:1'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TagsColumn::make('details')
                    ->separator(','),
                Tables\Columns\TextColumn::make('rate')
                    ->money('php'),
                Tables\Columns\TextColumn::make('max_people'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date(),
            ])
            ->filters([
                // Max people
                Filter::make('max_people')
                    ->form([
                        Forms\Components\TextInput::make('max_people')
                            ->required()
                            ->label('Maximum number of people.')
                            ->placeholder(20)
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(99)
                                ->normalizeZeros()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['max_people'],
                                fn (Builder $query, $max_people): Builder => $query->where('max_people', '>=', $max_people)
                            );
                    }),

                // Rate
                Filter::make('rate')
                    ->form([
                        Forms\Components\TextInput::make('rate')
                            ->required()
                            ->hint('Min: 1 - Max: 99,999')
                            ->placeholder(1_299)
                            ->prefix('₱')
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->minValue(1)
                                ->maxValue(99_999)
                                ->normalizeZeros()
                                ->thousandsSeparator(',')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['rate'],
                                fn (Builder $query, $rate): Builder => $query->where('rate', '<=', Format::moneyForDatabase($rate))
                            );
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Group::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('rate')
                                    ->required()
                                    ->hint('Min: 1 - Max: 99,999')
                                    ->placeholder(1_299)
                                    ->prefix('₱')
                                    ->numeric()
                                    ->mask(fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->decimalPlaces(2)
                                        ->minValue(1)
                                        ->maxValue(99_999)
                                        ->normalizeZeros()
                                        ->thousandsSeparator(',')),
                                Forms\Components\TextInput::make('max_people')
                                    ->required()
                                    ->label('Maximum number of people.')
                                    ->placeholder(20)
                                    ->numeric()
                                    ->mask(fn (TextInput\Mask $mask) => $mask
                                        ->numeric()
                                        ->minValue(1)
                                        ->maxValue(99)
                                        ->normalizeZeros()),
                            ])
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
