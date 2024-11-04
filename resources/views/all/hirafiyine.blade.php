@extends('OurLayouts.master')

@section('title', 'Hirafiyine')

@section('content')
    <div class="container">
        <h2>جميع الحرف الموجودة</h2>

        <form method="GET" action="{{ route('hirafiyine') }}">
            <select name="hirfa" id="hirfaSelect" onchange="this.form.submit()">
                <option value="">الكل</option>
                @foreach ($allHiraf as $hirfaOption)
                    <option value="{{ $hirfaOption->hirfa }}" {{ $hirfaOption->hirfa == $selectedHirfa ? 'selected' : '' }}>
                        {{ $hirfaOption->hirfa }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="grid-layout">
            @foreach ($hiraf as $item)
                <div class="post_head">

                    <h2>{{ $item->name }}</h2>
                    @if ($selectedHirfa)
                        <h2>{{ $item->hirfa }}</h2>
                        <img src="{{ $item->image }}" alt="{{ $item->hirfa }}">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <style>
        h2 {
            font-size: 2.5rem;
            color: #34495e;
            margin-bottom: 1.5rem;
            text-align: center;
        }


        form {
            width: 100%;
            max-width: 400px;
            margin-bottom: 2rem;
        }

        #hirfaSelect {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #ecf0f1;
        }

        .post_head {
            border: 2px solid #3498db;
            border-radius: 12px;
            padding: 1rem;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .post_head h2 {
            font-size: 1.5rem;
            color: #2980b9;
            margin-bottom: 1rem;
        }

        .post_head img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }
    </style>
@endsection
