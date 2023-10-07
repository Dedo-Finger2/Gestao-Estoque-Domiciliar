<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Info geral')
                ->description('Informações gerais sobre o produto')
                ->collapsible(true)
                ->schema([

                    TextInput::make('nome')->required()->unique(ignoreRecord:true),
                    TextInput::make('quantidade_minima')->numeric(),
                    Select::make('unidade_medida')->options([
                        'kg' => 'KG',
                        'l' => 'L',
                        'penca' => 'Penca',
                        'unidade' => 'Unidade'
                    ])->required(),

                    TextInput::make('preco_unitario')->numeric()->step('any'),
                ])->columns(2)
                ->columnSpan(1),

                Section::make('Visualização e categoziração')
                    ->description('Imagem e categorias do produto')
                    ->collapsible(true)
                    ->schema([

                        FileUpload::make('imagem')->disk('public')
                        ->directory('images'),

                        Select::make('categorias')->multiple()
                        ->relationship('categorias','nome')
                        ->preload(),

                    ])->columnSpan(1),
            ])->columns([
                'default' => 1,
                'md' => 2,
                'lg' => 2,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem'),
                TextColumn::make('nome')
                ->searchable()
                ->sortable(),
                TextColumn::make('quantidade_minima')
                ->sortable(),
                TextColumn::make('unidade_medida')
                ->sortable(),
                TextColumn::make('preco_unitario')
                ->sortable(),
                TextColumn::make('categorias.nome')
                ->searchable(),
                TextColumn::make('updated_at')
                    ->date("D - d/m/Y")
                    ->sortable()
                    ->label('Última compra')
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('arrozes')->query(
                    function (Builder $query): Builder {
                        return $query->where('nome', 'like', 'arroz');
                    }
                ),
                SelectFilter::make('categorias')
                ->relationship('categorias', 'nome')
                ->multiple()
                ->preload()
                ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
