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
                    <input type="text" class="p-3 border rounded-md" name="full_name"
                        value="{{ $applicant->full_name ?? '' }}">
                    @if ($errors->has('full_name'))
                        <div class="text-red-500 text-sm">{{ $errors->first('full_name') }}</div>
                    @endif
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Email :</span>
                    <input type="email" class="p-3 border rounded-md" name="email" value="{{ $applicant->email ?? '' }}">
                    @if ($errors->has('email'))
                        <div class="text-red-500 text-sm">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Phone Number :</span>
                    <input type="text" class="p-3 border rounded-md" name="phone_number"
                        value="{{ $applicant->phone_number ?? '' }}">
                    @if ($errors->has('phone_number'))
                        <div class="text-red-500 text-sm">{{ $errors->first('phone_number') }}</div>
                    @endif
                </div>

                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Job :</span>
                    <select name="job_id" class="p-3 border rounded-md">
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" {{ $job->id == $applicant->job_id ? 'selected' : '' }}>
                                {{ $job->title }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('job_id'))
                        <div class="text-red-500 text-sm">{{ $errors->first('job_id') }}</div>
                    @endif
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Document :</span>
                    <a href="{{ Storage::url($applicant->document) }}" class="text-blue-500">download</a>
                    <input type="file" class="p-3 border rounded-md" name="document">
                </div>
            </div>
            <div class="flex border-t p-5 justify-end space-x-3">
                <a href="{{ url()->previous() }}" class="bg-red-300 py-3 px-5 rounded-md font-semibold">Cancel</a>
                <button class="bg-green-300 py-3 px-5 rounded-md font-semibold">Save</button>
            </div>
        </form>


    </div>
@endsection
