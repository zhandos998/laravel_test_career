<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Центр карьеры') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="/admin/add_test">
                        <div class="flex items-center  mt-4">
                            <x-button type="button">
                                {{ __('Добавить тест') }}
                            </x-button>
                        </div>
                    </a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Название</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tests as $test)
                            <tr>
                                <th scope="row">{{$test->id}}</th>
                                <td>{{$test->name}}</td>
                                <td>
                                    <div class="flex items-center justify-end mt-4" class="ml-2">
                                        <a href="/admin/test/{{$test->id}}">
                                            <x-button type="button">
                                                {{ __('Посмотреть тест') }}
                                            </x-button>
                                        </a>
                                        <a href="/admin/change_test/{{$test->id}}" class="ml-2">
                                            <x-button type="button">
                                                {{ __('Изменить тест') }}
                                            </x-button>
                                        </a>
                                        <a href="/admin/delete_test/{{$test->id}}" class="ml-2">
                                            <x-button type="button">
                                                {{ __('Удалить тест') }}
                                            </x-button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
