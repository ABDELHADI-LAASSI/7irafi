@extends('OurLayouts.master')

@section('title', 'الملف الشخصي')

@section('content')
    <div class="container">
        <div class="profile">
{{-- 
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form class="additionalInfo_form" action="{{route('profile.updateInfo')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <h1>المعلومات الشخصية</h1>
                <p>يرجى تعديل المعلومات الشخصية </p>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="name">الاسم</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $user->name)}}">
                    @error('name')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="image">رفع صورة</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                    @error('image')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <img width="100" src="{{asset('storage/'.$user->infos->image)}}" alt="">

                {{-- <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Email">البريد الإلكتروني</label>
                    <input name="email" type="email" class="form-control" id="Email">
                </div> --}}

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Adress">العنوان</label>
                    <input name="address" type="text" class="form-control" id="Adress" value="{{ old('address', $user->infos->address ?? '')}}">
                    @error('address')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Phone Number">رقم الهاتف</label>
                    <input style="direction: ltr" name="phone_number" type="text" class="form-control" id="Phone Number" value="{{ old('phone_number', $user->infos->phone_number ?? '')}}">
                    @error('phone_number')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if ($user->role == 'hirafi')
                    <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                        <label for="Hirfa">المهنة</label>
                        <select name="hirfa" id="Hirfa" class="form-control">
                            <option value=""></option>
                            @php
                                $hirfas = [
                                    'نجار' => 'نجار',
                                    'حداد' => 'حداد',
                                    'كهربائي' => 'كهربائي',
                                    'سباك' => 'سباك',
                                    'مزارع' => 'مزارع',
                                    'ميكانيكي' => 'ميكانيكي',
                                    'حلاق' => 'حلاق',
                                    'خياط' => 'خياط',
                                    'خباز' => 'خباز',
                                    'اخرى' => 'اخرى',
                                ];
                            @endphp
                            @foreach ($hirfas as $key => $val)
                                @if (old('hirfa', $user->infos->hirfa ?? '') == $key)
                                    <option value="{{ $key }}" selected>{{ $val }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('hirfa')
                            <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                    

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Date Of birth">تاريخ الميلاد</label>
                    <input name="date_of_birth" type="date" class="form-control" id="Date Of birth" value="{{ old('date_of_birth', $user->infos->date_of_birth ?? '')}}">
                    @error('date_of_birth')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Gender">الجنس</label>
                    <select name="gender" id="Gender" class="form-control">

                        <option value="male">ذكر</option>
                        <option value="female">انثى</option>
                    </select>
                    @error('gender')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="City">المدينة</label>
                    <select name="city" id="City" class="form-control">
                        <option value=""></option>
                        @php
                            $cities = [
                                'الدار البيضاء' => 'الدار البيضاء',
                                'الرباط' => 'الرباط',
                                'مراكش' => 'مراكش',
                                'فاس' => 'فاس',
                                'طنجة' => 'طنجة',
                            ];
                        @endphp
                        @foreach ($cities as $key => $val)
                            @if (old('city', $user->infos->city ?? '') == $key)
                                <option value="{{ $key }}" selected>{{ $val }}</option>
                            @else
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('city')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Bigraphy">السيرة الذاتية</label>
                    <textarea name="biography" class="form-control" id="Bigraphy">{{ old('biography', $user->infos->biography ?? '') }}</textarea>
                    @error('biography')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if ($user->role == 'hirafi')
                    <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                        <label for="Available">هل انت متوفر</label>
                        <div class="form-check">
                            <input name="availability" class="form-check-input" type="radio" value="true" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                            متوفر
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="availability" class="form-check-input" type="radio" value="false" id="defaultCheck2" >
                            <label class="form-check-label" for="defaultCheck2">
                            غير متوفر
                            </label>
                        </div>
                    </div>
                @endif

                <button type="submit">تغيير</button>
            </form>

            <form action="{{route('profile.updatePassword')}}" class="ChangePasswordForm" method="POST">
                @csrf
                <h5>تغيير كلمة المرور</h5>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Current Password">كلمة المرور الحالية</label>
                    <input name="current_password" type="password" class="form-control" id="Current Password">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="New Password">كلمة المرور الجديدة</label>
                    <input name="new_password" type="password" class="form-control" id="New Password">
                    @error('new_password')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Confirm Password">تأكيد كلمة المرور</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="Confirm Password">
                    @error('new_password_confirmation')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">تغيير</button>
            </form>

            <form action="" class="delete_account" method="POST">
                @csrf
                @method('DELETE')
                <p>هل أنت متأكد أنك تريد حذف حسابك؟</p>

                <div class="form-group" style="margin-bottom: 1.5rem; width: 90%">
                    <label for="Current Password">كلمة المرور </label>
                    <input name="password" type="password" class="form-control" id="Current Password">
                    @error('password')
                        <p style="color: red;" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button>حذف</button>
            </form>
        </div>
    </div>

    <style>
        .profile {
            direction: rtl;
            margin-top: 3rem;
        }

        .profile h1 {
            font-size: 2rem;
        }

        .additionalInfo_form {
            padding: 1rem;
            background-color: #f5f5f5;
            max-width: 600px;
            border-radius: 10px;
            margin-top: 3rem;
        }

        .additionalInfo_form h1 {
            font-size: 1.5rem;
        }

        .additionalInfo_form button {
            grid-column: span 2;
        }

        .ChangePasswordForm {
            padding: 1rem;
            background-color: #f5f5f5;
            max-width: 600px;
            border-radius: 10px;
            margin-top: 3rem;
        }

        .ChangePasswordForm h5 {
            font-size: 1.5rem;
        }

        .delete_account {
            padding: 1rem;
            background-color: #f5f5f5;
            width: 600px;
            border-radius: 10px;
            margin-top: 3rem;
            margin-bottom: 3rem
        }

        
    </style>
@endsection
