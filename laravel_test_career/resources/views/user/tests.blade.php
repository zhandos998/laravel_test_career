<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Центр карьеры') }}
        </h2>
    </x-slot>
 
    @if (session('text'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-green-300 border-b border-gray-200">
                        <div class="alert alert-success" role="alert">
                            @foreach (session('text') as $item)
                                    <p>{{$item}}</p><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                @if ($test->tested==1)
                                    <tr class="bg-red-200 rounded ">
                                        <th scope="row">{{$test->id}}</th>
                                        <td>{{$test->name}}</td>
                                        <td>
                                            <div class="flex items-center justify-end my-3" class="mr-2">
                                                <h5>Тест уже пройден!</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th scope="row">{{$test->id}}</th>
                                        <td>{{$test->name}}</td>
                                        <td>
                                            <div class="flex items-center justify-end mt-4" class="ml-2">
                                                <a href="/test/{{$test->id}}">
                                                    <x-button type="button">
                                                        {{ __('Пройти тест') }}
                                                    </x-button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
