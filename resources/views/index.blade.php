@extends('layouts.head')
@section('body')
    <div class="bg-blue-500 h-screen w-3/12 p-3 absolute">
        <h1 class="mx-auto mb-10 p-3 text-6xl w-fit">To Do List</h1>

        <form action="{{ route('saveItem') }}" method="post">
            {{ csrf_field() }}
            <input class="mx-auto mb-3 p-1 rounded w-full" type="text" name="what" id="what"
                placeholder="What are you going to do?" required>
            <label for="deadline">When do you want this to be done?</label>
            <input class="mx-auto mb-3 p-1 rounded w-full" type="date" name="deadline" id="deadline" value="{{now()->format('Y-m-d')}}" required>
            <button class="bg-blue-300 hover:bg-blue-200 rounded p-2 font-semibold float-right"
                type="submit">Submit</button>
        </form>
    </div>
    <div class="w-9/12 inline-block absolute right-0 p-4">
        <table class="table-auto w-full">
            <thead class="bg-slate-400">
                <th class="border border-slate-900 px-4">Name</th>
                <th class="border border-slate-900 px-4">Deadline</th>
                <th class="border border-slate-900 px-4">Status</th>
            </thead>
            <tbody>
                @foreach ($listItems as $listItem)
                    <tr class="odd:bg-blue-300 hover:bg-blue-600">
                        <td class="border border-slate-900 px-4">{{ $listItem->name }}</td>
                        <td class="border border-slate-900 px-4">{{ Carbon\Carbon::parse($listItem->deadline)->translatedFormat('d F Y') }}</td>
                        <td
                            class="border border-slate-900 px-4 {{ $listItem->is_complete == 0 ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ $listItem->is_complete == 0 ? 'Not Done' : 'Done ('.Carbon\Carbon::parse($listItem->updated_at)->translatedFormat('d F Y - H:i').')' }}
                            @if ($listItem->is_complete == 0)
                                <form action="{{ route('markComplete', $listItem->id) }}" method="post" class="inline-block">
                                    {{ csrf_field() }}
                                    <button type="submit"
                                        class="bg-blue-300 hover:bg-blue-400 rounded my-2 p-2 text-xs">Mark As Done</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{now()->format('Y-m-d')}}
    </div>
@endsection
