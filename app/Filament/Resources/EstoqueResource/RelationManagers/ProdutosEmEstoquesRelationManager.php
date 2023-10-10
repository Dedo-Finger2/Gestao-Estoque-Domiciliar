<?php

namespace App\Filament\Resources\EstoqueResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutosEmEstoquesRelationManager extends RelationManager
{
    protected static string $relationship = 'produtosEmEstoques';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('produto.nome')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('produto.nome')
            ->columns([
                Tables\Columns\ImageColumn::make('produto.imagem')->label('Imagem'),
                Tables\Columns\TextColumn::make('produto.nome')->label('Nome')->searchable(),
                Tables\Columns\TextColumn::make('produto.unidade_medida')->label('Unidade de Medida')->badge(),
                Tables\Columns\TextColumn::make('produto.preco_unitario')->money('BRL')->label('Preço')->icon('heroicon-s-currency-dollar')->sortable(),
                Tables\Columns\TextColumn::make('quantidade')->label('Quantidade em estoque')->sortable()
            ])
            ->filters([
                //
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
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
