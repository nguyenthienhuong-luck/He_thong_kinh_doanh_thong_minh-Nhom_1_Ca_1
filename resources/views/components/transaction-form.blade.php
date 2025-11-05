<div class="card rounded-3 border-primary-color shadow-none">
    <div class="card-body">
        <form id="formTransaction" method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                <div class="p-1 rounded-2 border border-secondary" style="min-width: 80px;">
                    <h5 class="h5 text-center m-0">{{ Auth::user()->currency }}</h5>
                </div>
                <input type="number" name="amount" id="amount" class="form-control form-control-lg shadow-none"
                    value="0" min="0" onfocus="if(this.value=='0'){this.value=''}"
                    onblur="if(this.value==''){this.value='0'}">
            </div>
            <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2" width="60" alt="User Image"
                    style="min-width: 80px;">
                <input type="hidden" name="category_id" id="category_id" value="default">
                <button type="button" id="categorySelector" class="form-control form-control-lg text-start shadow-none"
                    data-bs-toggle="modal" data-bs-target="#selectCategory">
                    <span id="selectedCategoryText">Chọn nhóm</span>
                </button>
            </div>

            <!-- Rest of the form remains the same -->
            <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                <div class="p-1" style="min-width: 80px;">
                    <div class="h4 text-center m-0"><i class="fa-solid fa-note-sticky"></i></div>
                </div>
                <textarea name="note" id="note" class="form-control form-control-lg shadow-none" rows="2"
                    placeholder="Ghi chú"></textarea>
            </div>
            <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                <div class="p-1" style="min-width: 80px;">
                    <div class="h4 text-center m-0"><i class="fa-solid fa-calendar"></i></div>
                </div>
                <input type="date" name="date" id="date" class="form-select form-select-lg shadow-none"
                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
            <div class="form-group d-flex justify-content-center align-items-center gap-3 mb-3">
                <div class="p-1" style="min-width: 80px;">
                    <div class="h4 text-center m-0"><i class="fa-solid fa-wallet"></i></div>
                </div>
                <select name="wallet_id" id="wallet_id" class="form-select form-select-lg shadow-none">
                    @foreach ($user->wallets as $wallet)
                        <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
