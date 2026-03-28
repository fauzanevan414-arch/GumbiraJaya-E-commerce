<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gumbira Jaya</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{asset('images/logoweb.png')}}" alt="logo">
        <span>Admin Panel</span>
    </div>
    <nav>
        <a href="#" class="nav-link active" onclick="showTab('produk')">📦 Kelola Produk</a>
        <a href="#" class="nav-link" onclick="showTab('pesanan')">🧾 Kelola Pesanan</a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-footer">
    <a href="{{ route('indexsudahlog') }}">← Kembali ke Toko</a>
    <form method="POST" action="{{ route('admin.logout') }}" style="margin-top: 10px;">
        @csrf
        <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.4); font-size:0.82rem; cursor:pointer;">
            🚪 Logout Admin
        </button>
    </form>
</div>
    </div>
</div>

<div class="main">

    {{-- ===================== TAB PRODUK ===================== --}}
    <div id="tab-produk" class="tab-content active">
        <div class="page-header">
            <h1>Kelola Produk</h1>
            <button class="btn-primary" onclick="openModalTambah()">+ Tambah Produk</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $item)
                    <tr id="row-produk-{{ $item->id_produk }}">
                        <td><img src="{{ asset('images/'.$item->gambar_produk) }}" class="tbl-img"></td>
                        <td>
                            <div class="prod-name">{{ $item->nama_produk }}</div>
                            <div class="prod-desc">{{ Str::limit($item->deskripsi_produk ?? '-', 50) }}</div>
                        </td>
                        <td><span class="badge">{{ $item->kategori ?? '-' }}</span></td>
                        <td>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                        <td>
                            <span class="stok-badge {{ $item->stok_produk <= 5 ? 'stok-low' : 'stok-ok' }}">
                                {{ $item->stok_produk }}
                            </span>
                        </td>
                        <td>
                            <button class="btn-edit" onclick="openModalEdit(
                                {{ $item->id_produk }},
                                '{{ addslashes($item->nama_produk) }}',
                                '{{ addslashes($item->deskripsi_produk ?? '') }}',
                                {{ $item->harga_produk }},
                                {{ $item->stok_produk }},
                                '{{ addslashes($item->kategori ?? '') }}',
                                '{{ $item->gambar_produk }}'
                            )">Edit</button>
                            <button class="btn-delete" onclick="hapusProduk({{ $item->id_produk }})">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty-row">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===================== TAB PESANAN ===================== --}}
    <div id="tab-pesanan" class="tab-content">
        <div class="page-header">
            <h1>Kelola Pesanan</h1>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $p)
                    <tr id="row-pesanan-{{ $p->id_pesanan }}">
                        <td>#{{ $p->id_pesanan }}</td>
                        <td>{{ $p->user->nama ?? $p->id_user }}</td>
                        <td>{{ $p->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $p->detailPesanan->sum('jumlah') }}</td>
                        <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ $p->status_pesanan }}">
                                {{ ucfirst($p->status_pesanan) }}
                            </span>
                        </td>
                        <td>
                            <select class="select-status" onchange="updateStatus({{ $p->id_pesanan }}, this.value)">
                                <option value="pending"   {{ $p->status_pesanan == 'pending'   ? 'selected' : '' }}>Pending</option>
                                <option value="diproses"  {{ $p->status_pesanan == 'diproses'  ? 'selected' : '' }}>Diproses</option>
                                <option value="dikirim"   {{ $p->status_pesanan == 'dikirim'   ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai"   {{ $p->status_pesanan == 'selesai'   ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan"{{ $p->status_pesanan == 'dibatalkan'? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="empty-row">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ===================== MODAL TAMBAH PRODUK ===================== --}}
<div id="modal-tambah" class="modal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>Tambah Produk</h2>
            <button class="modal-close" onclick="closeModal('modal-tambah')">✕</button>
        </div>
        <form action="{{ route('admin.produk.tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi_produk" rows="3"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga_produk" required min="0">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok_produk" required min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori">
            </div>
            <div class="form-group">
                <label>Foto Produk</label>
                <input type="file" name="gambar_produk" accept="image/*" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modal-tambah')">Batal</button>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL EDIT PRODUK ===================== --}}
<div id="modal-edit" class="modal">
    <div class="modal-box">
        <div class="modal-header">
            <h2>Edit Produk</h2>
            <button class="modal-close" onclick="closeModal('modal-edit')">✕</button>
        </div>
        <form id="form-edit" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" id="edit-nama" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi_produk" id="edit-deskripsi" rows="3"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga_produk" id="edit-harga" required min="0">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok_produk" id="edit-stok" required min="0">
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" id="edit-kategori">
            </div>
            <div class="form-group">
                <label>Foto Baru (kosongkan jika tidak diganti)</label>
                <div class="preview-wrap">
                    <img id="edit-preview" src="" alt="preview" class="img-preview">
                </div>
                <input type="file" name="gambar_produk" accept="image/*">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('modal-edit')">Batal</button>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
// Tab switching
function showTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    event.target.classList.add('active');
}

// Modal
function openModalTambah() {
    document.getElementById('modal-tambah').classList.add('show');
}

function openModalEdit(id, nama, deskripsi, harga, stok, kategori, gambar) {
    document.getElementById('form-edit').action = '/admin/produk/' + id;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-harga').value = harga;
    document.getElementById('edit-stok').value = stok;
    document.getElementById('edit-kategori').value = kategori;
    document.getElementById('edit-preview').src = '/images/' + gambar;
    document.getElementById('modal-edit').classList.add('show');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}

// Tutup modal kalau klik backdrop
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});

// Hapus produk
function hapusProduk(id) {
    if (!confirm('Yakin hapus produk ini?')) return;

    fetch('/admin/produk/' + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('row-produk-' + id).remove();
        } else {
            alert(data.error || 'Gagal hapus!');
        }
    });
}

// Update status pesanan
function updateStatus(id, status) {
    fetch('/admin/pesanan/' + id + '/status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const badge = document.querySelector('#row-pesanan-' + id + ' .status-badge');
            badge.className = 'status-badge status-' + status;
            badge.innerText = status.charAt(0).toUpperCase() + status.slice(1);
        } else {
            alert('Gagal update status!');
        }
    });
}
</script>

</body>
</html>
