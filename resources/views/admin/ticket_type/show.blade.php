<x-layouts.admin title="Detail Tipe Tiket">
    <div class="container mx-auto p-10">

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">
                    Detail Tipe Tiket
                </h2>

                <div class="space-y-4">

                    <!-- Nama Tipe Tiket -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                Nama Tipe Tiket
                            </span>
                        </label>
                        <input type="text"
                            class="input input-bordered w-full"
                            value="{{ $ticketType->name }}"
                            disabled>
                    </div>

                    <!-- Event -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                Event
                            </span>
                        </label>
                        <input type="text"
                            class="input input-bordered w-full"
                            value="{{ $ticketType->event->judul ?? '-' }}"
                            disabled>
                    </div>

                    <!-- Harga -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                Harga
                            </span>
                        </label>
                        <input type="number"
                            class="input input-bordered w-full"
                            value="{{ $ticketType->price }}"
                            disabled>
                    </div>

                    <!-- Kuota -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">
                                Kuota
                            </span>
                        </label>
                        <input type="number"
                            class="input input-bordered w-full"
                            value="{{ $ticketType->quota }}"
                            disabled>
                    </div>

                </div>
            </div>
        </div>

        <!-- Action -->
        <div class="mt-6 flex gap-2">
            <a href="{{ route('admin.ticket-types.edit', $ticketType->id) }}"
                class="btn btn-primary">
                Edit
            </a>

            <a href="{{ route('admin.ticket-types.index') }}"
                class="btn">
                Kembali
            </a>
        </div>
    </div>
</x-layouts.admin>
