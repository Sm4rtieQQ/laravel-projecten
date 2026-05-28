<div class="wrap">

    <form action="{{ $newArticle ? route('articles.store') : route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(!$newArticle)
        @method('PUT')
        @endif

        <div class=" grid grid-cols-[120px_auto] gap-2">
            <label class="font-bold" for="name">Titel</label>
            <div class="grid">
                <input class="bg-white px-2" name="name" id="name" type="text" value="{{ old('name', $article->name) }}" />
                @error('name')
                <span class="text-red-700 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <label class="font-bold" for="text">Tekst</label>
            <div class="grid">
                <textarea class="bg-white h-64 px-2" name="text" id="text" type="text">{{ old('text', $article->text) }}</textarea>
                @error('text')
                <span class="text-red-700 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-10 my-6">
            <div class="grid grid-cols-[120px_auto] gap-2">
                <label class="font-bold" for="image">Afbeelding</label>
                <div class="flex flex-col gap-2">
                    <div class="flex ml-auto items-center gap-2">
                        <span id="image-name" class="text-sm">{{$article->image ? 'Huidige afbeelding' : 'Geen bestand gekozen' }}</span>
                        <label class="btn-neutral" for="image">Bladeren...</label>
                        <input class="hidden" name="image" id="image" type="file" accept="image/*" onchange="handleImageChange(this)">
                    </div>
                    <div id="image-preview-wrapper" class="{{ $article->image ? '' : 'hidden' }}">
                        <img id="image-preview" src="{{ $article->image ? Storage::url($article->image) : '' }}" class="rounded shadow-lg">
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-[120px_auto]">
                <label class="font-bold" for="categories">Categorieën</label>
                <div>
                    <div class="flex flex-wrap">
                        @foreach($categories as $category)
                        <div class="m-1">
                            <input class="peer hidden" type="checkbox" name="categories[]" id="box-{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id, $selectedCategories ?? []) ? 'checked' : '' }} />
                            <label for="box-{{$category->id}}" class="wrap cursor-pointer select-none px-2 py-1 text-sm font-semibold bg-gray-200 peer-checked:bg-green-300">{{$category->name}} </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex">
                <button class="btn-submit" type="submit">Opslaan</button>
                <a class="btn-cancel" href="{{ url()->previous() }}">Annuleren</a>
            </div>
    </form>
    <form action="{{route('categories.store')}}" method="POST">
        <div class="flex justify-end">
            <input class="bg-white px-2 text-sm" name="newCategory" id="newCategory" type="text" placeholder="nieuwe categorie" />
            <button class="btn-submit py-1" type="submit" id="addCategoryBtn">toevoegen</button>
        </div>
</div>
</form>
</div>

<!-- image preview -->
<script>
    function handleImageChange(input) {
        document.getElementById('image-name').textContent = input.files[0]?.name ?? 'Geen bestand gekozen';

        const file = input.files[0];
        const wrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = event => {
                preview.src = event.target.result;
                wrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>