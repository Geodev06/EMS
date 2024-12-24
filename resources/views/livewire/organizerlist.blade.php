<div class="row">
    <div class="col-lg-12">
        <h4>Organizer Accounts</h4>

    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered mg-b-0">
                <thead>
                    <tr>
                        <th>Unit no.</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($organizers as $dt)
                    <tr>
                        <th scope="row">{{ $dt->unit_no ?? '' }} </th>
                        <td>{{ $dt->email ?? '' }}</td>
                        <th>{{ $dt->active_flag == 'Y' ? 'Active' : 'Inactive' }}</th>

                        <td>
                            <div class="d-flex">
                                <button class="btn btn-success btn-icon mr-1" @click="$dispatch('edit', { id : {{ $dt->id }} } )">
                                    <i class="typcn typcn-pencil"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <th scope="row" colspan="4">No Data</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $organizers->links() }}
        </div>
    </div>


</div>