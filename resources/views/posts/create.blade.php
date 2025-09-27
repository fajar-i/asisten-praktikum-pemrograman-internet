<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Halaman Selamat Datang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Reset dan Pengaturan Dasar */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Pengaturan Body Utama */
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 1.5rem;
            /* p-6 */
        }

        /* Container Utama */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            transition: opacity 750ms;
            opacity: 1;
        }

        main {
            display: flex;
            width: 100%;
            max-width: 335px;
            flex-direction: column-reverse;
        }

        /* Konten Card */
        .content-card {
            width: 100%;
            text-align: center;
            font-size: 13px;
            line-height: 20px;
            background-color: white;
            padding: 1.5rem;
            /* p-6 */
            border-radius: 0.375rem;
            /* rounded-md */
            box-shadow: inset 0px 0px 0px 1px rgba(26, 26, 0, 0.16);
        }

        .content-card h1 {
            font-size: 1.5rem;
            /* text-2xl */
            font-weight: 500;
            /* font-medium */
            margin-bottom: 2rem;
            /* mb-8 */
        }

        /* Form Grup */
        .form-group {
            display: flex;
            justify-content: center;
            width: 100%;
            gap: 0.5rem;
            /* m-2 on children creates gap */
        }

        .form-group input {
            flex-grow: 1;
            /* Occupy remaining space */
            background-color: #f0f0f0;
            /* Simplified from gray */
            border: 1px solid #d1d5db;
            color: #111827;
            font-size: 0.875rem;
            /* text-sm */
            border-radius: 0.375rem;
            /* rounded-md */
            padding: 0.625rem;
            /* p-2.5 */
            width: 100%;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }

        .form-group .post-button {
            display: inline-block;
            background-color: #1b1b18;
            color: white;
            border: 1px solid #1b1b18;
            border-radius: 0.375rem;
            /* rounded-md */
            padding: 0.625rem 1rem;
            text-align: center;
            font-size: 0.875rem;
            /* text-sm */
            text-decoration: none;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .form-group .post-button:hover {
            background-color: black;
            border-color: black;
        }

        /* Daftar Tugas */
        .task-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0.5rem 0;
            /* br and mb-2 */
            display: flex;
            flex-direction: column;
        }

        .task-item {
            display: flex;
            gap: 1rem;
            /* gap-4 */
            padding: 0.5rem 0;
            /* py-2 */
            position: relative;
            font-size: 0.875rem;
            /* text-sm */
            align-items: center;
        }

        .task-icon-bg {
            position: relative;
            background-color: white;
            /* To cover lines if any */
            padding: 0.25rem 0;
        }

        .task-icon-outer {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            /* rounded-full */
            background-color: #FDFDFC;
            box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.03), 0px 1px 2px 0px rgba(0, 0, 0, 0.06);
            width: 0.875rem;
            /* w-3.5 */
            height: 0.875rem;
            /* h-3.5 */
            border: 1px solid #e3e3e0;
        }

        .task-icon-inner {
            border-radius: 9999px;
            /* rounded-full */
            background-color: #dbdbd7;
            width: 0.375rem;
            /* w-1.5 */
            height: 0.375rem;
            /* h-1.5 */
        }

        /* Media Queries untuk Mode Gelap */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0a0a0a;
            }

            .content-card {
                background-color: #161615;
                color: #EDEDEC;
                box-shadow: inset 0px 0px 0px 1px #fffaed2d;
            }

            .form-group input {
                background-color: #374151;
                /* dark:bg-gray-700 */
                border-color: #4b5563;
                /* dark:border-gray-600 */
                color: white;
            }

            .form-group input::placeholder {
                color: #9ca3af;
                /* dark:placeholder-gray-400 */
            }

            .form-group .post-button {
                background-color: #eeeeec;
                border-color: #eeeeec;
                color: #1C1C1A;
            }

            .form-group .post-button:hover {
                background-color: white;
                border-color: white;
            }

            .task-icon-bg {
                background-color: #161615;
            }

            .task-icon-outer {
                background-color: #161615;
                border-color: #3E3E3A;
            }

            .task-icon-inner {
                background-color: #3E3E3A;
            }
        }

        /* Media Queries untuk Layar Besar (Desktop) */
        @media (min-width: 1024px) {
            body {
                padding: 2rem;
                /* lg:p-8 */
                justify-content: center;
            }

            .container {
                flex-grow: 1;
                /* lg:grow */
            }

            main {
                max-width: 56rem;
                /* lg:max-w-4xl */
                flex-direction: row;
                /* lg:flex-row */
            }

            .content-card {
                padding: 3.75rem;
                /* Custom value based on lg:p-15 */
                border-radius: 0.5rem;
                /* lg:rounded-lg */
            }

            .form-group input,
            .form-group .post-button {
                border-radius: 0.5rem;
                /* lg:rounded-lg */
            }

            .task-list {
                margin-bottom: 1rem;
                /* lg:mb-4 */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <main>
            <div class="content-card">
                <h1>Welcome Back</h1>

                <div class="form-group">
                    {{-- <input type="text" id="inputText" placeholder="John" required /> --}}
                    <a href="{{ route('posts.create') }}" target="_blank" class="post-button">tambah post</a>
                </div>

                <ul class="task-list">
                    @forelse ($posts as $post)
                        <li class="task-item">
                            {{-- icon --}}
                            <span class="task-icon-bg">
                                <span class="task-icon-outer">
                                    <span class="task-icon-inner"></span>
                                </span>
                            </span>
                            {{-- text dan gambar --}}
                            <span>{{ $post->title }}</span>
                            <span><img src="{{ asset('/storage/posts/' . $post->image) }}"
                                    style="width: 50px border-radius: 50%"></span>
                            {{-- action button --}}
                            <span>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </span>
                        </li>
                    @empty
                        <div class="alert alert-danger">
                            Data Post belum Tersedia.
                        </div>
                    @endforelse
                </ul>
                {{ $posts->links() }}
            </div>
        </main>
    </div>
</body>

</html>
