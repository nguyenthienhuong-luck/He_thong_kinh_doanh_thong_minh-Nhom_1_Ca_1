<div class="modal fade" id="walletsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="walletsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-primary-color mb-0">Ví của tôi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mb-1 text-muted fw-bold">Tổng cộng số dư</h5>
                <div class="card rounded-4 border-primary-color shadow-none mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-start gap-3"
                            style="border-bottom-color: var(--primary-color) !important">
                            <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2" width="60"
                                alt="User Image">
                            <div class="d-flex flex-column justify-content-between">
                                <h4 class="m-0">
                                    Tổng cộng
                                </h4>
                                <h6 class="m-0 fw-medium">{{ $user->total_balance }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mb-1 text-muted fw-bold">Danh sách ví</h5>
                <div class="card rounded-4 border-primary-color shadow-none ">
                    <div class="card-body">
                        @foreach ($user->wallets as $wallet)
                            <div
                                class="d-flex align-items-center justify-content-between @if (!$loop->last) mb-4 @endif">
                                <div class="d-flex justify-content-start gap-3">
                                    <img src="{{ asset('images/icon.jpg') }}" class="img-circle elevation-2"
                                        width="60" alt="User Image">
                                    <div class="d-flex flex-column justify-content-between">
                                        <h4 class="m-0">
                                            {{ $wallet->name }}
                                        </h4>
                                        <h6 class="m-0 fw-medium">{{ $wallet->formatted_balance }}</h6>
                                    </div>
                                </div>
                                @if (!request()->routeIs('home.dashboard'))
                                    <div class="btn btn-lg btn-outline-primary-color" data-bs-toggle="modal"
                                        data-bs-target="#editWallet-{{ $wallet->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if (!request()->routeIs('home.dashboard'))
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-outline-primary-color w-100" data-bs-toggle="modal"
                        data-bs-target="#addWallet">
                        <i class="fa-solid fa-plus me-2"></i>Thêm ví
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
