<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 fw-bold">📅 Data Jadwal</h4>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th>Kelas</th>
                    <th>Pelajaran</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($jadwal as $index => $j)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>

                        {{-- nama kelas --}}
                        <td class="text-capitalize">{{ $j->kelas->nama_kelas ?? '-' }}</td>

                        {{-- pelajaran --}}
                        <td>{{ $j->kelas->pelajaran ?? '-' }}</td>

                        <td class="text-capitalize">{{ \Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, DD MMM YYYY') }}</td>
                        <td>{{ $j->jam_mulai ?? '-' }} - {{ $j->jam_selesai ?? '-' }}</td>

                        <td>
                            @if(\Carbon\Carbon::parse($j->tanggal)->isToday())
                                <span class="badge bg-success">Hari Ini</span>
                            @elseif(\Carbon\Carbon::parse($j->tanggal)->isPast())
                                <span class="badge bg-secondary">Selesai</span>
                            @else
                                <span class="badge bg-warning">Akan Datang</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">Belum ada jadwal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
