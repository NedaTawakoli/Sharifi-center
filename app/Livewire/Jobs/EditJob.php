<?php

namespace App\Livewire\Jobs;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\Job1;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Livewire\Component;

class EditJob extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Job1 $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit Job')
                ->description("You can Edit Jobs")
                ->columns(2)
                ->schema([
                    TextInput::make("title"),
                    TextInput::make("salary"),
                    TextInput::make("type"),
                    TextInput::make("location"),
                    TextInput::make("company_id"),
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
        return view('livewire.jobs.edit-job');
    }
}
