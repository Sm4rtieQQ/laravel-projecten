<form action="{{ $newArticle ? route('articles.store') : route('articles.update', $article) }}" method="POST">
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
    </div>
    <button class="btn-submit" type="submit">Opslaan</button>
    <a class="btn-cancel" href="{{ url()->previous() }}">Annuleren</a>
</form>