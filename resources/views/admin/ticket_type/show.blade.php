<x-layouts.admin title="Detail Tipe Tiket">

    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-6">Detail Tipe Tiket</h1>

        <div class="bg-white rounded-box p-6 shadow-xs max-w-xl">
            <table class="table">
                <tr>
                    <th class="w-1/3">Nama Tipe Tiket</th>
                    <td>{{ $ticketType->name }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $ticketType->created_at->format('d M Y') }}</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.ticket-types.index') }}" class="btn">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</x-layouts.admin>
