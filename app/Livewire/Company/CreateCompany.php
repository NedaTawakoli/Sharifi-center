<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateCompany extends Component implements HasActions, HasSchemas
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
                Section::make('create Company')
                ->description('Now you can create the data of specific Company')
                ->columns(2)
                ->schema([
                    TextInput::make('name'),
                    TextInput::make('website'),
                    Textarea::make('Description'),
                ]),
            ])
            ->statePath('data')
            ->model(Company::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Company::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.company.create-company');
    }
}
