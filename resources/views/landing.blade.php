@extends('template.default')

@section('head')
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <link href="{{ asset('css/splide.min.css') }}" rel="stylesheet">
@endsection

@section('black')
    <div x-data="{'active':{{session('message')?'true':'false'}}}" x-show='active' class="fixed w-screen h-screen z-10 bg-black bg-opacity-20">
        <div class="flex w-full h-full justify-center items-center">
            <div class="bg-white  rounded-md flex flex-col">
                <span class="font-semibold text-xl p-5">
                    {{session('message')??'no message'}}
                </span>
                <div class="p-5 border-t flex justify-end">
                    <button x-on:click='active=false' class="font-semibold bg-blue-500 text-white p-3 rounded">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="flex flex-1 pb-5 flex-col bg-gray-100 space-y-5 items-center">
        <div class="splide w-2/3">
            <div class="splide__track">
                <ul class="splide__list ">
                    <li class="splide__slide flex items-start justify-center overflow-hidden h-96">
                        <img class="w-full" src="{{ asset('images/image0.jpg') }}" alt="">
                    </li>
                    <li class="splide__slide flex items-center justify-center overflow-hidden h-96">
                        <img class="w-full" src="{{ asset('images/image1.jpg') }}" alt="">
                    </li>
                    <li class="splide__slide flex items-center justify-center overflow-hidden h-96">
                        <img class="w-full" src="{{ asset('images/image2.jpg') }}" alt="">
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-1 flex-col items-center bg-white space-y-5 pb-20">
            <div class="w-full text-center text-3xl font-semibold py-20">Job Search</div>
            <div class=" w-1/2">
                <form action="" class="flex space-x-3">
                    <input type="text" name="search" id="" value="{{ Request::get('search') }}"
                        class="p-3 border rounded flex-1" placeholder="Job name">
                    <button class="bg-blue-500 p-3 rounded-md font-semibold text-white">Search</button>
                </form>
            </div>
            <div class="grid grid-cols-3 w-2/3 gap-5 pt-3 ">
                @foreach ($jobs as $job)
                    <div class="bg-white rounded-md shadow border flex flex-col space-y-3">
                        <div class="flex-1 flex flex-col space-y-3 p-5 ">
                            <div>
                                <img src="{{ asset('images/logofull.jpg') }}" alt="">
                            </div>
                            <div class="font-semibold text-xl">{{ $job->title }}</div>
                            @if ($job->salary)
                                <span>Rp {{ $job->salary }}</span>
                            @endif
                            <p class=" truncate">{{ $job->desc }}</p>
                        </div>
                        <div class="flex justify-end items-center space-x-3 p-5 border-t">

                            <a class="text-blue-500" href="{{ route('jobDetail', ['jobid' => $job->id]) }}">Detail</a>
                            <a class="bg-green-100 font-semibold p-3 rounded-md text-green-900"
                                href="{{ route('jobForm', ['jobid' => $job->id]) }}">Apply</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class=" py-3 flex flex-col items-center w-full">
                    @foreach ($jobs as $job)
                    <div class="bg-white py-5 px-10 rounded-md flex justify-between shadow border m-3 items-center w-1/2">
                        <span>{{$job->title}}</span>
                        <a href="" class="bg-green-200 p-3 rounded-md font-semibold">Detail</a>
                    </div>
                    @endforeach
                </div> --}}

            {{-- <div></div> --}}
            <div class="w-1/2 p-3 flex flex-wrap justify-center">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        new Splide('.splide').mount();
    </script>
@endsection
