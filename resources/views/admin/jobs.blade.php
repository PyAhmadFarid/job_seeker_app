@extends('template.admin')





@section('content')
    <div class="flex justify-between py-5">
        <div class=" font-bold text-2xl">Jobs Data</div>
        <a href="{{ route('jobs.new') }}" class=" bg-blue-500 py-2 px-4 font-semibold text-white  rounded-lg">

            + New jobs</a>
    </div>
    <div class=" bg-white border rounded-lg ">
        {{-- <div class="flex space-x-5 justify-end items-end p-5 border-b">
            <div>
                <div class=" font-medium">Title</div>
                <input placeholder="title" class="p-2 border rounded-md" />
            </div>
            <div>
                <div class=" font-medium">Years</div>
                <select class="p-2 border rounded-md">
                    <option value="">All</option>
                    <option value="">2001</option>
                    <option value="">2002</option>
                    <option value="">2003</option>
                    <option value="">2004</option>
                    <option value="">2005</option>
                </select>
            </div>
            <button class="py-3 px-4 bg-blue-100  rounded-lg font-semibold text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24">
                    <path fill="#1e40af"
                        d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z" />
                </svg>
            </button>
        </div> --}}
        <div class="p-5">
            <table class="w-full table-fix" id="jobs">
                <thead class=" border-b ">
                    <tr>

                        <th class=" text-left p-3">NO</th>
                        <th class=" text-left p-3">Title</th>
                        <th class=" text-left p-3">Create By</th>
                        <th class=" text-left p-3">Create Date</th>
                        <th class=" text-left p-3">Salary</th>
                        <th class=" text-left p-3">Description</th>
                        <th class=" text-left p-3">Applicant</th>
                        <th class=" text-left p-3">Status</th>
                        <th class="text-left p-3">...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $idx => $job)
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="p-3">{{ $idx + 1 }}</td>
                            <td class="p-3 font-medium">{{ $job->title }}</td>
                            <td class="p-3 font-medium">{{ $job->User->name }}</td>
                            <td class="p-3">{{ $job->created_at->year."-".$job->created_at->month."-".$job->created_at->day }}</td>
                            <td class="p-3">{{ $job->salary ? 'Rp ' . $job->salary : 'None' }}</td>
                            <td class="p-3 truncate" style="max-width: 10rem">{{ $job->desc }}</td>
                            <td class="p-3">{{ $job->Applicants->count() }}</td>
                            <td class="p-3">
                                @if ($job->status)
                                    <span class="text-blue-500">Active</span>
                                @else
                                    <span class="text-red-500">Inactive</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <div class=" flex space-x-3">
                                    <a href="{{ route('jobs.edit', ['jobid' => $job->id]) }}"
                                        class="p-3 bg-green-100 rounded-md">edit</a>
                                    <a href="{{ route('jobs.delete', ['jobid' => $job->id]) }}"
                                        class="p-3 bg-red-100 rounded-md">delete</a>
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
