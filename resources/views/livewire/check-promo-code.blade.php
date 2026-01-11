<div id="Promo" class="flex flex-col rounded-[20px] p-5 gap-5 bg-white overflow-hidden">
    <h2 class="font-bold text-xl leading-[30px]">Apply Promo</h2>
    <label class="flex flex-col gap-[10px]">
        <p class="font-semibold">Your Promo Code</p>
        <div class="flex items-center flex-nowrap gap-[10px]">
            <div
                class="flex items-center rounded-full border border-garuda-black py-3 px-5 gap-[10px] focus-within:border-[#0068FF] transition-all duration-300">
                <img src="{{ asset('assets/images/icons/receipt-discount-black.svg') }}" class="w-5 flex shrink-0" alt="icon">
                <input type="text" name="promo_code" id="promo_code"
                    class="appearance-none outline-none w-full font-semibold placeholder:font-normal"
                    placeholder="Input promo code"
                    wire:model.lazy="promo_code"
                    {{-- yang dilakukan ketika mengetikkan sesuatu --}}
                    wire:keyup="checkPromoCode"
                    >
                @if ($isValid)
                    <img src="{{ asset('assets/images/icons/verify.svg') }}" class="w-5 flex shrink-0" alt="icon">
                @endif
            </div>
            @if ($isValid)
                <span class="font-semibold text-garuda-green text-nowrap">Kode promo tersedia</span>
            @else
                <span class="font-semibold text-garuda-red text-nowrap">Kode promo tidak tersedia</span>
            @endif
        </div>
    </label>
</div>