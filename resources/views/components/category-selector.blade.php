<div class="modal-header">
    <h1 class="text-primary-color fw-bold fs-5 m-0" id="addTransactionLabel">Chọn nhóm</h1>
    <button type="button" class="btn-close" data-bs-target="#addTransaction" data-bs-toggle="modal"
        aria-label="Close"></button>
</div>

<div class="modal-body">
    <!-- Tabs -->
    <div class="tab-navigation-wrapper">
        <ul class="nav nav-pills nav-fill mb-3 bg-body-secondary rounded-3 p-2" id="categoryTabs" role="tablist">
            @foreach ($groupTypes->where('name', 'Khoản chi') as $groupType)
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                        id="tab-{{ $groupType->group_type_id }}"
                        data-bs-toggle="tab"
                        data-bs-target="#content-{{ $groupType->group_type_id }}"
                        type="button" role="tab">
                        {{ $groupType->name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tab Contents -->
    <div class="tab-content">
        @foreach ($groupTypes->where('name', 'Khoản chi') as $groupType)
            <div class="tab-pane fade show active"
                id="content-{{ $groupType->group_type_id }}" role="tabpanel">
                <div class="row g-3">
                    @foreach ($categories->where('group_type_id', $groupType->group_type_id) as $category)
                        <div class="col-md-6">
                            <button type="button"
                                class="category-item btn btn-outline-primary-color w-100 text-start p-3"
                                data-category-id="{{ $category->id }}"
                                data-category-name="{{ $category->name }}"
                                data-bs-target="#addTransaction"
                                data-bs-toggle="modal">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($category->icon)
                                        {!! \App\Helpers\IconHelper::addClasses($category->icon, 'text-dark fs-4') !!}
                                    @else
                                        <i class="text-dark fas fa-envelope fs-4"></i>
                                    @endif
                                    <span>{{ $category->name }}</span>
                                </div>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
