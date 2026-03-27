<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex items-center gap-8">

                @if(!$note->trashed())

                <p class="opacity-70">
                    <strong>Created:</strong> {{ $note->created_at->diffForHumans() }}
                </p>

                <p class="opacity-70">
                    <strong>Updated at:</strong> {{ $note->updated_at->diffForHumans() }}
                </p>

                <div class="ml-auto flex items-center gap-3">
                    <a
                        href="{{ route('notes.edit', $note) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Edit Note
                    </a>

                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf

                        <x-danger-button onclick="return confirm('Are you sure you want to move this note to the trash?')">Move to Trash</x-danger-button>
                    </form>
                </div>

                    @else 

                    <p class="opacity-70">
                    <strong>Deleted at:</strong> {{ $note->deleted_at->diffForHumans() }}
                </p>

                <div class="ml-auto flex items-center gap-3">

                    <form action="{{ route('trashed.update', $note) }}" method="post">

                        @method('put')
                        @csrf

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Restore Note</button>

                    </form>

                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf

                        <x-danger-button onclick="return confirm('Are you sure you want to delete this note forever? This action cannot be undone.')">Delete Permanently</x-danger-button>
                    </form>

                </div>

                    @endif

            </div>

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-5xl">
                    {{ $note->title }}
                </h2>

                <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
                
            </div>

        </div>
    </div>
</x-app-layout>