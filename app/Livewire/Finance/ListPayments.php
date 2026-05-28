<?php

namespace App\Livewire\Finance;

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
use Livewire\Component;
use App\Models\Payment;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;

class ListPayments extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Payment::query())
            ->columns([
                //
                TextColumn::make("user.student.name")->label("Student Name")->sortable()->searchable(),
                TextColumn::make("sinf.title")->label("Course Name")->sortable()->searchable(),
                TextColumn::make("amount")->money("AFG"),
                TextColumn::make("created_at")->date(),
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
                ->url(fn($record):string => route('payment.edit',$record))
                ->openUrlInNewTab(),
                Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (Payment $record) => $record->delete($record->id))
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.finance.list-payments');
    }
}
