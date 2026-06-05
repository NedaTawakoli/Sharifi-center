<?php

namespace App\Livewire\Jobs;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\JobDetails;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Livewire\Component;

class CreateJobDateils extends Component implements HasActions, HasSchemas
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
                //
                Section::make('Insert Details of Jobs')
                ->description('Now you can Insert the data of specific Details of Jobs')
                ->columns(2)
                ->schema([
                    TextInput::make('job_id'),
                    Textarea::make('description'),
                    DatePicker::make('start_date')->format('Y-m-d')->timezone('Asia/Kabul'),
                    DatePicker::make('end_date')->format('Y-m-d')->timezone('Asia/Kabul'),
                ]),
            ])
            ->statePath('data')
            ->model(JobDetails::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = JobDetails::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.jobs.create-job-dateils');
    }
}
