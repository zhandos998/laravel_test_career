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
                    <form method="POST" action="{{ route('add_test') }}">
                        @csrf
                        <div>
                            <x-label for="name" :value="__('Название')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                        <div class="flex items-center  mt-4">
                            <x-button type="button" onclick="add_question()">
                                {{ __('Добавить вопрос') }}
                            </x-button>
                        </div>

                        <div id='questions'>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var q = 0;
        var a = [];
        function add_question(){
            q++;
            a.push(0);
            var text =  
            '<div class="ml-3 mt-3">'+
                '<label class="block font-medium text-sm text-gray-700" for="question_'+(q)+'">'+
                    'Вопрос '+ (q) + 
                '</label>'+
                '<div class="inline-flex w-full" role="group">'+
                    '<input class="rounded-l-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-11/12" id="question_'+(q)+'" type="text" name="question['+(q)+'][name]" required="required" autofocus="autofocus">'+
                    '<button onclick="delete_parent_parent(this)" type="button" class="w-1/12 inline-flex items-center justify-center bg-gray-800 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-1">Удалить</button>'+
                '</div>'+
                '<div class="flex items-center  mt-4">'+
                    '<button onclick="add_answer('+(q)+')" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">'+
                        'Добавить ответ'+
                    '</button>'+
                '</div>'+
                '<div id="answers_'+(q)+'" class="ml-3 mt-3">'+
                '</div>'+
            '</div>';
            $('#questions').append(text);
        };
        function add_answer(i){
            var text =
                '<div class="ml-3 mt-3">'+
                    '<label class="block font-medium text-sm text-gray-700" for="name">'+
                        'Ответ '+ (a[i-1]+1) +
                    '</label>'+

                    '<div class="inline-flex w-full" role="group">'+
                        '<input name="question['+i+'][correct]" value="'+a[i-1]+'" class="shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block my-auto mr-3" id="name" type="radio" required="required" autofocus="autofocus">'+
                        '<input name="answer['+i+']['+a[i-1]+'][answer]" class="rounded-l-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-10/12" id="name" type="text" required="required" autofocus="autofocus">'+
                        '<input name="answer['+i+']['+a[i-1]+'][liter]" class="rounded-none shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/12" type="text" required="required" autofocus="autofocus" placeholder="Вариант">'+
                        '<button onclick="delete_parent_parent(this)" type="button" class="w-1/12 inline-flex items-center justify-center bg-gray-800 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-1">Удалить</button>'+
                    '</div>'+
                '</div>';
            $('#answers_'+i).append(text);
            a[i-1]++;
        }
        function delete_parent_parent(t){
            t.parentElement.parentElement.remove()
        }
    </script>
</x-app-layout>
