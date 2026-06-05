<?php

namespace App\Livewire\Jobs;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Job_Details1;
use App\Models\JobDetails;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;

class ListJobsDateils extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => JobDetails::query())
            ->columns([
                //
                TextColumn::make("job_id"),
                TextColumn::make("description"),
                TextColumn::make("start_date"),
                TextColumn::make("end_date"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make("Edit")
                ->badge()
                ->url(fn($record):string => route('jobDetails.edit',$record))
                ->openUrlInNewTab(),
                             Action::make('delete')
                             ->badge()
    ->requiresConfirmation()
    ->action(fn (JobDetails $record) => $record->delete($record->id))->color('danger')->successNotification(
        Notification::make()->title("Job Datiel deleted successfully")->success()
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
        return view('livewire.jobs.list-jobs-dateils');
    }
}
