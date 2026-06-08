<?php

namespace App\Livewire\Finance;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Payment;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreatePayment extends Component implements HasActions, HasSchemas
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

                  Section::make('create Teacher')
                ->description('Now you can create the data of specific Teacher')
                ->columns(2)
                ->schema([
                    TextInput::make(""),
                ]),
            ])
            ->statePath('data')
            ->model(Payment::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Payment::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.finance.create-payment');
    }
}
