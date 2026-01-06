@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Riwayat Booking Saya</h3>
                <a href="{{ route('booking.index') }}" class="btn btn-primary rounded-pill btn-sm px-3">
                    <i class="bi bi-plus-lg"></i> Booking Baru
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4">No. Antrian</th>
                                    <th class="py-3">Kendaraan</th>
                                    <th class="py-3">Jadwal Service</th>
                                    <th class="py-3">Keluhan</th>
                                    <th class="py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td class="ps-4">
                                        <div class="bg-light rounded-3 text-center border p-1" style="width: 50px; height: 50px;">
                                            <small class="d-block text-muted" style="font-size: 0.7rem;">ANTRIAN</small>
                                            <span class="fw-bold fs-5 text-dark">{{ $booking->queue_number }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-bold">{{ $booking->vehicle_type }}</div>
                                        <small class="text-muted">{{ $booking->customer_name }}</small>
                                    </td>

                                    <td>
                                        <i class="bi bi-calendar-event me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                                    </td>

                                    <td>
                                        <span class="d-inline-block text-truncate text-muted" style="max-width: 200px;">
                                            {{ $booking->problem_note ?? 'Tidak ada catatan' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3">
                                                <i class="bi bi-clock me-1"></i> Menunggu
                                            </span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="badge bg-primary rounded-pill px-3">
                                                <i class="bi bi-check-circle me-1"></i> Dikonfirmasi
                                            </span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge bg-success rounded-pill px-3">
                                                <i class="bi bi-check-all me-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3">
                                                <i class="bi bi-x-circle me-1"></i> Batal
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" alt="Empty" style="width: 150px; opacity: 0.5;">
                                        <p class="text-muted mt-3">Belum ada riwayat booking.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection