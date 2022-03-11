@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Dashboard</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>
    <div class="  flex justify-between space-x-10">
        <div class="bg-green-100 flex-1 p-5 rounded-lg">
            <div class="flex items-center space-x-4"> <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 24 24">
                    <path fill="#14532d"
                        d="M19,6.5H16v-1a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v1H5a3,3,0,0,0-3,3v9a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3v-9A3,3,0,0,0,19,6.5Zm-9-1a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1v1H10Zm10,13a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V13.45H7V14.5a1,1,0,0,0,2,0V13.45h6V14.5a1,1,0,0,0,2,0V13.45h3Zm0-7H4V9.5a1,1,0,0,1,1-1H19a1,1,0,0,1,1,1Z" />
                </svg>
                <span class=" font-semibold text-green-900">Jobs total</span>
            </div>
            <div class=" font-semibold text-green-900 text-4xl py-6">{{$joball}}</div>
            <span class=" text-green-900 "> {{$jobpercen}}% Jobs active</span>

        </div>
        <div class="bg-purple-100 flex-1 p-5 rounded-lg">
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 24 24">
                    <path fill="#581c87"
                        d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z" />
                </svg>
                <span class=" font-semibold text-purple-900">Applicants total</span>
            </div>
            <div class=" font-semibold text-purple-900 text-4xl py-6">{{$applicantall}}</div>
            {{-- <span class=" text-purple-900"> 5% Applicants accepted</span> --}}

        </div>
        <div class=" bg-amber-100 flex-1 p-5 rounded-lg">
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" data-name="Layer 1" viewBox="0 0 24 24">
                    <path fill="#713f12"
                        d="M12,2A10,10,0,0,0,4.65,18.76h0a10,10,0,0,0,14.7,0h0A10,10,0,0,0,12,2Zm0,18a8,8,0,0,1-5.55-2.25,6,6,0,0,1,11.1,0A8,8,0,0,1,12,20ZM10,10a2,2,0,1,1,2,2A2,2,0,0,1,10,10Zm8.91,6A8,8,0,0,0,15,12.62a4,4,0,1,0-6,0A8,8,0,0,0,5.09,16,7.92,7.92,0,0,1,4,12a8,8,0,0,1,16,0A7.92,7.92,0,0,1,18.91,16Z" />
                </svg>
                <span class=" font-semibold text-yellow-900">Users total</span>
            </div>
            <div class=" font-semibold text-yellow-900 text-4xl py-6">{{$user}}</div>
            <span class=" text-yellow-900 "> {{$usersuper}} Super admin</span>

        </div>
    </div>
    <div class="flex justify-between space-x-10 py-10">
        <div class=" rounded-xl border flex-1 bg-white p-5">
            <span class=" font-semibold">Jobs in years {{$year}}</span>
            <div class="py-5">
                <canvas id='job' class=" w-full">
            </div>
        </div>
        <div class=" rounded-xl border flex-1 bg-white p-5">
            <span class=" font-semibold">Applicants in years {{$year}}</span>
            <div class="py-5">
                <canvas id='applicant' class=" w-full">
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        const ctx = document.getElementById('job').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Jobs',
                    data: {{$ctbr}},
                    fill: false,
                    borderColor: 'rgb(34, 197, 94)',
                    tension: 0.1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        const ctx2 = document.getElementById('applicant').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'line',
            responsive:true,
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    label: 'Jobs',
                    data: {{$apbsr}},
                    fill: false,
                    borderColor: 'rgb(168, 85, 247)',
                    tension: 0.1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
