<div>
    <form wire:submit="save">
        {{ $this->form }}

        <button class="py-2 px-8 bg-purple-600 rounded-md text-white my-5" type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
