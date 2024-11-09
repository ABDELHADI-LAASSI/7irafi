@extends('OurLayouts.userInfoMaster')

@section('title' , 'userInfo')
    
@section('content')
    <div class="userInfo">
        <div class="nameImage">
            <img src="{{asset('storage/'.$user->infos->image)}}" height="100" width="100" />
            <h1>{{ $user->name }}</h1>
        </div>

        <div class="rating">
            <div class="">
                <h6>التقييم : </h6>
                <p>{{ $user->rating }}</p>
            </div>

            @if (!$alreadyRated)
                <form action="{{route('user.rate' , ['user' => Auth::user()->id , 'hirafi' => $user->id])}}" method="post">
                    @csrf
                    <input type="number" min="0" max="5" step="0.01" name="score" value="{{ old('score') }}">
                    <button>submit</button>
                </form>
            @else
                <form action="{{route('user.update' , ['user' => Auth::user()->id , 'hirafi' => $user->id])}}" method="post">
                    @csrf
                    <input type="number" min="0" max="5" step="0.01" name="score" value="{{ $user->rates()->first()->score }}">
                    <button>change rate</button>
                </form>
            @endif
        </div>

        <div class="info">
            <h6>الحرفة : </h6>
            <p>{{ $user->infos->hirfa}}</p>
        </div>

        <div class="infos">
            <h6>السيرة الذاتية : </h6>
            <p>{{ $user->infos->biography }}</p>
        </div>

        <div class="info">
            <h6>الحالة : </h6>
            <p>{{ $user->infos->availability ? 'متاح' : 'غير متاح' }}</p>
        </div>

        <div class="infos">
            <h6>الجنس : </h6>
            <p>{{ $user->infos->gender == 'male' ? 'ذكر' : 'انثى' }}</p>
        </div>

        <div class="infos">
            <h6>المدينة : </h6>
            <p>{{ $user->infos->city }}</p>
        </div>

        <div class="infos">
            <h6>العنوان : </h6>
            <p>{{ $user->infos->address }}</p>
        </div>

        <div class="infos">
            <h6>رقم الهاتف : </h6>
            <p>{{ $user->infos->phone_number }}</p>
        </div>

        <div class="infos">
            <h6>البريد الالكتروني : </h6>
            <p>{{ $user->email }}</p>
        </div>

        <div class="infos">
            <h6>تاريخ الميلاد : </h6>
            <p>{{ $user->infos->date_of_birth }}</p>
        </div>

        

        


    </div>




    <style>
        .userInfo {
            padding: 2rem;
            width: calc(100% - 250px);
            direction: rtl;
        }


        .rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        .nameImage {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
    
        .nameImage img {
            border-radius: 50%; 
            border: 2px solid #495057; 
        }
    
        .nameImage h1 {
            font-size: 2rem;
            color: #343a40; 
        }
    
        .infos, .info , .rating {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); 
        }
    
        .infos h6, .info h6 {
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #495057; 
        }
    
        .infos p, .info p {
            margin: 0;
            color: #495057; 
            line-height: 1.6;
        }
    </style>
    
@endsection