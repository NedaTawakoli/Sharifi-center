<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Dom\Text;
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

class ListCompany extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Company::query())
            ->columns([
                //
                TextColumn::make("name"),
                TextColumn::make("website"),
                TextColumn::make("description"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make("Edit")
                ->url(fn($record):string => route('company.edit',$record))
                ->openUrlInNewTab(),
                Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (Company $record) => $record->delete($record->id))->color('danger')->successNotification(
        Notification::make()->title("Company deleted successfully")->success()
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
        return view('livewire.company.list-company');
    }
}
