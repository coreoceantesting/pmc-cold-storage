@include('common.header')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>User</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <!--<li class="breadcrumb-item"><a href="{{ url('/ward_master') }}">Master</a></li>-->
                        <li class="breadcrumb-item active">User</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong style="text-transform: capitalize;">User Master List</strong></h2>
                        </div>
                        <div class="body">
                            <a class="btn btn-primary boxs-close" href="{{ route('user_master.create') }}" role="button">
                                <strong><i class="zmdi zmdi-plus"></i>&nbsp;&nbsp;Add User</strong>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable ">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
        									<th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>User Type</th>
        									<th>Edit</th>
                                            <th>Delete</th>
        								</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user_mst as $key => $value)
                                            <tr>
                                                <td><b>{{ $key+1 }}</b></td>
            									<td>{{ $value->name }} {{ $value->m_name }} {{ $value->l_name }}</td>
                                                <td>{{ $value->mobile_number }} </td>
                                                <td>{{ $value->email }} </td>

                                                <?php 

                                                $user_type = '';
                                                if($value->user_type == 1){
                                                      $user_type = 'Admin';
                                                }
                                                 if($value->user_type == 2){
                                                      $user_type = 'Veterinary';
                                                }
                                                if($value->user_type == 3){
                                                      $user_type = 'HOD';
                                                }


                                                ?>
                                                <td>{{ $user_type }} </td>
            									<td>
                                                    <a href="{{ route('user_master.edit', $value->id) }}"
                                                        class="btn btn-info waves-effect waves-float btn-sm waves-green">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                </td>
            
                                                <td>
                                                    <form action="{{ route('user_master.destroy', $value->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger waves-effect waves-float btn-sm waves-red" onclick="return confirm('Are you sure to delete?')">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
            
                                                </td>
            								</tr>
                                        @endforeach
                                    </tbody>
                                   <!--  <tfoot>
                                        <tr>
                                            <th>Sr. No.</th>
        									<th>Ward Name</th>
        									<th>Edit</th>
                                            <th>Delete</th>
        								</tr>
                                    </tfoot> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    function confirmation() {
        var result = confirm("Are you sure to delete?");
        if (result) {
            // Delete logic goes here
        }
    }
</script>
@include('common.footer')  