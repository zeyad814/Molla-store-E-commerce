@extends('admin.layouts.auth')

@section('adminContent')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Sales </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $orders }}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title">Products </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bag"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $products }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">


                <div class="card-body">
                  <h5 class="card-title">Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $users }}</h6>


                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Customers Card -->
            @if(Auth::guard('admin')->user()->type== 1)
                <div class="col-xxl-4 col-xl-12">

                <div class="card info-card customers-card">


                    <div class="card-body">
                    <h5 class="card-title">Brands</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $brands }}</h6>


                        </div>
                    </div>

                    </div>
                </div>
                </div><!-- End Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                <div class="card info-card customers-card">


                    <div class="card-body">
                    <h5 class="card-title">Categories</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-grid"></i>
                        </div>
                        <div class="ps-3">
                        <h6>{{ $categories }}</h6>
                        </div>
                    </div>

                    </div>
                </div>
                </div><!-- End Customers Card -->
            @endif
            @if(Auth::guard('admin')->user()->type== 2)
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Revenue <span>| Last Month</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3" for="data-1">
                        <h6>${{ number_format($lastMonth) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Revenue Card -->




            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Revenue <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3" for="data-1">
                        <h6>${{ number_format($thisMonth) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Revenue <span>| Total</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3" for="data-1">
                        <h6>${{ number_format($totalRevenue) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Revenue Card -->

            <!-- Top Selling -->
            @endif

            @if(Auth::guard('admin')->user()->type== 2)
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Top Selling </h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($topSelling as $best)
                        <tr>
                          <th scope="row"><a href="#"><img src="{{ asset('admin/assets/img/products') }}/{{ $best->product->main_image }}" alt=""></a></th>
                          <td><a href="{{ route('adminProduct',['search'=>$best->product->product_name]) }}" class="text-primary fw-bold">{{ $best->product->product_name }}</a></td>
                          <td>${{ $best->product->final_price }}</td>
                          <td class="fw-bold">{{ $best->product_qty }}</td>
                          <td>${{ $best->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->
            @endif
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            <!-- Website Traffic -->
            @if(Auth::guard('admin')->user()->type== 2)
            <div class="card">

                <div class="card-body pb-0">
                <h5 class="card-title">Website Revenue Traffic </h5>

                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                        trigger: 'item'
                        },
                        legend: {
                        top: '5%',
                        left: 'center'
                        },
                        series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [{
                            value: {{ $totalRevenue }},
                            name: 'Total'
                            },
                            {
                            value: 735,
                            name: 'Direct'
                            },
                            {
                            value: {{ $lastMonth }},
                            name: 'last Month'
                            },
                            {
                            value: {{ $thisMonth }},
                            name: 'This Month'
                            },
                            {
                            value: 300,
                            name: 'Last year'
                            }
                        ]
                        }]
                    });
                    });
                </script>

                </div>
            </div><!-- End Website Traffic -->
            @endif
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

@endsection
