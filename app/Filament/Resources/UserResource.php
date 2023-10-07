<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;      // ? Modelo referente

    protected static ?string $navigationIcon = 'heroicon-o-users';        // ? Ícone da barra lateral

    /**
     * Método responsável por configurar o formulário de criação de instâncias do modelo
     * Aqui vamos dizer quais inputs e também o posicionamento deles. É aqui que criamos
     * o formulário referente a operação CREATE do CRUD.
     *
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*
                | -------------------------------------------------------------------------
                | TextInput -> Tipo do input (input type text)
                | make -> método que cria o input e recebe como parâmetro o nome do input
                | -------------------------------------------------------------------------
                |
                | * [DETALHE] O nome do input DEVE SER IGUAL ao nome da coluna da tabela no seu banco de dados.
                | Ou seja, se vc tem a coluna "nome" e esse input vai ser usado para escrever um nome, então seu nome
                | deve ser "nome"
                */
                TextInput::make('name')->required(),
                TextInput::make('email')->email(),
                TextInput::make('password')->password()->readOnly('edit'),
            ]);
    }

    /**
     * Método responsável por configurar a tabela de listagem dos dados do modelo referenciado.
     * É aqui que vamos configurar e definir como que a tabela que mostra os dados será exibida.
     *
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('email'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
