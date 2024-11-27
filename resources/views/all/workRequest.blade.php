@extends('OurLayouts.userInfoMaster')

@section('title', 'workRequest')

@section('content')
    <div class="workRequest">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>ارسل طلب عمل</h1>

        <form action="{{ route('user.sendWorkRequest', ['user' => $user->id]) }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea 
                    name="description" 
                    id="description" 
                    class="form-control" 
                    rows="4" 
                    placeholder="أدخل وصف العمل هنا...">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">إرسال الطلب</button>
        </form>

        <div class="requests" style="margin-top: 5rem">
            <h2>طلبات العمل</h2>
            <table class="table">

                <tr>
                    <th>وصف العمل</th>
                    <th>تاريخ الطلب</th>
                    <th>حالة الطلب</th>
                    <th></th>
                </tr>

                @foreach ($requests as $request)
                    
                    <tr>
                        <td style="width: 75%">{{ $request->description }}</td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>{{ $request->status }}</td>
                        <td>
                            @if ($request->status == 'pending' || $request->status == 'canceled')
                                <form action="{{route('user.deleteWorkRequest' , ['requestWork' => $request->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                                @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        
    </div>


    <style>
        .workRequest {
            padding: 2rem;
            width: calc(100% - 280px);
            direction: rtl;
        }

        h1 , h2 {
            margin-bottom: 2rem
        }
    </style>
@endsection