<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Центр карьеры') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h2 class="text-5xl">{{$test->name}}</h2>
                    </div>

                    
                    <div id='questions'>
                        <div class="hidden">{{$quests_count = 1}}</div>
                        @foreach ($quests as $item)
                            <div class="ml-3 mt-3">
                                <p class="text-2xl">{{$quests_count}}) {{$item->quest}}</p>
                                <div class="hidden">{{$answers_count = 0}}</div>
                                <div id="answers_1" class="ml-3 mt-3"> 
                                    @foreach ($item->answers as $item2)
                                        <p class="text-2xl">{{$item2->liter}}) {{$item2->answer}}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="hidden">{{$quests_count++}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden">{{$quests_count=1}}</div>
                <div class="flex justify-center">
                    <div>
                        <div id="reportvalue">
                            <div class="wraper container-fluid">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table-fixed table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        @foreach ($quests as $item)
                                                            <th>{{$item->numering}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $item)
                                                    <tr>
                                                        <td>{{$quests_count++}}</td>
                                                        <td>{{$item->name}}</td>
                                                        @foreach ($item->answereds as $item2)
                                                            <td>{{$item2->liter}}</td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-button type="button" onclick="downloadInnerHtml()">
                            {{ __('Экспорт в Excel') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function downloadInnerHtml() {
            var elId = 'reportvalue';
            var filename = 'report-test-{{date("Y-m-d \a\\t h.i.s")}}.xls';
            var elHtml = document.getElementById(elId).innerHTML;
            var link = document.createElement('a');
            link.setAttribute('download', filename);
            link.setAttribute('href', 'data:' + 'text/xls' + ';charset=utf-8,' +
                encodeURIComponent(document.getElementById(elId).innerHTML));
            link.click();
        }
    </script>
</x-app-layout>
