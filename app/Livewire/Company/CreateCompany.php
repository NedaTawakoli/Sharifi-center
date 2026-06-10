<?php

namespace App\Livewire\Company;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
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
                Wizard::make([
                    Step::make('Company')
                    ->schema([
                        TextInput::make('name')->required(),
                        Textarea::make('description')->required(),
                    ]),
                    Step::make('Job')
                    ->schema([
                        Select::make('company_id')
                        ->options([
                            "dell"=> "Dell",
                            "Apple"=> "Apple",
                            "HP"=> "HP",
                            "Meta"=> "Meta",
                            "Ecma"=> "Ecma",
                        ]),
                        TextInput::make('title')->required(),
                        TextInput::make('salary')->required(),
                        TextInput::make('location')->required(),
                    ]),
                    Step::make('JobDetails')
                    ->schema([
                        Select::make('job_id')
                        ->options([
                            "backen developer"=> "Backend Developer",
                            "Frontend Developer"=> "Frontend Developer",
                            "full stack developer"=> "FullStack Developer",
                            "Software Engineering"=> "Software Engineering",
                            "Eployee"=> "Employee",
                        ]),
                        TextInput::make('start_date')->label('Announcement Date')->required(),
                        TextInput::make('end_date')->label('End Date')->required(),
                        Textarea::make('description')->required(),
                    ]),
                ])
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
         DB::transaction( function() use ($data){
               //......
                $company =  Company::create([
                'name'=> $data['name'],
                'description'=> $data['description'],
             ]);
             $company->Job1()->create([
                 'title'=> $data['title'],
                 'salary'=> $data['salary'],
                 'location'=> $data['location'],
                 'company_id'=> $data['company_id'],
             ]);
             $company->JobDetails()->create([
                 'start_date'=> $data['start_date'],
                 'end_date'=> $data['end_date'],
                 'description'=> $data['description'],
                 'job_id'=> $data['job_id'],
         )]);
             return redirect()->route('jobs.index');
         }

    public function render(): View
    {
        return view('livewire.company.create-company');
    }
}
