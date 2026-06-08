<?php

namespace App\Livewire\Sinfs;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Sinf;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateClass extends Component implements HasActions, HasSchemas
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
                  Section::make('create Class')
                ->description('Now you can create the data of specific Class')
                ->columns(2)
                ->schema([
                    TextInput::make('name'),
                    TextInput::make('website'),
                    Textarea::make('Description'),
                ]),
            ])
            ->statePath('data')
            ->model(Sinf::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Sinf::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.sinfs.create-class');
    }
}
