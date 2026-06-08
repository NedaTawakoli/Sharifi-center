<?php

namespace App\Livewire\Teachers;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateTeacher extends Component implements HasActions, HasSchemas
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
                    Select::make('user_id')->options(User::query()->pluck('name','id'))->required()->searchable(),
                    TextInput::make('lastName'),
                    TextInput::make('degree-of-education'),
                    TextInput::make('phone_number'),
                    TextInput::make("tazkira_number"),
                    FileUpload::make('image_url')->directory('teacher_images')->disk('public'),
                    Textarea::make('bio'),
                ]),
            ])
            ->statePath('data')
            ->model(Teacher::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Teacher::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.teachers.create-teacher');
    }
}
