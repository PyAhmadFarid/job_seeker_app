@extends('template.admin')

@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">
            @if (Route::current()->getName() == 'jobs.new')
                New Jobs
            @else
                Edit Jobs
            @endif


        </div>
        {{-- <button class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New jobs</button> --}}
    </div>
    <div class=" bg-white border rounded-lg ">

        <form action="" method="POST">
            @csrf
            <div class="flex flex-col space-y-3 p-5">
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Job Title :</span>
                    <input type="text" class="p-3 border rounded-md" name="title" value="{{ $job->title ?? '' }}">
                    @if ($errors->has('title'))
                        <div class="text-red-500 text-sm">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Job Description :</span>
                    <textarea class="p-3 border rounded-md" name="desc" value="">{{ $job->desc ?? '' }}</textarea>
                    @if ($errors->has('desc'))
                        <div class="text-red-500 text-sm">{{ $errors->first('desc') }}</div>
                    @endif
                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">Salary :</span>
                    <input type="number" class="p-3 border rounded-md" name="salary" value="{{ $job->salary ?? '' }}">

                </div>
                <div class="flex flex-col space-y-3">
                    <span class=" font-semibold">End Date :</span>
                    <input type="date" class="p-3 border rounded-md" name="end_date" value="{{ $job->end_date ?? '' }}">
                    @if ($errors->has('end_date'))
                        <div class="text-red-500 text-sm">{{ $errors->first('end_date') }}</div>
                    @endif
                </div>
                <div class="flex items-center  space-x-3">
                    <span class=" font-semibold">Status :</span>
                    <input type="checkbox" class="p-3 border rounded-md" name="status"
                        {{ isset($job->status) ? ($job->status ? 'checked' : '') : 'checked' }}>
                </div>
            </div>
            <div class="flex border-t p-5 justify-end space-x-3">
                <a href="{{ route('jobs') }}" class="bg-red-300 py-3 px-5 rounded-md font-semibold">Cancel</a>
                <button class="bg-green-300 py-3 px-5 rounded-md font-semibold">Save</button>
            </div>
        </form>


    </div>
@endsection
