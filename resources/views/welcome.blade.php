<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{asset('css/style.css')}}">

    </head>

    <body>
        <div class="container">
            <div class="main">

                <h3>Search a Word</h3>

                <form action="/search" method="get">
                    <input type="text" placeholder="Write here..." name="word" autocomplete="off">
                    <button type="submit">Search</button>
                </form>

            </div>

            <div class="informations">
                @if(isset($_GET['word']) && $url != false)
                    <div class="description">

                        <p class="word">{{$_GET['word']}}</p>

                        <audio controls="controls">
                            <source src="{{$audio}}" type="audio/mp3"/>
                        </audio>

                        @foreach ($url[0]->meanings as $item)

                            <p class="type-of-word">{{$item->partOfSpeech}}</p>

                            @foreach ($item->definitions as $definition)
                                <p class="definition">
                                    {{($loop->index + 1) . ' - '}}
                                    {{$definition->definition}}
                                </p>
                            @endforeach

                            <p class="example m-2">Examples:</p>

                            @php
                                $counter = 0;
                            @endphp

                            @foreach ($item->definitions as $definition)

                                @if (isset($definition->example))
                                    <p class="definition">
                                        {{'• ' . $definition->example}}
                                    </p>
                                    @php
                                        $counter = 1;
                                    @endphp
                                @endif

                            @endforeach

                            @if ($counter == 0)
                                <p class="definition">
                                    {{"Sorry, our don't have examples for this.."}}
                                </p>
                            @endif

                        @endforeach

                    </div>

                @else
                    <p class="definition"> Word Not Found.. </p>
                @endif

            </div>
        </div>
    </body>

</html>
