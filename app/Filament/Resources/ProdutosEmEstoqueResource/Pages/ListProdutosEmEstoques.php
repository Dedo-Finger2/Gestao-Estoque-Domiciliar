<?php

namespace App\Filament\Resources\ProdutosEmEstoqueResource\Pages;

use App\Filament\Resources\ProdutosEmEstoqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProdutosEmEstoques extends ListRecords
{
    protected static string $resource = ProdutosEmEstoqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
