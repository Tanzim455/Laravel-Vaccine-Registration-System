<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserVaccineRegistrationResource\Pages;
use App\Models\UserVaccineRegistration;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserVaccineRegistrationResource extends Resource
{
    protected static ?string $model = UserVaccineRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vaccine_centre_id')
                    ->relationship('vaccineCentre', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('nid')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->numeric(),
                // Forms\Components\DatePicker::make('scheduled_date'),
                // Forms\Components\Toggle::make('is_scheduled')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vaccineCentre.name')

                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('nid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_scheduled')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Filter::make('Registered')
                    ->query(fn (Builder $query): Builder => $query->where('is_scheduled', false)),
                Filter::make('Scheduled')
                    ->query(fn (Builder $query): Builder => $query->where('is_scheduled', true)
                        ->where('scheduled_date', '>', Carbon::now()->format('Y-m-d')),

                    ),
                Filter::make('Vaccinated')
                    ->query(fn (Builder $query): Builder => $query->where('is_scheduled', true)
                        ->where('scheduled_date', '<', Carbon::now()->format('Y-m-d')),

                    ),
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
            'index' => Pages\ListUserVaccineRegistrations::route('/'),
            // 'create' => Pages\CreateUserVaccineRegistration::route('/create'),
            'edit' => Pages\EditUserVaccineRegistration::route('/{record}/edit'),
        ];
    }
}
