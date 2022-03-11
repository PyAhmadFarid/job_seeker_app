@extends('template.default')

@section('content')
    <div class="flex-1 flex justify-center bg-gray-100 ">
        <div class="bg-white w-2/3  flex flex-col">
            <div class="flex flex-col p-10 space-y-5 flex-1">
                <div class="flex justify-center">
                    <img class="" src="{{ asset('images/logofull.jpg') }}" alt="">
                </div>
                <div class="font-semibold text-5xl">
                    {{ $job->title }}
                </div>
                @if ($job->salary)
                    <div>
                        <span class="font-semibold">
                            Salary :</span> Rp {{ $job->salary }}
                    </div>
                @endif
                <div>
                    <span class="font-semibold">End Date for apply : </span>
                    {{$job->end_date}}
                </div>
                <div>
                    <span class="font-semibold">Description : </span>
                    <p>{{ $job->desc }}</p>
                </div>
            </div>
            <div class="p-10 border-t flex justify-end">
                <a class="bg-green-100 font-semibold p-3 rounded-md text-green-900" href="{{route('jobForm',['jobid'=>$job->id])}}">Apply</a>
            </div>
        </div>
    </div>
@endsection
