@php
    $data = App\Models\Hero::all()->count('name');
    $price = App\Models\Hero::all()->sum('price');


    @endphp

<div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="mb-2 text-dark font-weight-normal">Cash Income</h5>
        <h2 class="mb-4 text-dark font-weight-bold">{{ $price }}</h2>
        <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i></div>
        <p class="mt-4 mb-0">Completed</p>
        <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{$data}}</h3>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="mb-2 text-dark font-weight-normal">Unique Visitors</h5>
        <h2 class="mb-4 text-dark font-weight-bold">{{ $data }}</h2>
        <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
        <p class="mt-4 mb-0">Increased since yesterday</p>
        <h3 class="mb-0 font-weight-bold mt-2 text-dark">50%</h3>
      </div>
    </div>
  </div>
  <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="mb-2 text-dark font-weight-normal">Impressions</h5>
        <h2 class="mb-4 text-dark font-weight-bold">0</h2>
        <div class="dashboard-progress dashboard-progress-3 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-eye icon-md absolute-center text-dark"></i></div>
        <p class="mt-4 mb-0">Increased since yesterday</p>
        <h3 class="mb-0 font-weight-bold mt-2 text-dark">0%</h3>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="mb-2 text-dark font-weight-normal">Followers</h5>
        <h2 class="mb-4 text-dark font-weight-bold">0</h2>
        <div class="dashboard-progress dashboard-progress-4 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-cube icon-md absolute-center text-dark"></i></div>
        <p class="mt-4 mb-0">Decreased since yesterday</p>
        <h3 class="mb-0 font-weight-bold mt-2 text-dark">0%</h3>
      </div>
    </div>
  </div>
</div>
