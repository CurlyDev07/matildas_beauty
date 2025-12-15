@extends('admin.order-sources.layouts')

@section('content')
<div class="tmax-w-7xl tmx-auto tp-6">
    <!-- Header -->
    <div class="tflex tjustify-between titems-center tmb-6">
        <h1 class="ttext-2xl tfont-bold ttext-gray-900">Order Sources</h1>
        <a href="{{ route('order-sources.create') }}" class="tpx-4 tpy-2 tbg-pink-600 ttext-white trounded-lg hover:tbg-pink-700 ttransition-all">
            <i class="fas fa-plus tmr-2"></i> Add New Source
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="tbg-green-100 tborder tborder-green-400 ttext-green-700 tpx-4 tpy-3 trounded tmb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="tbg-red-100 tborder tborder-red-400 ttext-red-700 tpx-4 tpy-3 trounded tmb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Sources Table -->
    <div class="tbg-white trounded-lg tshadow-lg toverflow-hidden">
        <table class="tw-full">
            <thead class="tbg-gray-50">
                <tr>
                    <th class="tpx-6 tpy-3 ttext-left ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Source Name</th>
                    <th class="tpx-6 tpy-3 ttext-left ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Type</th>
                    <th class="tpx-6 tpy-3 ttext-left ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Description</th>
                    <th class="tpx-6 tpy-3 ttext-left ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Color</th>
                    <th class="tpx-6 tpy-3 ttext-center ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Status</th>
                    <th class="tpx-6 tpy-3 ttext-center ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Orders</th>
                    <th class="tpx-6 tpy-3 ttext-right ttext-xs tfont-medium ttext-gray-500 tuppercase ttracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="tbg-white tdivide-y tdivide-gray-200">
                @forelse($sources as $source)
                    <tr class="hover:tbg-gray-50">
                        <td class="tpx-6 tpy-4 twhitespace-nowrap">
                            <div class="tflex titems-center">
                                <span class="tw-4 th-4 trounded-full tmr-3" style="background-color: {{ $source->color }}"></span>
                                <span class="ttext-sm tfont-medium ttext-gray-900">{{ $source->name }}</span>
                            </div>
                        </td>
                        <td class="tpx-6 tpy-4 twhitespace-nowrap">
                            <span class="tpx-2 tpy-1 ttext-xs tfont-semibold trounded-full tbg-gray-100 ttext-gray-800 tcapitalize">
                                {{ $source->type }}
                            </span>
                        </td>
                        <td class="tpx-6 tpy-4 ttext-sm ttext-gray-600">
                            {{ Str::limit($source->description, 50) }}
                        </td>
                        <td class="tpx-6 tpy-4 twhitespace-nowrap">
                            <code class="ttext-xs tbg-gray-100 tpx-2 tpy-1 trounded">{{ $source->color }}</code>
                        </td>
                        <td class="tpx-6 tpy-4 twhitespace-nowrap ttext-center">
                            <form action="{{ route('order-sources.toggle', $source->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="tpx-3 tpy-1 ttext-xs tfont-semibold trounded-full {{ $source->is_active ? 'tbg-green-100 ttext-green-800' : 'tbg-red-100 ttext-red-800' }}">
                                    {{ $source->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="tpx-6 tpy-4 twhitespace-nowrap ttext-center ttext-sm ttext-gray-900">
                            {{ $source->orders->count() }}
                        </td>
                        <td class="tpx-6 tpy-4 twhitespace-nowrap ttext-right ttext-sm tfont-medium">
                            <a href="{{ route('order-sources.edit', $source->id) }}" class="ttext-blue-600 hover:ttext-blue-900 tmr-3">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('order-sources.destroy', $source->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this source?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ttext-red-600 hover:ttext-red-900">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="tpx-6 tpy-8 ttext-center ttext-gray-500">
                            No order sources found. <a href="{{ route('order-sources.create') }}" class="ttext-pink-600 hover:ttext-pink-800">Create one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection