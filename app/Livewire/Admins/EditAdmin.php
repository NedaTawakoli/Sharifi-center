<?php

namespace App\Livewire\Admins;

use App\Models\Admin1;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditAdmin extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Admin1 $record;

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
                   Section::make('Edit Admin')
                ->description('Now you can edit the data of specific Admin')
                ->columns(2)
                ->schema([
                    TextInput::make('name'),
                    TextInput::make('Last Name'),
                    TextInput::make('Image Url'),
                    TextInput::make('Email'),
                    TextInput::make('User Id'),

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
        return view('livewire.admins.edit-admin');
    }
}
