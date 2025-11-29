<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')

        <!-- Main Content -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customers</h4>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered On</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($customers as $customer)
                            <tr>
                              <td>{{ $customer->id }}</td>
                              <td>{{ $customer->name }}</td>
                              <td>{{ $customer->email }}</td>
                              <td>{{ $customer->phone ?? 'N/A' }}</td>
                              <td>{{ $customer->created_at->format('M d, Y') }}</td>
                              <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="6" class="text-center">No customers found</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>

                    <div class="mt-3">
                      {{ $customers->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- content-wrapper ends -->

          <!-- Footer (اختياري لو عندك include للfooter) -->
          {{-- @include('admin.footer') --}}
        </div> <!-- main-panel ends -->
      </div> <!-- page-body-wrapper ends -->
    </div> <!-- container-scroller ends -->

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
