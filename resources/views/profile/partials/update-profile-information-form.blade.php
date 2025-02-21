<section class="bg-white shadow-lg rounded-lg p-6">
    <header class="mb-4">
        <h2 class="text-xl font-bold text-gray-900">{{ __('Profile Information') }}</h2>
        <p class="text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <div class="flex flex-col items-center">
            <label for="photo" class="font-medium text-gray-700">Profile Picture</label>
            <div class="relative">
                <img id="photoPreview" src="{{ auth()->user()->photo_url }}"
                    class="w-24 h-24 rounded-full border-2 border-gray-300 shadow-sm">
                <input type="file" name="photo" id="photo" class="hidden" onchange="previewImage(event)">
                <label for="photo" class="absolute bottom-0 right-0 bg-gray-200 p-1 rounded-full cursor-pointer">
                    📷
                </label>
            </div>
        </div>

        <div>
            <label for="name" class="block font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ auth()->user()->name }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ auth()->user()->email }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="bio" class="block font-medium text-gray-700">Bio</label>
            <textarea id="bio" name="bio"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                {{ auth()->user()->bio }}
            </textarea>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Save Changes
            </button>
        </div>
    </form>
</section>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('photoPreview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
