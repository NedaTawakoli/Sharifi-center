<?php

namespace App\Livewire\Admins;
use App\Models\Admin1;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListAdmin extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder =>Admin1::query())
            ->columns([
                //
                TextColumn::make("user.name")->label("Admin Name"),
                TextColumn::make("lastName"),
                TextColumn::make("image_url"),
                TextColumn::make("email"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
                  Action::make("Edit")
                ->url(fn($record):string => route('admins.edit',$record))
                ->openUrlInNewTab(),
                 Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (Admin1 $record) => $record->delete($record->id))->color('danger')->successNotification(
        Notification::make()->title("Admin deleted successfully")->success()
     )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.admins.list-admin');
    }
}
