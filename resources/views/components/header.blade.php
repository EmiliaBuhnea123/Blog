<div>
    <nav class="bg-cyan-700 text-white p-2.5">
        <ul class="list-none p-0 flex space-x-16">
            <li class="text-white no-underline">Diversity</li>

            <li><a href="{{ route('home') }}" class="text-white no-underline hover:underline">Acasă</a></li>
            @cannot('view-all-profiles')
                <li><a href="{{ route('about') }}" class="text-white no-underline hover:underline">Despre noi</a></li>
            @endcannot

            @guest
                <li><a href="{{ route('auth.register') }}" class="text-white no-underline hover:underline">Sign up</a></li>
                <li><a href="{{ route('auth.login') }}" class="text-white no-underline hover:underline">Login</a></li>
            @endguest

            @auth
                @cannot('view-all-profiles')
                    <li>
                        <a href="{{ route('profile.show', ['id' => auth()->user()->id]) }}"
                            class="text-white no-underline hover:underline">Profilul meu</a>
                    </li>
                @endcannot

                @can('view-all-profiles')
                    <li>
                        <a href="{{ route('admin.profiles') }}" class="text-white no-underline hover:underline">Toate
                            Profilurile</a>
                    </li>

                    <li><a href="{{ route('admin.create') }}" class="text-white no-underline hover:underline">Creează o
                            categorie</a></li>
                @endcan

                @cannot('view-all-profiles')
                    <li><a href="{{ route('pages.create') }}" class="text-white no-underline hover:underline">Creează un
                            articol</a></li>
                    <li><a href="{{ route('pages.index') }}" class="text-white no-underline hover:underline">Articolele mele</a>
                    </li>
                @endcannot
                
                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-white no-underline hover:underline">Logout</button>
                </form>
            @endauth
        </ul>
    </nav>
</div>
