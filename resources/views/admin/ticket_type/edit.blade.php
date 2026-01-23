<x-layouts.admin title="Edit Tipe Tiket">

    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-6">
            Edit Tipe Tiket
        </h1>

        <div class="bg-white rounded-box p-6 shadow-xs max-w-xl">
            <form
                action="{{ route('admin.ticket-types.update', $ticketType->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <!-- Event -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Event</span>
                    </label>

                    <select name="event_id" class="select select-bordered w-full" required>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id', $ticketType->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }}
                            </option>
                        @endforeach
                    </select>

                    @error('event_id')
                        <span class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Nama Tipe Tiket -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Nama Tipe Tiket</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="input input-bordered"
                        value="{{ old('name', $ticketType->name) }}"
                        required
                    >

                    @error('name')
                        <span class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Harga</span>
                    </label>

                    <input
                        type="number"
                        name="price"
                        class="input input-bordered"
                        value="{{ old('price', $ticketType->price) }}"
                        required
                    >

                    @error('price')
                        <span class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Kuota -->
                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text">Kuota</span>
                    </label>

                    <input
                        type="number"
                        name="quota"
                        class="input input-bordered"
                        value="{{ old('quota', $ticketType->quota) }}"
                        required
                    >

                    @error('quota')
                        <span class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Action -->
                <div class="flex gap-2">
                    <button class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('admin.ticket-types.index') }}" class="btn">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layouts.admin>
