@extends('OurLayouts.master')

@section('title', 'Hirafiyine')

@section('content')
    <div class="container">
        <h2>جميع الحرفيين الموجودين</h2>

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
                <div class="card">
                    <div class="image d-flex flex-column justify-content-center align-items-center">
                        <button class="btn btn-secondary">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" height="100" width="100" />
                        </button>
                        <span class="name mt-3">{{ $item->user->name }}</span>
                        <span class="idd">الحرفة :{{ $item->hirfa }} </span>
                        <button class="More">للمزيد من المعلومات</button>
                    </div>
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


        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .card {
            padding: 20px;
            background-color: #efefef;
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.5s;
            text-align: center;
            border-radius: 10px;
        }

        .image img {
            transition: all 0.5s;
        }

        .card:hover .image img {
            transform: scale(1.1);
        }

        .btn {
            height: 140px;
            width: 140px;
            border-radius: 50%;
        }

        .name {
            font-size: 22px;
            font-weight: bold;
            color: #2980b9;
        }

        .idd {
            font-size: 14px;
            font-weight: 600;
            color: #34495e;
        }
        .More {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
