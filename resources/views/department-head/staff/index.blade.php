@extends('layouts.app')

@section('title', __('department-head.staff_information'))

@section('content')
    <div class="space-y-6">
        <div class="cu-card-header">
            <div>
                <h2 class="cu-page-title">{{ __('department-head.staff_information') }}</h2>
                <p class="cu-muted mt-1">{{ __('department-head.staff_information_subtitle') }}</p>
            </div>
        </div>

        <div class="cu-table-wrap overflow-x-auto">
            <table class="cu-table">
                <thead>
                    <tr>
                        <th>{{ __('common.number') }}</th>
                        <th>
                            <a href="{{ route('department-head.staff.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                               class="inline-flex items-center gap-1 hover:text-primary-600">
                                {{ __('common.name') }}
                                <span class="inline-flex flex-col leading-none">
                                    <span class="{{ $sort === 'name' && $direction === 'asc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▲</span>
                                    <span class="{{ $sort === 'name' && $direction === 'desc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▼</span>
                                </span>
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('department-head.staff.index', array_merge(request()->query(), ['sort' => 'staff_id', 'direction' => $sort === 'staff_id' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                               class="inline-flex items-center gap-1 hover:text-primary-600">
                                {{ __('common.staff_id') }}
                                <span class="inline-flex flex-col leading-none">
                                    <span class="{{ $sort === 'staff_id' && $direction === 'asc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▲</span>
                                    <span class="{{ $sort === 'staff_id' && $direction === 'desc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▼</span>
                                </span>
                            </a>
                        </th>
                        <th>{{ __('common.email') }}</th>
                        <th>
                            <a href="{{ route('department-head.staff.index', array_merge(request()->query(), ['sort' => 'position', 'direction' => $sort === 'position' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                               class="inline-flex items-center gap-1 hover:text-primary-600">
                                {{ __('common.position') }}
                                <span class="inline-flex flex-col leading-none">
                                    <span class="{{ $sort === 'position' && $direction === 'asc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▲</span>
                                    <span class="{{ $sort === 'position' && $direction === 'desc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▼</span>
                                </span>
                            </a>
                        </th>
                        <th>{{ __('common.phone') }}</th>
                        <th>
                            <a href="{{ route('department-head.staff.index', array_merge(request()->query(), ['sort' => 'role', 'direction' => $sort === 'role' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                               class="inline-flex items-center gap-1 hover:text-primary-600">
                                {{ __('common.staff_role') }}
                                <span class="inline-flex flex-col leading-none">
                                    <span class="{{ $sort === 'role' && $direction === 'asc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▲</span>
                                    <span class="{{ $sort === 'role' && $direction === 'desc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▼</span>
                                </span>
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('department-head.staff.index', array_merge(request()->query(), ['sort' => 'is_active', 'direction' => $sort === 'is_active' && $direction === 'asc' ? 'desc' : 'asc'])) }}"
                               class="inline-flex items-center gap-1 hover:text-primary-600">
                                {{ __('common.status') }}
                                <span class="inline-flex flex-col leading-none">
                                    <span class="{{ $sort === 'is_active' && $direction === 'asc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▲</span>
                                    <span class="{{ $sort === 'is_active' && $direction === 'desc' ? 'text-primary-600 font-bold' : 'text-slate-400' }}">▼</span>
                                </span>
                            </a>
                        </th>
                        <th>{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $member)
                        <tr>
                            <td>{{ config('app.locale') == 'my' ? my_number($staff->firstItem() + $loop->index) : $staff->firstItem() + $loop->index }}</td>
                            <td class="primary">
                                <div class="flex items-center gap-2">
                                    @if($member->profile_image)
                                        <img src="{{ asset('storage/' . $member->profile_image) }}" alt="{{ $member->name }}" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    {{ app()->getLocale() == 'my' ? $member->name_mm ?? $member->name : $member->name }}
                                </div>
                            </td>
                            <td>{{ $member->staff_id ? $member->staff_id : __('common.n_a') }}</td>
                            <td>{{ $member->email }}</td>
                            <td>
                                {{ app()->getLocale() == 'my' ? $member->position_mm ?? $member->position : $member->position ?? $member->position_mm ?? __('common.n_a') }}
                            </td>
                            <td>{{ my_phone($member->phone) }}</td>
                            <td>
                                <span @class([
                                    'cu-badge-admin' => $member->role === 'admin',
                                    'cu-badge-info' => $member->role === 'department_head',
                                    'cu-badge-neutral' => $member->role === 'staff',
                                ])>
                                    {{ __('common.role.' . $member->role) }}
                                </span>
                            </td>
                            <td>
                                <span @class([
                                    'cu-badge-success' => $member->is_active,
                                    'cu-badge-danger' => !$member->is_active,
                                ])>
                                    {{ $member->is_active ? __('common.staff.active') : __('common.staff.inactive') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('department-head.staff.show', $member) }}"
                                    class="cu-btn-secondary !px-3 !py-1.5 !rounded-full text-xs">{{ __('common.view') }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-slate-500 py-8">{{ __('common.no_data') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staff->hasPages())
            <div class="mt-4">
                {{ $staff->links() }}
            </div>
        @endif
    </div>
@endsection
