@extends('template.admin')

@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">Applicant Data</div>
        {{-- <a href="{{ route('jobs.new') }}" class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New Applicant</a> --}}
    </div>
    <div class=" bg-white border rounded-lg ">
        <div class="p-5">
            <table class="w-full table-fix" id="jobs">
                <thead class=" border-b ">
                    <tr>

                        <th class=" text-left p-3">NO</th>
                        <th class=" text-left p-3">Name</th>
                        <th class=" text-left p-3">Email</th>
                        <th class=" text-left p-3">Job</th>
                        <th class=" text-left p-3">Apply date</th>
                        <th class="text-left p-3">Document</th>
                        @if (auth()->user()->role == 0)
                            <th class="text-left p-3">...</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $idx => $applicant)
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="p-3">{{ $idx + 1 }}</td>
                            <td class="p-3 font-medium">{{ $applicant->full_name }}</td>
                            <td class="p-3 font-medium">{{ $applicant->email }}</td>
                            <td class="p-3">{{ $applicant->job->title }}</td>
                            <td class="p-3">{{ $applicant->created_at }}</td>
                            <td class="p-3">
                                <a class="text-blue-500" href="{{ Storage::url($applicant->document) }}">download</a>
                            </td>

                            @if (auth()->user()->role == 0)
                                <td>
                                    <div class=" flex space-x-3">
                                        <a href="{{ route('applicants.edit', ['applicantid' => $applicant->id]) }}"
                                            class="p-3 bg-green-100 rounded-md">edit</a>
                                        <a href="{{ route('applicants.delete', ['applicantid' => $applicant->id]) }}"
                                            class="p-3 bg-red-100 rounded-md">delete</a>
                                        {{-- <button class="p-3 bg-red-100 rounded-md">delete</button> --}}
                                    </div>
                                </td>
                            @endif

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
