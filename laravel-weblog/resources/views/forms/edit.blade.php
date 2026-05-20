<form action="{{ $newArticle ? route('articles.store') : route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(!$newArticle)
    @method('PUT')
    @endif

    <div class="wrap">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="name">Titel</label>
            <input class="bg-white w-11/12" name="name" id="name" type="text" value="{{ old('name', $article->name) }}" required />
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="text">Tekst</label>
            <textarea class="bg-white w-11/12 h-64" name="text" id="text" type="text" required>{{ old('text', $article->text) }}</textarea>
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="image">Afbeelding</label>
            <div class="flex items-center gap-2 min-w-0">
                <div class="flex items-center gap-2 min-w-0">
                    <span id="image-name" class="text-sm">{{$article->image ? 'Huidige afbeelding' : 'Geen bestand gekozen' }}</span>
                    <label class="btn-neutral" for="image">Bladeren...</label>
                    <input class="hidden" name="image" id="image" type="file" accept="image/*" onchange="handleImageChange(this)">
                </div>
            </div>
        </div>
        <div id="image-preview-wrapper" class="{{ $article->image ? '' : 'hidden' }}">
            <img id="image-preview" src="{{ $article->image ? Storage::url($article->image) : '' }}" class="w-64 object-cover rounded shadow-lg ml-auto">
        </div>
    </div>
    <button class="btn-submit" type="submit">Opslaan</button>
    <a class="btn-cancel" href="{{ url()->previous() }}">Annuleren</a>
</form>


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