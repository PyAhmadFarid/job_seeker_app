@extends('template.default')

@section('content')
    <div class="flex-1 flex justify-center bg-gray-100 ">
        <div class="bg-white w-2/3  flex flex-col">
            <div class="flex flex-col flex-1">
                <div class="flex justify-center">
                    <img class="" src="{{ asset('images/logofull.jpg') }}" alt="">
                </div>
                <div class="font-semibold text-5xl p-10">
                    Form Applicant for {{ $job->title }}
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col space-y-3 p-10">
                        <div class="flex flex-col space-y-3">
                            <span class=" font-semibold">Full Name</span>
                            <input type="text" class="p-3 border rounded-md" name="full_name">
                        </div>
                        <div class="flex flex-col space-y-3">
                            <span class=" font-semibold">Email</span>
                            <input type="text" class="p-3 border rounded-md" name="email">
                        </div>
                        <div class="flex flex-col space-y-3">
                            <span class=" font-semibold">Phone Number</span>
                            <input type="text" class="p-3 border rounded-md" name="phone_number" >
                        </div>
                        <div class="flex flex-col space-y-3">
                            <span class=" font-semibold">Document</span>
                            <span class="text-sm">*lampiran documen seperti cv/ijaza/dll</span>
                            <input type="file" class="p-3 border rounded-md" name="document" >
                        </div>

                    </div>
                    <div class="flex border-t justify-end space-x-3 p-10">
                        <a href="{{ redirect()->back()->getTargetUrl()}}" class="bg-red-300 py-3 px-5 rounded-md font-semibold">Cancel</a>
                        <button class="bg-green-300 py-3 px-5 rounded-md font-semibold">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
