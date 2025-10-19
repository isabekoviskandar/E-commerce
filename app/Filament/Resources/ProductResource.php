<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name_uz')
                    ->required(),

                Forms\Components\TextInput::make('name_uz')
                    ->label('Name (Uzbek)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('name_ru')
                    ->label('Name (Russian)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('name_en')
                    ->label('Name (English)')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description_uz')
                    ->label('Description (Uzbek)')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description_ru')
                    ->label('Description (Russian)')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description_en')
                    ->label('Description (English)')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('country_uz')
                    ->label('Country (Uzbek)')
                    ->maxLength(255),

                Forms\Components\TextInput::make('country_ru')
                    ->label('Country (Russian)')
                    ->maxLength(255),

                Forms\Components\TextInput::make('country_en')
                    ->label('Country (English)')
                    ->maxLength(255),

                Forms\Components\Textarea::make('composition_uz')
                    ->label('Composition (Uzbek)')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('composition_ru')
                    ->label('Composition (Russian)')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('composition_en')
                    ->label('Composition (English)')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image(),

                Forms\Components\TextInput::make('count')
                    ->label('Count')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_uz')
                        ->searchable(),
                TextColumn::make('description_uz')->limit(50),
                ImageColumn::make('image')
                        ->label('Image')
                        ->square(),
                TextColumn::make('price'),
                TextColumn::make('count'),

            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
