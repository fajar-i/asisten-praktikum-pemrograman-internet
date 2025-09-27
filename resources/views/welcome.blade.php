<!DOCTYPE html>
<html lang="id" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Halaman Selamat Datang</title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="store" class="modal">
        <div class="container">
            <div class="modal-content content-card">
                <div class="close" onclick="closeModalStore()">&times;</div>
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <h1>Post</h1>
                    <div class="form-group" style="display: block; align-content: space-between;">
                        <div class="form-group">
                            <input type="text" name="title" class=" @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="Masukkan Judul Post" required>
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" class=" @error('image') is-invalid @enderror" name="image">
                            <!-- error message untuk image -->
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="post-button me-3">simpan</button>
                        <button type="reset" class="post-button"
                            style="color: goldenrod; background-color: #005fa300">reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="edit" class="modal">
        <div class="container">
            <div class="modal-content content-card">
                <h1>Edit</h1>
                <span class="close" onclick="closeModalEdit()">&times;</span>
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="display: block; align-content: space-between;">
                        <div class="form-group">
                            <input type="text" name="title" class="" id="edit-title"
                                placeholder="Masukkan Judul Post" required>
                        </div>
                        <div class="form-group">
                            <input type="file" class=" @error('image') is-invalid @enderror" name="image">
                        </div>
                        <div class="form-group">
                            <small class="text">Kosongkan input gambar jika tidak ingin merubah gambar</small>
                        </div>
                        <button type="submit" class="post-button me-3">simpan</button>
                        <button type="reset" class="post-button"
                            style="color: goldenrod; background-color: #005fa300">reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <main>
            <div class="content-card">
                <h1>Welcome Back</h1>

                <div class="form-group">
                    {{-- <input type="text" id="inputText" placeholder="John" required /> --}}
                    <button onclick="openModalStore()" target="_blank" class="post-button">tambah post</button>
                </div>

                <ul class="task-list scroll-view-container scroll">
                    @forelse ($posts as $post)
                        <li class="task-item">
                            <!-- GRUP 1: Semua konten di sisi kiri -->
                            <div class="task-content-left">
                                <span class="task-icon-bg">
                                    <span class="task-icon-outer">
                                        <span class="task-icon-inner"></span>
                                    </span>
                                </span>
                                <span class="task-title">{{ $post->title }}</span>
                            </div>
                            @if ($post->image)
                                <img src="{{ Storage::disk('public_uploads')->url('posts/' . $post->image) }}"
                                    class="task-image" alt="Post Image">
                            @endif
                            <div class="task-actions-right">
                                <i class="bi bi-clipboard me-3" style="cursor: pointer;" title="Salin Teks"
                                    onclick="copyToClipboard('{{ e($post->title) }}', this)"></i>

                                <i class="bi bi-pencil-fill me-3" style="cursor: pointer;" title="Edit Post"
                                    onclick="openEditModal('{{ route('posts.update', $post->id) }}', '{{ e($post->title) }}')">
                                </i>

                                <form id="delete-form-{{ $post->id }}" class="d-inline"
                                    action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <i class="bi bi-trash-fill" style="cursor: pointer;" title="Hapus Post"
                                        onclick="if(confirm('Apakah Anda Yakin ?')) { document.getElementById('delete-form-{{ $post->id }}').submit(); }">
                                    </i>
                                </form>
                            </div>
                        </li>
                    @empty
                        <div>
                            Data Post belum Tersedia.
                        </div>
                    @endforelse
                </ul>
                <div class="pagination-wrapper text">
                    {{ $posts->links() }}
                </div>
            </div>
        </main>
    </div>
    <script>
        function openModalStore() {
            document.getElementById("store").style.display = "flex";
        }

        function closeModalStore() {
            document.getElementById("store").style.display = "none";
        }

        function openModalEdit() {
            document.getElementById("edit").style.display = "flex";
        }

        function closeModalEdit() {
            document.getElementById("edit").style.display = "none";
        }

        function copyToClipboard(text, element) {
            // Menggunakan metode document.execCommand untuk kompatibilitas yang lebih luas
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            // Memberikan umpan balik visual kepada pengguna
            const originalIcon = 'bi-clipboard';
            const successIcon = 'bi-clipboard-check-fill';
            const originalTitle = 'Salin Teks';

            element.classList.remove(originalIcon);
            element.classList.add(successIcon);
            element.title = 'Tersalin!';

            // Mengembalikan ikon dan tooltip ke keadaan semula setelah 2 detik
            setTimeout(() => {
                element.classList.remove(successIcon);
                element.classList.add(originalIcon);
                element.title = originalTitle;
            }, 2000);
        }

        // Fungsi spesifik untuk membuka dan MENGISI modal edit
        function openEditModal(actionUrl, title) {
            // 1. Ambil elemen form dan input di dalam modal edit
            const editForm = document.getElementById('editForm');
            const editTitleInput = document.getElementById('edit-title');

            // 2. Atur action form dan value input berdasarkan data dari tombol yang diklik
            editForm.action = actionUrl;
            editTitleInput.value = title;

            // 3. Tampilkan modalnya
            openModalEdit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
