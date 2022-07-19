<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                        <div class="ml-3 mt-3">
                            <x-label for="name" :value="__('Вопрос')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        
                            <div class="ml-3 mt-3">
                                <x-label for="name" :value="__('Ответ')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="flex items-center  mt-4">
                                <x-button type="button">
                                    {{ __('Добавить ответ') }}
                                </x-button>
                            </div>
                        </div>

                        <div class="flex items-center  mt-4">
                            <x-button type="button" onclick="add_question">
                                {{ __('Добавить вопрос') }}
                            </x-button>
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

    <script>
        var q = 1;
        var a = [];
        function add_question(){
            q++;
            a.push(0);
            var text =  "<label>Класса #"+q+"</label>"+
                        "<div class=\"input-group mb-3\">"+
                            "<div class=\"input-group-prepend\">"+
                                "<span class=\"input-group-text\">Название класса</span>"+
                            "</div>"+
                            "<input required name=\'services["+(i_7-1)+"][name]\' type=\"text\" class=\"form-control\">"+
                            '<button class="btn btn-outline-secondary" type="button" onclick="add_services('+(i_7-1)+')">Добавить сервис</button>'+
                        "</div>"+
                        '<div id="form-group-services-'+ (i_7-1) +'" class="form-group ms-3"></div>';
            $('#form-group-class').append(text);
        };
        function add_answer(i){
            var text =  "<label>Услуга</label>"+
                        "<div class=\"input-group mb-3\">"+
                            "<div class=\"input-group-prepend\">"+
                                "<span class=\"input-group-text\" style=\"width:100px\">Услуга</span>"+
                            "</div>"+
                            "<input required name=\'services["+(i)+"][services]["+(arr_7[i])+"][text]\' type=\"text\" class=\"form-control\">"+
                            // "<input required name=\'services["+(i)+"][price]\' type=\"number\" class=\"form-control\">"+
                        "</div>";
            $('#form-group-services-'+i).append(text);
            arr_7[i]++;
        }
    </script>
</x-app-layout>
