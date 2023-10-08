<?php

namespace App\Filament\Resources\ProdutosEmEstoqueResource\Pages;

use App\Filament\Resources\ProdutosEmEstoqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProdutosEmEstoque extends EditRecord
{
    protected static string $resource = ProdutosEmEstoqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
