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
                    <form method="POST" action="/test/{{$test->id}}">
                        @csrf
                        <div>
                            <h2 class="text-xl">{{$test->name}}</h2>
                        </div>
                        <div id='questions'>
                            <div class="hidden">{{$quests_count = 1}}</div>
                            @foreach ($quests as $item)
                                <div class="ml-3 mt-3">
                                    <p>{{$quests_count}}) {{$item->quest}}</p>
                                    <div class="hidden">{{$answers_count = 1}}</div>
                                    <div id="answers_1" class="ml-3 mt-3"> 
                                        @foreach ($item->answers as $item2)
                                            <div class="flex items-center mb-4">
                                                <input id="answer_{{$quests_count}}_{{$answers_count}}" type="radio" value="{{$item2->liter}}" name="answers[{{$item->numering}}]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                                <label for="answer_{{$quests_count}}_{{$answers_count}}" class="ml-2 text-sm font-medium text-gray-900 ">{{$item2->answer}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="hidden">{{$quests_count++}}</div>
                                
                            @endforeach
                        </div>

                        <div class="flex items-center  mt-4">
                            <x-button>
                                {{ __('Создать') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
