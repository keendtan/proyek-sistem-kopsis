@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row align-items-end mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="kt-eyebrow mb-1">Data Management</p>
                <h3 class="mb-0">{{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card kt-table-card">
            <div class="card-body">
                <div class="row align-items-center mb-3 g-2">
                    <div class="col-12 col-md-9">
                        <form action="{{ route('transaksi.index') }}" method="get">
                            <div class="form-group has-icon-left position-relative kt-search-input">
                                <input type="text" class="form-control rounded-pill" value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                <div class="form-control-icon"><i class="fa fa-search"></i></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
						{!! button('transaksi.create', $title) !!}
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table table-hover align-middle kt-table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>Kode Transaksi</td>
								<td>Status</td>
								<td>Tanggal</td>
								<td>Total</td>
								<td>Users Id</td>
								
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td class="transaction-status">{{ ucfirst($item->status) }}</td>
									<td>{{ $item->tanggal }}</td>
									<td>{{ $item->total }}</td>
									<td>{{ $item->users_id }}</td>
									
                                    <td>
                                        <select
                                            class="form-select transaction-status-select"
                                            data-url="{{ route('transaksi.status.update', $item->id) }}"
                                            data-status-target=".transaction-status"
                                            aria-label="Ubah status transaksi {{ $item->kode_transaksi }}"
                                        >
                                            <option value="diproses" @selected($item->status === 'diproses')>Diproses</option>
                                            <option value="selesai" @selected($item->status === 'selesai')>Selesai</option>
                                        </select>
                                        <div class="mt-2">
                                            {!! button('transaksi.destroy', 'Transaksi', $item->id) !!}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center"><i>No data.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
				{{ $data->links() }}
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
<script>
    document.querySelectorAll('.transaction-status-select').forEach((select) => {
        select.addEventListener('change', async function () {
            const previousStatus = this.dataset.previousStatus;
            const statusCell = this.closest('tr').querySelector(this.dataset.statusTarget);

            this.disabled = true;

            try {
                const response = await fetch(this.dataset.url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ status: this.value }),
                });

                if (!response.ok) {
                    throw new Error('Status transaksi gagal diperbarui.');
                }

                const result = await response.json();
                this.value = result.status;
                this.dataset.previousStatus = result.status;
                statusCell.textContent = result.status.charAt(0).toUpperCase() + result.status.slice(1);
            } catch (error) {
                this.value = previousStatus;
                alert(error.message);
            } finally {
                this.disabled = false;
            }
        });

        select.dataset.previousStatus = select.value;
    });
</script>
@endsection
