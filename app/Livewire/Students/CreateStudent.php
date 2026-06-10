<?php

namespace App\Livewire\Students;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateStudent extends Component implements HasActions, HasSchemas
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
                Section::make('create new Student')
                ->description('Now you can create the data of specific Student')
                ->columns(2)
                ->schema([
                    Select::make("user_id")
                    ->label("User Name")
                    ->options(User::query()->pluck('name','id'))
                    ->loadingMessage('please wait a minute')
                    ->searchable(),
                    TextInput::make('lastName')->required(),
                    TextInput::make('phone_number')->required(),
                    TextInput::make('tazkira_number')->required(),
                    FileUpload::make("image_url")->directory('student_photos')->disk('public'),
                ]),
            ])
            ->statePath('data')
            ->model(Student::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Student::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.students.create-student');
    }
}
