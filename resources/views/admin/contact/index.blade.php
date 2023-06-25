<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('お問い合わせ一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($Contacts as $Contact)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin_contact_detail', $Contact->id) }}">
                                    <p class="my-2 ml-5">{{ $Contact->name }}様からのお問い合わせ</p>
                                </a>
                            </div>
                            <div class="mt-2">
                                @if ($Contact->type === 0)
                                    <form class="admin_contact_update" action="{{ route('admin_contact_update', $Contact->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" name="id" value="{{ $Contact->id }}">未対応</button>
                                        </div>
                                    </form>
                                @else
                                    <form class="admin_contact_update" action="{{ route('admin_contact_update', $Contact->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-danger active btn-sm" name="id" value="{{ $Contact->id }}">対応済み</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
