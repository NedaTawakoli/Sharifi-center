<?php

namespace App\Livewire\Jobs;

use App\Models\Job1;
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

class ListJobs extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Job1::query())
            ->columns([
                //
                TextColumn::make("company_id"),
                TextColumn::make("title")->searchable(),
                TextColumn::make("salary")->sortable(),
                TextColumn::make("type"),
                TextColumn::make("location"),
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
                ->url(fn($record):string => route('jobs.edit',$record))
                ->openUrlInNewTab(),
                   Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (Job1 $record) => $record->delete($record->id))->color('danger')->successNotification(
        Notification::make()->title("Job deleted successfully")->success()
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
        return view('livewire.jobs.list-jobs');
    }
}
