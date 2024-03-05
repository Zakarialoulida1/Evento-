<x-app-layout>
    <!-- Display success message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Display error message -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @foreach ($events as $event)
        <div class=" flex items-center justify-center m-3 px-8">
            <div class="flex flex-col w-full bg-white rounded shadow-lg sm:w-3/4 md:w-1/2 lg:w-3/5">
                <div class="w-full h-64 bg-top bg-cover rounded-t"
                    style="background-image: url({{ asset('storage/' . $event->image) }})"></div>
                <div class="flex flex-col w-full md:flex-row">
                    <div
                        class="flex flex-row justify-around p-4 font-bold leading-none text-gray-800 uppercase bg-gray-400 rounded md:flex-col md:items-center md:justify-center md:w-1/4">
                        <div class="md:text-3xl">{{ date('M', strtotime($event->date)) }}</div>
                        <div class="md:text-6xl">{{ date('j', strtotime($event->date)) }}</div>

                    </div>
                    <div class="p-4 font-normal text-gray-800 md:w-3/4">
                        <div class="flex justify-between items-center ">
                            <h1 class="mb-4 text-4xl font-bold leading-none tracking-tight text-gray-800">
                                {{ $event->title }}</h1>
                            @if ($event->Status == 'not_confirmed_yet')
                                <p class="flex justify-center items-center text-red-500">Not confirmed yet
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4"
                                        viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ff3300"
                                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                    </svg>
                                </p>
                            @else
                                <p class="flex justify-center items-center text-green-500">Confirmed
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#4dff00"
                                            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                    </svg>
                                </p>
                            @endif

                        </div>
                        <p class="leading-normal">{{ $event->description }}</p>
                        <div class="flex flex-row items-center mt-4 text-gray-700">
                            <div class="w-1/2">
                                {{ $event->category->name }}
                            </div>

                            <form action="{{ route('Reservation.store', ['Evenement' => $event->id]) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center justify-center w-full py-2 mt-4 font-medium text-black  rounded hover:bg-blue-500">
                                    Reserve Your Place
                                    <img src="{{ asset('storage/images/reserve.png') }}" class="w-12 m-2"
                                        alt="reservation">
                                </button>
                            </form>
                            <div class="w-1/2 flex justify-end">
                                <form action="{{ route('Evenement.details', ['Evenement' => $event]) }}"
                                    method="POST">
                                    @csrf

                                    <button>See More</button>

                                </form>
                            </div>

                            <div class="w-1/2 flex justify-end">
                                <form action="{{ route('evenement.destroy', ['evenement' => $event->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete Event</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-4">
        {{ $events->links() }}
    </div>
</x-app-layout>
