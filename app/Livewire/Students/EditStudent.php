<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class EditStudent extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Student $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Edit Student')
                ->description('Now you can edit the data of specific student')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->numeric(),
                    TextInput::make('lastName'),
                    TextInput::make('sinf'),
                    TextInput::make('phone Number'),
                    TextInput::make("Teazkira Number"),
                    TextInput::make("Email")

                ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.students.edit-student');
    }
}
