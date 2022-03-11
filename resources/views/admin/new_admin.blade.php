@extends('template.admin')

@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">
            @if (Route::current()->getName() == 'admins.new')
                New Admin
            @else
                Edit Admin
            @endif


        </div>
        {{-- <button class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New jobs</button> --}}
    </div>
    <div class=" bg-white border rounded-lg ">

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col space-y-3 p-5">
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Name :</span>
                    <input type="text" class="p-3 border rounded-md" name="name" value="{{ $user->name ?? '' }}">
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Email :</span>
                    <input type="email" class="p-3 border rounded-md" name="email" value="{{ $user->email ?? '' }}">
                </div>

                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Password :</span>
                    <input type="password" class="p-3 border rounded-md" name="password" >
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Profile Picture :</span>
                    <img class="inline object-cover w-16 h-16 rounded-full cursor-pointer" src="{{$user->profile_picture?Storage::url($user->profile_picture):url('/images/default_profil.jpg')}}" alt="">

                    <input type="file" class="p-3 border rounded-md" name="profile_picture">
                </div>
                @if (auth()->user()->role == 0)
                <div class="flex items-center  space-x-3">
                    <span class=" font-semibold">Super admin :</span>
                    <input type="checkbox" class="p-3 border rounded-md" name="role" {{isset($user->role)?($user->role == 0?'checked':''):'checked'}}>
                </div>
                @endif

            </div>
            <div class="flex border-t p-5 justify-end space-x-3">
                <a href="{{ route('admins') }}" class="bg-red-300 py-3 px-5 rounded-md font-semibold">Cancel</a>
                <button class="bg-green-300 py-3 px-5 rounded-md font-semibold">Save</button>
            </div>
        </form>


    </div>
@endsection
