@extends('template.admin')

@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">Admins Data</div>
        <a href="{{ route('admins.new') }}" class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New Admin</a>
    </div>
    <div class=" bg-white border rounded-lg ">
        <div class="p-5">
            <table class="w-full table-fix" id="jobs">
                <thead class=" border-b ">
                    <tr>

                        <th class=" text-left p-3">NO</th>
                        <th class=" text-left p-3">Profile</th>
                        <th class=" text-left p-3">Name</th>
                        <th class=" text-left p-3">Email</th>
                        <th class=" text-left p-3">Create at</th>
                        <th class="text-left p-3">Role</th>
                        <th class="text-left p-3">...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $idx => $user)
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="p-3">{{ $idx + 1 }}</td>
                            <td class="p-3">
                                <div >
                                    <img class="inline object-cover w-16 h-16 rounded-full cursor-pointer" src="{{$user->profile_picture?Storage::url($user->profile_picture):url('/images/default_profil.jpg')}}" alt="">
                                </div>
                            </td>
                            <td class="p-3 font-medium">{{ $user->name }}</td>
                            <td class="p-3 font-medium">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->created_at }}</td>
                            <td class="p-3">
                                @if ($user->role)
                                    <span class="text-green-500"> Regular admin</span>
                                @else
                                    <span class="text-purple-500"> Super admin</span>
                                @endif
                            </td>
                            <td>
                                <div class=" flex space-x-3">
                                    <a href="{{route('admins.edit',['userid'=>$user->id])}}" class="p-3 bg-green-100 rounded-md">edit</a>
                                    <a href="{{route('admins.delete',['userid'=>$user->id])}}" class="p-3 bg-red-100 rounded-md">delete</a>
                                    {{-- <button class="p-3 bg-red-100 rounded-md">delete</button> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#jobs').DataTable();
    </script>
@endsection
