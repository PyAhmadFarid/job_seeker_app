@extends('template.admin')

@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">Export Data</div>
        {{-- <a href="{{ route('jobs.new') }}" class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New Applicant</a> --}}
    </div>
    <div class="flex flex-col space-y-5">
        <div class=" bg-white border rounded-lg ">
            <div class="p-5">
                <form action="{{ route('export.applicants') }}" method="POST" class="flex justify-between items-end">
                    @csrf
                    <div class="flex flex-col space-y-3">
                        <div class="font-semibold">Export data applicants</div>
                        <div class="flex space-x-5 items-center">
                            <div class="flex flex-col">
                                <span class="font-semibold">Job : </span>
                                <select name="job_id" class="p-3 border rounded-md" aria-label="job">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold">From date : </span>
                                <input name="from_date" class="p-3 border rounded-md" type="date">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold">To date : </span>
                                <input name="to_date" class="p-3 border rounded-md" type="date">
                            </div>
                        </div>
                    </div>
                    <button class="bg-blue-500 p-3 rounded text-white font-semibold">Export Excel</button>
                </form>
            </div>
        </div>



        <div class=" bg-white border rounded-lg ">
            <div class="p-5">
                <form action="{{route('export.jobs')}}" method="POST" class="flex justify-between items-end">
                    @csrf
                    <div class="flex flex-col space-y-3">
                        <div class="font-semibold">Export data Job</div>
                        <div class="flex space-x-5 items-center">

                            @if (auth()->user()->role == 0)
                                <div class="flex flex-col">
                                    <span class="font-semibold">Create by : </span>
                                    <select class="p-3 border rounded-md" name="create_by" id="">
                                        <option value="">all</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif



                            <div class="flex flex-col">
                                <span class="font-semibold">From date : </span>
                                <input class="p-3 border rounded-md" type="date" name="from_date">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold">To date : </span>
                                <input class="p-3 border rounded-md" type="date" name="to_date">
                            </div>
                        </div>
                    </div>
                    <button class="bg-blue-500 p-3 rounded text-white font-semibold">Export Excel</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#jobs').DataTable();
    </script>
@endsection
