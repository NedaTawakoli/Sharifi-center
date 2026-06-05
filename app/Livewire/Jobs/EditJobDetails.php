<?php

namespace App\Livewire\Jobs;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\JobDetails;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Livewire\Component;

class EditJobDetails extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public JobDetails $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit JobDetails')
                ->description("You can Edit Details of Jobs")
                ->columns(2)
                ->schema([
                    TextInput::make("start_date"),
                    TextInput::make("end_date"),
                    TextInput::make("description"),
                    TextInput::make("job_id"),
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
        return view('livewire.jobs.edit-job-details');
    }
}
