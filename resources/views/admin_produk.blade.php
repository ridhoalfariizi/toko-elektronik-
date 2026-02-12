@extends('layouts.app')

@section('title', 'Kelola Produk — Toko Elektronik')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Produk</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Tambah Produk Button -->
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus mr-1"></i> Tambah Produk
        </button>
    </div>

    <!-- DataTables Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                             alt="{{ $item->produk }}"
                                             style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image"></i> No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->produk }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>Rp. {{ number_format($item->harga, 0, ',', '') }}</td>
                                <td>
                                    <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">Edit</a>
                                    <span class="mx-1">|</span>
                                    <a href="{{ route('produk.delete', $item->id) }}"
                                       class="text-danger font-weight-bold"
                                       onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</a>
                                </td>
                            </tr>

                            <!-- Edit Modal for item {{ $item->id }} -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('produk.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold">
                                                    <i class="fas fa-edit text-warning mr-2"></i>Edit Produk
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Current Thumbnail Preview -->
                                                @if($item->thumbnail)
                                                    <div class="mb-3 text-center">
                                                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                             alt="Current thumbnail"
                                                             style="max-width: 150px; max-height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #e3e6f0;">
                                                        <p class="small text-muted mt-1">Gambar saat ini</p>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for="editThumbnail{{ $item->id }}">Upload Thumbnail <small class="text-muted">(Kosongkan jika tidak ingin mengganti)</small></label>
                                                    <input type="file" class="form-control-file" id="editThumbnail{{ $item->id }}" name="thumbnail" accept="image/*">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kategori</label>
                                                    <input type="text" name="kategori" class="form-control" value="{{ $item->kategori }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Produk</label>
                                                    <input type="text" name="produk" class="form-control" value="{{ $item->produk }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga (Rp)</label>
                                                    <input type="number" name="harga" class="form-control" value="{{ $item->harga }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-2 d-block"></i>
                                    <span class="text-muted">Belum ada data produk.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-plus-circle text-primary mr-2"></i>Tambah Produk
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addThumbnail">Upload Thumbnail</label>
                            <input type="file" class="form-control-file" id="addThumbnail" name="thumbnail" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF, WebP. Maks 2MB.</small>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Contoh: Iphone" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="produk" class="form-control" placeholder="Contoh: Iphone 13 Pro" required>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="12000000" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i> Tambah Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
