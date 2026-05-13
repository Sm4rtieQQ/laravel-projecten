<form action="{{route('articles.store')}}" method="POST">
    @csrf
    <div class="wrap">
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="name">Titel</label>
            <input class="bg-white w-11/12" name="name" id="name" type="text" required />
        </div>
        <div class="p-4 flex justify-between">
            <label class="font-bold" for="text">Tekst</label>
            <textarea class="bg-white w-11/12 h-64" name="text" id="text" type="text" required>hier komt text</textarea>
        </div>
    </div>
    <button class="btn-submit" type="submit">Publiceer artikel</button>
    <a class="btn-cancel" href="{{ route('articles.index')}}">Annuleren</a>
</form>