<?php

namespace App\Livewire\Teachers;

use App\Models\Teacher;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListTeachers extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Teacher::query())
            ->columns([
                //
                TextColumn::make("user.name")->label("Name"),
                TextColumn::make("phone_number")->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make("degree-of-education")->badge(),
                TextColumn::make("sinf.title")->badge()->separator("-"),
                TextColumn::make("salary.amount")->label("Amount")->expandableLimitedList(3)->listWithLineBreaks(),
                TextColumn::make("lastName")->searchable()->sortable(),
                // ImageColumn::make('image_url')->disk('public')->directory('teacher_images'),
                TextColumn::make("bio")->limit(10)->toggleable(isToggledHiddenByDefault:false),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
                Action::make("createTeacher")
                ->label("Create Teacher")
                ->url(route('teacher.create')),
            ])
            ->recordActions([
                //
                 Action::make("Edit")
                ->url(fn($record):string => route('teachers.edit',$record))
                ->openUrlInNewTab(),

     Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (Teacher $record) => $record->delete($record->id))->color('danger')->successNotification(
        Notification::make()->title("Teacher deleted successfully")->success()
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
        return view('livewire.teachers.list-teachers');
    }
}
