@extends('Layoutss.master')
@section('content')

<div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">

            <tr>
                <th scope="col" class="py-3 px-6">
                    Name
                </th>
                <th scope="col" class="py-3 px-6">
                    Email
                </th>
                <th scope="col" class="py-3 px-6">
                    Phone number
                </th>
                <th scope="col" class="py-3 px-6">
                    Job title & company
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
            <tr class="bg-white border-b ">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                    {{$contact->firstName}}
                </th>
                <td class="py-4 px-6">
                    {{$contact->email}}
                </td>
                <td class="py-4 px-6">
                    {{$contact->phone}}
                </td>
                <td class="py-4 px-6">

                </td>
            </tr>
            @empty

            @endforelse


        </tbody>
    </table>
</div>


@endsection
