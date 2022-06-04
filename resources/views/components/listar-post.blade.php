<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    @if ($posts->count() > 0)
       <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 grap-6">
                @foreach ($posts as $post)
                    <div class="">
                        <a href="{{ route('post.show', ['user' => $post->user, 'post' => $post]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
    @else
        <p class="text-center">No hay Posts, sugue a alguien para poder mostrar sus posts</p>
    @endif
</div>
