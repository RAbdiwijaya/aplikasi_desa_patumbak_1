<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kontak Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
                <div class="mx-auto max-w-3xl px-4 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-slate-800 dark:text-gray-200">Edit Kontak Pengaduan</h2>
                            <a href="{{ route('kontak.index') }}" class="text-white font-medium text-sm bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-md px-5 py-2.5 transition duration-200">&laquo; Kembali ke Daftar Kontak</a>
                        </div>
                        <div class="px-6 py-4">
                            <form action="{{ route('kontak.update', $kontak->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div>
                                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama', $kontak->nama) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    </div>
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $kontak->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    </div>
                                    <div>
                                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $kontak->no_hp) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    </div>
                                    <div>
                                        <label for="jenis_subyek" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Subyek</label>
                                        <select id="jenis_subyek" name="jenis_subyek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="">Pilih subjek</option>
                                            <option value="Informasi Umum" {{ old('jenis_subyek', $kontak->jenis_subyek) == 'Informasi Umum' ? 'selected' : '' }}>Informasi Umum</option>
                                            <option value="Pengaduan Masyarakat" {{ old('jenis_subyek', $kontak->jenis_subyek) == 'Pengaduan Masyarakat' ? 'selected' : '' }}>Pengaduan Masyarakat</option>
                                            <option value="Pelayanan Administrasi" {{ old('jenis_subyek', $kontak->jenis_subyek) == 'Pelayanan Administrasi' ? 'selected' : '' }}>Pelayanan Administrasi</option>
                                            <option value="Kerjasama Desa" {{ old('jenis_subyek', $kontak->jenis_subyek) == 'Kerjasama Desa' ? 'selected' : '' }}>Kerjasama Desa</option>
                                            <option value="Lainnya" {{ old('jenis_subyek', $kontak->jenis_subyek) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pesan</label>
                                        <textarea id="pesan" name="pesan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>{{ old('pesan', $kontak->pesan) }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>