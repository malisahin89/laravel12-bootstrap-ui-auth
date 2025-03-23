@extends('dashboard.layouts.app')

@section('title', 'Bio Link Edit')
@section('pagename', 'biolink-edit')

@section('content')
    <main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

        <style>
            .btn {
                background-color: #2563eb;
                color: white;
                padding: 10px 16px;
                border-radius: 8px;
                font-size: 14px;
                cursor: pointer;
                border: none;
                transition: background-color 0.3s;
            }

            .btn:hover {
                background-color: #1d4ed8;
            }

            .btn-danger {
                background-color: #dc2626;
            }

            .btn-danger:hover {
                background-color: #b91c1c;
            }

            .draggable-row {
                cursor: move;
            }
        </style>

        <div class="mx-auto max-w-screen-xl p-4 md:p-6">
            @if (session('success'))
                <div id="success-toast" class="mb-4 rounded bg-green-100 px-4 py-3 text-warning-600 border border-green-300">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        const el = document.getElementById('success-toast');
                        if (el) el.remove();
                    }, 3000);
                </script>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-warning-600 border border-red-300">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div
                class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
                <form action="{{ route('dashboard.profile.biolink.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <ul id="linkList" class="space-y-4">
                        @foreach (old('links', $user->links ?? []) as $index => $link)
                            @php
                                $hasError = $errors->has("links.$index.title") || $errors->has("links.$index.url");
                            @endphp
                            <li
                                class="draggable-row p-5 border rounded-2xl lg:p-6 {{ $hasError ? 'border-error-300 bg-red-50' : 'border-gray-200 bg-gray-50' }} dark:border-gray-800">
                                <div class="flex flex-wrap gap-4 items-end w-full">
                                    <div class="flex-1 min-w-[200px]">
                                        <input name="links[{{ $index }}][title]" type="text" placeholder="Title"
                                            value="{{ old("links.$index.title", $link['title'] ?? '') }}"
                                            class="h-11 w-full rounded-md px-4 py-2.5 text-sm bg-white text-gray-800 border {{ $errors->has("links.$index.title") ? 'border-error-300' : 'border-gray-300' }}">
                                        @error("links.$index.title")
                                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex-1 min-w-[200px]">
                                        <input name="links[{{ $index }}][url]" type="text" placeholder="URL"
                                            value="{{ old("links.$index.url", $link['url'] ?? '') }}"
                                            class="h-11 w-full rounded-md px-4 py-2.5 text-sm bg-white text-gray-800 border {{ $errors->has("links.$index.url") ? 'border-error-300' : 'border-gray-300' }}">
                                        @error("links.$index.url")
                                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="button" class="btn btn-danger" onclick="removeLink(this)">Sil</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex gap-4 mt-6">
                        <button type="button" onclick="addLinkRow()" class="btn">+ Link Ekle</button>
                        <button type="submit" class="btn">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let linkIndex = {{ count(old('links', $user->links ?? [])) }};

            new Sortable(document.getElementById("linkList"), {
                animation: 150,
                ghostClass: "bg-gray-200"
            });

            function addLinkRow() {
                const list = document.getElementById('linkList');
                const item = document.createElement('li');
                item.className = 'draggable-row p-5 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6 bg-gray-50';

                item.innerHTML = `
            <div class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <input name="links[${linkIndex}][title]" type="text" placeholder="Title"
                        class="h-11 w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm bg-white text-gray-800">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <input name="links[${linkIndex}][url]" type="text" placeholder="URL"
                        class="h-11 w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm bg-white text-gray-800">
                </div>

                <button type="button" class="btn btn-danger" onclick="removeLink(this)">Sil</button>
            </div>
        `;

                list.appendChild(item);
                linkIndex++;
            }

            function removeLink(button) {
                button.closest('li').remove();
            }
        </script>
    </main>
@endsection
