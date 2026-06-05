<?php

namespace App\Livewire\Jobs;

use App\Models\Job1 as ModelsJob1;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\Job1;
use Livewire\Component;

class CreateJob extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('create Jobs')
                ->description('Now you can create the data of specific Jobs')
                ->columns(2)
                ->schema([
                    TextInput::make('company_id'),
                    TextInput::make('title'),
                    TextInput::make('salary'),
                    TextInput::make('type'),
                    TextInput::make('location'),
                ]),
            ])
            ->statePath('data')
            ->model(Job1::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Job1::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.jobs.create-job');
    }
}
