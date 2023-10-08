<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutosEmEstoqueResource\Pages;
use App\Filament\Resources\ProdutosEmEstoqueResource\RelationManagers;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoEmEstoque;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class ProdutosEmEstoqueResource extends Resource
{
    protected static ?string $model = ProdutoEmEstoque::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_produto')->options(function () {
                    // Obter todos os produtos do banco de dados
                    $produtos = Produto::all();

                    // Usar o método pluck para criar um array associativo com o id e o nome dos produtos
                    $opcoes = $produtos->pluck('nome', 'id')->toArray();

                    // Retornar o array de opções
                    return $opcoes;
                })->searchable()->required()->label('Produto'),

                Select::make('id_estoque')->options(function () {
                    // Obter todos os produtos do banco de dados
                    $estoques = Estoque::all();

                    // Usar o método pluck para criar um array associativo com o id e o nome dos estoques
                    $datasEIds = $estoques->pluck('created_at', 'id')->toArray();

                    $datasFormatadas = array_map(function ($date) {
                        $data = new DateTime($date);

                        return date_format($data, "d/m/Y");
                    }, $datasEIds);

                    // Retornar o array de opções
                    return $datasFormatadas;
                })->searchable()->required()->label('Estoque'),

                TextInput::make('quantidade')->numeric()->required(),
                TextInput::make('valor_pago')->numeric()->step('any')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('estoque.created_at')
                    ->label('Estoque')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantidade')
                    ->label('Quantidade')
                    ->sortable(),
                TextColumn::make('valor_pago')
                    ->label('Valor Pago')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProdutosEmEstoques::route('/'),
            'create' => Pages\CreateProdutosEmEstoque::route('/create'),
            'edit' => Pages\EditProdutosEmEstoque::route('/{record}/edit'),
        ];
    }
}
