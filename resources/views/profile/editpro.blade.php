<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    <h1>Edit Profile</h1>
                </div>
                <form method="POST" action="/profile/{{$user->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="pt-4">
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') ?? $user->profile->title}}" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="pt-4">
                        <x-input-label for="description" value="Description" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ old('description') ?? $user->profile->description}}" autofocus />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="pt-4">
                        <x-input-label for="url" value="URL" />
                        <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" value="{{ old('url') ?? $user->profile->url}}" autofocus />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                    <div class="pt-4 mb-3">
                        <x-input-label for="image" value="Profile Image" />
                        <x-text-input id="image" class="form-control" type="file" name="image" value="image" autofocus  />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                    <div class="pt-4">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
