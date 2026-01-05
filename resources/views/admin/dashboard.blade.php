@extends('layouts.app')

@section('content')
<div class="container-fluid px-4"> <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h2 class="fw-bold text-dark">Dashboard Bengkel</h2>
        <div class="text-muted">
            <small>Hari ini: {{ date('d M Y') }}</small>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2 fw-bold opacity-75">Booking Menunggu</h6>
                    <h2 class="fw-bold mb-0">{{ $total_pending }}</h2>
                    <small>Perlu konfirmasi segera</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2 fw-bold opacity-75">Service Hari Ini</h6>
                    <h2 class="fw-bold mb-0">{{ $total_today }}</h2>
                    <small>Kendaraan dijadwalkan hari ini</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="text-uppercase mb-2 fw-bold opacity-75">Total Pendapatan (Selesai)</h6>
                    <h2 class="fw-bold mb-0">Rp {{ number_format($income, 0, ',', '.') }}</h2>
                    <small>Akumulasi status 'Completed'</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Booking Masuk</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Pelanggan</th>
                            <th>Layanan & Kendaraan</th>
                            <th>Jadwal</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">{{ $booking->user->name }}</div>
                                <small class="text-muted">{{ $booking->user->email }}</small>
                            </td>

                            <td>
                                <span class="badge bg-info text-dark mb-1">{{ $booking->service->name }}</span><br>
                                <small class="text-muted fw-bold">{{ $booking->vehicle_plate }}</small>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                            </td>

                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                    {{ $booking->problem_note ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="badge bg-primary">Dikonfirmasi</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="btn-group btn-group-sm">
                                        <select name="status" class="form-select form-select-sm" 
                                                style="width: 130px; border-radius: 5px 0 0 5px;" 
                                                onchange="this.form.submit()">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Konfirmasi</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Batalkan</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Belum ada data booking yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-3 d-flex justify-content-end">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection