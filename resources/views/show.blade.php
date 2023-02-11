@extends('layouts.frontend')

@section('content')
<div class="grid grid-cols-5 mt-6 gap-4">
    <div class="col-span-3">
        <div class="p-4 rounded-lg bg-white shadow-soft">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Transaction Detail</p>
                <p class="text-sm text-primary font-medium">#{{ $detail->reference }}</p>
            </div>
            <div class="mt-3">
                <h3 class="text-3xl font-medium text-primary ">Rp. {{ number_format($detail->amount) }}</h3>
                {{-- <div class="text-xs px-2 py-1 rounded-full bg-green-200 inline-block mt-4    text-green-600 font-semibold">Paid</div> --}}
                <div class="text-xs px-2 py-1 rounded-full bg-red-200 inline-block mt-4  text-red-600 font-semibold">{{ $detail->status }}</div>
            </div>
        </div>
    </div>
    <div class="col-span-2">
        <div class="p-4 rounded-lg bg-white shadow-soft">
            <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Instruction</p>
            @foreach ($detail->instructions as $trx )
            <div tabindex="0" class="collapse mt-3">
                <div class="collapse-title font-medium">
                    <div class="flex items-center justify-between cursor-pointer">
                        <span class=" font-medium text-primary">
                            {{ $trx->title }}
                        </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="collapse-content">
                    <p class=" text-gray-500 ">
                        @foreach ($trx->steps as $item )
                            <li class=" text-gray-500 ">
                                {!! $item !!}
                            </li>
                        @endforeach
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

